<?php require  '_db_connect.php' ?>
<?php
$data_item = [
    '#' => 'sid',
    '會員編號' => 'number',
    '等級' => 'personLevel',
    '姓名' => 'name',
    '密碼' => 'password',
    '電子信箱' => 'email',
    '性別' => 'gender',
    '生日' => 'birthday',
    '手機' => 'mobile',
    '職業' => 'career',
    '地址' => 'address',
    '建立時間' => 'createdDate',
];

$result = [
    'success' => false,
    'code' => 400,
    'info' => '輸入錯誤',
    'POST' => $_POST,
];

if (
    empty($_POST['name']) or
    empty($_POST['password']) or
    empty($_POST['email']) or
    empty($_POST['mobile'])
) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `mr_information`
(`sid`, `MR_number`, `MR_name`, `MR_password`, `MR_nickname`, 
`MR_email`, `MR_gender`, `MR_birthday`, `MR_mobile`, `MR_career`, 
`MR_address`, `MR_personLevel`, `MR_createdDate`) 
VALUES
(`sid`, ?, ?, ?,'nickname', 
?, '2', ?, ?, ?,
 ?, ?, NOW())";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['number'],
    $_POST['name'],
    $_POST['password'],
    // $_POST['nickname'],
    $_POST['email'],
    // // $_POST['gender'],
    $_POST['birthday'],
    $_POST['mobile'],
    $_POST['career'],
    $_POST['address'],
    $_POST['personLevel'],
]);


echo $stmt->rowCount();
//rowCount()可以返回DELETE, INSERT, 或者UPDATE語句的影響行數
//此API只能新增一筆資料，回傳1代表新增成功
if ($stmt->rowCount() == 1) {
    $result['success'] = true;;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>