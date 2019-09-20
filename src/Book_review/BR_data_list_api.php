<?php
require __DIR__. '/BR__connect_db.php';


$sql = "SELECT * FROM `br_create` ORDER BY `br_create`.`sid` ASC";

//PDO
$stmt = $pdo->prepare($sql);
$stmt->execute();
$row = $stmt->fetchAll();

//回傳
echo json_encode($row);