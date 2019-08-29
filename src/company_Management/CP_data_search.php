<?php
require __DIR__ . '/__admin_required.php';
require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '輸入錯誤',
];

$sql = ("SELECT * FROM `cp_data_list` WHERE `cp_name` LIKE '%?%'");
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['data_search'],
]);
if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '搜尋成功';
} else {
    $result['success'] = false;
    $result['code'] = 400;
    $result['info'] = '搜尋失敗';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);
    /*OR
     `cp_contact_p` LIKE '%$data_search%' OR
     `cp_phone` LIKE '%$data_search%' OR
     `cp_email` LIKE '%$data_search%' OR
     `cp_address` LIKE '%$data_search%' OR
     `cp_tax_id` LIKE '%$data_search%' OR
     `cp_stock` LIKE '%$data_search%' OR
     `cp_account` LIKE '%$data_search%' OR
     `cp_password` LIKE '%$data_search%'*/
