<?php
require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '輸入錯誤',
];
# 如果沒有輸入必要欄位
if (empty($_POST['account']) or empty($_POST['oldpassword']) or empty($_POST['newpassword'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$sql = "SELECT `cp_account`, `cp_password`, `cp_name` FROM `cp_data_list` WHERE `cp_account`=? AND `cp_password`=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['account'],
    $_POST['oldpassword'],
]);
$row = $stmt->fetch();
if (!empty($row)) {
    $sql2 = "UPDATE `cp_data_list` SET `cp_password`= ? WHERE `cp_account`=?";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([
        $_POST['newpassword'],
        $_POST['account'],
    ]);
    $sql3 = "SELECT `cp_account`, `cp_password`, `cp_name` FROM `cp_data_list` WHERE `cp_account`=? AND `cp_password`=?";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute([
        $_POST['account'],
        $_POST['newpassword'],
    ]);
    $row2 = $stmt3->fetch();
    if (!empty($row2)) {
        $_SESSION['loginUser2'] = $row2;
        $result['success'] = true;
        $result['code'] = 200;
        $result['info'] = '修改成功';
    } else {
        $result['success'] = false;
        $result['code'] = 400;
        $result['info'] = '修改失敗';
    }
} else {
    $result['success'] = false;
    $result['code'] = 400;
    $result['info'] = '修改失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
