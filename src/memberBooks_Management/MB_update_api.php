<?php

require __DIR__. '/__admin_required.php';
require __DIR__ . '/__connect_db.php';

//移動上傳的圖檔到指定資料夾
$upload_dir = __DIR__. '/mb_images/';
$allowed_types =[
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];

$new_filename = '';
$new_ext ='';

$pic_sql = sprintf("SELECT `mb_pic` FROM `mb_books` WHERE `mb_sid` = %s", $_POST['mb_sid']);
$pic_stmt = $pdo->query($pic_sql);
$new_filename = $pic_stmt->fetch()['mb_pic'];

if(!empty($_FILES['mb_pic'])){ //檔案有沒有上傳
    if(in_array($_FILES['mb_pic']['type'],$allowed_types)){  //上傳檔案類型是否符合

        $new_filename = sha1(uniqid(). $_FILES['mb_pic']['name']); //為了避免檔案重名(因為重名新的會覆蓋掉舊的),所以將上傳檔案重新命名
        $new_ext = $exts[$_FILES['mb_pic']['type']];

        move_uploaded_file($_FILES['mb_pic']['tmp_name'], $upload_dir. $new_filename. $new_ext);
        //函式 : move_uploaded_file(要移动的文件名稱,移動文件的新位置。);
    }
}

$result = [
    'success'=> false,
    'code' => 400,
    'info' => '請輸入必填欄位',
    'post' => $_POST,
];


if(empty($_POST['mb_name'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "UPDATE `mb_books` 
SET 
`mb_isbn`=?,
`mb_name`=?,
`mb_author`=?,
`mb_publishing`=?,
`mb_publishDate`=?,
`mb_version`=?,
`mb_fixedPrice`=?,
`mb_page`=?,
`mb_savingStatus`=?,
`mb_shelveMember`=?,
`mb_pic`=?,
`mb_categories`=?,
`mb_remarks`=?,
`mb_shelveDate`= NOW()
WHERE `mb_sid`=?";

$stmt = $pdo->prepare($sql); 

$stmt->execute([
    $_POST['mb_isbn'],
    $_POST['mb_name'],
    $_POST['mb_author'],
    $_POST['mb_publishing'],
    $_POST['mb_publishDate'],
    $_POST['mb_version'],
    $_POST['mb_fixedPrice'],
    $_POST['mb_page'],
    $_POST['mb_savingStatus'],
    $_POST['mb_shelveMember'],
    $new_filename.$new_ext,
    $_POST['mb_categories'],
    $_POST['mb_remarks'],
    $_POST['mb_sid'],
]);

if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
}else{
    $result['code'] = 420;
    $result['info'] = '修改失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);