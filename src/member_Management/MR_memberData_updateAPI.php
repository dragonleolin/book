<?php require  'MR_db_connect.php' ?>
<?php
$upload_dir = __DIR__ . '/MR_uploads_img/'; //目標的上傳資料夾

$allowed_types = [ // 允許的檔案類型 mime type 查詢
    'image/jpeg',
    'image/png',
];
$exts = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
];

if (!empty($_FILES['pic']['name'])) { // 有沒有上傳

    if (in_array($_FILES['pic']['type'], $allowed_types)) { // 檔案類型是否允許

        $new_filename = sha1(uniqid() . $_FILES['pic']['name']); //用uniqid()+原檔名進行sha1編碼當作新檔名
        $new_exts = $exts[$_FILES['pic']['type']]; //相對應的副檔名
        // 上傳圖片為了安全性 在資料庫只儲存檔案名 (存這兩行資料)

        move_uploaded_file($_FILES['pic']['tmp_name'], $upload_dir . $new_filename . $new_exts);
        //  move_uploaded_file(暫存檔案路徑檔名,目標檔案路徑檔名)
        unlink($upload_dir.$_POST['pic1']);
        $new_picName = $new_filename . $new_exts;
       
    }
}
else {
    $new_picName =$_POST['pic1'];
}


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
$sql = "UPDATE `mr_information` SET 
     `MR_name`=?,
     `MR_password`=?,
     `MR_nickname`=?,
     `MR_email`=?,
     `MR_gender`=?,
     `MR_birthday`=?,
     `MR_mobile`=?,
     `MR_career`=?,
     `MR_address`=?,
     `MR_imageloactionX`=?, 
     `MR_imageloactionY`=?,
     `MR_personLevel`=?,
     `MR_pic`=?
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
    $_POST['imageLocationX'],
    $_POST['imageLocationY'],
    $_POST['personLevel'],
    $new_picName,
    $_POST['sid'],
]);
if ($stmt->rowCount() == 1) {
    $result['success'] = true;;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '請更改資料或返回上一頁';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
