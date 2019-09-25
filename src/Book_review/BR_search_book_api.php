<?php
require __DIR__. '/BR__connect_db.php';

//取得api request
// $search = $_POST['search'];

$search = $_POST['search'];
//搜尋解析
// $search = $pdo->quote("%$search%");

$search = $pdo->quote("%$search%");

//搜尋規則
// $sql = "SELECT * FROM `br_create` WHERE (`BR_name` LIKE $search OR `sid` LIKE $search OR `BR_job` LIKE $search)";

$sql="SELECT * FROM `vb_books` WHERE (`name` LIKE $search OR `sid` LIKE $search)";
//PDO
$stmt = $pdo->prepare($sql);
$stmt->execute();
$row = $stmt->fetchAll();


//回傳
echo json_encode($row);