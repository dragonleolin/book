<?php
require __DIR__. '/AC__connect_db.php';

$result = [
    'success' => false,
    'code' => 400, 
    'info' => '沒有輸入姓名',
    'post' => $_POST,
];

if(empty($_POST['AC_name'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `AC_pbook`(
    `AC_name`, `AC_title`, `AC_type`, `AC_date`, `AC_eventArea`, `AC_mobile`, `AC_organizer`
    ) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        $_POST['AC_name'],
        $_POST['AC_title'],
        $_POST['AC_type'],
        $_POST['AC_date'],
        $_POST['AC_eventArea'],
        $_POST['AC_mobile'],
        $_POST['AC_organizer'],
        // $_POST['AC_price'],
        // $_POST['AC_created_at'],
]);

// echo $stmt->rowCount();

if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
};



echo json_encode($result, JSON_UNESCAPED_UNICODE);