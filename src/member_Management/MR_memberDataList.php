<?php require  'MR_db_connect.php' ?>
<?php
$thead_item = [
    '#', '編號', '等級', '姓名', '密碼', '電子信箱', '性別', '生日', '手機',
];

$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10; // 每頁顯示的筆數
$count = "SELECT COUNT(1) FROM `mr_information`"; //用count計算出總筆數

$totalRows = $pdo->query($count)->fetch(PDO::FETCH_NUM)[0];

// echo "$totalRows <br>";
$totalPage = ceil($totalRows / $per_page); //ceil()無條件進位

if ($page < 1) {
    header('Location: MR_dataList.php');
    exit;
}
if ($page > $totalPage) {
    header('Location: MR_dataList.php?page=' . $totalPage);
    exit;
}

$sql = sprintf(
    "SELECT * FROM `mr_information` ORDER BY `sid` LIMIT %s,%s",
    ($page - 1) * $per_page,
    $per_page
);
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();
?>

<?php include '../../pbook_index/__html_head.php' ?>
<?php include '../../pbook_index/__html_body.php' ?>
<?php include '../../pbook_index/__navbar.php' ?>

<section class="justify-content-center p-4">
    <div class="container-fluid">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h4>會員列表</h4>
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
                        新增會員
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
                    <th scope="col">詳細</th>
                    <th scope="col">修改</th>
                    <th scope="col">刪除</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($rows as $a) : ?>
                <tr>
                    <td><?= $a['sid'] ?></td>
                    <td><?= htmlentities($a['MR_number']) ?></td>
                    <td><?= htmlentities($a['MR_personLevel']) ?></td>
                    <td><?= htmlentities($a['MR_name']) ?></td>
                    <td><?= htmlentities($a['MR_password']) ?></td>
                    <td><?= htmlentities($a['MR_email']) ?></td>
                    <td><?= (htmlentities($a['MR_gender'])) ? '男' : '女' ?></td>
                    <td><?= htmlentities($a['MR_birthday']) ?></td>
                    <td><?= htmlentities($a['MR_mobile']) ?></td>
                    <td><a href="#"><i class="fas fa-file-alt"></i></i></a></td>
                    <td><a href="MR_memberData_update.php?sid=<?= $a['sid'] ?>"><i class="fas fa-edit"></i></a></td>
                    <td><a href="javascript:delete_one(<?= $a['sid'] ?>)"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <nav class="" aria-label="Page navigation example ">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page - 1 ?>">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            $p_start = $page - 3;
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
                <a class="page-link my_text_blacktea" href="?page=<?= $page  + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>

            </li>
        </ul>
    </nav>
</section>
<script>
    let search_bar=document.querySelector('#search_bar');
    const letsSearch=(evt)=>{
        // location.href


    }
    search_bar.addEventListener('keydown',letsSearch);
    
    function delete_one(sid) {
        console.log('2');
        if (confirm(`確定要刪除編號${sid}的資料嗎?`)) {
                location.href = 'MR_memberData_delete.php?sid=' + sid;
            }
        }
</script>

<?php include '../../pbook_index/__html_foot.php' ?>