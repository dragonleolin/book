<?php
$page_name = 'event_insert_gd2';
$page_title = '選擇折扣適用商品';
require __DIR__ . '/__connect_db.php';

include __DIR__ . '/__html_head.php';
include __DIR__ . '/../../pbook_index/__html_body.php';
include __DIR__ . '/../../pbook_index/__navbar.php';

$_SESSION['event_insert_gd'] = $_POST;

$cate_sql = "SELECT `sid`,`name` FROM `vb_categories` WHERE 1";
$cate_row = $pdo->query($cate_sql)->fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_COLUMN);

$cp_sql = "SELECT `sid`,`cp_name` FROM `cp_data_list` WHERE 1";
$cp_row = $pdo->query($cp_sql)->fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_COLUMN);

?>

    <style>
        body {
            background: url(../../images/bg.png) repeat center top;
        }

        small.form-text {
            color: red;
        }
    </style>

    <div class="container pt-5">

        <nav class="navbar justify-content-between">
            <div>
                <h4>新增商品折扣活動</h4>
                <div class="title_line"></div>
            </div>
            <ul class="nav justify-content-between">
                <li class="nav-item" style="margin: 0px 10px">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="button"
                            onclick="location.href = 'event_insert_gd.php'">
                        <i class="fas fa-arrow-circle-left"></i>
                        回到上一頁
                    </button>
                </li>
            </ul>
        </nav>

        <div class="row mt-4 ml-auto">
            <div class="col-md-9 m-auto">
                <div class="alert alert-primary" role="alert" id="info_bar" style="display: none"></div>
                <form name="form1" onsubmit="return checkForm()" method="POST"
                      action="event_insert_gd_api.php">
                    <div class="card mb-5 pl-5 pr-5 pt-3">
                        <div class="card-body">

                            <div class="row border-bottom mt-2">
                                <div class="form-group col-md-6">
                                    <label for="group_type">選擇分類方式</label>
                                    <select class="form-control" id="group_type" name="group_type"
                                            onchange="group_type_display()">
                                        <option selected value="0">全站適用</option>
                                        <option value="1">書籍分類</option>
                                        <option value="2">自訂群組</option>
                                    </select>
                                    <small class="form-text"></small>
                                </div>
                            </div>
                            <div class="row pl-4">
                                <div id="bg_checkboxes" class="row border-bottom" style="display: none">
                                    <div class="form-group col-md-12">
                                        <label for="categories" class="update_label"></label>
                                        <div class="d-flex mt-2 mb-2">
                                            <button type="button" class="btn btn-info btn-sm mr-2"
                                                    onclick="checkAll(true,'#bg_checkboxes')">
                                                全選
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm"
                                                    onclick="checkAll(false,'#bg_checkboxes')">
                                                全部取消
                                            </button>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            <?php foreach ($cate_row as $k => $v) : ?>
                                                <div class="form-check" style="margin:0px 20px 10px 0px">
                                                    <input class="form-check-input" type="checkbox"
                                                           name="categories[]"
                                                           id="categories<?= $k ?>" value="<?= $k ?>">
                                                    <label class="form-check-label"
                                                           for="categories<?= $k ?>"><?= $v ?></label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="book_id_block" class="row" style="display: none;">
                                    <input type="hidden" name="book_group" id="book_group" value="">
                                    <div class="row mt-2 border-bottom pl-3">
                                        <label>新增品項</label>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col">取消</th>
                                                <th scope="col">#</th>
                                                <th scope="col">ISBN</th>
                                                <th scope="col">書籍名稱</th>
                                                <th scope="col">分類</th>
                                                <th scope="col">作者</th>
                                                <th scope="col">出版社</th>
                                            </tr>
                                            </thead>
                                            <tbody id="sel_books">

                                            </tbody>
                                        </table>
                                        <button id="submit_btn" type="submit" class="btn btn-primary mr-3 ml-3 mb-3">
                                            完成
                                        </button>

                                    </div>
                                    <div class="row mt-2 border-bottom pl-3">
                                        <div class="form-group form-inline mt-3 mb-3">
                                            <label class="mr-3" for="search_type">搜尋方式</label>
                                            <select class="form-control mr-3 border-0" name="search_type"
                                                    id="search_type" onchange="search()">
                                                <option value="0">快速搜尋</option>
                                                <option value="1">ISBN</option>
                                                <option value="2">書籍名稱</option>
                                                <option value="3">分類</option>
                                                <option value="4">作者</option>
                                                <option value="5">出版社</option>
                                            </select>
                                            <input class="mr-3" type="text" name="my_search" id="my_search"
                                                   onkeydown="return !(event.key == 'Enter');">
                                            <a href="javascript:search()">搜尋</a>
                                        </div>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col">
                                                    <input id="book_list_checkAll" type="checkbox"
                                                           onclick="javascript: checkAll($(this).prop('checked'),'#books_list');">
                                                    <label for="book_list_checkAll">全選</label>
                                                </th>
                                                <th scope="col">#</th>
                                                <th scope="col">ISBN</th>
                                                <th scope="col">書籍名稱</th>
                                                <th scope="col">分類</th>
                                                <th scope="col">作者</th>
                                                <th scope="col">出版社</th>
                                            </tr>
                                            </thead>
                                            <tbody id="books_list">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button id="submit_btn" type="submit" class="btn btn-primary mr-3 ml-3 mb-3">完成</button>

                    </div>
            </div>
            </form>
        </div>

    </div>
    <script src="../../lib/jquery-3.4.1.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script>
        "use strict";
        let cate_row = <?= json_encode($cate_row); ?>;
        let cp_row = <?= json_encode($cp_row);?>;
        let tbody = document.getElementById('books_list');
        let sel_books_ar = [];
        let books;

        //dataTable
        let dataTableLanguage = <?php include('data-table-language.json'); ?>;
        let table = $("#books_list").closest("table").DataTable({
            "searching": false,
            "language": dataTableLanguage,
            "drawCallback": function() {
                book_checked();
            },
        });


        function render_book_row(i) {
            let html = '';
            html += '<td>' + books[i].sid + '</td>';
            html += '<td>' + books[i].isbn + '</td>';
            html += '<td>' + books[i].name + '</td>';
            html += '<td>' + cate_row[books[i].categories] + '</td>';
            html += '<td>' + books[i].author + '</td>';
            html += '<td>' + cp_row[books[i].publishing] + '</td>';
            html += '</tr>';
            return html;
        }

        function render_books() {
            table.destroy();
            $('#book_list_checkAll').prop('checked', false);
            let total_rows = books.length;
            let html = '';
            if (total_rows == 0) {
                tbody.innerHTML = '<td style="text-align: center" colspan="7">無結果</td>';
                return false;
            }
            for (let i = 0; i < total_rows; i++) {
                html += `<tr data-sid="${books[i].sid}" id="book_list_id_${books[i].sid}">`;
                if ($.inArray(books[i].sid, sel_books_ar) != -1) {
                    html += '<td>' + '<input checked type="checkbox" onchange="addBook(' + i + ')">' + '</td>';
                } else {
                    html += '<td>' + '<input type="checkbox" onchange="addBook(' + i + ')">' + '</td>';
                }
                html += render_book_row(i);
            }
            tbody.innerHTML = html;
            table = $("#books_list").closest("table").DataTable({
                "searching": false,
                "language": dataTableLanguage,
                "drawCallback": function() {
                    book_checked();
                },
            });
            return false;
        }

        let my_search = $('#my_search');

        function search() {
            //取得搜尋字串
            let search_type = $('#search_type').val();
            //ajax
            $.ajax({
                method: "GET",
                url: "./book_searching_api.php", //進api
                data: {
                    search: my_search.val(),
                    search_type: search_type,
                }
            })

                .done(function (msg) {
                    books = JSON.parse(msg);
                    render_books(1);
                });
            return false;
        }

        my_search.on('keyup', search);


        function checkForm() {
            $('#book_group').val(JSON.stringify(sel_books_ar));
            return true;
        }


        function checkAll(bool, check_area) {
            if (bool) {
                $(check_area + ' input:not(:checked)').click();
            } else {
                $(check_area + ' input:checked').click();
            }
        }


        function group_type_display() {
            let group_type = document.querySelector('#group_type');
            if (group_type.value == 0) {
                checkAll(false, '#bg_checkboxes');
                checkAll(false, '#books_list');
                $('#book_list_checkAll').prop('checked', false);
                $('#bg_checkboxes').hide();
                $('#book_id_block').hide();
            } else if (group_type.value == 1) {
                checkAll(false, '#books_list');
                $('#book_list_checkAll').prop('checked', false);
                $('#bg_checkboxes').show();
                $('#book_id_block').hide();
            } else {
                checkAll(false, '#bg_checkboxes');
                $('#bg_checkboxes').hide();
                $('#book_id_block').show();
            }
        }


        let sel_books = document.querySelector('#sel_books');

        function addBook(search_id) {
            if (document.querySelector('#book_list_id_' + books[search_id].sid + ' input').checked == false) {
                unSelBook(books[search_id].sid);
            } else if ($.inArray(books[search_id].sid, sel_books_ar) == -1) {
                sel_books_ar.push(books[search_id].sid);
                let html = '';
                html += '<tr id=book_sel_id_' + books[search_id].sid + '>';
                html += '<td>' + '<input type="checkbox" onchange="unSelBook(' + books[search_id].sid + ')">' + '</td>';
                html += render_book_row(search_id);
                sel_books.innerHTML += html;
            }
        }

        function unSelBook(book_id) {
            let book_tr = document.querySelector('#book_sel_id_' + book_id);
            sel_books.removeChild(book_tr);
            let book_index = $.inArray("" + book_id, sel_books_ar);
            sel_books_ar.splice(book_index, 1);
            book_checked();
        }

        $('tbody').click(function () {
            if (event.path[1].id) {
                let tr_id = event.path[1].id;
                $('#' + tr_id + " input").click();
            }
        })

        function book_checked() {
            $("#books_list tr").each(function () {
                if ($.inArray( ""+$(this).data("sid"),sel_books_ar)!=-1) {
                    $(this).find("input").prop("checked", true);
                } else {
                    $(this).find("input").prop("checked", false);
                }
            })
        }

    </script>

<?php include __DIR__ . '/../../pbook_index/__html_foot.php'; ?>