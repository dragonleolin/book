<?php
require 'BR__connect_db.php';


$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料未輸入完整',
    'post' => $_POST
];

if (empty($_POST['BR_title'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    // header('Location: BR_data_list.php');
    exit;
}

$sql = "INSERT INTO 
`br_list`(`BR_title`,`BR_book_name`,`BR_data`, `BR_image`, `BR_release_time`) 
VALUES 
(?,?,?,?,NOW())";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['BR_title'],
    $_POST['BR_book_name'],
    $_POST['BR_data'],
    $_POST['BR_image'],
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);

// header('Location: BR_data_list.php');
