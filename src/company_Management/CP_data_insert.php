<?php
// require __DIR__. '/__admin_required.php';
require __DIR__ . '/__connect_db.php';
$page_title = '新增出版社';
?>
<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
</style>
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/../../pbook_index/__navbar.php' ?>
    <!-- 右邊section資料欄位 -->
    <section>
        <div class="container">
            <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
                <div>
                    <h4>新增出版社</h4>
                    <div class="title_line"></div>
                </div>
            </nav>

            <!-- 每個人填資料的區塊 -->
            <div class="container">
                <div class="update card mx-auto">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="cp_name" class="update_label">出版社名</label>
                                <input type="text" class="update form-control" id="cp_name" name="cp_name">
                                <small id="cp_nameHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="email" class="update_label">聯絡人</label>
                                <input type="text" class="update form-control" id="email" name="email">
                                <small id="emailHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="update_label">電話</label>
                                <input type="text" class="update form-control" id="mobile" name="mobile">
                                <small id="mobileHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="birthday" class="update_label">電子郵件</label>
                                <input type="text" class="update form-control" id="birthday" name="birthday">
                                <small id="birthdayHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="address" class="update_label">統一編號</label>
                                <input type="text" class="update form-control" id="address" name="address">
                                <small id="addressHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="address" class="update_label">書籍庫存</label>
                                <input type="text" class="update form-control" id="address" name="address">
                                <small id="addressHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="address" class="update_label">帳號</label>
                                <input type="text" class="update form-control" id="address" name="address">
                                <small id="addressHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="address" class="update_label">密碼</label>
                                <input type="text" class="update form-control" id="address" name="address">
                                <small id="addressHelp" class="update form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="address" class="update_label">logo</label>
                                <input type="text" class="update form-control" id="address" name="address">
                                <small id="addressHelp" class="update form-text"></small>
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
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>