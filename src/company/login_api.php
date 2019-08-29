<?php
require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '輸入錯誤',
];


# 如果沒有輸入必要欄位
if (empty($_POST['account']) or empty($_POST['password'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}


$sql = "SELECT `cp_account`, `cp_password`, `cp_name` FROM `cp_data_list` WHERE `cp_account`=? AND `cp_password`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['account'],
    $_POST['password'],
]);

$row = $stmt->fetch();

if (!empty($row)) {
    $_SESSION['loginUser2'] = $row;
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '登入成功';
} else {
    $result['success'] = false;
    $result['code'] = 400;
    $result['info'] = '登入失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
