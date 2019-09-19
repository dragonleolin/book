<?php
require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '未輸入欄位',
    'post' => $_POST,
];

if (empty($_POST)) {
    echo json_encode($result);
    exit;
}


//輸入活動
$sql = "INSERT INTO `pm_event`
(`name`, `start_time`, `end_time`,`created_time`, `rule`,`user_level`, `group_type`,`cp_group`, `event_set`)
VALUES 
(?,?,?,NOW(),?,?,?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['event_name'],
    $_POST['event_start_time'],
    $_POST['event_end_time'],
    $_POST['event_pbd_type'],
    $_POST['user_level_type'],
    0,
    0,
    0,
]);
if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '活動輸入成功';
}


$event_id = $pdo->lastInsertId();

//輸入折價條件
$i = 1;
do {
    $sql = "INSERT INTO `pm_price_break_discounts`
    (`event_id`, `type`, `price_limit`, `discounts`, `discount_type`,`stage`) 
    VALUES 
    (?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $event_id,
        $_POST['event_pbd_type'],
        $_POST['price_condition' . $i],
        $_POST['discount_amount' . $i],
        $_POST['discount_type'],
        $i,
    ]);
    if ($stmt->rowCount() == 1) {
        $result['success'] = true;
        $result['code'] = 210;
        $result['info'] = '折扣條件輸入成功';
    } else {
        $result['code'] = 420;
        $result['info'] = '輸入失敗';
    }
    $i++;
} while ($i <= 3 and $_POST['event_pbd_type'] == 4 and !empty($_POST['price_condition' . $i]));


//輸入適用會員
if ($_POST['user_level_type'] == 1) {
    $sql = "";
    foreach ($_POST['user_level'] as $k => $v) {
        $sql = $sql . "INSERT INTO `pm_condition`
        (`event_id`, `user_level`)
        VALUES 
        ({$event_id},{$v});";
    }
    $stmt = $pdo->query($sql);
    if ($stmt->rowCount() == 1) {
        $result['success'] = true;
        $result['code'] = 220;
        $result['info'] = '會員條件輸入成功';
    }
}

header('Location: result_page.php');