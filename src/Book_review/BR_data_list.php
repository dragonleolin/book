<?php require 'BR__connect_db.php';
$page_name = 'BR_datalist';
$page_title = '書評人資料總表';
?>
<style>
body {
    background: url(../../images/bg.png) repeat center top;
}

button:active {
    background: #aec
}
</style>
<?php require '__html_head.php'; ?>
<?php require '__html_body.php' ?>
<?php include '../../pbook_index/__navbar.php' ?>

<div class="d-flex flex-row my_content">
    <!-- 右邊section資料欄位 -->
    <section>
        <div class="container">
            <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
                <div>
                    <h4>書評總表</h4>
                    <div class="title_line"></div>
                </div>
                <ul class="nav justify-content-between">
                    <li class="nav-item">
                        <div style="padding: 0.375rem 0.75rem;">
                            <i class="fas fa-check"></i>
                            目前總計 <span id="search_total"> <span id="total_list"></span> </span> 筆資料
                        </div>
                    </li>
                    
                    <li class="nav-item" style="flex-grow: 1">
                        <form class="form-inline my-2 my-lg-0">
                            <input id="BR_search" class="search form-control mr-sm-2" type="search" placeholder="Search"
                                aria-label="Search">
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
                            <th scope="col">編號</th>
                            <th scope="col">姓名</th>
                            <th scope="col">電話</th>
                            <th scope="col">信箱</th>
                            <th scope="col">地址</th>
                            <th scope="col">性別</th>
                            <th scope="col">生日</th>
                            
                        </tr>
                    </thead>
                    <tbody id="data_page">
                    </tbody>
                </table>
            </div>
            <div>
                <button type="button" class="btn btn-warning multi_delete_btn">批次刪除</button>
            </div>
            <!-- 我是分頁按鈕列 請自取並調整頁面擺放位置 -->
            <nav aria-label="Page navigation example" class="d-flex justify-content-center" id="list_page">
                <ul class="page-item" id="prev_page">
                    <button class="page-link pagination_btn" style=""> &laquo;</button>
                </ul>
                <ul class="pagination">
                </ul>
                <ul class="page-item" id="next_page">
                    <button class="page-link pagination_btn" style="margin: 0 -40px;">&raquo;</button>
                </ul>
            </nav>
            <!-- 刪除提示框 -->
            <div id="d_window" class="delete update card" style="display:none;">
                <div class="delete card-body">
                    <label class="delete_text">您確認要刪除資料嗎?</label>
                    <div>
                        <button type="button" class="delete btn btn-danger delete_enter">
                            確認</button>
                        <button type="button" class="delete btn btn-warning delete_cancel">取消</button>
                    </div>
                </div>
            </div>

    </section>
</div>

<script>
//---------------全選功能-----------------------
$('#chooseAll').click(function() {
    let checked = $(this).prop('checked')
    $('tbody :visible :checkbox').prop('checked', checked)
});

//-----------------批次刪除jquery----------------------------------

$('.multi_delete_btn').click(function() {
    let delete_arr = new Array()
    let checkCount = $('.checkbox:checked')
    if (checkCount.length > 0) {
        let delete_arr = []
        $(checkCount).each(function() {
            delete_arr.push($(this).val())
            console.log(delete_arr)
        })
        $.ajax({
            url: 'BR_delete.php',
            method: 'POST',
            data: {
                delete_arr: delete_arr
            },
            success: function() {
                location.href = 'BR_data_list.php';
                console.log('delete successful');
            }
        })
    } else {
        console.log('no data');
        return false;
    }
})


let gender12 = document.querySelector('.gender')
if ($('.gender').text() == 1) {
    gender12.innerHTML = '男'
}


