<?php
require __DIR__. '/BR__connect_db.php';


$sql = "SELECT * FROM `mr_information` WHERE `MR_personLevel`= '6'";

//PDO
$stmt = $pdo->prepare($sql);
$stmt->execute();
$row = $stmt->fetchAll();

//回傳
echo json_encode($row);