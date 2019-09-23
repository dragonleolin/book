<?php require 'BR__connect_db.php';
$page_name = 'BR_bookreview_list';
$page_title = '書評列表';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page_list = 10;
$p_list = " SELECT COUNT(10) FROM `br_list`";
$total_list = $pdo->query($p_list)->fetch(PDO::FETCH_NUM)[0];
$total_page = ceil($total_list / $page_list);
if ($page < 1) {
    header('Location: BR_bookreview_list.php');
    exit;
};
if ($page > $total_page) {
    header('Location: BR_bookreview_list.php?page=' . $total_page);
    exit;
};
$sql = sprintf("SELECT * FROM `br_list` LIMIT %s , %s", ($page - 1) * $page_list, $page_list);
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
                        目前總計<?= $total_list ?>筆資料
                    </div>
                </li>
                <li class="nav-item" style="flex-grow: 1">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="search form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">
                            <i class="fas fa-search" name="Submit" value="提交"></i>
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
                        <th scope="col">書評標題</th>
                        <th scope="col">書評內容</th>
                        <th scope="col">書評圖片</th>
                        <th scope="col">書評發表時間</th>
                        <th scope="col">書評發表人</th>
                        <th scope="col">刪除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($row as $value) : ?>
                        <tr>
                            <td><?= $value['BR_sid'] ?></td>
                            <td><?= htmlentities($value['BR_title']) ?></td>
                            <td><?= htmlentities($value['BR_data']) ?></td>
                            <td><?= $value['BR_image'] ?></td>
                            <td><?= $value['BR_release_time'] ?></td>
                            <td><?= htmlentities($value['BR_publisher']) ?></td>
                            <td><a href="javascript:delete_doublecheck(<?= $value['BR_sid'] ?>)">
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
                        <a class="page-link" style="<?= $i ==
                                                            $page ? 'background: rgba(156, 197, 161, 0.5) ;color: #ffffff;' : '' ?>" href="?page=<?= $i ?>"><?= $i ?>
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
        location.href = 'BR_bookreview_list_delete.php?BR_sid=' + d;
    }

    function delete_cancel() {
        location.href = window.location.href;
    }
</script>
<?php require '__html_foot.php'; ?>