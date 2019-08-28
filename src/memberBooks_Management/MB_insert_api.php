<?php

// require __DIR__. '/__admin_required.php';
require __DIR__ . '/__connect_db.php';

$result = [
    'success'=> false,
    'code' => 400,
    'info' => '沒有輸入姓名',
];
if(empty($_POST['mb_name'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `mb_books`( 
    `mb_isbn`, `mb_name`, `mb_author`, `mb_publishing`, 
    `mb_publishDate`, `mb_fixedPrice`, `mb_page`, 
    `mb_savingStatus`, `mb_shelveMember`, `mb_shelveDate`,
       `mb_remarks`)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";

$stmt = $pdo->prepare($sql); 

$stmt->execute([
    $_POST['mb_isbn'],
    $_POST['mb_name'],
    $_POST['mb_author'],
    $_POST['mb_publishing'],
    $_POST['mb_publishDate'],
    $_POST['mb_fixedPrice'],
    $_POST['mb_page'],
    $_POST['mb_savingStatus'],
    $_POST['mb_shelveMember'],
    // $_POST['mb_pic'],
    // $_POST['mb_categories'],
    $_POST['mb_remarks'],
]);

if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
}else{
    $result['code'] = 420;
    $result['info'] = '新增失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);