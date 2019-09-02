<?php 
require 'BR__connect_db.php'; 
$page_name = 'BR_bookreview_list_delete';
$page_title = '刪除資料';


$sid = isset($_GET['BR_sid']) ? intval($_GET['BR_sid']) : 0 ;

if(! empty($sid)){
    $sql = "DELETE FROM `br_list` WHERE`BR_sid`=$sid";
    $pdo->query($sql);
};
header('Location: BR_bookreview_list.php');