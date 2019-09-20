<?php require __DIR__ . '/__admin_required.php' ?>
<?php require  'MR_db_connect.php' ?>
<?php

$result = [
    'success' => false,
    'code' => 400,
    'info' => '讀取錯誤',
    'POST' => $_GET,
];
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if (empty($_GET['sid'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "SELECT * FROM `mr_information` WHERE `sid`= $sid ";

$data = $pdo->query($sql)->fetchAll();


echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>


