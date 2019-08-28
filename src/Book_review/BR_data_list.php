<?php require 'BR__connect_db.php';
$page_name = 'BR_datalist';
$page_title = '書評人資料總表';



$page =  isset($_GET['page']) ? intval($_GET['page']) : 1;
$page_list = 10;

$p_list = " SELECT COUNT(10) FROM `br_create`";

$total_list = $pdo->query($p_list)->fetch(PDO::FETCH_NUM)[0];
$total_page = ceil($total_list / $page_list);

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
<?php require 'BR__html_head.php'; ?>
<?php include __DIR__ . '/BR__html_body.php' ?>
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
    <?php include __DIR__ . '/BR__navbar.php' ?>
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
                            <input class="search form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">
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
                    <tbody>
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
            <nav aria-label="Page navigation example">
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
                        <button type="button" class="delete btn btn-danger"  onclick="delete_enter()"> 確認</button>
                        <button type="button" class="delete btn btn-warning" onclick="delete_cancel()">取消</button>
                        <!-- <a href="BR_delete.php?sid=<?= $value['sid'] ?>"></a>  -->
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
    function delete_enter(){
        location.href = 'BR_delete.php?sid=' + d;
    }
    function delete_cancel(){
        window.location.href='BR_data_list.php'
    }
</script>
<?php require 'BR__html_foot.php'; ?>