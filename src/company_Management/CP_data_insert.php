<?php
require __DIR__. '/__admin_required.php';
require __DIR__ . '/__connect_db.php';
$page_title = '新增出版社';
$form_data1 = [
    '出版社名' => 'cp_name',
    '聯絡人' => 'cp_contact_p',
    '電話' => 'cp_phone',
    '電子郵件' => 'cp_email',
    '地址' => 'cp_address',
];
$form_data2 = [
    '統一編號' => 'cp_tax_id',
    '書籍庫存' => 'cp_stock',
    '帳號' => 'cp_account',
    '密碼' => 'cp_password',
    'logo' => 'cp_logo',
];
?>
<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }

    #info_position {
        left: calc(50% - 350px);
        top: 30%;
    }

    .rand_button {
        right: 10%;
        top: 0;
    }
</style>
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/../../pbook_index/__navbar.php' ?>
<!-- 右邊section資料欄位 -->
<section class="p-4 container-fluid">
    <div class="container">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h4>新增出版社</h4>
                <div class="title_line"></div>
            </div>
        </nav>
        <!-- 每個人填資料的區塊 -->
        <div class="container position-relative" style="margin-left:calc( 50% - 314px)">
            <div style="text-align: center">
                <button type="button" class="btn btn-warning position-absolute rand_button" onclick="rand_data()">隨機產生</button>
            </div>
            <div class="row">
                <form name="form1" style="width:1000px" onsubmit="return checkForm()">
                    <div class="form-group d-flex">
                        <div class="container">
                            <?php foreach ($form_data1 as $k => $v) : ?>
                            <label for="<?= $v ?>" class="update_label pt-3"><?= $k ?></label>
                            <?php if ($v == 'cp_password') { ?>
                            <!-- 密碼用password type -->
                            <input type="password" class="update form-control" id="cp_password" name="cp_password" autocomplete="new-password">
                            <small id="cp_passwordHelp" class="update form-text"></small>
                            <?php } else { ?>
                            <input type="text" class="update form-control" id="<?= $v ?>" name="<?= $v ?>">
                            <small id="<?= $v ?>Help" class="update form-text"></small>
                            <?php }
                            endforeach; ?>
                        </div>
                        <div class="container">
                            <?php foreach ($form_data2 as $k => $v) : ?>
                            <label for="<?= $v ?>" class="update_label pt-3"><?= $k ?></label>
                            <?php if ($v == 'cp_password') { ?>
                            <!-- 密碼用password type -->
                            <input type="password" class="update form-control" id="cp_password" name="cp_password" autocomplete="new-password">
                            <small id="cp_passwordHelp" class="update form-text"></small>
                            <?php } else { ?>
                            <input type="text" class="update form-control" id="<?= $v ?>" name="<?= $v ?>">
                            <small id="<?= $v ?>Help" class="update form-text"></small>
                            <?php }
                            endforeach; ?>
                        </div>
                    </div>

                    <div style="text-align: center">
                        <button type="submit" class="btn btn-warning" id="submit_btn">&nbsp;確&nbsp;認&nbsp;新&nbsp;增&nbsp;</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 以下為修改或新增成功才會跳出來的顯示框 -->
    <div class="success update card position-absolute" id="info_position" style="display: none; background:#fff">
        <div class="success card-body">
            <label class="success_text" id="info_bar"></label>
            <div><img class="success_img" src="../../images/icon_checked.svg"></div>
        </div>
    </div>
