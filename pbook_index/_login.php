<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../lib/jquery-3.4.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../lib/mycss.css">
    <title><?= isset($page_title) ? $page_title : 'Document'  ?></title>

<style>
    body {
        background: url(../images/bg.png) repeat center top;
    }

    .wrapper {
        width: 600px;
        background: #2d3a3a;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgb(104, 104, 104);
        padding: 30px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #ffffff;
    }

    .border_dot {
        margin: 0 auto;
        border: 30px solid transparent;
        border-image: url(../images/icon_bg_border2.svg) 100 round;
    }

    .card-title {
        text-align: center;
    }

    .form-control:focus {
        color: #495057;
        border-color: #ffffff;
        box-shadow: 0 0 0 0.2rem rgba(156, 197, 161, 0.5);
    }

    .form-text {
        color: #cd4042;
    }
</style>
<?php include __DIR__ . '/__html_body.php' ?>
<nav class="navbar justify-content-between my_bg_seasongreen">
    <a class="navbar-brand" href="#">
        <img style="cursor: default" class="book_logo" src="../images/icon_logo.svg" alt="">
    </a>
    <ul class="nav justify-content-between">
        <li class="nav-item">
            <a class="nav-link my_text_blacktea nav_text" style="cursor: default">管理者系統</a>
        </li>
    </ul>
</nav>

<div class="wrapper">
    <div class="border_dot">
        <form name="form">
            <h5 class="card-title">品書網管理者登入</h5>
            <div class="form-group">
                <label for="email">帳號</label>
                <input type="text" class="form-control" id="email" name="email">
                <small id="emailHelp" class="form-text">示意:帳號錯誤顯示訊息</small>
            </div>
            <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" class="form-control" id="password" name="password">
                <small id="mobileHelp" class="form-text">示意:密碼錯誤顯示訊息</small>
            </div>
            <div style="text-align: center">
                <button type="submit" class="btn btn-warning" id="submit_btn">&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;入&nbsp;</button>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . '/__html_foot.php' ?>