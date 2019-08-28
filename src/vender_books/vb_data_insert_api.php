<?php
require __DIR__. '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '請輸入書籍名稱',
    'post' => $_POST,
];

if(empty($_POST['name'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    exit;
};

$sql = "INSERT INTO `vb_books`(`isbn`, `name`, `author`, `publishing`, `publish_date`, `version`, `fixed_price`, `stock`, `page`, `created_at`) 
        VALUES (?,?,?,?,?,?,?,?,?,NOW())";

$stmt = $pdo -> prepare($sql);

$stmt -> execute([
    $_POST['isbn'],
    $_POST['name'],
    $_POST['author'],
    $_POST['publishing'],
    $_POST['publish_date'],
    $_POST['version'],
    $_POST['fixed_price'],
    $_POST['stock'],
    $_POST['page'],
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