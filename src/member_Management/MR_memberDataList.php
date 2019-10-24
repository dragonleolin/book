<?php //require __DIR__ . '/__admin_required.php' 
?>
<?php require  'MR_db_connect.php' ?>
<?php
$thead_item = ['#', '編號', '等級', '姓名', '暱稱', '電子信箱', '性別', '生日', '手機'];

$page_title = '資料列表';

$item_switch = [
    'sid' => 'SID',
    'MR_number' => '會員編號',
    'MR_name' => '會員姓名',
    'MR_password' => '會員密碼',
    'MR_nickname' => '暱稱',
    'MR_email' => '電子信箱',
    'MR_gender' => '性別',
    'MR_birthday' => '生日',
    'MR_mobile' => '手機',
    'MR_career' => '職業',
    'MR_address' => '地址',
    'MR_pic' => '頭像路徑',
    'MR_imageloactionX' => '頭像位置X',
    'MR_imageloactionY' => '頭像位置Y',
    'MR_personLevel' => '會員等級',
    'MR_createdDate' => '創建日期'
];
// 會員等級項目獲取和轉換
$sql = "SELECT `MR_levelName` FROM `mr_level`";
$level = $pdo->query($sql)->fetchAll();
$a_level = [];
for ($i = 0; $i < count($level); $i++) {
    $a_level[$i] = $level[$i]['MR_levelName'];
};
// $a_level = [
//     '',
//     '品書會員',
//     '品書學徒',
//     '品書專家',
//     '品書大師',
//     '品書至尊',
// ];

?>
<?php include '../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }

    ul li {
        list-style-type: none;
    }

    .check_icon1 {
        top: 0;
        right: 0;
    }

    .modal-header {
        padding-left: 40px;
    }

    .display-none {
        display: none;
    }

    .display-block {
        display: block;
    }

    .page-link.active {
        background: rgba(156, 197, 161, 0.5);
        color: #ffffff;
    }
