<?php
require 'BR__connect_db.php';

if(empty($_POST['BR_name'])){
    header('Location: BR_data_list.php');
    exit;
}

$sql="INSERT INTO 
`br_create`(`BR_name`, `BR_phone`, `BR_email`, `BR_address`, `BR_gender`, `BR_birthday`, `BR_job`) 
VALUES 
(?, ?, ?, ?, ?, ?, ?)";

$stmt=$pdo->prepare($sql);

$stmt->execute([
    $_POST['BR_name'],
    $_POST['BR_phone'],
    $_POST['BR_email'],
    $_POST['BR_address'],
    $_POST['BR_gender'],
    $_POST['BR_birthday'],
    $_POST['BR_job'],
]);



header('Location: BR_data_list.php');