<?php
require __DIR__ . '/../../vendor/autoload.php';

use Tracy\Debugger;

Debugger::enable();

require __DIR__. '/__admin_required.php';
require __DIR__ . '/__connect_db.php';


print_r($_POST);
$str = implode("','", $_POST['check']);
print_r('$str='.$str);
// //刪除語法 in (1,2,3)
$sql = "DELETE FROM `mb_books` WHERE `mb_sid` in ('{$str}')";
$pdo->query($sql);
header('Location: '. $_SERVER['HTTP_REFERER']); //從哪裡來從哪裡回去
?>