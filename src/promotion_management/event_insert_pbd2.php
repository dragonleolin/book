<?php
$page_name = 'event_insert_pbd2';
$page_title = '選擇滿減促銷活動適用商品範圍';
require __DIR__ . '/__connect_db.php';

include __DIR__ . '/../../pbook_index/__html_head.php';
include __DIR__ . '/../../pbook_index/__html_body.php';
include __DIR__ . '/../../pbook_index/__navbar.php';

$_SESSION['event_insert_pbd2'] = $_POST;

?>
    <style>
        small.form-text {
            color: red;
        }
    </style>

    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="alert alert-primary" role="alert" id="info_bar" style="display: none"></div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">選擇適用商品</h5>
                        <form name="form2" onsubmit="return checkForm()">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="event_pbd">使用分類</label>
                                    <small class="form-text"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="event_pbd_type">新增品項</label>
                                    <select class="form-control" id="event_pbd_type" name="event_pbd_type"">
                                    <option value="1">每滿減</option>
                                    <option value="2">階梯減價</option>
                                    </select>
                                    <small class="form-text"></small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="price_condition">每滿(元)</label>
                                    <input type="text" class="form-control" id="price_condition" name="price_condition">
                                    <small class="form-text"></small>
                                </div>
                                <div class="form-group">
                                    <label for="discount_amount">減</label>
                                    <div class="d-flex">
                                        <input type="text" class="form-control" id="discount_amount"
                                               name="discount_amount">
                                        <small class="form-text"></small>
                                        <select class="form-control col-md-5" name="discount_type" id="discount_type">
                                            <option value="1">元</option>
                                            <option value="2">百分比</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <button id="submit_btn" type="submit" class="btn btn-primary mr-3 ml-3 mb-3">下一步</button>

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
        const coupon_limit = document.querySelector('#coupon_limit');
        let limit_const = <?= json_encode($limit_const); ?>;
        limit_const.forEach((val, ind) => {
            let limit_opt = document.createElement('option');
            limit_opt.value = val.sid;
            limit_opt.innerHTML = val.description;
            coupon_limit.appendChild(limit_opt);
        });

        const required_fields = [
            {
                id: 'coupon_content',
                pattern: /^\S{2}/,
                info: '請輸入正確活動名稱',
            },
            {
                id: 'coupon_no',
                pattern: /^\w{5}/,
                info: '請輸入正確優惠券格式',
            },
            {
                id: 'coupon_rule',
                pattern: /^\d/,
                info: '請輸入正確規則',
            },
            {
                id: 'coupon_price',
                pattern: /^\d/,
                info: '請輸入正確金額',
            },
            {
                id: 'coupon_send_type',
                pattern: /^\d/,
                info: '請輸入正確發送模式',
            },
            {
                id: 'coupon_start_time',
                pattern: /^\d{4}\-\d{2}\-\d{2}$/,
                info: '請輸入正確時間格式',
            },
            {
                id: 'coupon_end_time',
                pattern: /^\d{4}\-\d{2}\-\d{2}$/,
                info: '請輸入正確時間格式',
            },
        ];

        for (let s in required_fields) {
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = item.el.closest('.form-group').querySelector('small');
        }

        function checkForm() {
            let isPass = true;
            submit_btn.style.display = 'none';

            for (let s in required_fields) {

                //先重置
                item = required_fields[s];
                item.el.style.border = '1px solid #ccc';
                item.infoEl.innerText = '';

                //再檢查
                if (!item.pattern.test(item.el.value)) {
                    item.el.style.border = '1px solid red';
                    item.infoEl.innerText = item.info;
                    isPass = false;
                }
            }

            if (isPass) {
                let fd = new FormData(document.form1);
                let info_bar = document.querySelector('#info_bar');
                fetch('coupon_insert_api.php', {
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
                                location.href = 'coupon_list.php';
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
        const coupon_no = document.querySelector('#coupon_no');

        function show_rule() {

            if (coupon_rule.value === "1") {
                coupon_price_label.innerHTML = '折價金額';
            } else {
                coupon_price_label.innerHTML = '折扣百分比(%)';
            }
        }

        function rand_no() {
            let ALPHABET = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            let ID_LENGTH = 10;
            let rtn = '';
            for (let i = 0; i < ID_LENGTH; i++) {
                rtn += ALPHABET.charAt(Math.floor(Math.random() * ALPHABET.length));
            }
            coupon_no.value = rtn;
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

<?php print_r($_SESSION)?>
<?php include __DIR__ . '/../../pbook_index/__html_foot.php'; ?>