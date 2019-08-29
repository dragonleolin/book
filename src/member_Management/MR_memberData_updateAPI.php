<?php require  'MR_db_connect.php' ?>

<?php 
$result = [
    'success' => false,
    'code' => 400,
    'info' => '沒有輸入必要資料',
    'POST' => $_POST,
];

if (empty($_POST['number']) or empty($_POST['name'])) {
    json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$sql="UPDATE `mr_information` SET 
     `MR_name`=?,
     `MR_password`=?,
     `MR_nickname`=?,
     `MR_email`=?,
     `MR_gender`=?,
     `MR_birthday`=?,
     `MR_mobile`=?,
     `MR_career`=?,
     `MR_address`=?,
     `MR_personLevel`=?
     WHERE `sid`=?";
// WHERE 前面不可以有逗號!!!
$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['name'],
    $_POST['password'],
    $_POST['nickname'],
    $_POST['email'],
    $_POST['gender'],
    $_POST['birthday'],
    $_POST['mobile'],
    $_POST['career'],
    $_POST['address'],
    $_POST['personLevel'],
    $_POST['sid'],
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '請更改資料或返回';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
