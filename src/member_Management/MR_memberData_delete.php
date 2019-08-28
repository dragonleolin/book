<?php require  'MR_db_connect.php' ?>
<?php
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if (!empty($sid)) {
    $sql = "DELETE FROM `mr_information` WHERE `sid`=$sid";
    $pdo->query($sql);
}
header('Location: '.$_SERVER['HTTP_REFERER']);

?>