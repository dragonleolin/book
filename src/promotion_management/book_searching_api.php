<?php
require __DIR__. '/__connect_db.php';

//取得api request
$search = $_GET['search'];
$search_type = $_GET['search_type'];

$search_type_const=[
    "sid",
    "isbn",
    "name",
    "categories",
    "author",
    "publishing",
];

//搜尋解析
$search = $pdo->quote("%$search%");
//搜尋規則
$ac_sql = "SELECT * FROM `vb_books` WHERE (`{$search_type_const[$search_type]}` LIKE $search)";

//PDO
$stmt = $pdo->prepare($ac_sql);
$stmt->execute();
$row = $stmt->fetchAll();

//回傳
echo json_encode($row);