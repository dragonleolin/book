<?php
include __DIR__ . '/BR__connect_db.php';
$page_name = 'BR_update';
$page_title = '編輯資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: BR_data_list.php');
    exit;
}

$sql = "SELECT * FROM `br_create` WHERE `sid`=$sid";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: BR_data_list.php');
    exit;
}
?>
<style>
    body {
        background: url(../images/bg.png) repeat center top;
    }
</style>
<?php include __DIR__ . '/BR__html_head.php' ?>
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
                        <form action="BR_update_api.php" method="post">
                            <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                            <div class="form-group">
                                <label for="BR_name" class="update_label">姓名</label>
                                <input type="text" class="update form-control" id="BR_name" name="BR_name" value="<?= htmlentities($row['BR_name']) ?>">
                                <small id="BR_nameHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="BR_phone" class="update_label">電話</label>
                                <input type="text" class="update form-control" id="BR_phone" name="BR_phone" value="<?= htmlentities($row['BR_phone']) ?>">
                                <small id="BR_phoneHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="BR_email" class="update_label">信箱</label>
                                <input type="text" class="update form-control" id="BR_email" name="BR_email" value="<?= htmlentities($row['BR_email']) ?>">
                                <small id="BR_emailHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="BR_address" class="update_label">地址</label>
                                <input type="text" class="update form-control" id="BR_address" name="BR_address" value="<?= htmlentities($row['BR_address']) ?>">
                                <small id="BR_addressHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="BR_gender" class="update_label">性別</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="BR_gender" id="BR_gender" value="male">
                                    <label class="form-check-label" for="BR_gender">男</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="BR_gender" id="BR_gender" value="female">
                                    <label class="form-check-label" for="BR_gender">女</label>
                                </div>
                                <small id="genderHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="BR_birthday" class="update_label">生日</label>
                                <input type="text" class="update form-control" id="BR_birthday" name="BR_birthday" value="<?= htmlentities($row['BR_birthday']) ?>">
                                <small id="BR_birthdayHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="BR_job" class="update_label">工作</label>
                                <input type="text" class="update form-control" id="BR_job" name="BR_job" value="<?= htmlentities($row['BR_job']) ?>">
                                <small id="BR_jobHelp" class="update form-text"></small>
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
    <script>
        function check_form() {
            let fd = new FormData(document.BR_form);
            fetch('BR_update_api.php', {
                    method: 'POST',
                    body: fd,
                })
                .then(response => {
                    return response.json();
                })
                .then(json => {
                    console.log(json);
                    info_bar.style.display = 'block';
                    info_bar.innerHTML = json.info;
                    if (json.success) {
                        info_bar.className = 'alert alert-success'
                    } else {
                        info_bar.className = 'alert alert-danger'
                    }
                });


            return false;
        }
    </script>
</div>
<?php include __DIR__ . '/BR__html_foot.php' ?>