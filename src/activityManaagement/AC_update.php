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
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>