<?php
require 'BR__connect_db.php';

$result = [
    'success'=>false,
    'code'=>400 ,
    'info'=>'資料未輸入完整',
    'post'=>$_POST
];

if(empty($_POST['BR_name'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    // header('Location: BR_data_list.php');
    exit;
}

$sql="INSERT INTO 
`br_create`(`BR_name`, `BR_phone`, `BR_email`,`BR_password`, `BR_address`, `BR_gender`, `BR_birthday`, `BR_job`) 
VALUES 
(?, ?, ?, ?, ?, ?, ?, ?)";

$stmt=$pdo->prepare($sql);

$stmt->execute([
    $_POST['BR_name'],
    $_POST['BR_phone'],
    $_POST['BR_email'],
    $_POST['BR_password'],
    $_POST['BR_address'],
    $_POST['BR_gender'],
    $_POST['BR_birthday'],
    $_POST['BR_job'],
]);

if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['code'] = 200; 
    $result['info'] = '修改成功';

}
else{
    $result['code'] = 420; 
    $result['info'] = '修改失敗';
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);

// header('Location: BR_data_list.php');