<?php

$page_name = 'event_insert_gd';
$page_title = '新增商品折扣活動';
require __DIR__ . '/__connect_db.php';

include __DIR__ . '/../../pbook_index/__html_head.php';
include __DIR__ . '/../../pbook_index/__html_body.php';
include __DIR__ . '/../../pbook_index/__navbar.php';

$sql = "SELECT `sid`,`cp_name` FROM `cp_data_list` WHERE 1";
$cp_data_list = $pdo->query($sql)->fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_COLUMN);

?>
    <style>
        body {
            background: url(../../images/bg.png) repeat center top;
        }

        small.form-text {
            color: red;
        }

    </style>

    <div class="container-fluid pt-5">

        <nav class="navbar justify-content-between">
            <div>
                <h4>新增商品折扣活動</h4>
                <div class="title_line"></div>
            </div>
            <ul class="nav justify-content-between">
                <li class="nav-item" style="margin: 0px 10px">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="button"
                            onclick="location.href = 'event_insert.php'">
                        <i class="fas fa-arrow-circle-left"></i>
                        回到上一頁
                    </button>
                </li>
            </ul>
        </nav>


        <div class="row mt-4 ml-auto">
            <div class="col-md-9 m-auto">
                <div class="alert alert-primary" role="alert" id="info_bar" style="display: none"></div>
                <form name="form1" onsubmit="return checkForm()" method="POST"
                      action="event_insert_gd2.php">
                    <div class="card mb-5 pl-5 pr-5 pt-3">
                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="event_name">活動名稱</label>
                                    <input type="text" class="form-control" id="event_name" name="event_name">
                                    <small class="form-text"></small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="user_level_type">會員等級限制</label>
                                    <select class="form-control" id="user_level_type" name="user_level_type"
                                            onchange="display_user_level_row()">
                                        <option value="0">無限制</option>
                                        <option value="1">僅限－－</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 mt-2 ml-1" id="user_level_row" style="display: none">
                                <div class="form-group col-md-12 d-flex flex-wrap">
                                    <div class="form-check pr-3">
                                        <input class="form-check-input" type="checkbox"
                                               name="user_level[]"
                                               id="user_level1" value="1">
                                        <label class="form-check-label"
                                               for="user_level1">品書會員</label>
                                    </div>
                                    <div class="form-check pr-3">
                                        <input class="form-check-input" type="checkbox"
                                               name="user_level[]"
                                               id="user_level2" value="2">
                                        <label class="form-check-label"
                                               for="user_level2">品書學徒</label>
                                    </div>
                                    <div class="form-check pr-3">
                                        <input class="form-check-input" type="checkbox"
                                               name="user_level[]"
                                               id="user_level3" value="3">
                                        <label class="form-check-label"
                                               for="user_level3">品書專家</label>
                                    </div>
                                    <div class="form-check pr-3">
                                        <input class="form-check-input" type="checkbox"
                                               name="user_level[]"
                                               id="user_level4" value="4">
                                        <label class="form-check-label"
                                               for="user_level4">品書大師</label>
                                    </div>
                                    <div class="form-check pr-3">
                                        <input class="form-check-input" type="checkbox"
                                               name="user_level[]"
                                               id="user_level5" value="5">
                                        <label class="form-check-label"
                                               for="user_level5">品書至尊</label>
                                    </div>
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
                                    <label for="gd_type">折扣類型</label>
                                    <select class="form-control" id="gd_type" name="gd_type"">
                                    <option value="5">百分比折扣</option>
                                    <option value="6">固定金額</option>
                                    </select>
                                    <small class="form-text"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="gd_amount">折扣</label>
                                    <input type="text" class="form-control price_condition" id="gd_amount"
                                           name="gd_amount">
                                    <small class="form-text"></small>
                                </div>
                            </div>


                            <div class="row mt-2">
                                <div class="form-group col-md-6">
                                    <label for="cp_group_set">選擇參與廠商</label>
                                    <select class="form-control" id="cp_group_set" name="cp_group_set"
                                            onchange="cp_group_display()">
                                        <option value="0">所有廠商</option>
                                        <option value="1">僅限－－</option>
                                    </select>
                                    <small class="form-text"></small>
                                </div>
                            </div>
                            <div class="pl-4 row border-bottom ">
                                <div id="cp_checkboxes_row" class="row" style="display: none;">
                                    <div class="form-group col-md-12">
                                        <div class="d-flex mt-2 mb-2">
                                            <button type="button" class="btn btn-info btn-sm mr-2"
                                                    onclick="checkAll(true)">
                                                全選
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm"
                                                    onclick="checkAll(false)">
                                                全部取消
                                            </button>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            <?php foreach ($cp_data_list as $k => $v) : ?>
                                                <div class="form-check" style="margin:0px 20px 10px 0px">
                                                    <input class="form-check-input" type="checkbox"
                                                           name="cp_group[]"
                                                           id="cp_group<?= $k ?>" value="<?= $k ?>">
                                                    <label class="form-check-label"
                                                           for="cp_group<?= $k ?>"><?= $v ?></label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button id="submit_btn" type="submit" class="btn btn-primary mr-3 ml-3 mb-3">下一步</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        "use strict";

        let item;

        const required_fields = [
            {
                id: 'event_name',
                pattern: /^\S{2}/,
                info: '請輸入正確活動名稱',
            },
            {
                id: 'event_start_time',
                pattern: /^\d{4}\-\d{2}\-\d{2}$/,
                info: '請輸入正確時間格式',
            },
            {
                id: 'event_end_time',
                pattern: /^\d{4}\-\d{2}\-\d{2}$/,
                info: '請輸入正確時間格式',
            },
            {
                id: 'gd_amount',
                pattern: /^\d{1,}$/,
                info: '請輸入正確金額',
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


            //檢查會員等級選項

            let user_level_help = document.querySelector('#user_level_row small');
            let user_level_type = document.querySelector('#user_level_type');
            let user_level_checkboxes = document.querySelectorAll('#user_level_row input');
            let user_level_ischeck = 0;
            user_level_help.innerHTML = '';
            for (let i = 0; i < 5; i++) {
                if (user_level_checkboxes[i].checked == true) {
                    user_level_ischeck++;
                }
            }
            if (user_level_type.value == '1' && user_level_ischeck == 0) {
                isPass = false;
                user_level_help.innerHTML = '請勾選會員等級需求';
            }

            if (isPass) {
                return true;
            } else {
                submit_btn.style.display = 'inline-block';
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

        //顯示會員等級選項
        function display_user_level_row() {
            let user_level_type = document.querySelector('#user_level_type');
            let user_level_row = document.querySelector('#user_level_row');
            if (user_level_type.value == '1') {
                user_level_row.style.display = 'flex';
            } else {
                let user_level_checkboxes = document.querySelectorAll('#user_level_row input')
                for (let i = 0; i < 5; i++) {
                    user_level_checkboxes[i].checked = false;
                }
                user_level_row.style.display = 'none';
            }
        }


        //自動輸入當天日期
        document.querySelector('#event_start_time').value = formatDate(new Date());
        document.querySelector('#event_end_time').value = formatDate(new Date());


        //顯示廠商選項
        function cp_group_display() {
            let cp_group_set = document.querySelector('#cp_group_set');
            let cp_checkboxes_row = document.querySelector('#cp_checkboxes_row');
            if (cp_group_set.value == 1) {
                cp_checkboxes_row.style.display = 'flex';
            } else {
                checkAll(false);
                cp_checkboxes_row.style.display = 'none';
            }
        }

        //自動勾選
        function checkAll(bool) {
            let cp_checkboxes = document.querySelectorAll('#cp_checkboxes_row input');
            for (let i = 0; i < cp_checkboxes.length; i++) {
                cp_checkboxes[i].checked = bool;
            }
        }


    </script>


<?php include __DIR__ . '/../../pbook_index/__html_foot.php'; ?>