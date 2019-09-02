<?php require  'MR_db_connect.php' ?>
<?php
// $data_item = [
//     '#' => 'sid',
//     '會員編號' => 'number',
//     '等級' => 'personLevel',
//     '姓名' => 'name',
//     '密碼' => 'password',
//     '電子信箱' => 'email',
//     '性別' => 'gender',
//     '生日' => 'birthday',
//     '手機' => 'mobile',
//     '職業' => 'career',
//     '地址' => 'address',
//     '建立時間' => 'createdDate',
// ];
$upload_dir = __DIR__ . '/MR_uploads_img/'; //目標的上傳資料夾

$allowed_types = [ // 允許的檔案類型 mime type 查詢
    'image/jpeg',
    'image/png',
];
$exts = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
];

$new_filename = '';
$new_exts = '';


if (!empty($_FILES['pic'])) { // 有沒有上傳
    if (in_array($_FILES['pic']['type'], $allowed_types)) { // 檔案類型是否允許

        $new_filename = sha1(uniqid() . $_FILES['pic']['name']); //用uniqid()+原檔名進行sha1編碼當作新檔名
        $new_exts = $exts[$_FILES['pic']['type']]; //相對應的副檔名
        // 上傳圖片為了安全性 在資料庫只儲存檔案名 (存這兩行資料)

        move_uploaded_file($_FILES['pic']['tmp_name'], $upload_dir . $new_filename . $new_exts);
        //  move_uploaded_file(暫存檔案路徑檔名,目標檔案路徑檔名)

        $new_picName=$new_filename . $new_exts;
    }else{
        $new_picName=$new_filename . $new_exts;
    }
} 

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
`MR_address`,`MR_pic`, `MR_imageloactionX`, `MR_imageloactionY`,`MR_personLevel`, 
`MR_createdDate`) 
VALUES
(`sid`, ?, ?, ?,?, 
?, ?, ?, ?, ?,
 ?,?,?,?,?,
 NOW())";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['number'],
    $_POST['name'],
    $_POST['password'],
    $_POST['nickname'],
    $_POST['email'],
    $_POST['gender'],
    $_POST['birthday'],
    $_POST['mobile'],
    $_POST['career'],
    $_POST['address'],
    $new_picName,
    $_POST['imageLocationX'],
    $_POST['imageLocationY'],
    $_POST['personLevel'],
]);


// echo $stmt->rowCount();
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