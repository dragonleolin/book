<?php require  'MR_db_connect.php' ?>

<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10; // 每頁顯示的筆數
$count = "SELECT COUNT(1) FROM `mr_information`"; //用count計算出總筆數
$totalRows = $pdo->query($count)->fetch(PDO::FETCH_NUM)[0];
// echo "$totalRows <br>";
$totalPage = ceil($totalRows / $per_page); //ceil()無條件進位

// if (($page < 1) | ($totalPage == 0)) {
//     // header('Refresh:2; url=MR_memberDataList.php');
//     header('Location: searchFail.php');
//     exit;
// }

// if ($page > $totalPage) {
//     header('Location: MR_memberDataList.php?page=' . $totalPage);
//     exit;
// }

// http_build_query($params)

$sql = "SELECT * FROM `mr_information` ORDER BY `sid` LIMIT " . ($page - 1) * $per_page . "," . $per_page;
$stmt = $pdo->query($sql)->fetchAll();
$result = [
    'totalPage' => $totalPage,
    'page' => $page,
    'search' => $search,
    'totalRows' => $totalRows,
    'rows' => $stmt,
];

echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>