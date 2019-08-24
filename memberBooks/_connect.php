<?php 
    $db_host = 'localhost';
    $db_name = 'memberbooks';
    $db_username = 'root';
    $db_password = 'root';
    $dsn = "mysql:host={$db_host};dbname={$db_name}";
    $pdo_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8 COLLATE utf8_unicode_ci"
    ];
    try{
        //連線資料庫
        $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_username, $db_password, $pdo_options);
    }catch(PODException $e){
        print "資料庫連結失敗，訊息:{$e->getMessage()}<br>";
        die();
    }
    if(! isset($_SESSION)){
        session_start();
    }