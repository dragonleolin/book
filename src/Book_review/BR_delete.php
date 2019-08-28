<?php 
require 'BR__connect_db.php'; 
$page_name = 'BR_delete';
$page_title = '刪除資料';


$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0 ;

if(! empty($sid)){
    $sql = "DELETE FROM `br_create` WHERE`sid`=$sid";
    $pdo->query($sql);
};
header('Location: BR_data_list.php');