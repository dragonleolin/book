<?php include __DIR__ . '/BR__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
</style>
<?php include __DIR__ . '/BR__html_body.php' ?>
<nav class="navbar justify-content-between my_bg_seasongreen">
    <a class="navbar-brand" href="#">
        <img class="book_logo" src="../../images/icon_logo.svg" alt="">
    </a>
    <ul class="nav justify-content-between">
        <li class="nav-item">
            <a class="nav-link my_text_blacktea nav_text">管理者「大師」,您好</a>
        </li>
        <li class="nav-item dropdown">
            <a style="display: inline" class="nav-link dropdown-toggle my_text_yellow" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="my_login_img"><img class="yoko_logo" src="../../images/yoko.jpg" alt=""></div>
            </a>
            <div class="dropdown-menu" style="left: -100%;top: 90%;">
                <a class="dropdown-item" href="#">修改密碼</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">登出</a>
            </div>
        </li>
    </ul>
</nav>

<div class="d-flex flex-row my_content">
    <!-- 左邊aside選單欄位 -->
    <?php include __DIR__ . '/BR__navbar.php' ?>
    <!-- 右邊section資料欄位 -->
    <section style="width: calc(100vw - 280px);">
        <img src="../../images/admin_bg.png" alt="" style="height: 100%;object-fit: contain;width:100%">
    </section>
</div>
<?php include __DIR__ . '/BR__html_foot.php' ?>