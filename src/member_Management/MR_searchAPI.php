<?php require  'MR_db_connect.php' ?>
<?php
if (empty($_POST['searchText'])) {
    exit;
}
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

$sql = "SELECT * FROM `mr_information` WHERE 1";
