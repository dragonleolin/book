<?php include __DIR__ . '/__html_head.php' ?>
<style>
    body {
        background: url(../images/bg.png) repeat center top;
    }
</style>
<?php include __DIR__ . '/__html_body.php' ?>
<nav class="navbar justify-content-between my_bg_seasongreen">
    <a class="navbar-brand" href="#">
        <img class="book_logo" src="../images/icon_logo.svg" alt="">
    </a>
    <ul class="nav justify-content-between">
        <li class="nav-item">
            <a class="nav-link my_text_blacktea nav_text">管理者「大師」,您好</a>
        </li>
        <li class="nav-item dropdown">
            <a style="display: inline" class="nav-link dropdown-toggle my_text_yellow" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="my_login_img"><img class="yoko_logo" src="../images/yoko.jpg" alt=""></div>
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
    <?php include __DIR__ . '/__navbar.php' ?>
    <!-- 右邊section資料欄位 -->
    <section>
        <div class="container">
            <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
                <div>
                    <h4>會員資料修改</h4>
                    <div class="title_line"></div>
                </div>
            </nav>

            <!-- 每個人填資料的區塊 -->
            <div class="container">
                <div class="update card mx-auto">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="name" class="update_label">姓名</label>
                                <input type="text" class="update form-control" id="name" name="name">
                                <small id="nameHelp" class="update form-text">示意:錯誤顯示訊息</small>
                            </div>
                            <div class="form-group">
                                <label for="email" class="update_label">電子郵箱</label>
                                <input type="text" class="update form-control" id="email" name="email">
                                <small id="emailHelp" class="update form-text">示意:錯誤顯示訊息</small>
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="update_label">手機</label>
                                <input type="text" class="update form-control" id="mobile" name="mobile">
                                <small id="mobileHelp" class="update form-text">示意:錯誤顯示訊息</small>
                            </div>
                            <div class="form-group">
                                <label for="birthday" class="update_label">生日</label>
                                <input type="text" class="update form-control" id="birthday" name="birthday">
                                <small id="birthdayHelp" class="update form-text">示意:錯誤顯示訊息</small>
                            </div>
                            <div class="form-group">
                                <label for="address" class="update_label">地址</label>
                                <input type="text" class="update form-control" id="address" name="address">
                                <small id="addressHelp" class="update form-text">示意:錯誤顯示訊息</small>
                            </div>
                            <div style="text-align: center">
                                <button type="submit" class="btn btn-warning" id="submit_btn">&nbsp;確&nbsp;認&nbsp;修&nbsp;改&nbsp;</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- 以下為修改或新增成功才會跳出來的顯示框 -->
                <!-- <div class="success update card">
                        <div class="success card-body">
                            <label class="success_text">修改成功</label>
                            <div><img class="success_img" src="../images/icon_checked.svg"></div>
                        </div>
                    </div> -->
            </div>
    </section>
</div>
<?php include __DIR__ . '/__html_foot.php' ?>