//----------------ajax資料-------------------------------------
function datalist(list) {
    let tbody = document.querySelector('#data_page');
    let html = '';

    console.log(list)
    for (let i = 0; i < list.length; i++) {
        html += '<tr>';
        html += '<td> <input type="checkbox" value="' + list[i].sid + '" class="checkbox"> </td>';
        html += '<td>' + list[i].sid + '</td>';
        html += '<td>' + list[i].MR_number + '</td>';
        html += '<td>' + list[i].MR_name + '</td>';
        html += '<td>' + list[i].MR_mobile + '</td>';
        html += '<td>' + list[i].MR_email + '</td>';
        html += '<td>' + list[i].MR_address + '</td>';
        html += '<td class="gender">' + list[i].MR_gender + '</td>';
        html += '<td>' + list[i].MR_birthday + '</td>';
        html += '</tr>';
    }


    total_list.innerHTML = list.length
    tbody.innerHTML = html;





    //分頁功能
    let table = document.querySelector('#my_page');
    let list_row = 10 //max_row
    let total_page = Math.ceil(list.length / list_row);
    for (let p = 1; p <= total_page; p++) {
        $('.pagination').append('<li data-page="' + p + '" class="page-item"> ' +
            '<button class="page-link pagination_btn" style="">' + [p] + '</button>' + '</li>')
    }
    $('.pagination li').on('click', function() {
        let pageNum = $(this).attr('data-page')
        let trIndex = 0;
        if ($(this).hasClass('current_page')) {
            return false;
        } else {
            $(".pagination li").removeClass('current_page');
            $(this).addClass('current_page');
        }

        $('tbody tr').each(function() {
            trIndex++
            if (trIndex > (list_row * pageNum) || trIndex <= ((list_row * pageNum) - list_row)) {
                $(this).hide()
            } else {
                $(this).show()
            }
        })
    })

    //前一頁
    $("#prev_page").on("click", function() {
        $(".pagination li.current_page").prev().click()

    });

    //下一頁
    $("#next_page").on("click", function() {
        $(".pagination li.current_page").next().click()

    });

    // jquery單次刪除功能
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


// 首頁調整為顯示10筆
function hide() {
    $('tbody tr:gt(9)').hide()
}

//  將性別數字轉換為中文
function gender() {
    $('.gender').each(function() {
        var ad = $(this).text()
        if (ad == 1) {
            $(this).text('男')
        } else {
            $(this).text('女')
        }
    })
}


//----------------搜尋後觸發function 連接ajax資料----------------
function search_data(data) {
    var tbody = document.getElementById('data_page');
    var search_total = document.getElementById('search_total');
    var html = '';
    for (var i = 0; i < data.length; i++) {
        html += '<tr>';
        html += '<td> <input type="checkbox" value="' + data[i].sid + '" class="checkbox"> </td>';
        html += '<td>' + data[i].sid + '</td>';
        html += '<td>' + data[i].MR_number + '</td>';
        html += '<td>' + data[i].MR_name + '</td>';
        html += '<td>' + data[i].MR_mobile + '</td>';
        html += '<td>' + data[i].MR_email + '</td>';
        html += '<td>' + data[i].MR_address + '</td>';
        html += '<td>' + data[i].MR_gender + '</td>';
        html += '<td>' + data[i].MR_birthday + '</td>';
        html += '<td><a href="BR_update.php?sid=' + data[i].sid + '"><i class="fas fa-edit"></i></a></td>';
        html += '<td><a href="javascript:(' + data[i].sid + ')"><i class="fas fa-trash-alt d_button"></i></a></td>';
        html += '</tr>';
    }
    tbody.innerHTML = html;
    search_total.innerHTML = data.length
    $('tbody tr:gt(9)').hide()

    //根據筆數生成分頁功能

    let list_row = 10 //max_row
    let total_page = Math.ceil(data.length / list_row); //共幾頁
    let pagination = ''; //顯示內容
    let search_page = document.querySelector('#list_page')
    for (let p = 1; p <= total_page; p++) {
        pagination += '<ul class="pagination">' + '<li data-page="' + p + '" class="page-item">' +
            '<button class="page-link pagination_btn" color: #ffffff">' + [p] + '</button>' + '</li>' + '</ul>'
    }


    $(document).ready(function() {
        $('.pagination li').on('click', function() {
            let pageNum = $(this).attr('data-page')
            var trIndex = 0;
            $('tbody tr').each(function() {
                trIndex++
                if (trIndex > (list_row * pageNum) || trIndex <= ((list_row * pageNum) -
                        list_row)) {
                    $(this).hide()
                } else {
                    $(this).show()
                }
            })
        })
    })


    // 使分頁出現
    search_page.innerHTML = pagination


    //刪除功能
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

//------------------input 輸入觸發搜尋---------------------------------------------------------

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
        datalist(list)
        hide()
        gender()
    });
//------------------Ajax搜尋功能-----------------------------------------------------------

var searchItem = document.querySelector('#BR_search'); //取ID
function search() {
    //取得搜尋字串
    if ($('#BR_search').val() != '') {
        $.ajax({
                method: "POST",
                url: "./BR_search_api.php", //進api
                data: {
                    search: searchItem.value
                }
            })

            .done(function(msg) {
                var data = JSON.parse(msg);
                search_data(data);
            });
    }
    //ajax
    else {
        datalist(list)
    }
}
</script>
<?php require '__html_foot.php'; ?>