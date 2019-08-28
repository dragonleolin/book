<?php

    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['loginUser'])){
        header('Location: ../../pbook_index/_login.php');
        exit;
    }
