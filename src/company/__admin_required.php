<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['loginUser2'])) {
    header('Location: login.php');
    exit;
}