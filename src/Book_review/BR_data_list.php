<?php require 'BR__connect_db.php';
$page_name = 'BR_datalist';
$page_title = '書評人資料總表';

?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
</style>
<?php require '__html_head.php'; ?>
<?php include __DIR__ . '/__html_body.php' ?>
<?php include '../../pbook_index/__navbar.php' ?>

<div class="d-flex flex-row my_content">
    <!-- 右邊section資料欄位 -->
    <section>
        <div class="container">
            <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
                <div>
                    <h4>書評人總表</h4>
                    <div class="title_line"></div>
                </div>
                <ul class="nav justify-content-between">
                    <li class="nav-item">
                        <div style="padding: 0.375rem 0.75rem;">
                            <i class="fas fa-check"></i>
                            目前總計 <span id="search_total"> <span id="total_list"></span> </span> 筆資料
                        </div>
                    </li>
                    <li class="nav-item" style="margin: 0px 10px">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" onclick="location.href='BR_insert.php'">
                            <i class="fas fa-plus-circle"></i>
                            新增書評人
                        </button>
                    </li>
                    <li class="nav-item" style="flex-grow: 1">
                        <form class="form-inline my-2 my-lg-0">
                            <input id="BR_search" class="search form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button id="BR_search_btn" class="btn btn-outline-warning my-2 my-sm-0" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- 每個人填資料的區塊 -->
            <div style="margin-top: 1rem">

                <table id="my_data" class="table table-striped table-bordered" style="text-align: center ; width:80vw">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="" id="chooseAll"></th>
                            <th scope="col">#</th>
                            <th scope="col">姓名</th>
                            <th scope="col">電話</th>
                            <th scope="col">信箱</th>
                            <th scope="col">地址</th>
                            <th scope="col">性別</th>
                            <th scope="col">生日</th>
                            <th scope="col">工作</th>
                            <th scope="col">修改</th>
                            <th scope="col">刪除</th>
                        </tr>
                    </thead>
                    <tbody id="data_page">
                    </tbody>
                </table>
            </div>
            <div>
                <button type="button" class="btn btn-warning choose_btn">批次刪除</button>
            </div>
            <!-- 我是分頁按鈕列 請自取並調整頁面擺放位置 -->
            <nav aria-label="Page navigation example" class="d-flex justify-content-center" id="list_page">
                <ul class="pagination">
                </ul>
            </nav>


            <!-- 刪除提示框 -->
            <div id="d_window" class="delete update card" style="display:none;">
                <div class="delete card-body">
                    <label class="delete_text">您確認要刪除資料嗎?</label>
                    <div>
                        <button type="button" class="delete btn btn-danger delete_enter"> 確認</button>
                        <button type="button" class="delete btn btn-warning delete_cancel">取消</button>
                    </div>
                </div>
            </div>

    </section>
</div>

