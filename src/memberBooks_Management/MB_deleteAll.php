<?php
require __DIR__. '/__admin_required.php';
require __DIR__ . '/__connect_db.php';

$sid = isset($_GET['mb_sid']) ? intval($_GET['mb_sid']) : 0;

if (!empty($mb_sid)) {
    $sql = "DELETE FROM `mb_books` WHERE `mb_sid`= $mb_sid";
    $pdo->query($sql);
}

$checkbox_sid = isset($_COOKIE['checkbox_sid']) ? $_COOKIE['checkbox_sid'] : '';

if (!empty($checkbox_sid)) {
    $checkbox_sql = "DELETE FROM `mb_books` WHERE `mb_sid` IN ($checkbox_sid)";
    $pdo->query($checkbox_sql);
}

setcookie("checkbox_sid", "", time()-3600);

header('Location: '. $_SERVER['HTTP_REFERER']); //從哪裡來從哪裡回去