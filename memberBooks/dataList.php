<?php

require __DIR__ . '/_connect.php';
$page_name = 'data_list';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10;

$t_sql = "SELECT COUNT(1) FROM `memberBooks`";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; //共多少筆資料
$totalPage = ceil($totalRows / $per_page); //有多少頁
// printf("$totalRows<br>");
// echo "$totalPage<br>";
// exit;

if ($page < 1) {
    header('Location: dataList.php');
    exit;
}
if ($page > $totalPage) {
    header('Location: deatList.php?page=' . $totalPage);
    exit;
}

$sql = sprintf(
    "SELECT * FROM `memberBooks` ORDER BY `sid` ASC LIMIT %s, %s",
    ($page - 1) * $per_page,
    $per_page
);

$stmt = $pdo->query($sql);


?>

<?php require __DIR__ . '/_header.php' ?>
<?php require __DIR__ . '/_navbar.php' ?>

<div class="container">
    <div style="margin-top: 2rem;">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?> ">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                <?php
                $p_start = $page - 5;
                $p_end = $page + 5;
                for ($i = $p_start; $i <= $p_end; $i++) :
                    if ($i < 1 or $i > $totalPage) continue;
                    ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="alert alert-success" role="alert">
            目前的資料筆數: <?php echo $totalRows; ?> 筆
        </div>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <!-- <th scope="col"><i class="fas fa-trash-alt"></i></th> -->
                    <th scope="col">#</th>
                    <th scope="col">會員編號</th>
                    <th scope="col">ISBN碼</th>
                    <th scope="col">書名</th>
                    <th scope="col">類別</th>
                    <th scope="col">作者</th>
                    <th scope="col">出版社</th>
                    <th scope="col">版次</th>
                    <th scope="col">定價</th>
                    <th scope="col">保存狀況</th>
                    <th scope="col">備註</th>
                    <th scope="col">頁數</th>
                    <th scope="col">上架日期</th>
                    <th scope="col">出版日期</th>
                    <th scope="col"><i class="fas fa-edit"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = $stmt->fetch()) { ?>
                <tr>
                    <!-- 加入htmlentities()會使用跳脫字元，避免讓使用者下script語法-->
                    <td><?= $r['sid'] ?></td>
                    <td><?= htmlentities($r['會員編號']) ?></td>
                    <td><?= htmlentities($r['ISBN碼']) ?></td>
                    <td><?= htmlentities($r['書名']) ?></td>
                    <td><?= htmlentities($r['類別']) ?></td>
                    <td><?= htmlentities($r['作者']) ?></td>
                    <td><?= htmlentities($r['出版社']) ?></td>
                    <td><?= htmlentities($r['版次']) ?></td>
                    <td><?= htmlentities($r['定價']) ?></td>
                    <td><?= htmlentities($r['保存狀況']) ?></td>
                    <td><?= htmlentities($r['備註']) ?></td>
                    <td><?= htmlentities($r['頁數']) ?></td>
                    <td><?= htmlentities($r['上架日期']) ?></td>
                    <td><?= htmlentities($r['出版日期']) ?></td>
                    <td><a href="__data_edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-edit"></i></a>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/_footer.php' ?>