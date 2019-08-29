<?php

require __DIR__.'/__connect_db.php';

$a = [1,3,5,2];
$b = [a,b,c];
$b[] = $a;
print_r($b);

?>

