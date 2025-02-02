<?php require __DIR__ . '/__admin_required.php' ?>
<?php require  'MR_db_connect.php' ?>
<?php
$thead_item = [
    '#', '會員等級', '等級名稱', '特殊功能', '發表文章數', '折扣',
];
$function_item = [
    0 => '品書會員',
    1 => '品書學徒',
    2 => '品書專家',
    3 => '品書大師',
    4 => '品書至尊',
];
$page_title = '會員等級列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10; // 每頁顯示的筆數
$count = "SELECT COUNT(1) FROM `mr_level`"; //用count計算出總筆數

$totalRows = $pdo->query($count)->fetch(PDO::FETCH_NUM)[0];

// echo "$totalRows <br>";
$totalPage = ceil($totalRows / $per_page); //ceil()無條件進位

if ($page < 1) {
    header('Location: MR_levelList.php');
    exit;
}
if ($page > $totalPage) {
    header('Location: MR_levelList.php?page=' . $totalPage);
    exit;
}

$sql = sprintf(
    "SELECT * FROM `mr_level` ORDER BY `sid` LIMIT %s,%s",
    ($page - 1) * $per_page,
    $per_page
);
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();
?>

<?php include '../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
</style>
<?php include '../../pbook_index/__html_body.php' ?>
<?php include '../../pbook_index/__navbar.php' ?>

<section class="justify-content-center p-4">
    <div class="container-fluid">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h4>會員等級列表</h4>
                <div class="title_line"></div>
            </div>
            <ul class="nav justify-content-between">
                <li class="nav-item">
                    <div style="padding: 0.375rem 0.75rem;">
                        <i class="fas fa-check"></i>
                        目前總計 <?= $totalRows ?> &nbsp筆資料
                    </div>
                </li>
                <li class="nav-item" style="margin: 0px 10px">
                    <button class="btn btn-outline-primary my-2 my-sm-0" onclick="location.href='MR_memberData_insert.php'">
                        <i class="fas fa-plus-circle"></i>
                        新增等級分類
                    </button>
                </li>
                <li class="nav-item" style="flex-grow: 1">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="search form-control mr-sm-2" id="search_bar" type="search" placeholder="Search" aria-label="Search">
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
                    <?php for ($i = 0; $i < count($thead_item); $i++) : ?>
                        <th scope="col"><?= $thead_item[$i] ?></th>
                    <?php endfor ?>
                    <th scope="col">修改</th>
                    <th scope="col">刪除</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($rows as $a) : ?>
                    <tr>
                        <td><?= $a['sid'] ?></td>
                        <td><?= $a['MR_personLevel'] ?></td>
                        <td><?= $a['MR_levelName'] ?></td>
                        <td><?= htmlentities($a['MR_function']) ?></td>
                        <td><?= $a['MR_articleNumber'] ?></td>
                        <td><?= htmlentities($a['MR_discount']) ?></td>
                        <td><a href="MR_memberData_update.php?sid=<?= $a['sid'] ?>"><i class="fas fa-edit"></i></a></td>
                        <td><a href="javascript:delete_one(<?= $a['sid'] ?>)"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?php if ($totalPage > 1) : ?>
        <nav class="" aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link my_text_blacktea" href="?page=1" aria-label="Next">
                        <i class="fas fa-angle-double-left"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= ($page - 1 <= 0) ? 1 : $page - 1 ?>">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
                <?php
                    $p_start = ($page - 3 < 0) ? 0 : $page - 3;
                    $p_end = $page + 3;
                    if ($p_start <= 0) $p_end += -($p_start) + 1;
                    if ($p_end > $totalPage) $p_start -= -($totalPage - $p_end);
                    for ($i = $p_start; $i <= $p_end; $i++) :
                        if ($i < 1 or $i > $totalPage) continue;
                        //continue跳過該次迴圈
                        ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link my_text_blacktea" href="?page=<?= ($page + 1 > $totalPage) ? $totalPage : $page + 1 ?> ?>" aria-label="Next">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link my_text_blacktea" href="?page=<?= $totalPage ?>" aria-label="Next">
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif ?>
    <!-- 刪除提示框 -->
    <div class="delete update card" id="delete_confirm" style="display:none">
        <div class="delete card-body">
            <label class="delete_text " id="delete_info"></label>
            <div>
                <button type="button" class="delete btn btn-danger" onclick="delete_yes()">確認</button>
                <button type="button" class="delete btn btn-warning" onclick="delete_no()">取消</button>
            </div>
        </div>
    </div>
</section>
<script>
    let delete_info = document.querySelector('#delete_info');
    let delete_confirm = document.querySelector('#delete_confirm')

    function delete_one(sid) {
        delete_confirm.style.display = "block";
        delete_info.innerHTML = `確定要刪除編號${sid}的資料嗎?`;
        delete_sid = sid;
        // if (confirm(`確定要刪除編號${sid}的資料嗎?`)) {
        //     location.href = 'MR_memberData_delete.php?sid=' + sid;
        // }
    }
    let delete_sid;

    function delete_yes() {
        location.href = 'MR_memberData_delete.php?sid=' + delete_sid;
    }

    function delete_no() {
        delete_confirm.style.display = "none";
    }
</script>

<?php include '../../pbook_index/__html_foot.php' ?>