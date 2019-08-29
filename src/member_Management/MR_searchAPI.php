<?php require  'MR_db_connect.php' ?>
<?php

$s = isset($_GET['s']) ? $_GET['s'] : 'MR00055';
// // if (empty($_GET['searchText'])) {
// //     exit;
// // }
$item = [
    'sid',
    'MR_number',
    'MR_name',
    'MR_password',
    'MR_nickname',
    'MR_email',
    'MR_gender',
    'MR_birthday',
    'MR_mobile',
    'MR_career',
    'MR_address',
    'MR_personLevel',
    'MR_createdDate'
];
$thead_item = [
    '#', '編號', '等級', '姓名', '密碼', '電子信箱', '性別', '生日', '手機',
];


$range = '';
for ($i = 0; $i < count($item); $i++) {
    if ($i == (count($item) - 1)) {
        $range .=  "`$item[$i]`" . " LIKE '%$s%' ";
    } else {
        $range .= "`$item[$i]`" . " LIKE '%$s%' OR";
    }
}
// `sid` LIKE %$_GET['s']%
$sql = "SELECT * FROM `mr_information` WHERE $range";
$stmt=$pdo->query($sql);

$rows = $stmt->fetchAll();
// print_r($rows);

// echo $range;
// echo  $sql;
echo json_encode($rows, JSON_UNESCAPED_UNICODE);
