<?php
if (!isset($_SESSION)) {
    session_start();
}
require __DIR__ . '/pbook_index/__admin_required.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="lib/jquery-3.4.1.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="lib/mycss.css">
    <title>品書</title>

    <style>
        body {
            background: url(images/bg.png) repeat center top;
        }
    </style>
    <?php include __DIR__ . '/pbook_index/__html_body.php' ?>
    <nav class="navbar justify-content-between my_bg_seasongreen">
        <a class="navbar-brand" href="_index.php">
            <img class="book_logo" src="images/icon_logo.svg" alt="">
        </a>
        <ul class="nav justify-content-between">
            <?php if (isset($_SESSION['loginUser'])) : ?>
                <li class="nav-item">
                    <a class="nav-link my_text_blacktea nav_text">管理者「<?= $_SESSION['loginUser']['name'] ?>」,您好</a>
                </li>
                <li class="nav-item dropdown">
                    <a style="display: inline" class="nav-link dropdown-toggle my_text_yellow" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="my_login_img"><img class="yoko_logo" src="images/yoko.jpg" alt=""></div>
                    </a>
                    <div class="dropdown-menu" style="left: -100%;top: 90%;">
                        <a class="dropdown-item" href="pbook_index/password_edit.php">修改密碼</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="pbook_index/logout.php">登出</a>
                    </div>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link my_text_blacktea nav_text" href="pbook_index/login.php">登入</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="d-flex flex-row my_content">
        <!-- 左邊aside選單欄位 -->

        <aside class="d-flex aside_heigh">
            <div id="accordion">
                <div class="aside card">
                    <button type="button" class="aside card-header btn btn-info" id="headingOne">
                        <div class="aside_hover" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <img class="aside_logo" src="images/icon_VD_m.svg" alt="">
                            <span class="aside_text">出版社管理</span>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </button>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <button type="button" class="btn btn-light sub_aside_text" onclick="CP_data_list()">
                            <i class="fas fa-caret-right"></i>
                            <span>出版社總表</span>
                        </button>
                        <!-- <button type="button" class="btn btn-light sub_aside_text">
                            <i class="fas fa-caret-right"></i>
                            <span>出版社訂單總表</span>
                        </button> -->
                    </div>
                </div>

                <div class="aside card">
                    <button type="button" class="aside card-header btn btn-info" id="headingTwo">
                        <div class="aside_hover" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <img class="aside_logo" src="images/icon_VB_m.svg" alt="">
                            <span class="aside_text">出版社書籍管理</span>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </button>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <button type="button" class="btn btn-light sub_aside_text" onclick="vb_data_list()">
                            <i class="fas fa-caret-right"></i>
                            <span>出版社書籍總表</span>
                        </button>
                        <button type="button" class="btn btn-light sub_aside_text" onclick="vb_data_insert()">
                            <i class="fas fa-caret-right"></i>
                            <span>新增出版社書籍</span>
                        </button>
                    </div>
                </div>

                <div class="aside card">
                    <button type="button" class="aside card-header btn btn-info" id="headingThree">
                        <div class="aside_hover" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <img class="aside_logo" src="images/icon_MR_m.svg" alt="">
                            <span class="aside_text">會員管理</span>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </button>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <button type="button" class="btn btn-light sub_aside_text" onclick="location='src/member_Management/MR_memberDataList.php'">
                            <i class="fas fa-caret-right"></i>
                            <span>品書會員列表</span>
                        </button>
                        <button type="button" class="btn btn-light sub_aside_text" onclick="location='src/member_Management/MR_levelList.php'">
                            <i class="fas fa-caret-right"></i>
                            <span>品書會員等級</span>
                        </button>
                    </div>
                </div>

                <div class="aside card">
                    <button type="button" class="aside card-header btn btn-info" id="headingFour">
                        <div class="aside_hover" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <img class="aside_logo" src="images/icon_MB_m.svg" alt="">
                            <span class="aside_text">會員書籍管理</span>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </button>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <button type="button" class="btn btn-light sub_aside_text">
                            <i class="fas fa-caret-right"></i>
                            <span>會員書籍總表</span>
                        </button>
                        <button type="button" class="btn btn-light sub_aside_text">
                            <i class="fas fa-caret-right"></i>
                            <span>新增會員書籍</span>
                        </button>
                    </div>
                </div>

                <div class="aside card">
                    <button type="button" class="aside card-header btn btn-info" id="headingFive">
                        <div class="aside_hover" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            <img class="aside_logo" src="images/icon_BR_m.svg" alt="">
                            <span class="aside_text">書評家管理</span>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </button>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <button type="button" class="btn btn-light sub_aside_text" onclick="location.href='src/Book_review/BR_data_list.php'">
                            <i class="fas fa-caret-right"></i>
                            <span>書評總表</span>
                        </button>
                        <button type="button" class="btn btn-light sub_aside_text" onclick="location.href='src/Book_review/BR_insert.php'">
                            <i class="fas fa-caret-right"></i>
                            <span>新增書評人</span>
                        </button>
                        <button type="button" class="btn btn-light sub_aside_text" onclick="location.href='src/Book_review/BR_bookreview_list.php'">
                            <i class="fas fa-caret-right"></i>
                            <span>書評列表</span>
                        </button>
                        <button type="button" class="btn btn-light sub_aside_text">
                            <i class="fas fa-caret-right"></i>
                            <span>影片列表</span>
                        </button>
                    </div>
                </div>

                <div class="aside card">
                    <button type="button" class="aside card-header btn btn-info" id="headingSix">
                        <div class="aside_hover" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            <img class="aside_logo" src="images/icon_AC_m.svg" alt="">
                            <span class="aside_text">實體活動管理</span>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </button>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <button type="button" class="btn btn-light sub_aside_text" onclick="location.href='src/activityManaagement/AC_data_list.php'">
                            <i class="fas fa-caret-right"></i>
                            <span>品書活動總表</span>
                        </button>
                        <button type="button" class="btn btn-light sub_aside_text" onclick="location.href='src/activityManaagement/AC_insert.php'">
                            <i class="fas fa-caret-right"></i>
                            <span>新增活動</span>
                        </button>
                    </div>
                </div>

                <div class="aside card">
                    <button type="button" class="aside card-header btn btn-info" id="headingSeven">
                        <div class="aside_hover" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            <img class="aside_logo" src="images/icon_PP_m.svg" alt="">
                            <span class="aside_text">虛擬行銷管理</span>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </button>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                        <!-- <button type="button" class="btn btn-light sub_aside_text">
                            <i class="fas fa-caret-right"></i>
                            <span>P幣系統</span>
                        </button> -->
                        <button type="button" class="btn btn-light sub_aside_text" onclick="location.href='src/promotion_management/event_list.php'">
                            <i class="fas fa-caret-right"></i>
                            <span>折扣系統</span>
                        </button>
                        <button type="button" class="btn btn-light sub_aside_text">
                            <i class="fas fa-caret-right"></i>
                            <span>檢舉系統</span>
                        </button>
                        <button type="button" class="btn btn-light sub_aside_text">
                            <i class="fas fa-caret-right"></i>
                            <span>廣告系統</span>
                        </button>
                        <button type="button" class="btn btn-light sub_aside_text">
                            <i class="fas fa-caret-right"></i>
                            <span>紙娃娃系統</span>
                        </button>
                    </div>
                </div>
            </div>
        </aside>
        <!-- 右邊section資料欄位 -->
        <section style="width: calc(100vw - 280px);">
            <img src="images/admin_bg.png" alt="" style="height: 100%;object-fit: contain;width:100%;">
        </section>
    </div>
    <script>
        function CP_data_list() {
            location = "src/company_Management/CP_data_list.php";
        }
        function vb_data_list() {
            location = "src/venderBooks_Management/vb_data_list.php";
        }
        function vb_data_insert() {
            location = "src/venderBooks_Management/vb_data_insert.php";
        }
    </script>
    <?php include __DIR__ . '/pbook_index/__html_foot.php' ?>