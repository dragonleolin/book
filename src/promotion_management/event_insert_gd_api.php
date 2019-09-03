<?php
require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '未輸入欄位',
    'post' => $_POST,
];

if (empty($_POST) or empty($_SESSION)) {
    echo json_encode($result);
    exit;
}

$fd = array_merge($_SESSION['event_insert_gd'], $_POST);
//unset($_SESSION['event_insert_gd']);

$fd['book_group'] = json_decode($fd['book_group']);

echo '<pre>';
print_r($fd);
echo '</pre>';


//輸入活動
$sql = "INSERT INTO `pm_event`
(`name`, `start_time`, `end_time`,`created_time`, `rule`,`user_level`, `group_type`,`cp_group`, `event_set`)
VALUES 
(?,?,?,NOW(),?,?,?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $fd['event_name'],
    $fd['event_start_time'],
    $fd['event_end_time'],
    $fd['gd_type'],
    $fd['user_level_type'],
    $fd['group_type'],
    $fd['cp_group_set'],
    0
]);
if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '活動輸入成功';
}


//輸入折扣條件
$event_id = $pdo->lastInsertId();
echo 'event_id:' . $event_id;

$i = 1;
$sql = "INSERT INTO `pm_general_discounts`
    (`event_id`, `type`, `discounts`) 
    VALUES 
    (?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $event_id,
    $fd['gd_type'],
    $fd['gd_amount'],
]);
if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 210;
    $result['info'] = '折扣條件輸入成功';
} else {
    $result['code'] = 420;
    $result['info'] = '輸入失敗';
}


//輸入適用會員
if ($fd['user_level_type'] == 1) {
    $sql = "";
    foreach ($fd['user_level'] as $k => $v) {
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



//輸入參與廠商
if ($fd['cp_group_set'] == 1) {

    $sql = "";
    foreach ($fd['cp_group'] as $k => $v) {
        $sql = $sql . "INSERT INTO `pm_condition`
        (`event_id`, `cp_id`)
        VALUES 
        ({$event_id},{$v});";
    }
    $stmt = $pdo->query($sql);
    if ($stmt->rowCount() == 1) {
        $result['success'] = true;
        $result['code'] = 220;
        $result['info'] = '廠商輸入成功';
    }
}


//輸入適用商品群組
if ($fd['group_type'] == 1) {

    $sql = "";
    foreach ($fd['categories'] as $k => $v) {
        $sql = $sql . "INSERT INTO `pm_books_group`
        (`event_id`, `categories_id`)
        VALUES 
        ({$event_id},{$v});";
    }
    $stmt = $pdo->query($sql);
    if ($stmt->rowCount() == 1) {
        $result['success'] = true;
        $result['code'] = 230;
        $result['info'] = '商品群組輸入成功';
    }
} else if ($fd['group_type'] == 2) {
    $sql = "";
    foreach ($fd['book_group'] as $k => $v) {
        $sql = $sql . "INSERT INTO `pm_books_group`
        (`event_id`, `books_id`)
        VALUES 
        ({$event_id},{$v});";
    }
    $stmt = $pdo->query($sql);
    if ($stmt->rowCount() == 1) {
        $result['success'] = true;
        $result['code'] = 240;
        $result['info'] = '商品群組新增成功';
    }
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);

header('Location: result_page.php');