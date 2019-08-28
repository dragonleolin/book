<?php

require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '未輸入欄位',
    'post' => $_POST,
];

// 不能用!isset，empty才會排除掉空字串
if (empty($_POST['coupon_no'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

foreach ($_POST as $k=>$v){
    $_POST[$k] = empty($_POST[$k])? NULL:$v;
}

$sql = "UPDATE `coupon` 
SET 
`coupon_content`=?,`coupon_no`=?,
`coupon_rule`=?,`coupon_price`=?,`coupon_number`=?,
`coupon_limit`=?,`coupon_send_type`=?,`coupon_start_time`=?,
`coupon_end_time`=?,`coupon_sp_rule`=? 
WHERE `coupon_id`= ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['coupon_content'],
    $_POST['coupon_no'],
    $_POST['coupon_rule'],
    $_POST['coupon_price'],
    $_POST['coupon_number'],
    $_POST['coupon_limit'],
    $_POST['coupon_send_type'],
    $_POST['coupon_start_time'],
    $_POST['coupon_end_time'],
    $_POST['coupon_sp_rule'],
    $_POST['coupon_id'],
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '輸入成功';
} else {
    $result['code'] = 420;
    $result['info'] = '輸入失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);