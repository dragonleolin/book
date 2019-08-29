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

$fd = array_merge($_SESSION['event_insert_pbd2'], $_POST);
echo '<pre>';
print_r($fd);
echo '</pre>';

$hashid = md5(uniqid().$fd['event_name']);

//輸入活動
$sql = "INSERT INTO `pm_event`
(`hashid`,`name`, `start_time`, `end_time`, `rule`, `parent_sid`)
VALUES 
(?,?,?,?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $hashid,
    $fd['event_name'],
    $fd['event_start_time'],
    $fd['event_end_time'],
    $fd['event_pbd_type'],
    0
]);
if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '活動輸入成功';
}

$sql = "SELECT `sid` FROM `pm_event` WHERE `hashid` = '{$hashid}'";
$event_id = $pdo->query($sql)->fetch()['sid'];
print_r($event_id);
//輸入滿減規則
$i=1;
do{
    $sql = "INSERT INTO `pm_price_break_discounts`
    (`event_id`, `type`, `price_limit`, `discounts`) 
    VALUES 
    (?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $event_id,
        $fd['event_pbd_type'],
        $fd['price_condition'.$i],
        $fd['discount_amount'.$i],
    ]);
    if ($stmt->rowCount() == 1) {
        $result['success'] = true;
        $result['code'] = 200;
        $result['info'] = '折扣條件輸入成功';
    }else {
        $result['code'] = 420;
        $result['info'] = '輸入失敗';
    }
    $i++;
}while( $i<=3 and $fd['event_pbd_type']==4 and !empty($fd['price_condition'.$i]));


//輸入適用商品群組
$sql = "INSERT INTO `pm_books_group`
(`group_name`, `event_id`,`books_id`, `categories_id`) 
VALUES 
(?,?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $fd['event_name'],
    $event_id,
    json_encode($fd['book_id']),
    json_encode($fd['categories']),
]);
$books_group_sid = $pdo->lastInsertId();
echo '<br>';
var_dump($books_group_sid);
echo '<br>';

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '活動輸入成功';
}



echo json_encode($result, JSON_UNESCAPED_UNICODE);