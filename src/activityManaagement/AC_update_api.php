<?php
require 'AC__connect_db.php';

if(empty($_POST['AC_name'])){
    header('Location: AC_data_list.php');
    exit;
}

$sql="INSERT INTO 

`br_create`(`AC_name`, `AC_title`, `AC_type`, `AC_date`, `AC_eventArea`, `AC_mobile`, `AC_organizer`, `AC_price`) 
VALUES 
(?, ?, ?, ?, ?, ?, ?, ?)";

$stmt=$pdo->prepare($sql);

$stmt->execute([
    $_POST['AC_name'],
    $_POST['AC_title'],
    $_POST['AC_type'],
    $_POST['AC_date'],
    $_POST['AC_eventArea'],
    $_POST['AC_mobile'],
    $_POST['AC_organizer'],
    $_POST['AC_price'],
    // $_POST['AC_created_at'],

]);


header('Location: AC_data_list.php');