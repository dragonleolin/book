<?php
// $db_host = '127.0.0.1';
<<<<<<< HEAD
$db_host = '192.168.27.186';
$db_name = 'pbook';
// $db_name = 'nana_vb_project';
$db_user = 'Nana';
$db_pass = 'addme';
// $db_host = '192.168.0.108';
=======
// $db_host = '192.168.27.186';
>>>>>>> 6dee688bfd23993737a985c4f5538930fce72557
// $db_name = 'pbook';
// $db_user = 'Nana';
// $db_pass = 'addme';
$db_host = '192.168.31.72';
$db_name = 'pbook';
$db_user = 'root';
$db_pass = 'root';
$db_charset = 'utf8';
$db_collate = 'utf8_unicode_ci';

$dsn = "mysql:host={$db_host};dbname={$db_name}";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8 COLLATE utf8_unicode_ci"
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

if(! isset($_SESSION)){
    session_start();
}

?>