<?php require 'BR__connect_db.php';
$page_name = 'BR_datalist';
$page_title = '書評人資料總表';



$page =  isset($_GET['page']) ? intval($_GET['page']) : 1;
$page_list = 10; //每頁筆數

$p_list = " SELECT COUNT(10) FROM `br_create`";

$total_list = $pdo->query($p_list)->fetch(PDO::FETCH_NUM)[0];
$total_page = ceil($total_list / $page_list);

//搜尋筆數
// $count = $db->prepare("SELECT * FROM `br_create` WHERE (`BR_name` LIKE $search OR `sid` LIKE $search)");   
// $count->execute();   
// $no=$count->rowCount();

if ($page < 1) {
    header('Location: BR_data_list.php');
    exit;
}

if ($page > $total_page) {
    header('Location: BR_data_list.php?page=' . $total_page);
    exit;
}


$sql = sprintf("SELECT * FROM `br_create` LIMIT %s,%s", ($page - 1) * $page_list, $page_list);
$stmt = $pdo->query($sql);
$row = $stmt->fetchAll();

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
                            目前總計<?= $total_list ?>筆資料
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
                            <button class="btn btn-outline-warning my-2 my-sm-0" type="button" onclick="search()">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- 每個人填資料的區塊 -->
            <div style="margin-top: 1rem">

                <table class="table table-striped table-bordered" style="text-align: center ; width:80vw">
                    <thead>
                        <tr>
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
                    <tbody id="books">
                        <?php foreach ($row as $value) : ?>
                            <tr>
                                <td><?= $value['sid'] ?></td>
                                <td><?= htmlentities($value['BR_name']) ?></td>
                                <td><?= htmlentities($value['BR_phone']) ?></td>
                                <td><?= htmlentities($value['BR_email']) ?></td>
                                <td><?= htmlentities($value['BR_address']) ?></td>
                                <td><?= htmlentities($value['BR_gender']) ?></td>
                                <td><?= htmlentities($value['BR_birthday']) ?></td>
                                <td><?= htmlentities($value['BR_job']) ?></td>
                                <td><a href="BR_update.php?sid=<?= $value['sid'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td><a href="javascript:delete_doublecheck(<?= $value['sid'] ?>)">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- 我是分頁按鈕列 請自取並調整頁面擺放位置 -->
            <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                        <li class="page-item">
                            <a class="page-link" style="<?= $i == $page ? 'background: rgba(156, 197, 161, 0.5) ;color: #ffffff;' : '' ?>" href="?page=<?= $i ?>"><?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" aria-label="Next" href="?page=<?= $page + 1 ?>">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>

                </ul>
            </nav>


            <!-- 刪除提示框 -->
            <div id="d_window" class="delete update card" style="display:none;">
                <div class="delete card-body">
                    <label class="delete_text">您確認要刪除資料嗎?</label>
                    <div>
                        <button type="button" class="delete btn btn-danger" onclick="delete_enter()"> 確認</button>
                        <button type="button" class="delete btn btn-warning" onclick="delete_cancel()">取消</button>
                    </div>
                </div>
            </div>

    </section>
</div>

<script>
    let delete_window = document.querySelector('#d_window');
    let d;

    function delete_doublecheck(sid) {
        d = sid;
        delete_window.style.display = 'block';
    };

    function delete_enter() {
        location.href = 'BR_delete.php?sid=' + d;
    }

    function delete_cancel() {
        location.href = window.location.href;
    }

    function renderBooks(books) {
        var tbody = document.getElementById('books');
        var html = '';
        for (var i = 0; i < books.length; i++) {
            html += '<tr>';
            html += '<td>' + books[i].sid + '</td>';
            html += '<td>' + books[i].BR_name + '</td>';
            html += '<td>' + books[i].BR_password + '</td>';
            html += '<td>' + books[i].BR_phone + '</td>';
            html += '<td>' + books[i].BR_email + '</td>';
            html += '<td>' + books[i].BR_address + '</td>';
            html += '<td>' + books[i].BR_gender + '</td>';
            html += '<td>' + books[i].BR_birthday + '</td>';
            html += '<td>' + books[i].BR_job + '</td>';
            html += '<td><a href="BR_update.php?sid=' + books[i].sid + '"><i class="fas fa-edit"></i></a></td>';
            html += '<td><a href="javascript:delete_doublecheck(' + books[i].sid + ')"><i class="fas fa-trash-alt"></i></a></td>';
            html += '</tr>';
        }
        tbody.innerHTML = html;
        return false;
    }

    //--Enter監聽---------------------------------------------------------------------------
    document.onkeypress = function(e) { //對整個頁面監聽 
        var keyNum = window.event ? e.keyCode : e.which; //獲取被按下的鍵值
        //判斷使用者按下Enter鍵 (監聽13）
        if (keyNum == '13') {
            search();
            return false;
        }
    };


    //--Ajax搜尋功能---------------------------------------------------------------------------

    var searchItem = document.querySelector('#BR_search'); //取ID
    function search() {
        //取得搜尋字串
        if (searchItem.value != 0) {
            $.ajax({
                    method: "POST",
                    url: "./BR_search_api.php", //進api
                    data: {
                        search: searchItem.value
                    }
                })

                .done(function(msg) {
                    var books = JSON.parse(msg);
                    renderBooks(books);
                });
            return false;
        }
        //ajax
        else {
            return false;
        }
    }
</script>
<?php require '__html_foot.php'; ?>