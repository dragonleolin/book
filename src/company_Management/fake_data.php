<?php
exit;
require __DIR__ . '/__connect_db.php';
$rand_phone = "";
for ($i = 0; $i < 8; $i++) {
    $d = rand(0, 9);
    $rand_phone = $rand_phone . $d;
}
$rand_email = "";
for ($i = 0; $i < rand(6, 10); $i++) {
    $c = rand(1, 3);
    if ($c == 1) {
        $a = rand(97, 122);
        $b = chr($a);
    }
    if ($c == 2) {
        $a = rand(65, 90);
        $b = chr($a);
    }
    if ($c == 3) {
        $b = rand(0, 9);
    }
    $rand_email = $rand_email . $b;
}
$rand_tax = "";
for ($i = 0; $i < 8; $i++) {
    $e = rand(0, 9);
    $rand_tax = $rand_tax . $e;
}
$rand_stock = "";
for ($i = 0; $i < 3; $i++) {
    $f = rand(0, 9);
    $rand_stock = $rand_stock . $f;
}
$rand_acc = "";
for ($i = 0; $i < rand(6, 14); $i++) {
    $c = rand(1, 3);
    if ($c == 1) {
        $a = rand(97, 122);
        $b = chr($a);
    }
    if ($c == 2) {
        $a = rand(65, 90);
        $b = chr($a);
    }
    if ($c == 3) {
        $b = rand(0, 9);
    }
    $rand_acc = $rand_acc . $b;
}
$rand_pass = "";
for ($i = 0; $i < rand(6, 14); $i++) {
    $c = rand(1, 3);
    if ($c == 1) {
        $a = rand(97, 122);
        $b = chr($a);
    }
    if ($c == 2) {
        $a = rand(65, 90);
        $b = chr($a);
    }
    if ($c == 3) {
        $b = rand(0, 9);
    }
    $rand_pass = $rand_pass . $b;
}
for ($i = 0; $i < 1; $i++) {
    $pdo->query("INSERT INTO `cp_data_list`(`cp_name`, `cp_contact_p`, `cp_phone`,`cp_email`, `cp_address`, `cp_tax_id`, `cp_stock`, `cp_account`, `cp_password`, `cp_logo`, `cp_created_date`)
     VALUES ('麥浩斯',
            '陳美貞',
            '09{$rand_phone}','{$rand_email}@gmail.com', '台北市大安區資訊教育研究所','{$rand_tax}','{$rand_stock}' ,'{$rand_acc}','{$rand_pass}','logo', '2012-10-12')");
}
