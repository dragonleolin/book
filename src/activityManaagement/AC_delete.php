<?php
// require __DIR__. '/AC__admin_required.php';
require __DIR__. '/AC__connect_db.php';
$page_name = 'AC_delete';
$page_title = '刪除資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if(! empty($sid)) {
    $sql = "DELETE FROM `ac_pbook` WHERE `AC_sid`=$sid";
    $pdo->query($sql);
}

header('Location: '. $_SERVER['HTTP_REFERER']);
