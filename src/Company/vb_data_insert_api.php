<?php
require __DIR__. '/__admin_required.php';
require __DIR__. '/__connect_db.php';

//移動上傳的圖檔到指定資料夾
$upload_dir = __DIR__. '/../venderBooks_Management/vb_images/';
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


if(!empty($_FILES['pic'])){ //檔案有沒有上傳
    if(in_array($_FILES['pic']['type'],$allowed_types)){  //上傳檔案類型是否符合

        $new_filename = sha1(uniqid(). $_FILES['pic']['name']); //為了避免檔案重名(因為重名新的會覆蓋掉舊的),所以將上傳檔案重新命名
        $new_ext = $exts[$_FILES['pic']['type']];

        move_uploaded_file($_FILES['pic']['tmp_name'], $upload_dir. $new_filename. $new_ext);
        //函式 : move_uploaded_file(要移动的文件名稱,移動文件的新位置。);
    }
}

$result = [
    'success' => false,
    'code' => 400,
    'info' => '請輸入必填欄位',
    'post' => $_POST,
];

if(empty($_POST['name'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    exit;
};


$sql = "INSERT INTO `vb_books`(`isbn`, `name`, `author`, `publishing`, `publish_date`, `version`, `fixed_price`, `stock`, `page`, `pic`, `categories`, `introduction`, `created_at`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,NOW())";

$stmt = $pdo -> prepare($sql);

$stmt -> execute([
    $_POST['isbn'],
    $_POST['name'],
    $_POST['author'],
    $_SESSION['loginUser2']['sid'],
    $_POST['publish_date'],
    $_POST['version'],
    $_POST['fixed_price'],
    $_POST['stock'],
    $_POST['page'],
    $new_filename.$new_ext,
    $_POST['categories'],
    $_POST['introduction'],
]);


if($stmt -> rowCount() == 1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
}else{
    $result['code'] = 402;
    $result['info'] = '新增失敗'; 
};

echo json_encode($result,JSON_UNESCAPED_UNICODE);





?>