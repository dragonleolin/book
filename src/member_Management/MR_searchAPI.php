<?php require  'MR_db_connect.php' ?>
<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $search = $pdo->quote("%$search%");
    $sql = "SELECT * FROM `mr_information` WHERE`MR_name` LIKE $search OR `MR_email` LIKE $search OR `MR_mobile` LIKE $search OR `MR_number` LIKE $search ";
    $rows = $pdo->query($sql)->fetchAll();
}

echo json_encode($rows, JSON_UNESCAPED_UNICODE)

?>