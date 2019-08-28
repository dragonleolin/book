<?php
require __DIR__. '/__connect_db.php';


$result = [
    'success' => false, //#= 是胖箭頭=>
    'code' => 400, //#= 是胖箭頭=>
    'info' => '資料欄位不足', //#= 是胖箭頭=>
    'post' => $_POST,
];


//如果沒有輸入必要欄位，就離開
if(empty($_POST['name']) or empty($_POST['sid'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "UPDATE `address_book` SET
         `name`=?,
         `email`=?,
         `mobile`=?,
         `birthday`=?,
         `address`=?
         WHERE `sid`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['mobile'],
        $_POST['birthday'],
        $_POST['address'],
        $_POST['sid'],
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













