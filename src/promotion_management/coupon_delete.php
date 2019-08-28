<?php

require __DIR__.'/__connect_db.php';

//intval 防止 sql insert 攻擊
$coupon_id = isset($_GET['coupon_id'])? intval($_GET['coupon_id']) : 0;

if(!empty($coupon_id)){
    $sql = "DELETE FROM `coupon` WHERE `coupon`.`coupon_id` = {$coupon_id}";
    $pdo->query($sql);

}

header('Location: '. "coupon_list.php?page={$_GET['page']}");