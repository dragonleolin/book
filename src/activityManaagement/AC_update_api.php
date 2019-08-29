<?php
require 'AC__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];

if(empty($_POST['AC_name']) or empty($_POST['AC_sid'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "UPDATE `AC_pbook` SET
         `name`=?,
         `email`=?,
         `mobile`=?,
         `birthday`=?,
         `address`=?
         WHERE `sid`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        $_POST['AC_name'],
        $_POST['AC_email'],
        $_POST['AC_mobile'],
        $_POST['AC_birthday'],
        $_POST['AC_address'],
        $_POST['AC_sid'],
]);

//echo $stmt->rowCount();
if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '資料沒有修改';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);