</section>
</div>
<script>
    function getRandom(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    };

    function rand_data() {
        let rand_phone = "";
        for (let i = 0; i < 8; i++) {
            let d = getRandom(0, 9);
            rand_phone = rand_phone + d;
        };

        let rand_email = "";
        for (let i = 0; i < getRandom(6, 10); i++) {
            let c = getRandom(1, 3);
            let a, b;
            if (c == 1) {
                a = getRandom(97, 122);
                b = String.fromCharCode(a);
            }
            if (c == 2) {
                a = getRandom(65, 90);
                b = String.fromCharCode(a);
            }
            if (c == 3) {
                b = getRandom(0, 9);
            }
            rand_email = rand_email + b;
        };

        let rand_tax = "";
        for (let i = 0; i < 8; i++) {
            let d = getRandom(0, 9);
            rand_tax = rand_tax + d;
        };
        let rand_stock = "";
        for (let i = 0; i < 3; i++) {
            let d = getRandom(0, 9);
            rand_stock = rand_stock + d;
        };
        let rand_acc = "";
        for (let i = 0; i < getRandom(6, 14); i++) {
            let c = getRandom(1, 3);
            let a, b;
            if (c == 1) {
                a = getRandom(97, 122);
                b = String.fromCharCode(a);
            }
            if (c == 2) {
                a = getRandom(65, 90);
                b = String.fromCharCode(a);
            }
            if (c == 3) {
                b = getRandom(0, 9);
            }
            rand_acc = rand_acc + b;
        };
        let rand_pass = "";
        for (let i = 0; i < getRandom(6, 14); i++) {
            let c = getRandom(1, 3);
            let a, b;
            if (c == 1) {
                a = getRandom(97, 122);
                b = String.fromCharCode(a);
            }
            if (c == 2) {
                a = getRandom(65, 90);
                b = String.fromCharCode(a);
            }
            if (c == 3) {
                b = getRandom(0, 9);
            }
            rand_pass = rand_pass + b;
        };
        document.querySelector('#cp_phone').value = '09' + rand_phone;
        document.querySelector('#cp_email').value = rand_email + '@gmail.com';
        document.querySelector('#cp_tax_id').value = rand_tax;
        document.querySelector('#cp_stock').value = rand_stock;
        document.querySelector('#cp_account').value = rand_acc;
        document.querySelector('#cp_password').value = rand_pass;
    }
    let info_bar = document.querySelector('#info_bar');
    let info_position = document.querySelector('#info_position');
    const required_fields = [{
            id: 'cp_name',
            pattern: /^\S{2,}/,
            info: '請輸入正確名字',
        },
        {
            id: 'cp_contact_p',
            pattern: /^\S{2,}/,
            info: '請輸入正確名字',
        },
        {
            id: 'cp_phone',
            pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
            info: '請輸入正確電話',
        },
        {
            id: 'cp_email',
            pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
            info: '請輸入正確電子郵件',
        },
        {
            id: 'cp_address',
            pattern: /\S{1,}/i,
            info: '請輸入正確地址',
        },
        {
            id: 'cp_tax_id',
            pattern: /^\d{8}$/,
            info: '請輸入正確統一編號',
        },
        {
            id: 'cp_stock',
            pattern: /^\d{1,3}$/,
            info: '請輸入正確庫存',
        },
        {
            id: 'cp_account',
            pattern: /^\w{6,}$/,
            info: '請輸入正確帳號',
        },
        {
            id: 'cp_password',
            pattern: /^\w{6,}$/,
            info: '請輸入正確密碼',
        },
        {
            id: 'cp_logo',
            pattern: /\S{1,}/i,
            info: '請輸入正確logo',
        },
    ]
    let s, item;
    for (s in required_fields) {
        item = required_fields[s];
        item.el = document.querySelector('#' + item.id); //item.el拿到input的id
        item.info_el = document.querySelector('#' + item.id + 'Help'); //item.info_el拿到small的id
    }

    function checkForm() {
        for (s in required_fields) {
            item = required_fields[s];
            item.el.style.border = '1px solid #CCCCCC';
            item.info_el.innerHTML = '';
        }
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
            fetch('CP_data_insert_api.php', {
                    method: 'POST',
                    body: fd,
                })
                .then(response => {
                    return response.json();
                })
                .then(json => {
                    console.log(json);
                    info_position.style.display = 'block';
                    info_bar.innerHTML = json.info;
                    if (json.success) {
                        info_position.style.display = 'block';
                        setTimeout(function() {
                            location.href = 'CP_data_list.php';
                        }, 1000);
                    } else {
                        info_position.style.display = 'none';
                    }
                });
        }
        return false;
    }
</script>
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>