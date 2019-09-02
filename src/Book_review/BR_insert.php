<?php include __DIR__ . '/BR__connect_db.php' ?>
<style>
body {
    background: url(../../images/bg.png) repeat center top;
}
</style>
<?php include __DIR__ . '/__html_head.php' ?>
<?php include __DIR__ . '/__html_body.php' ?>
<?php include '../../pbook_index/__navbar.php' ?>

<div class="d-flex flex-row my_content">
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
                    <form name="BR_form" onsubmit="return check_form()" style=" visibility:visible" id="main_datalist" class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="BR_name" class="update_label">書評人姓名</label>
                                <span id="BR_nameHelp" style="margin:0px 10px;color:red"></span>
                                <input type="text" class="form-control" id="BR_name" name="BR_name" placeholder="請輸入姓名">
                            </div>
                            <div class="form-group">
                                <label for="BR_password" class="update_label">書評人密碼</label>
                                <span id="BR_passwordHelp" style="margin:0px 10px;color:red"></span>
                                <input type="password" class="form-control" id="BR_password" name="BR_password"
                                    placeholder="請輸入密碼">
                            </div>
                            <div class="form-group">
                                <label for="BR_phone" class="update_label">書評人電話</label>
                                <span id="BR_phoneHelp" style="margin:0px 10px;color:red"></span>
                                <input type="text" class="form-control" id="BR_phone" name="BR_phone"
                                    placeholder="請輸入電話">
                            </div>

                            <div class=" form-group ">
                                <label class="update_label">書評人性別</label>
                                <div class="container row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="BR_gender" id="BR_gender"
                                            value="male" checked>
                                        <label class="form-check-label" for="BR_gender">男</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="BR_gender" id="BR_gender"
                                            value="female">
                                        <label class="form-check-label" for="BR_gender">女</label>
                                        <small id="BR_genderHelp" class="form-text"></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="BR_email" class="update_label">書評人信箱</label>
                                <span id="BR_emailHelp" style="margin:0px 10px;color:red"></span>
                                <input type="text" class="form-control" id="BR_email" name="BR_email"
                                    placeholder="請輸入信箱">
                            </div>
                            <div class="form-group">
                                <label for="BR_address" class="update_label">書評人地址</label>
                                <span id="BR_addressHelp" style="margin:0px 10px;color:red"></span>
                                <input type="text" class="form-control" id="BR_address" name="BR_address"
                                    placeholder="請輸入地址">
                            </div>
                            <div class="form-group">
                                <label for="BR_birthday" class="update_label">書評人生日</label>
                                <span id="BR_birthdayHelp" style="margin:0px 10px;color:red"></span>
                                <input type="text" class="form-control" id="BR_birthday" name="BR_birthday"
                                    placeholder="請輸入生日">
                            </div>
                            <div class="form-group">
                                <label for="BR_job" class="update_label">書評人工作</label>
                                <input type="text" class="form-control" id="BR_job" name="BR_job" placeholder="請輸入目前工作">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group d-flex" id="photo_insert" style="visibility:visible;">
                                <div class="col-lg-8">
                                    <label for="BR_photo" style="font-size: 20px">&nbsp;&nbsp;請選擇大頭貼</label>
                                    <input type="file" class="form-control-file" id="BR_photo" name="BR_photo"
                                        style="display:none">
                                    <div style="height: 200px;width: 230px; padding: 5px;">
                                        <img style="object-fit: contain;width: 100%;height: 100%" id="demo" />
                                    </div>
                                    <button class="btn btn-outline-primary my-2 my-sm-0" type="button"
                                        onclick="selUpload()">
                                        <i class="fas fa-plus-circle" style="margin-right:5px"></i>選擇檔案
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-8" style="transform: translate(40vw,-10px)">
                            <button type="submit" class="btn btn-warning" id="insert_btn">
                                &nbsp;確&nbsp;認&nbsp;新&nbsp;增&nbsp;
                            </button>
                        </div>
                    </form>
                </section>




                <!-- 以下為修改或新增成功才會跳出來的顯示框 -->
                <div class="success update card" style="display:none; transform: translate(170px,-55vh)"
                    id="success_insert">
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
    function selUpload() {
        document.querySelector('#BR_photo').click();
    }



    $('#BR_photo').change(function() {
        var file = $('#BR_photo')[0].files[0];
        var reader = new FileReader;
        reader.onload = function(e) {
            $('#demo').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });



    let insert_info = document.querySelector('#success_insert');
    let main_datalist_hidden = document.querySelector('#main_datalist');
    let insert_btn = document.querySelector('#insert_btn');
    let photo_insert = document.querySelector('#photo_insert');
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
                        photo_insert.style.visibility = 'hidden';
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
<?php include __DIR__ . '/__html_foot.php' ?>