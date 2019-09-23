<?php require  'MR_db_connect.php' ?>
<?php

$search1 = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : '';
$params = [];
$params['page'] = $page;
$params['search'] = $search1;
$where = ' WHERE 1 ';

$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10; // 每頁顯示的筆數

if (!empty($search1)) {
    $search = $pdo->quote("%$search1%");
    $where .= " AND (`MR_name` LIKE $search OR `MR_email` LIKE $search OR `MR_mobile` LIKE $search OR `MR_number` LIKE $search )";
    
    $sql = "SELECT * FROM `mr_information` $where ORDER BY `sid` LIMIT " . ($page - 1) * $per_page . "," . $per_page;
    $rows = $pdo->query($sql)->fetchAll();
    
    $count = "SELECT COUNT(1) FROM `mr_information` $where"; //用count計算出總筆數
    $totalRows = $pdo->query($count)->fetch(PDO::FETCH_NUM)[0];
    // echo "$totalRows <br>";
    $totalPage = ceil($totalRows / $per_page); //ceil()無條件進位

}
$result = [
    'params' => http_build_query($params),
    'totalPage' => $totalPage,
    'page' => $page,
    'search' => $search1,
    'totalRows' => $totalRows,
    'rows' => $rows,
];


echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>