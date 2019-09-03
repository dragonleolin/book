<?php

require __DIR__. '/AC__connect_db.php';

if (empty($_POST['AC_name']) or empty($_POST['AC_sid'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料錯誤',
    'post' => $_POST,
];


$upload_dir = __DIR__. '/AC_images/';
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

$pic_sql = sprintf("SELECT `AC_pic` FROM `ac_pbook` WHERE `AC_sid` = %s", $_POST['AC_sid']);
$pic_stmt = $pdo->query($pic_sql);
$new_filename = $pic_stmt->fetch()['AC_pic'];


if(!empty($_FILES['AC_pic'])){ //檔案有沒有上傳
    if(in_array($_FILES['AC_pic']['type'],$allowed_types)){  //上傳檔案類型是否符合

        $new_filename = sha1(uniqid(). $_FILES['AC_pic']['name']); //為了避免檔案重名(因為重名新的會覆蓋掉舊的),所以將上傳檔案重新命名
        $new_ext = $exts[$_FILES['AC_pic']['type']];
        move_uploaded_file($_FILES['AC_pic']['tmp_name'], $upload_dir. $new_filename. $new_ext);
        //函式 : move_uploaded_file(要移動的文件名稱,移動文件的新位置。);
    }
}

if (empty($_POST['AC_introduction'])) {
    $introduction_sql = sprintf("SELECT `AC_introduction` FROM `ac_pbook` WHERE `AC_sid` = %s", $_POST['AC_sid']);
    $introduction_stmt = $pdo->query($introduction_sql);
    $_POST['AC_introduction'] = $introduction_stmt->fetch()['AC_introduction'];
}

$sql = "UPDATE `ac_pbook` SET
         `AC_name`=?,
         `AC_title`=?,
         `AC_type`=?,
         `AC_date`=?,
         `AC_eventArea`=?,
         `AC_mobile`=?,
         `AC_organizer`=?,
         `AC_introduction`=?,
         `AC_pic`=?
         WHERE `AC_sid`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        $_POST['AC_name'],
        $_POST['AC_title'],
        $_POST['AC_type'],
        $_POST['AC_date'],
        $_POST['AC_eventArea'],
        $_POST['AC_mobile'],
        $_POST['AC_organizer'],
        $_POST['AC_introduction'],
        $new_filename . $new_ext,
        $_POST['AC_sid'],
]);


if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '活動修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '活動沒有修改';
};

echo json_encode($result, JSON_UNESCAPED_UNICODE);