</style>
<?php include '../../pbook_index/__html_body.php' ?>
<?php include '../../pbook_index/__navbar.php' ?>
<div id="outerSpace">
    <section class="justify-content-center p-4 container-fluid" id="table_content">
        <div class="container-fluid">
            <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
                <div class="d-flex">
                    <div>
                        <h4>會員列表</h4>
                        <div class="title_line"></div>
                    </div>
                    <ul class="nav justify-content-between display-none prep-page">
                        <li class="nav-item" style="margin: 0px 10px">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick='location.href = "MR_memberDataList.php"'>
                                <i class="fas fa-arrow-circle-left"></i>
                                回到上一頁
                            </button>
                        </li>
                    </ul>
                </div>
                <ul class="nav justify-content-between">
                    <li class="nav-item">
                        <div style="padding: 0.375rem 0.75rem;">
                            <i class="fas fa-check"></i>
                            目前總計 <span id="totalRows"></span> &nbsp筆資料
                        </div>
                    </li>
                    <li class="nav-item" style="margin: 0px 10px">
                        <button class="btn btn-outline-primary my-2 my-sm-0" onclick="location.href='MR_memberData_insert.php'">
                            <i class="fas fa-plus-circle"></i>
                            新增會員
                        </button>
                    </li>
                    <li class="nav-item" style="flex-grow: 1">
                        <form name="form" class="form-inline my-2 my-lg-0" onsubmit="return checkSearch()">
                            <input class="search form-control mr-sm-2" id="search_input" name="search" type="search" placeholder="請輸入會員編號、姓名、電子信箱、手機" aria-label="Search" style="width:330px">
                            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- 每個人填資料的區塊 -->
        <div class="container-fluid" style="margin-top: 1rem">
            <table class="table table-striped table-bordered" style="text-align: center">
                <thead>
                    <tr>
                        <ul class="nav" style="visibility: hidden" id="delete1">
                            <button class="btn btn-outline-primary my-2 my-sm-0 " id="multi_delete" onclick="delete_multiple(event)"><i class="fas fa-trash-alt"></i> &nbsp刪除</button>
                        </ul>
                    </tr>
                    <tr>
                        <th>
                            <input type="checkbox" onclick="check_all(this,'c')" id="all_check">
                            <i class="fas fa-angle-down" style="color:#bbb;margin-left:5px"></i>
                        </th>
                        <?php for ($i = 0; $i < count($thead_item); $i++) : ?>
                            <th scope="col"><?= $thead_item[$i] ?></th>
                        <?php endfor ?>
                        <th scope="col">詳細</th>
                        <th scope="col">修改</th>
                        <th scope="col">刪除</th>
                    </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
            </table>
        </div>
        <!-- 分頁按鈕列 -->
        <nav class="mt-5" aria-label="Page navigation example ">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link my_text_blacktea" href="" data-page="1" aria-label="Next">
                        <i class="fas fa-angle-double-left"></i>
                    </a>
                </li>
                <li class="page-item ">
                    <a class="page-link my_text_blacktea" id="prep-page" href="">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
                <li class="page-item d-flex" id="pages">
                </li>
                <li class="page-item">
                    <a class="page-link my_text_blacktea" id="next-page" href="" aria-label="Next">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link my_text_blacktea" id="last-page" href="" aria-label="Next">
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            </ul>
            <div class="d-flex">
                <p id="showT_Pages" style="margin:0 auto;"></p>
            </div>
        </nav>
        <!-- 刪除提示框 -->
        <div class="delete update card" id="delete_confirm" style="display:none">
            <div class="delete card-body">
                <label class="delete_text " id="delete_info"></label>
                <div>
                    <button type="button" class="delete btn btn-danger" id="deltet_yes">確認</button>
                    <!-- onclick="delete_yes()" -->
                    <button type="button" class="delete btn btn-warning" id="deltet_no">取消</button>
                    <!-- onclick="delete_no()" -->
                </div>
            </div>
        </div>

        <!-- 搜尋失敗提視窗 -->
        <div class="delete update card" id="search_failed" style="display:none">
            <div class="delete card-body">
                <label class="delete_text " id="">查無資料，請重新輸入搜尋條件</label>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:1200px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">會員資料</h5>
                        <div class="nav-item" style="margin-left:50px">
                            <button class="btn btn-outline-primary my-2 my-sm-0" id="MBList">
                                <i class="fas fa-arrow-circle-right"></i>
                                會員二手書清單
                            </button>
                            <button class="btn btn-outline-primary my-2 my-sm-0" id="BRList">
                                <i class="fas fa-arrow-circle-right"></i>
                                追蹤書評人清單
                            </button>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="min-height:500px">
                        <!-- body -->
                        <ul class="" id="modal-body">
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="detailUpdate">修改資料</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let item_switch = <?= json_encode($item_switch, JSON_UNESCAPED_UNICODE) ?>; // 表格title
            let a_level = <?= json_encode($a_level, JSON_UNESCAPED_UNICODE) ?>;
            console.log(a_level);
            let delete_sid, delete_eventTarget; // 刪除資料功能
            let ar = [];
            let nowPage = 1;
            let s_page = 1;
            let search = $("#search_input").val();
            // 讀取完成生成頁面
            $(function() {
                fetch("MR_DataListAPI.php")
                    .then(Response => {
                        return Response.json();
                    })
                    .then(json => {
                        dataList(json);
                        pagination(json);
                    })
                $('input').iCheck({
                    checkboxClass: 'icheckbox_flat',
                    radioClass: 'iradio_flat'
                });
            });


            //全選刪除 
            $('#tbody').on("click", "input[name='check[]']", function() {
                let state = false;
                for (let i = 0; i < 10; i++) {
                    state = $('input[name="check[]"]').eq(i).prop('checked') ? true : false;
                    if (state) break;
                }
                if (state) {
                    $('#delete1').css('visibility', 'visible');
                } else {
                    $('#delete1').css('visibility', 'hidden');
                }
            });

            //顯示details
            // let itemCount=Object.keys(item_switch).length;

            $("#tbody").on("click", ".showDetails", function() {
                setTimeout(() => {
                    let sid = $(this).data("sid");
                    fetch(`MR_detailAPI.php?sid=${sid}`)
                        .then(Response => {
                            return Response.json();
                        })
                        .then(json => {
                            showDetails(json);
                        });
                    return false;
                }, 100);

            });

            // details連結
            $("#MBList").click(function() {
                let num = $(this).data("num");
                location.href = `MR_MBList.php?MR_number=${num}`;
            });
            $("#BRList").click(function() {
                let num = $(this).data("num");
                location.href = `MR_BRDataList.php?MR_number=${num}`;
            });
            $("#detailUpdate").click(function() {
                let sid = $(this).data("sid");
                location.href = `MR_memberData_update.php?sid=${sid}`;
            })

            //分頁按鈕事件
            $(".page-item").on("click", ".page-link", function() {
                page = $(this).data('page');
                if (nowPage != page) {
                    if (search) {
                        s_page = page;
                        checkSearch();
                    } else {
                        fetch(`MR_DataListAPI.php?page=${page}`)
                            .then(Response => {
                                return Response.json();
                            })
                            .then(json => {
                                dataList(json);
                                pagination(json);
                            });
                    }
                }
                return false;
            });

            //分頁按鈕生成
            function pagination(json) {
                let t_Page = json.totalPage;
                let page_items = '';
                let page = (json.page == 1) ? 1 : parseInt(json.page);
                $("#pages").empty();
                $("#showT_Pages").text(`共${t_Page}頁`);
                for (let i = 0; i < t_Page; i++) {
                    let page = `<a class="page-link" href="" data-page="${i+1}">${i+1}</a>`;
                    page_items += page;
                }
                $("#pages").append(page_items);
                $('#prep-page').data('page', `${(page - 1 <= 0) ? 1 : page - 1}`);
                $('#next-page').data('page', `${(page + 1 > t_Page) ? t_Page : page + 1}`);
                $('#last-page').data('page', `${t_Page}`);
                pageActive(page);
                nowPage = page;

            }
            //分頁按鈕active
            function pageActive(page) {
                $("#pages .page-link").removeClass("active");
                $("#pages .page-link").eq(page - 1).addClass("active");
            }


            // 搜尋功能
            function checkSearch() {
                search = $("#search_input").val();
                if (search) {
                    $("#tbody").empty();

                    $(".prep-page").removeClass("display-none");
                    $(".prep-page").addClass("display-block");
                    fetch(`MR_searchAPI.php?search=${search}&page=${s_page}`)
                        .then(Response => {
                            return Response.json();
                        })
                        .then(json => {
                            dataList(json);
                            pagination(json);
                        });
                }
                return false;
            }

            // 頁面生成
            function dataList(json) {
                $("#totalRows").text(`${json.totalRows}`);
                let data = json.rows;
                let new_tr = "";
                $("#tbody").empty();
                data.forEach(function(element, index) {

                    let tr = `
            <tr>
                <td>
                     <input type="checkbox" name="check[]" id="check${index}" value="${element.sid}">
                </td>
                <td>${index+1}</td>
                <td>${element['MR_number']}</td>
                <td>${a_level[element['MR_personLevel']-1]}</td>
                <td>${element['MR_name']}</td>
                <td>${element['MR_nickname']}</td>
                <td>${element['MR_email']}</td>
                <td>${element['MR_gender']==1?"男":"女"}</td>
                <td>${element['MR_birthday']}</td>
                <td>${element['MR_mobile']}</td>
                <td>
                    <a href="" class="showDetails" data-toggle="modal" data-target="#exampleModalCenter" data-sid="${element.sid}">
                    <i class="fas fa-plus-circle"></i>&nbsp&nbsp顯示
                    </a>
                </td>
                <td><a href="MR_memberData_update.php?sid=${element.sid}"><i class="fas fa-edit"></i></a></td>
                <td><a href="javascript:delete_one(${element.sid})"><i class="fas fa-trash-alt"></i></a></td>
                <input type="hidden" id='tdsid${element.sid}' value="${element.sid}">
            </tr>`;
                    new_tr += tr;
                });
                $("#tbody").append(new_tr);
            };

            //顯示details
            function showDetails(json) {
                $("#modal-body").empty();
                let data = json[0];
                console.log(json)
                let contents = '';
                $("#MBList").attr("data-num", data['MR_number']);
                $("#BRList").attr("data-num", data['MR_number']);
                $("#detailUpdate").attr("data-sid", data['sid']);
                for (let item in data) {
                    let value = data[item]
                    let title = item_switch[item];
                    if (item == 'MR_gender') {
                        if (value == 2) value = "女";
                        if (value == 1) value = "男";
                    }
                    if (item == 'MR_personLevel') {
                        value = a_level[value - 1];
                    }
                    let content = ` <li class="d-flex justify-content-start" style="width:50%">
                                <h5 class="d-flex justify-content-between" style="width:18% ;"> <span>${title}</span> <span>:</span></h5>
                                <span style="padding-left:10px">${value}</span>
                            </li>`;
                    contents += content;
                }
                $("#modal-body").append(contents);
            }

            // 全選刪除
            function check_all() {
                if ($("#all_check").prop('checked')) {
                    $('#delete1').css('visibility', 'visible');
                    $("input[name='check[]']").each(function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $('#delete1').css('visibility', 'hidden');
                    $('input[name="check[]"]').each(function() {
                        $(this).prop('checked', false);
                    });
                }
            }

            // 刪除資料功能

            function delete_one(sid) {
                $("#delete_confirm").css("display", "block");
                $("#delete_info").text(`確定要刪除編號${sid}的資料嗎?`);
                delete_sid = sid;
            }
            $("#deltet_no").click(function() {
                $("#delete_confirm").css("display", "none");
            });

            $("#deltet_yes").click(function() {
                if (event.target == deltet_yes) {
                    location.href = 'MR_memberData_delete.php?sid=' + delete_sid;
                }
                if (delete_eventTarget == multi_delete) {
                    document.cookie = "delete_sid=" + ar;
                    location.href = 'MR_memberData_delete.php';
                }
            });

            function delete_multiple(event) {
                delete_eventTarget = event.target;
                ar = [];
                for (i = 0; i < 10; i++) {
                    let input = $('input[name="check[]"]').eq(i);
                    if (input.prop('checked')) {
                        console.log(input.prop('value'))
                        ar.push(input.prop('value'));
                    }
                }
                $("#delete_confirm").css("display", "block");
                let string1 = '';
                for (i = 0; i < ar.length; i++) {
                    string1 += `${ar[i]}, `;
                }
                string1 = string1.slice(0, string1.length - 2);
                $("#delete_info").text(`確定要刪除編號 ${string1} 的資料嗎?`);
            }
        </script>

        <?php include '../../pbook_index/__html_foot.php' ?>