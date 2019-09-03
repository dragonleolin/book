<?php
require __DIR__ . '/__connect_db.php';

//取得api request
$search = $_GET['search'];
$search_type = $_GET['search_type'];

$search_type_const = [
    "1",
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
if($search_type == 0){
    $ac_sql = "SELECT b.* FROM `vb_books` b
    JOIN `vb_categories` cate ON cate.`sid` = b.`categories`
    JOIN `cp_data_list` cp ON cp.`sid` = b.`publishing`
    WHERE `isbn` LIKE $search
    OR b.`name` LIKE $search
    OR cate.`name` LIKE $search
    OR `author` LIKE $search
    OR cp.`cp_name` LIKE $search";
}elseif ($search_type == 3) {
    $ac_sql = "SELECT b.* FROM `vb_books` b 
    JOIN `vb_categories` c ON c.`sid` = b.`categories` 
    WHERE (c.`name` LIKE $search)";
} elseif ($search_type == 5) {
    $ac_sql = "SELECT b.* FROM `vb_books` b 
    JOIN `cp_data_list` c ON c.`sid` = b.`publishing` 
    WHERE (c.`cp_name` LIKE $search)";
} else {
    $ac_sql = "SELECT * FROM `vb_books` WHERE (`{$search_type_const[$search_type]}` LIKE $search)";
}
//PDO
$stmt = $pdo->prepare($ac_sql);
$stmt->execute();
$row = $stmt->fetchAll();

//回傳
echo json_encode($row);