<script>
    //---------------刪除jquery-----------------------
    // $('.d_button').click(function() {
    //     $('#d_window').css('display', 'block')

    //     let sid = $(this).closest('tr').children().eq(1).text()

    //     $('.delete_enter').click(function() {
    //         location.href = 'BR_delete.php?sid=' + sid;
    //     })
    //     $('.delete_cancel').click(function() {
    //         location.href = window.location.href;
    //     })
    // })

    //-----------------批次刪除jquery----------------------------------
    $('#chooseAll').click(function() {
        let checked = $(this).prop('checked')
        $('tbody :checkbox').prop('checked', checked)

        $('.td_sid').each(function() {
            let asa = $(this).text()
            let ar = []
            let i = ar.push(asa)

            console.log(ar)
        })
    })


    $('tbody :checkbox').click(function() {
        var sid = $(this).closest('tr').children().eq(1).text()
        var checkCount = $('tbody :checked').length
        console.log(checkCount)
        console.log(sid)
        // $('.choose_btn').click(function() {

        //     location.href = 'BR_delete.php?sid=' + sid;
        // })
    })


    //----------------ajax資料-------------------------------------
    function datalist(list) {
        let tbody = document.querySelector('#data_page');
        let total_list = document.querySelector('#total_list');
        let list_page = document.querySelector('#list_page')
        let html = '';
        for (let i = 0; i < list.length; i++) {
            html += '<tr>';
            html += '<td> <input type="checkbox" name="" id=""> </td>';
            html += '<td>' + list[i].sid + '</td>';
            html += '<td>' + list[i].BR_name + '</td>';
            html += '<td>' + list[i].BR_phone + '</td>';
            html += '<td>' + list[i].BR_email + '</td>';
            html += '<td>' + list[i].BR_address + '</td>';
            html += '<td>' + list[i].BR_gender + '</td>';
            html += '<td>' + list[i].BR_birthday + '</td>';
            html += '<td>' + list[i].BR_job + '</td>';
            html += '<td><a href="BR_update.php?sid=' + list[i].sid + '"><i class="fas fa-edit"></i></a></td>';
            html += '<td><a href="javascript:(' + list[i].sid + ')"><i class="fas fa-trash-alt d_button"></i></a></td>';
            html += '</tr>';
        }
        total_list.innerHTML = list.length
        tbody.innerHTML = html;


        let list_row = 10 //每頁筆數
        let total_page = Math.ceil(list.length / list_row); //分頁數量

        //產生分頁迴圈
        for (let p = 1; p <= total_page; p++) {
            $('.pagination').append('<li data-page="' + p + '" class="page-item"> ' +
                '<button class="page-link pagination_btn"  color: #ffffff">' + [p] + '</button>' + '</li>')
        }


        //點擊分頁鈕後 顯示所需要筆數
        $('.pagination li').on('click', function() {
            let pageNum = $(this).attr('data-page')
            console.log(pageNum)
            let trIndex = 0;
            $('tbody tr').each(function() {
                trIndex++
                var ax = $(this).text()
                console.log(ax)
                if (trIndex > (list_row * pageNum) || trIndex <= ((list_row * pageNum) - list_row)) {
                    $(this).hide()
                } else {
                    $(this).show()
                }
            })
        })


        $('.d_button').click(function() {
            $('#d_window').css('display', 'block')

            let sid = $(this).closest('tr').children().eq(1).text()

            $('.delete_enter').click(function() {
                location.href = 'BR_delete.php?sid=' + sid;
            })
            $('.delete_cancel').click(function() {
                location.href = window.location.href;
            })
        })
    }








    //----------------搜尋後觸發function 連接ajax資料----------------
    function renderBooks(books) {
        var tbody = document.getElementById('data_page');
        var search_total = document.getElementById('search_total');
        var html = '';
        for (var i = 0; i < books.length; i++) {
            html += '<tr>';
            html += '<td> <input type="checkbox" name="" id=""> </td>';
            html += '<td>' + books[i].sid + '</td>';
            html += '<td>' + books[i].BR_name + '</td>';
            html += '<td>' + books[i].BR_phone + '</td>';
            html += '<td>' + books[i].BR_email + '</td>';
            html += '<td>' + books[i].BR_address + '</td>';
            html += '<td>' + books[i].BR_gender + '</td>';
            html += '<td>' + books[i].BR_birthday + '</td>';
            html += '<td>' + books[i].BR_job + '</td>';
            html += '<td><a href="BR_update.php?sid=' + books[i].sid + '"><i class="fas fa-edit"></i></a></td>';
            html += '<td><a href="javascript:(' + books[i].sid + ')"><i class="fas fa-trash-alt d_button"></i></a></td>';
            html += '</tr>';
        }
        tbody.innerHTML = html;
        search_total.innerHTML = books.length
        
        $('.d_button').click(function() {
            $('#d_window').css('display', 'block')

            let sid = $(this).closest('tr').children().eq(1).text()

            $('.delete_enter').click(function() {
                location.href = 'BR_delete.php?sid=' + sid;
            })
            $('.delete_cancel').click(function() {
                location.href = window.location.href;
            })
        })
    }

    //------------------input 輸入觸發---------------------------------------------------------

    $('#BR_search').keyup(function() {
        search()
    })

    //------------------AJAX 資料列表----------------------------------------------------------

    $.ajax({
            method: "POST",
            url: "./BR_data_list_api.php", //進api
        })

        .done(function(msg) {
            var list = JSON.parse(msg);
            console.log(list);
            datalist(list)
        });
    //------------------Ajax搜尋功能-----------------------------------------------------------

    var searchItem = document.querySelector('#BR_search'); //取ID
    function search() {
        //取得搜尋字串
        if (searchItem.value != '') {
            $.ajax({
                    method: "POST",
                    url: "./BR_search_api.php", //進api
                    data: {
                        search: searchItem.value
                    }
                })

                .done(function(msg) {
                    var books = JSON.parse(msg);
                    console.log(books);
                    renderBooks(books);
                });
        }
        //ajax
        else {
            location.href = window.location.href;
        }
    }
</script>
<?php require '__html_foot.php'; ?>