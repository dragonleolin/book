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

<?php require '__html_head.php'; ?>
<?php include __DIR__ . '/__html_body.php' ?>
<nav class="navbar justify-content-between my_bg_seasongreen">
    <a class="navbar-brand" href="example_index.php">
        <img class="book_logo" src="../../images/icon_logo.svg" alt="">
    </a>
    <ul class="nav justify-content-between">
        <li class="nav-item">
            <a class="nav-link my_text_blacktea nav_text">管理者「大師」,您好</a>
        </li>
        <li class="nav-item dropdown">
            <a style="display: inline" class="nav-link dropdown-toggle my_text_yellow" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="my_login_img"><img class="yoko_logo" src="../../images/yoko.jpg" alt=""></div>
            </a>
            <div class="dropdown-menu" style="left: -100%;top: 90%;">
                <a class="dropdown-item" href="#">修改密碼</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">登出</a>
            </div>
        </li>
    </ul>
</nav>
<div class="d-flex flex-row my_content">
    <!-- 左邊aside選單欄位 -->
    <?php include __DIR__ . '/__navbar.php' ?>
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
                            <th scope="col">書評資料</th>
                            <th scope="col">書評圖片</th>
                            <th scope="col">書評發表時間</th>
                            <th scope="col">書評發表人</th>
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
                                <!-- <td><a href="BR_update.php?sid=<?= $value['sid'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td><a href="javascript:delete_doublecheck(<?= $value['sid'] ?>)">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td> -->
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
            <!-- <div id="d_window" class="delete update card" style="display:none;">
                <div class="delete card-body">
                    <label class="delete_text">您確認要刪除資料嗎?</label>
                    <div>
                        <button type="button" class="delete btn btn-danger" onclick="delete_enter()"> 確認</button>
                        <button type="button" class="delete btn btn-warning" onclick="delete_cancel()">取消</button>
                    </div>
                </div>
            </div> -->

    </section>
</div>
<?php require '__html_foot.php'; ?>