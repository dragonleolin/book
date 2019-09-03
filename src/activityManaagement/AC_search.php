<?php
require __DIR__. '/AC__connect_db.php';

//取得api request
$search = $_POST['search'];

//搜尋解析
$search = $pdo->quote("%$search%");
//搜尋規則
$ac_sql = "SELECT * FROM `ac_pbook` WHERE (`AC_title` LIKE $search OR `AC_name` LIKE $search 
OR `AC_sid` LIKE $search OR `AC_type` LIKE $search OR `AC_eventArea` LIKE $search
OR `AC_organizer` LIKE $search )";

//PDO
$stmt = $pdo->prepare($ac_sql);
$stmt->execute();
$row = $stmt->fetchAll();

//回傳
echo json_encode($row);