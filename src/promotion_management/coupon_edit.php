<?php
$page_name = 'coupon_edit';
$page_title = '編輯折價券';
$coupon_id = isset($_GET['coupon_id']) ? intval($_GET['coupon_id']) : 0;
if(empty($coupon_id)){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
}
require __DIR__ . '/__connect_db.php';
$sql = "SELECT * FROM `coupon` WHERE `coupon_id` = {$coupon_id}";
$row = $pdo->query($sql)->fetch();
if(empty($row)){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
}


?>


<?php
include __DIR__ . '/../../pbook_index/__html_head.php';
include __DIR__ . '/../../pbook_index/__html_body.php';
include __DIR__ . '/../../pbook_index/__navbar.php';
?>
    <style>
        small.form-text {
            color: red;
        }
    </style>

    <div class="container-fluid pt-3">
        <?php include __DIR__ . '/__coupon_navbar.php'; ?>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="alert alert-primary" role="alert" id="info_bar" style="display: none"></div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">新增折價券</h5>
                        <form name="form1" onsubmit="return checkForm()">
                            <input type="hidden" name="coupon_id" value="<?= $row['coupon_id']?>">
                            <div class="form-group">
                                <label for="coupon_content">活動名稱</label>
                                <input type="text" class="form-control" id="coupon_content" name="coupon_content" value="<?= htmlentities($row['coupon_content']);?>">
                                <small class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="coupon_no">折價券編號</label>
                                <button type="button" class="btn btn-light rounded" onclick="rand_no()">隨機產生</button>
                                <input type="text" class="form-control" id="coupon_no" name="coupon_no" value="<?= htmlentities($row['coupon_no']);?>">
                                <small class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="coupon_rule">折價規則</label>
                                <select class="form-control" id="coupon_rule" name="coupon_rule" onchange="show_rule()"  value="<?= htmlentities($row['coupon_rule']);?>">
                                    <option value="1">金額</option>
                                    <option value="2">百分比</option>
                                </select>
                                <small class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label id="coupon_price_label" for="coupon_price">折價金額</label>
                                <input type="text" class="form-control" id="coupon_price" name="coupon_price" value="<?= htmlentities($row['coupon_price']);?>">
                                <small class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="coupon_number">發送數量</label>
                                <input type="text" class="form-control" id="coupon_number" name="coupon_number" value="<?= htmlentities($row['coupon_number']);?>">
                                <small class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="coupon_limit">適用消費下限(TWD)</label>
                                <input type="text" class="form-control" id="coupon_limit" name="coupon_limit" value="<?= htmlentities($row['coupon_limit']);?>">
                                <small class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="coupon_send_type">發送類型</label>
                                <select class="form-control" id="coupon_send_type" name="coupon_send_type" value="<?= htmlentities($row['coupon_send_type']);?>">
                                    <option value="1">全館發送</option>
                                    <option value="2">優惠序號</option>
                                    <option value="3">消費回饋</option>
                                    <option value="4">生日禮</option>
                                </select>
                                <small class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="coupon_start_time">起始日期</label>
                                <input type="date" class="form-control" id="coupon_start_time" name="coupon_start_time" value="<?= htmlentities($row['coupon_start_time']);?>">
                                <small class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="coupon_end_time">終止日期</label>
                                <input type="date" class="form-control" id="coupon_end_time" name="coupon_end_time" value="<?= htmlentities($row['coupon_end_time']);?>">
                                <small class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="coupon_sp_rule">特殊規則</label>
                                <select class="form-control" id="coupon_sp_rule" name="coupon_sp_rule" value="<?= htmlentities($row['coupon_sp_rule']);?>">
                                    <option value="0">none</option>
                                    <option value="1">test1</option>
                                    <option value="2">test2</option>
                                    <option value="3">test3</option>
                                    <option value="4">test4</option>
                                </select>
                                <small class="form-text"></small>
                            </div>
                            <button id="submit_btn" type="submit" class="btn btn-primary">提交</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        "use strict";

        let item;
        const submit_btn = document.querySelector('#submit_btn');

        //TODO 檢查格式
        // const required_fields = [
        // ];
        //
        // for (let s in required_fields) {
        //     item = required_fields[s];
        //     item.el = document.querySelector('#' + item.id);
        //     item.infoEl = item.el.closest('.form-group').querySelector('small');
        // }

        function checkForm() {
            // TODO 檢查格式
            let isPass = true;
            submit_btn.style.display = 'none';

            // for (let s in required_fields) {
            //
            //     //先重置
            //     item = required_fields[s];
            //     item.el.style.border = '1px solid #ccc';
            //     item.infoEl.innerText = '';
            //
            //     //再檢查
            //     if (!item.pattern.test(item.el.value)) {
            //         item.el.style.border = '1px solid red';
            //         item.infoEl.innerText = item.info;
            //         isPass = false;
            //     }
            // }

            if (isPass) {
                let fd = new FormData(document.form1);
                let info_bar = document.querySelector('#info_bar');
                fetch('coupon_edit_api.php', {
                    method: 'POST',
                    body: fd,
                })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        submit_btn.style.display = 'block';
                        console.log(json);
                        info_bar.style.display = 'block';
                        info_bar.innerHTML = json.info;
                        if (json.success) {
                            info_bar.className = 'alert alert-success';
                            setTimeout(() => {
                                location.href = 'coupon_list.php?page=<?= $_GET['page']?>';
                            }, 750)
                        } else {
                            info_bar.className = 'alert alert-danger';
                        }
                    });
            } else {
                submit_btn.style.display = 'block';
            }
            return false;
        }

        const coupon_price_label = document.querySelector('#coupon_price_label');
        const coupon_rule = document.querySelector('#coupon_rule');
        const coupon_start_time = document.querySelector('#coupon_start_time');
        const coupon_end_time = document.querySelector('#coupon_end_time');

        function show_rule() {

            if (coupon_rule.value === "1") {
                coupon_price_label.innerHTML = '折價金額';
            } else {
                coupon_price_label.innerHTML = '折扣百分比(%)';
            }
        }

        function rand_no() {
            document.querySelector('#coupon_no').value = "<?= md5(uniqid())?>";
        }

        function formatDate(date) {
            let d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }

        coupon_start_time.value = formatDate(new Date());
        coupon_end_time.value = formatDate(new Date());

    </script>


<?php include __DIR__ . '/../../pbook_index/__html_foot.php'; ?>