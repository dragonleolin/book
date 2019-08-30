<?php
require __DIR__. '/__admin_required.php';
require __DIR__ . '/__connect_db.php';

$mb_sid = isset($_GET['mb_sid'])? intval($_GET['mb_sid']) : 0;

if(! empty($mb_sid)){
    $sql = "DELETE FROM `mb_books` WHERE `mb_sid`=$mb_sid";
    $pdo->query($sql);
}

header('Location: '. $_SERVER['HTTP_REFERER']);