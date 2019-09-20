<?php
require __DIR__. '/__admin_required.php';
require __DIR__ . '/__connect_db.php';
$str = implode("','", $_POST['check']);
$sql = "DELETE FROM `cp_data_list` WHERE `sid` in ('{$str}')";
$pdo->query($sql);
header('Location: '. $_SERVER['HTTP_REFERER']); //從哪裡來從哪裡回去