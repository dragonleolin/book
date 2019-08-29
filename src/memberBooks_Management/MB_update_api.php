<?php

// require __DIR__. '/__admin_required.php';
require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];

// if(empty($_POST['name']) or empty($_POST['sid'])){
//     echo json_encode($result, JSON_UNESCAPED_UNICODE);
//     exit;
// }

$sql = "UPDATE `mb_books` SET 
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
`mb_remarks`=?,
`mb_shelveDate`= NOW()
WHERE `mb_sid`=? ";

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
    // $_POST['mb_pic'],
    // $_POST['mb_categories'],
    $_POST['mb_remarks'],
    $_POST['mb_sid'],
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '資料沒有修改';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
