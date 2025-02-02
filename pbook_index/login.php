<?php
require __DIR__ . '/__connect_db.php';
$page_title = '登入';


?>
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

        #info_position {
            left: 26.5%;
            top: 36%;
        }

        #info_position2 {
            left: 26.5%;
            top: 36%;
        }
    </style>
    <?php include __DIR__ . '/__html_body.php' ?>
    <nav class="navbar justify-content-between my_bg_seasongreen">
        <a class="navbar-brand" href="../_index.php">
            <img class="book_logo" src="../images/icon_logo.svg" alt="">
        </a>
        <ul class="nav justify-content-between">
            <li class="nav-item">
                <a class="nav-link my_text_blacktea nav_text" style="cursor: default">管理者系統</a>
            </li>
        </ul>
    </nav>

    <div class="wrapper" id="wrapper">
        <div class="border_dot">
            <h5 class="card-title">品書網管理者登入</h5>
            <form name="form1" onsubmit="return checkForm()">
                <div class="form-group">
                    <label for="account">帳號</label>
                    <input type="text" class="form-control" id="account" name="account">
                    <small id="accountHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="password">密碼</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                    <small id="passwordHelp" class="form-text"></small>
                </div>
                <div style="text-align: center">
                    <button type="submit" class="btn btn-warning" id="submit_btn">&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;入&nbsp;</button>
                </div>
            </form>
        </div>
    </div>
    <div class="success update card position-absolute" id="info_position" style="display:none; background:#fff">
        <div class="success card-body">
            <label class="success_text" id="info_bar"></label>
            <div><img class="success_img" src="../images/icon_checked.svg"></div>
        </div>
    </div>
    <div class="success update card position-absolute" id="info_position2" style="display:none; background:#2d3a3a;box-shadow: 0px 0px 10px red;">
        <div class="success card-body">
            <label class="success_text" id="info_bar2" style="color: #fff;  background:#2d3a3a"></label>
            <div><img class="success_img" src="../images/icon_false.svg"></div>
        </div>
    </div>
    <script>
        let wrapper = document.querySelector('#wrapper');
        let info_bar = document.querySelector('#info_bar');
        let info_bar2 = document.querySelector('#info_bar2');
        let info_position = document.querySelector('#info_position');
        let info_position2 = document.querySelector('#info_position2');
        let s, item;
        const required_fields = [{
                id: 'account',
                pattern: /^\S{6,14}$/,
                info: '請輸入正確帳號',
            },
            {
                id: 'password',
                pattern: /^\S{6,14}$/,
                info: '請輸入正確密碼',
            }
        ];

        for (s in required_fields) {
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.info_el = document.querySelector('#' + item.id + 'Help');
        }

        function checkForm() {

            for (s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid #CCCCCC';
                item.info_el.innerHTML = '';
            }
            // 檢查必填欄位, 欄位值的格式
            let isPass = true;
            for (s in required_fields) {
                item = required_fields[s];
                if (!item.pattern.test(item.el.value)) {
                    item.el.style.border = '1px solid red';
                    item.info_el.innerHTML = item.info;
                    isPass = false;
                }
            }
            let fd = new FormData(document.form1);
            if (isPass) {
                fetch('login_api.php', {
                        method: 'POST',
                        body: fd,
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);;
                        info_bar.innerHTML = json.info;
                        info_bar2.innerHTML = json.info;
                        if (json.success) {
                            info_position.style.display = 'block';
                            wrapper.style.display = 'none';
                            setTimeout(function() {
                                location.href = '../_index.php';
                            }, 1000);
                        } else {
                            info_position2.style.display = 'block';
                            wrapper.style.display = 'none'; 
                            setTimeout(function() {
                                location.href = window.location.href;
                            }, 1000);
                        }
                    });
            }
            return false; // 表單不出用傳統的 post 方式送出
        }
    </script>
    <?php include __DIR__ . '/__html_foot.php' ?>