<?php 
require 'BR__connect_db.php'; 
$page_name = 'BR_delete';
$page_title = '刪除資料';



$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0 ;

if(! empty($sid)){
    $sql_delete_one = "DELETE FROM `br_create` WHERE`sid`=$sid";
    $pdo->query($sql_delete_one);
};
header('Location: BR_data_list.php');





if(isset($_POST["delete_arr"])){
    for($s = 0 ; $s < count($_POST["delete_arr"]);$s++){
        $sql = "DELETE FROM `br_create` WHERE `br_create`.`sid`='".$_POST['delete_arr'][$s]."'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }
}

?>