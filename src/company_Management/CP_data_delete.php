<?php
require __DIR__. '/__admin_required.php';
require __DIR__ . '/__connect_db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if (!empty($sid)) {
    $sql = "DELETE FROM `cp_data_list` WHERE `sid` = $sid";
    $pdo->query($sql);
}

$checkbox_sid = isset($_COOKIE['checkbox_sid']) ? $_COOKIE['checkbox_sid'] : '';

if (!empty($checkbox_sid)) {
    $checkbox_sql = "DELETE FROM `cp_data_list` WHERE `sid` IN ($checkbox_sid)";
    $pdo->query($checkbox_sql);
}

setcookie("checkbox_sid", "", time()-3600);

header('Location: '. $_SERVER['HTTP_REFERER']); //從哪裡來從哪裡回去