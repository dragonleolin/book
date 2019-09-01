<?php

// $db_host = '192.168.27.186';
$db_host = 'localhost';
$db_name = 'pbook';
$db_user = 'Arwen';
$db_pass = '4595';

$dsn = "mysql:host={$db_host};dbname={$db_name}";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8 COLLATE utf8_unicode_ci"
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

// try {
//     $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
// }   catch(PDOException $ex) {
//     echo 'connection failed:'. $ex->getMessage();
// } 

// if(! isset($_SESSION)){ 
//     session_start();
// }
