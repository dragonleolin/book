<?php
require __DIR__ . '/__connect_db.php';
$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
$sid = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
if(!empty($sid)) {
    $sql = "DELETE FROM `pm_event` WHERE `pm_event`.`sid` = $sid";
    $pdo->query($sql);
}
header("Location: event_list.php?page=$page");