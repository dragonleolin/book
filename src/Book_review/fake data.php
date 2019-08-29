
<?php
exit;
// require '__connect_db.php';
require __DIR__ . '/BR__connect_db.php';

for ($i = 0; $i < 30; $i++) {
    $pdo->query("INSERT INTO `br_list`(`BR_title`, `BR_data`, `BR_release_time`, `BR_publisher`) 
VALUES 
('哈利波特${i}','魔法','2019-08-14 07:00:00','master')");
}
