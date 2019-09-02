<?php
$page_name = 'event_insert_pbd';
$page_title = '新增滿減促銷活動';
require __DIR__ . '/__connect_db.php';

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
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="alert alert-primary" role="alert" id="info_bar" style="display: none"></div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">新增商品促銷活動</h5>
                        <form name="form1" onsubmit="return checkForm()" method="POST" action="event_insert_pbd2.php">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="event_name">活動名稱</label>
                                    <input type="text" class="form-control" id="event_name" name="event_name">
                                    <small class="form-text"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="user_level">會員等級限制</label>
                                    <select class="form-control" id="user_level" name="user_level"">
                                    <option value="0">無限制</option>
                                    <option value="1">品書會員</option>
                                    <option value="2">品書學徒</option>
                                    <option value="3">品書專家</option>
                                    <option value="4">品書大師</option>
                                    <option value="5">品書至尊</option>
                                    </select>
                                    <small class="form-text"></small>
                                </div>
                            </div>
                            <div class="row justify-content-around border-bottom">
                                <div class="form-group col-md-6">
                                    <label class="mr-2" for="event_start_time">起始日期</label>
                                    <input type="date" class="form-control" id="event_start_time"
                                           name="event_start_time">
                                    <small class="form-text"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="mr-2" for="event_end_time">終止日期</label>
                                    <input type="date" class="form-control" id="event_end_time" name="event_end_time">
                                    <small class="form-text"></small>
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <div class="form-group col-md-6">
                                    <label for="event_pbd_type">折扣類型</label>
                                    <select class="form-control" id="event_gd_type" name="event_gd_type"">
                                    <option value="3">百分比</option>
                                    <option value="4">固定金額</option>
                                    </select>
                                    <small class="form-text"></small>
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
        //
        //let item;
        //const submit_btn = document.querySelector('#submit_btn');
        //const coupon_limit = document.querySelector('#coupon_limit');
        //let limit_const = <?//= json_encode($limit_const); ?>//;
        //limit_const.forEach((val, ind) => {
        //    let limit_opt = document.createElement('option');
        //    limit_opt.value = val.sid;
        //    limit_opt.innerHTML = val.description;
        //    coupon_limit.appendChild(limit_opt);
        //});
        //
        //const required_fields = [
        //    {
        //        id: 'coupon_content',
        //        pattern: /^\S{2}/,
        //        info: '請輸入正確活動名稱',
        //    },
        //    {
        //        id: 'coupon_no',
        //        pattern: /^\w{5}/,
        //        info: '請輸入正確優惠券格式',
        //    },
        //    {
        //        id: 'coupon_rule',
        //        pattern: /^\d/,
        //        info: '請輸入正確規則',
        //    },
        //    {
        //        id: 'coupon_price',
        //        pattern: /^\d/,
        //        info: '請輸入正確金額',
        //    },
        //    {
        //        id: 'coupon_send_type',
        //        pattern: /^\d/,
        //        info: '請輸入正確發送模式',
        //    },
        //    {
        //        id: 'coupon_start_time',
        //        pattern: /^\d{4}\-\d{2}\-\d{2}$/,
        //        info: '請輸入正確時間格式',
        //    },
        //    {
        //        id: 'coupon_end_time',
        //        pattern: /^\d{4}\-\d{2}\-\d{2}$/,
        //        info: '請輸入正確時間格式',
        //    },
        //];
        //
        //for (let s in required_fields) {
        //    item = required_fields[s];
        //    item.el = document.querySelector('#' + item.id);
        //    item.infoEl = item.el.closest('.form-group').querySelector('small');
        //}

        function checkForm() {
            let isPass = true;
            // submit_btn.style.display = 'none';
            //
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

                return true;
            } else {
                return false;
            }
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

        document.querySelector('#event_start_time').value = formatDate(new Date());
        document.querySelector('#event_end_time').value = formatDate(new Date());


        const event_pbd_type = document.querySelector('#event_pbd_type');
        const addStageBtn = document.querySelector('#addStageBtn');
        let stage = 1;

        event_pbd_type.addEventListener('change', () => {
            if (event_pbd_type.value == 4) {
                addStageBtn.style.display = 'inline-block';
            } else {
                addStageBtn.style.display = 'none';
                for (let i = 2; i <= 3; i++) {
                    let priceStage = document.querySelector('#priceStage' + i);
                    priceStage.style.display = 'none';
                }
                stage = 0;
            }
        });

        function addStage() {
            stage++;
            if (stage == 3) {
                addStageBtn.style.display = 'none';
            }
            let priceStage = document.querySelector('#priceStage' + stage);
            priceStage.style.display = 'flex';
        }

        function sel_type(sel_id) {
            let sel = document.querySelectorAll('.sel_discount_type');
            for (let i = 0; i < 3; i++) {
                sel[i].value = sel[sel_id].value;
            }
        }

    </script>


<?php include __DIR__ . '/../../pbook_index/__html_foot.php'; ?>