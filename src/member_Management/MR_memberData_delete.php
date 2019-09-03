<?php require  'MR_db_connect.php' ?>
<?php
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if (!empty($sid)) {
    $sql = "DELETE FROM `mr_information` WHERE `sid`=$sid";
    $pdo->query($sql);
}

$delete_sid = isset($_COOKIE['delete_sid']) ? $_COOKIE['delete_sid'] : '';

if (!empty($delete_sid)) {
    $delete_sid = "DELETE FROM `mr_information` WHERE `sid` IN ($delete_sid)";
    $pdo->query($delete_sid);
}

setcookie("delete_sid", "", time()-3600);

header('Location: '.$_SERVER['HTTP_REFERER']);

?>