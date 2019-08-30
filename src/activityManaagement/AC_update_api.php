<?php
require __DIR__. '/AC__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料錯誤',
    'post' => $_POST,
];


if (empty($_POST['AC_name']) or empty($_POST['AC_sid'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "UPDATE `AC_pbook` SET
         `AC_name`=?,
         `AC_title`=?,
         `AC_type`=?,
         `AC_date`=?,
         `AC_eventArea`=?,
         `AC_mobile`=?,
         `AC_organizer`=?
         WHERE `AC_sid`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        $_POST['AC_name'],
        $_POST['AC_title'],
        $_POST['AC_type'],
        $_POST['AC_date'],
        $_POST['AC_eventArea'],
        $_POST['AC_mobile'],
        $_POST['AC_organizer'],
        $_POST['AC_sid'],
]);


if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '活動修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '活動沒有修改';
};

echo json_encode($result, JSON_UNESCAPED_UNICODE);