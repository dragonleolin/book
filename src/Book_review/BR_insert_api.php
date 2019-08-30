<?php
require 'BR__connect_db.php';
//大頭貼資料夾
$upload_dir = __DIR__ . '/BR_images/';
$allowed_types = [
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];

$new_filename = '';
$new_ext = '';

if (!empty($_FILES['BR_photo'])) { //檔案有沒有上傳
    if (in_array($_FILES['BR_photo']['type'], $allowed_types)) {  //上傳檔案類型是否符合

        $new_filename = sha1(uniqid() . $_FILES['BR_photo']['name']); //為了避免檔案重名(因為重名新的會覆蓋掉舊的),所以將上傳檔案重新命名
        $new_ext = $exts[$_FILES['BR_photo']['type']];

        move_uploaded_file($_FILES['BR_photo']['tmp_name'], $upload_dir. $new_filename . $new_ext);
        //函式 : move_uploaded_file(要移动的文件名稱,移動文件的新位置。);
    }
}




$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料未輸入完整',
    'post' => $_POST
];

if (empty($_POST['BR_name'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    // header('Location: BR_data_list.php');
    exit;
}

$sql = "INSERT INTO 
`br_create`(`BR_name`,`BR_password`, `BR_phone`, `BR_email`, `BR_address`, `BR_gender`, `BR_birthday`,`BR_photo`, `BR_job`) 
VALUES 
(?, SHA1(?), ?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['BR_name'],
    $_POST['BR_password'],
    $_POST['BR_phone'],
    $_POST['BR_email'],
    $_POST['BR_address'],
    $_POST['BR_gender'],
    $_POST['BR_birthday'],
    $new_filename . $new_ext,
    $_POST['BR_job'],
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '修改失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);

// header('Location: BR_data_list.php');
