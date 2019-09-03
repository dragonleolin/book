<?php

require __DIR__ . '/__admin_required.php';
require __DIR__ . '/__connect_db.php';



$result = [
    'success'=> false,
    'code' => 400,
    'info' => '沒有輸入會員編號',
];


if(empty($_POST['mb_shelveMember'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
// echo $_POST['mb_shelveMember'];


//用輸入的欄位去核對表格的會員編號欄位
$sql = "SELECT `MR_number` FROM `mr_information` WHERE MR_number = '".$_POST['mb_shelveMember']."'";


$stmt =  $pdo->query($sql)->fetchAll();

// var_dump($stmt);
// var_dump(count($stmt)>0);
// exit;



if(count($stmt)>0){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '查到有會員編號';
}else{
    $result['code'] = 420;
    $result['info'] = '沒有此會員編號';
    $result['error'] = $stmt;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);