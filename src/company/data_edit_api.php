<?php
require __DIR__. '/__admin_required.php';
require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '輸入錯誤',
    'post' => $_POST,
];
if (empty($_POST['cp_name']) or empty($_POST['sid'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$upload_dir = __DIR__ . '/../company_Management/logo/';
$allowed_types = [
    'image/png',
    'image/jpeg',
    'image/svg+xml',
];
$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
    'image/svg+xml' => '.svg',
];
$new_filename = '';
$new_ext = '';
$sid = $_SESSION['loginUser2']['sid'];
$pic_sql = sprintf("SELECT `cp_logo` FROM `cp_data_list` WHERE `sid` = %s", $sid);
$pic_stmt = $pdo->query($pic_sql);
$new_filename = $pic_stmt->fetch()['cp_logo'];

if (!empty($_FILES['cp_logo'])) { //檔案有上傳
    if (in_array($_FILES['cp_logo']['type'], $allowed_types)) {  //上傳檔案類型是否符合
        $new_filename = sha1(uniqid() . $_FILES['cp_logo']['name']); //為了避免檔案重名(因為重名新的會覆蓋掉舊的),所以將上傳檔案重新命名
        $new_ext = $exts[$_FILES['cp_logo']['type']];
        move_uploaded_file($_FILES['cp_logo']['tmp_name'], $upload_dir . $new_filename . $new_ext);
    }
}

$sql = "UPDATE `cp_data_list` SET 
    `cp_name` = ?,
    `cp_contact_p` = ?,
    `cp_phone` = ?,
    `cp_email` = ?,
    `cp_address` = ?,
    `cp_tax_id` = ?,
    `cp_logo` = ?
    WHERE `sid` = $sid ";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['cp_name'],
    $_POST['cp_contact_p'],
    $_POST['cp_phone'],
    $_POST['cp_email'],
    $_POST['cp_address'],
    $_POST['cp_tax_id'],
    $new_filename . $new_ext,
]);
// echo $stmt->rowCount();         //上傳幾筆

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['success'] = false;
    $result['code'] = 400;
    $result['info'] = '修改失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);