<?php
require __DIR__. '/__admin_required.php';
require __DIR__ . '/__connect_db.php';
$page_title = '資料修改';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: CP_data_list.php');
    exit;
}
$sql = "SELECT * FROM `cp_data_list` WHERE `sid` = $sid";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: CP_data_list.php');
    exit;
}
$form_data1 = [
    '出版社名' => 'cp_name',
    '聯絡人' => 'cp_contact_p',
    '電話' => 'cp_phone',
    '電子郵件' => 'cp_email',
    '地址' => 'cp_address',
    '統一編號' => 'cp_tax_id',
];
$form_data2 = [
    '書籍庫存' => 'cp_stock',
    '帳號' => 'cp_account',
    '密碼' => 'cp_password',
];

$seq = "SELECT  1 + (SELECT count(*) FROM `cp_data_list` where `sid` < $sid)  FROM `cp_data_list` limit 1"; //拿到第幾筆
$stmt2 = $pdo->query($seq)->fetch();
foreach ($stmt2 as $k => $v) {
    $previous_page = intval(($v - 1) / 8) + 1;
}
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
</style>
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/../../pbook_index/__navbar.php' ?>
<!-- 右邊section資料欄位 -->
<section class="p-4 container-fluid">
    <div class="container">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h4>資料修改</h4>
                <div class="title_line"></div>
            </div>
        </nav>
        <!-- 每個人填資料的區塊 -->
        <div class="container position-relative" style="margin-left:calc( 50% - 314px)">
            <div class="row">
                <form name="form1" id="form1" style="width:1000px" onsubmit="return checkForm()">
                    <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                    <div class="form-group d-flex">
                        <div class="container">
                            <?php foreach ($form_data1 as $k => $v) : ?>
                            <label for="<?= $v ?>" class="update_label pt-3"><?= $k ?></label>
                            <input type="text" class="update form-control" id="<?= $v ?>" name="<?= $v ?>" value="<?= htmlentities($row[$v]) ?>">
                            <small id="<?= $v ?>Help" class="update form-text"></small>
                            <?php endforeach; ?>
                        </div>
                        <div class="container">
                            <?php foreach ($form_data2 as $k => $v) : ?>
                            <label for="<?= $v ?>" class="update_label pt-3"><?= $k ?></label>
                            <?php if ($v == 'cp_password') { ?>
                            <!-- 密碼用password type -->
                            <input type="password" class="update form-control" id="cp_password" name="cp_password" autocomplete="new-password" value="<?= htmlentities($row[$v]) ?>">
                            <small id="cp_passwordHelp" class="update form-text"></small>
                            <?php } else { ?>
                            <input type="text" class="update form-control" id="<?= $v ?>" name="<?= $v ?>" value="<?= htmlentities($row[$v]) ?>">
                            <small id="<?= $v ?>Help" class="update form-text"></small>
                            <?php }
                            endforeach; ?>
                            <div class="form-group d-flex mt-5">
                                <div class="col-lg-5">
                                    <label for="cp_logo" style="font-size: 20px">請選擇logo照片</label>
                                    <input type="file" class="form-control-file" id="cp_logo" name="cp_logo" style="display:none">
                                    <br>
                                    <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick="selUpload()">
                                        <i class="fas fa-plus-circle" style="margin-right:5px"></i>選擇檔案
                                    </button>
                                </div>
                                <div style="height: 230px;width: 230px;border: 1px solid #ddd">
                                    <img style="object-fit: contain;width: 100%;height: 100%"src="./logo/<?= htmlentities($row['cp_logo']) ?>"  id="demo">
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div style="text-align: center" id="btn1">
                        <button type="submit" class="btn btn-warning" id="submit_btn">&nbsp;確&nbsp;認&nbsp;修&nbsp;改&nbsp;</button>
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
    function selUpload() {
        document.querySelector('#cp_logo').click();
    }
    $('#cp_logo').change(function() {
        var file = $('#cp_logo')[0].files[0];
        var reader = new FileReader;
        reader.onload = function(e) {
            $('#demo').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
    let btn1 = document.querySelector('#btn1');
    let form1 = document.querySelector('#form1');
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
            fetch('CP_data_edit_api.php', {
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
                        btn1.style.display = 'none';
                        form1.style.display = 'none';
                        setTimeout(function(){
                                location.href = 'CP_data_list.php?page=<?= $previous_page ?>';
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