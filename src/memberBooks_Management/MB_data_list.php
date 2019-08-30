<?php
require __DIR__ . '/__connect_db.php';
$page_name = 'MB_data_list';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10;

$t_sql = "SELECT COUNT(1) FROM `mb_books`";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $per_page);

// echo "$totalRows<br>";

// echo "$totalPages<br>";


if ($page < 1) {
    header('Location:MB_data_list.php');
    exit;
}
if ($page > $totalPages) {
    header('Location:MB_data_list.php?page=' . $totalPages);
    exit;
}

$page_sql = sprintf(
    "SELECT * FROM `mb_books` ORDER BY `mb_sid` ASC LIMIT %s, %s",
    ($page - 1) * $per_page, //從第幾筆開始
    $per_page  //一頁幾筆
);
$t_stmt = $pdo->query($page_sql);



?>

<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }

    .page-position {
        position: absolute;
        bottom: 3%;
        left: 50%;
    }
</style>
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/../../pbook_index/__navbar.php' ?>
<!-- 右邊section資料欄位 -->
<section class="position-relative">
    <div class="container">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h4>會員書籍總表</h4>
                <div class="title_line"></div>
            </div>
            <ul class="nav justify-content-between">
                <li class="nav-item">
                    <div style="padding: 0.375rem 0.75rem;">
                        <i class="fas fa-check"></i>
                        目前總計<?= $totalRows ?>筆資料
                    </div>
                </li>
                <li class="nav-item" style="margin: 0px 10px">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" onclick="data_insert()">
                        <i class="fas fa-plus-circle"></i>
                        新增會員書籍
                    </button>
                </li>
                <li class="nav-item" style="flex-grow: 1">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="search form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- 每個人填資料的區塊 -->
        <div style="margin-top: 1rem; min-width: 80vw">
            <table class="table table-striped table-bordered" style="text-align: center ; ">
                <thead>
                    <tr>
                        <th scope="col">sid</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">書籍名稱</th>
                        <th scope="col">書籍圖片</th>
                        <th scope="col">分類</th>
                        <th scope="col">作者</th>
                        <th scope="col">出版社</th>
                        <th scope="col">出版日期</th>
                        <th scope="col">版次</th>
                        <th scope="col">定價</th>
                        <th scope="col">頁數</th>
                        <th scope="col">狀況</th>
                        <th scope="col">上架會員</th>
                        <th scope="col">上架時間</th>
                        <th scope="col">修改</th>
                        <th scope="col">刪除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $t_stmt->fetch()) { ?>
                        <tr>
                            <td><?= $r['mb_sid'] ?></td>
                            <td><?= htmlentities($r['mb_isbn']) ?></td>
                            <td><?= htmlentities($r['mb_name']) ?></td>
                            <td>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#<?= 'book' . $r['mb_sid']; ?>">
                                    <i class="fas fa-plus-circle"></i>
                                    顯示
                                </button>
                                <div class="modal fade" id="<?= 'book' . $r['mb_sid']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= 'book' . $r['mb_sid']; ?>Title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="<?= 'book' . $r['mb_sid']; ?>Title"><?= $r['mb_name']; ?></h5>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="width:450px;width:450px;margin:0 auto">
                                                <img style="object-fit: contain;width: 100%;height: 100%;" src="<?= 'mb_images/'.$r['mb_pic']; ?>" alt="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                                <button type="button" class="btn btn-primary" onclick="change_img(<?= $r['mb_sid'] ?>)">修改圖片</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <td><?= htmlentities($r['mb_categories']) ?></td>
                            <td><?= htmlentities($r['mb_author']) ?></td>
                            <td><?= htmlentities($r['mb_publishing']) ?></td>
                            <td><?= htmlentities($r['mb_publishDate']) ?></td>
                            <td><?= htmlentities($r['mb_version']) ?></td>
                            <td><?= htmlentities($r['mb_fixedPrice']) ?></td>
                            <td><?= htmlentities($r['mb_page']) ?></td>
                            <td><?= htmlentities($r['mb_savingStatus']) ?></td>
                            <td><?= htmlentities($r['mb_shelveMember']) ?></td>
                            <td><?= htmlentities($r['mb_shelveDate']) ?></td>
                            <td><a href="MB_update.php?mb_sid=<?= $r['mb_sid'] ?>"><i class="fas fa-edit"></i></a></td>
                            <td><a href="javascript:delete_one(<?= $r['mb_sid'] ?>)"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- 我是分頁按鈕列 請自取並調整頁面擺放位置 -->
            <nav aria-label="Page navigation example">
                <ul class="pagination page-position">
                <li class="page-item">
                    <a class="page-link" href="?page=1" aria-label="Previous">
                        <i class="fas fa-angle-double-left"></i>
                    </a>
                </li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                        <i class="fas fa-angle-left"></i>
                        </a>
                    </li>
                    <?php
                    $p_start = $page - 5;
                    $p_end = $page + 5;
                    if ($page < 5) :
                        for ($i = $p_start; $i <= $p_end; $i++) :
                            if ($i < 1 or $i > $totalPages) continue;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <?php
                    if ($page >= 5) :
                        for ($i = 1; $i <= $p_end; $i++) :
                            if ($i < 1 or $i > $totalPages) continue;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                        <i class="fas fa-angle-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                    <a class="page-link" href="?page=<?= $totalPages ?>" aria-label="Next">
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
                </ul>
            </nav>


            <!-- 刪除提示框 -->
            <div class="delete update card" id="deleteType" style="display: none;">
                <div class="delete card-body">
                    <label class="delete_text">您確認要刪除資料嗎?</label>
                    <div>
                        <button type="button" class="delete btn btn-danger" id="confirm">確認</button>
                        <button type="button" class="delete btn btn-warning" id="cancel">取消</button>
                    </div>
                </div>
            </div>

</section>
<script>
    let deleteType = document.querySelector('#deleteType');
    let confirm = document.querySelector('#confirm');
    let cancel = document.querySelector('#cancel');

    function data_insert(){
        location = "MB_insert.php";
    }

    function change_img(mb_sid) {
        let b = mb_sid;
        location = 'MB_update.php?mb_sid=' + b;
    }

    function delete_one(mb_sid) {

        deleteType.style.display = "block";

        // if (confirm(`確定要刪除編號為 ${mb_sid} 的資料嗎?`)) {
        //     location.href = 'MB_delete.php?mb_sid=' + mb_sid;
        // }

        confirm.addEventListener('click', function() {
            location.href = 'MB_delete.php?mb_sid=' + mb_sid;
        })
        cancel.addEventListener('click', function() {
            location.href = window.location.href;
        })
    }
</script>
</div>
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>