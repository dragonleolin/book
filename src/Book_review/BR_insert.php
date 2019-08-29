<?php include __DIR__ . '/BR__connect_db.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
</style>
<?php include __DIR__ . '/BR__html_head.php' ?>
<nav class="navbar justify-content-between my_bg_seasongreen">
    <a class="navbar-brand" href="example_index.php">
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
                    <h4>書評人資料新增</h4>
                    <div class="title_line"></div>
                </div>
            </nav>
            <!-- 每個人填資料的區塊 -->
            <div class="container">
                <section class="d-flex" style="min-width:600px;">
                    <div class="card-body d-flex">
                        <form name="BR_form" onsubmit="return check_form()" style="width:800px;margin:-15px 50px ; visibility:visible" id="main_datalist">
                            <div class="form-group">
                                <label for="BR_name" class="update_label">書評人姓名</label>
                                <span id="BR_nameHelp" style="margin:0px 10px;color:red"></span>
                                <input type="text" class="form-control" id="BR_name" name="BR_name" placeholder="請輸入姓名">
                            </div>
                            <div class="form-group">
                                <label for="BR_phone" class="update_label">書評人電話</label>
                                <span id="BR_phoneHelp" style="margin:0px 10px;color:red"></span>
                                <input type="text" class="form-control" id="BR_phone" name="BR_phone" placeholder="請輸入電話">
                            </div>
                            <div class="form-group">
                                <label for="BR_email" class="update_label">書評人信箱</label>
                                <span id="BR_emailHelp" style="margin:0px 10px;color:red"></span>
                                <input type="text" class="form-control" id="BR_email" name="BR_email" placeholder="請輸入信箱">
                            </div>
                            <div class="form-group">
                                <label for="BR_password" class="update_label">書評人密碼</label>
                                <span id="BR_passwordHelp" style="margin:0px 10px;color:red"></span>
                                <input type="password" class="form-control" id="BR_password" name="BR_password" placeholder="請輸入密碼">
                            </div>
                            <div class="form-group">
                                <label for="BR_address" class="update_label">書評人地址</label>
                                <span id="BR_addressHelp" style="margin:0px 10px;color:red"></span>
                                <input type="text" class="form-control" id="BR_address" name="BR_address" placeholder="請輸入地址">
                            </div>
                            <label class="update_label">書評人性別</label> <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="BR_gender" id="BR_gender" value="male" checked>
                                <label class="form-check-label" for="BR_gender">男</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="BR_gender" id="BR_gender" value="female">
                                <label class="form-check-label" for="BR_gender">女</label>
                                <small id="BR_genderHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="BR_birthday" class="update_label">書評人生日</label>
                                <span id="BR_birthdayHelp" style="margin:0px 10px;color:red"></span>
                                <input type="text" class="form-control" id="BR_birthday" name="BR_birthday" placeholder="請輸入生日">
                            </div>
                            <div class="form-group">
                                <label for="BR_job" class="update_label">書評人工作</label>
                                <input type="text" class="form-control" id="BR_job" name="BR_job" placeholder="請輸入目前工作">
                            </div>
                            <button type="submit" class="btn btn-primary" id="insert_btn">新增</button>
                        </form>
                </section>



                <!-- 以下為修改或新增成功才會跳出來的顯示框 -->
                <div class="success update card" style="display:none; transform: translate(170px,-55vh)" id="success_insert">
                    <div class="success card-body">
                        <label class="success_text">新增成功</label>
                        <div>
                            <img class="success_img" src="../../images/icon_checked.svg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        let insert_info = document.querySelector('#success_insert');
        let main_datalist_hidden = document.querySelector('#main_datalist');
        let insert_btn = document.querySelector('#insert_btn');
        let i, s, item;

        const error_text = [{
                id: 'BR_name',
                checker: /^\S{2,}/,
                info: '請輸入正確姓名格式'
            },
            {
                id: 'BR_phone',
                checker: /^09\d{2}\-?\d{3}\-?\d{3}$/,
                info: '請輸入正確電話格式'
            },
            {
                id: 'BR_password',
                checker: /\w{8}/,
                info: '請輸入正確密碼格式'
            },
            {
                id: 'BR_email',
                checker: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
                info: '請輸入正確信箱格式'
            },
            {
                id: 'BR_birthday',
                checker: /^\d{4}-\d{2}-\d{2}$/,
                info: '請輸入生日格式'
            },
            {
                id: 'BR_address',
                checker: /.+/,
                info: '請輸入地址格式'
            },
        ];


        //拿到對應輸入欄位 ID 顯示訊息的小文字框
        for (i in error_text) {
            item = error_text[i];
            item.el = document.querySelector('#' + item.id);
            item.error_info = document.querySelector('#' + item.id + 'Help');
        }

        function check_form() {
            let fd = new FormData(document.BR_form);


            for (i in error_text) {
                item = error_text[i];
                item.el.style.border = '1px solid #cccccc';
                item.error_info.innerHTML = '';
            }

            insert_btn.style.display = 'none';
            let passcheck = true;
            for (i in error_text) {
                item = error_text[i];

                if (!item.checker.test(item.el.value)) {
                    item.el.style.border = '1px solid red';
                    item.error_info.style.color = 'red';
                    item.error_info.innerHTML = item.info;
                    passcheck = false;
                }

            }

            if (passcheck) {
                fetch('BR_insert_api.php', {
                        method: 'POST',
                        body: fd,
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        insert_btn.style.display = 'block';
                        if (json.success) {
                            main_datalist_hidden.style.visibility = 'hidden';
                            insert_info.style.display = 'block'
                            setTimeout(function() {
                                location.href = 'BR_data_list.php';
                            }, 1500);

                        } else {
                            console.log('1')
                        }

                    });
            } else {
                insert_btn.style.display = 'block';
            }
            return false;
        }
    </script>

</div>
<?php include __DIR__ . '/BR__html_foot.php' ?>