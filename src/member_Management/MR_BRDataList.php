<?php require  'MR_db_connect.php';

$page_name = 'BR_datalist';
$page_title = '書評人資料列表';



// 限制會員編號
$MR_number = isset($_GET['MR_number']) ? $_GET['MR_number'] : '';
$params = [];
$where = ' WHERE 1 ';
if (!empty($MR_number)) {
    $params['MR_number'] = $MR_number;
    $MR_number = $pdo->quote("$MR_number");
    $JOIN_ON1 = "JOIN `mr_bookcriticsfans`ON `mr_bookcriticsfans`.`MR_mrNumber` = " . $MR_number;
    $where .= " AND`BR_name`=`mr_bookcriticsfans`.`MR_BRName`";
}

$page =  isset($_GET['page']) ? intval($_GET['page']) : 1;
$page_list = 10;

$search = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($search)) {
    $params['search'] = $search;
    $search1 = $pdo->quote("%$search%");
    $where .= " AND (`BR_name` LIKE $search1 OR `BR_birthday` LIKE $search1  OR `BR_address` LIKE $search1 ) ";
}


$count = "SELECT COUNT(1) FROM `br_create` $JOIN_ON1 $where"; //用count計算出總筆數


$totalRows = $pdo->query($count)->fetch(PDO::FETCH_NUM)[0];
$totalPage = ceil($totalRows / $page_list); //ceil()無條件進位


if ($page < 1) {
    header('Location: ../Book_review/BR_data_list.php');
    exit;
}

// if ($page > $total_page) {
//     header('Location: ../Book_review/BR_data_list.php?page=' . $total_page);
//     exit;
// }

$sql = "SELECT `br_create`.* FROM `br_create` $JOIN_ON1 $where ORDER BY `sid` LIMIT " . (($page - 1) * $page_list) . "," . $page_list;
$stmt = $pdo->query($sql);
$row = $stmt->fetchAll();

?>

<?php include '../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
</style>
<?php include '../../pbook_index/__html_body.php' ?>
<?php include '../../pbook_index/__navbar.php' ?>

<div class="d-flex flex-row my_content">
    <!-- 右邊section資料欄位 -->
    <section>
        <div class="container">
            <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
                <div class="d-flex">
                    <div>
                        <h4>追蹤書評人清單</h4>
                        <div class="title_line"></div>
                    </div>
                    <ul class="nav justify-content-between">
                        <li class="nav-item" style="margin: 0px 10px">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick="history.back()">
                                <i class="fas fa-arrow-circle-left"></i>
                                會員列表
                            </button>
                        </li>
                    </ul>
                </div>
                <ul class="nav justify-content-between">
                    <li class="nav-item">
                        <div style="padding: 0.375rem 0.75rem;">
                            <i class="fas fa-check"></i>
                            總計<?= $totalRows ?>筆資料
                        </div>
                    </li>
                    <li class="nav-item" style="margin: 0px 10px">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" onclick="location.href='../Book_review/BR_insert.php'">
                            <i class="fas fa-plus-circle"></i>
                            新增書評人
                        </button>
                    </li>
                    <li class="nav-item" style="flex-grow: 1">
                        <form class="form-inline my-2 my-lg-0" name="form2">
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
                            <th scope="col">大頭貼</th>
                            <th scope="col">姓名</th>
                            <th scope="col">密碼</th>
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
                                <td><?= $value['BR_photo'] ?></td>
                                <td><?= htmlentities($value['BR_name']) ?></td>
                                <td><?= htmlentities($value['BR_password']) ?></td>
                                <td><?= htmlentities($value['BR_phone']) ?></td>
                                <td><?= htmlentities($value['BR_email']) ?></td>
                                <td><?= htmlentities($value['BR_address']) ?></td>
                                <td><?= htmlentities($value['BR_gender']) ?></td>
                                <td><?= htmlentities($value['BR_birthday']) ?></td>
                                <td><?= htmlentities($value['BR_job']) ?></td>
                                <td><a href="../Book_review/BR_update.php?sid=<?= $value['sid'] ?>">
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
                <ul class="pagination ">
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
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

    function delete_enter() {
        location.href = '../Book_review/BR_delete.php?sid=' + d;
    }

    function delete_cancel() {
        location.href = window.location.href;
    }
</script>
<?php include '../../pbook_index/__html_foot.php' ?>