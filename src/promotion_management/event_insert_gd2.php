<?php
$page_name = 'event_insert_gd2';
$page_title = '選擇折扣適用商品';
require __DIR__ . '/__connect_db.php';

include __DIR__ . '/../../pbook_index/__html_head.php';
include __DIR__ . '/../../pbook_index/__html_body.php';
include __DIR__ . '/../../pbook_index/__navbar.php';

$_SESSION['event_insert_gd'] = $_POST;

$cate_sql = "SELECT `sid`,`name` FROM `vb_categories` WHERE 1";
$cate_row = $pdo->query($cate_sql)->fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_COLUMN);


?>

    <style>
        body {
            background: url(../../images/bg.png) repeat center top;
        }
        small.form-text {
            color: red;
        }
    </style>

    <div class="container-fluid pt-5">

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
                                                    onclick="checkAll(true)">
                                                全選
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm"
                                                    onclick="checkAll(false)">
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
                                    </div>
                                    <div class="row mt-2 border-bottom pl-3">
                                        <div class="form-group form-inline mt-3 mb-3">
                                            <label class="mr-3" for="search_type">搜尋方式</label>
                                            <select class="form-control mr-3 border-0" name="search_type"
                                                    id="search_type">
                                                <option value="1">ISBN</option>
                                                <option value="2">書籍名稱</option>
                                                <option value="3">分類</option>
                                                <option value="4">作者</option>
                                                <option value="5">出版社</option>
                                            </select>
                                            <input class="mr-3" type="text" name="my_search" id="my_search">
                                            <a href="javascript:search()">搜尋</a>
                                        </div>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col">加入</th>
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
    <script>
        "use strict";
        let cate_row = <?= json_encode($cate_row); ?>;
        let tbody = document.getElementById('books_list');
        let sel_books_ar = [];

        function renderBooks(books) {
            let html = '';
            for (let i = 0; i < books.length; i++) {
                html += '<tr id="book_list_id_' + books[i].sid + '">';

                if($.inArray(books[i].sid, sel_books_ar) != -1) {
                    html += '<td>' + '<input checked type="checkbox" onchange="addBook(' + i + ')">' + '</td>';
                }else{
                    html += '<td>' + '<input type="checkbox" onchange="addBook(' + i + ')">' + '</td>';
                }

                html += '<td>' + books[i].sid + '</td>';
                html += '<td>' + books[i].isbn + '</td>';
                html += '<td>' + books[i].name + '</td>';
                html += '<td>' + cate_row[books[i].categories] + '</td>';
                html += '<td>' + books[i].author + '</td>';
                html += '<td>' + books[i].publishing + '</td>';
                html += '</tr>';
            }
            tbody.innerHTML = html;
            return false;
        }

        let books;

        function search() {
            //取得搜尋字串
            let my_search = document.querySelector('#my_search').value;
            let search_type = document.querySelector('#search_type').value;
            //ajax
            $.ajax({
                method: "GET",
                url: "./book_searching_api.php", //進api
                data: {
                    search: my_search,
                    search_type: search_type,
                }
            })

                .done(function (msg) {
                    books = JSON.parse(msg);
                    renderBooks(books);
                });
            return false;
        }


        function checkForm() {
            let isPass = true;
            let book_group = document.querySelector('#book_group');
            book_group.value = JSON.stringify(sel_books_ar);

            if (isPass) {
                return true;
            } else {
                return false;
            }
        }


        function checkAll(bool) {
            let checkboxes = document.querySelectorAll('#bg_checkboxes input');
            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = bool;
            }
        }

        function group_type_display() {
            let group_type = document.querySelector('#group_type');
            let categories_block = document.querySelector('#bg_checkboxes');
            let book_id_block = document.querySelector('#book_id_block');
            if (group_type.value == 0) {
                checkAll(false);
                categories_block.style.display = 'none';
                book_id_block.style.display = 'none';
            } else if (group_type.value == 1) {
                categories_block.style.display = 'flex';
                book_id_block.style.display = 'none';
            } else {
                checkAll(false);
                categories_block.style.display = 'none';
                book_id_block.style.display = 'flex';
            }
        }


        let sel_books = document.querySelector('#sel_books');

        function addBook(search_id) {
            if(document.querySelector('#book_list_id_' + books[search_id].sid + ' input').checked == false){
                unSelBook(books[search_id].sid);
            }
            else if ($.inArray(books[search_id].sid, sel_books_ar) == -1) {
                sel_books_ar.push(books[search_id].sid);
                let html = '';
                html += '<tr id=book_sel_id_' + books[search_id].sid + '>';
                html += '<td>' + '<input type="checkbox" onchange="unSelBook(' + books[search_id].sid + ')">' + '</td>';
                html += '<td>' + books[search_id].sid + '</td>';
                html += '<td>' + books[search_id].isbn + '</td>';
                html += '<td>' + books[search_id].name + '</td>';
                html += '<td>' + cate_row[books[search_id].categories] + '</td>';
                html += '<td>' + books[search_id].author + '</td>';
                html += '<td>' + books[search_id].publishing + '</td>';
                html += '</tr>';
                sel_books.innerHTML += html;
            }
        }

        function unSelBook(book_id) {
            let book_tr = document.querySelector('#book_sel_id_' + book_id);
            sel_books.removeChild(book_tr);
            let book_list_checkbox = document.querySelector('#book_list_id_' + book_id + ' input');
            book_list_checkbox.checked = false;
            let book_index = $.inArray(""+book_id,sel_books_ar);
            console.log('delete: '+book_id);
            sel_books_ar.splice(book_index,1);
        }

    </script>

<?php include __DIR__ . '/../../pbook_index/__html_foot.php'; ?>