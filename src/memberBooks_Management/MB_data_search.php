<?php
require __DIR__ . '/__admin_required.php';
require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '輸入錯誤',
];

$sql = ("SELECT * FROM `mb_books` WHERE `mb_name` LIKE '%?%'");
$stmt = $pdo->prepare($sql);
$stmt ->execute([
    $_POST['data_search'],
]);
if($stmt->rowCount() == 1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '搜尋成功';
}else{
    $result['success'] = true;
    $result['code'] = 400;
    $result['info'] = '搜尋失敗';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);





?>