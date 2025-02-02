<?php
require __DIR__. '/AC__connect_db.php';

// --------------------------------------------------------------------------------------
//移動上傳的圖檔到指定資料夾
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

// $fileCount = count($_FILES['AC_pic']['name']);

if(!empty($_FILES['AC_pic'])){ //檔案有沒有上傳
    if(in_array($_FILES['AC_pic']['type'],$allowed_types)){  //上傳檔案類型是否符合

        $new_filename = sha1(uniqid(). $_FILES['AC_pic']['name']); //為了避免檔案重名(因為重名新的會覆蓋掉舊的),所以將上傳檔案重新命名
        $new_ext = $exts[$_FILES['AC_pic']['type']];

        move_uploaded_file($_FILES['AC_pic']['tmp_name'], $upload_dir. $new_filename. $new_ext);
        //函式 : move_uploaded_file(要移动的文件名稱,移動文件的新位置。);
    }
}
// --------------------------------------------------------------------------------------

$result = [
    'success' => false,
    'code' => 400,
    'info' => '請輸入必填欄位',
    'post' => $_POST,
];

if (empty($_POST['AC_name'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `AC_pbook`(
    `AC_name`, `AC_title`,`AC_type`, `AC_date`, `AC_eventArea`, `AC_mobile`, `AC_organizer`, `AC_pic`, `AC_introduction`, `AC_created_at`
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        $_POST['AC_name'],
        $_POST['AC_title'],
        $_POST['AC_type'],
        $_POST['AC_date'],
        $_POST['AC_eventArea'],
        $_POST['AC_mobile'],
        $_POST['AC_organizer'],
        $new_filename.$new_ext,
        $_POST['AC_introduction'],
]);

if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
};



echo json_encode($result, JSON_UNESCAPED_UNICODE);