<?php

$page_name = 'event_insert_pbd';
$page_title = '新增滿減促銷活動';
require __DIR__ . '/__connect_db.php';

include __DIR__ . '/../../pbook_index/__html_head.php';
include __DIR__ . '/../../pbook_index/__html_body.php';
include __DIR__ . '/../../pbook_index/__navbar.php';

?>
    <style>
        body {
            background: url(../../images/bg.png) repeat center top;
        }
        small.form-text {
            color: red;
        }

    </style>

    <div class="container pt-5">

        <nav class="navbar justify-content-between">
            <div>
                <h4>新增滿額折價活動</h4>
                <div class="title_line"></div>
            </div>
            <ul class="nav justify-content-between">
                <li class="nav-item" style="margin: 0px 10px">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick="location.href = 'event_insert.php'">
                        <i class="fas fa-arrow-circle-left"></i>
                        回到上一頁
                    </button>
                </li>
            </ul>
        </nav>


        <div class="row mt-4 ml-auto">
            <div class="col-md-9 m-auto">
                <div class="alert alert-primary" role="alert" id="info_bar" style="display: none"></div>
                <div class="card mb-5 pl-5 pr-5 pt-3">
                    <div class="card-body">
                        <form name="form1" onsubmit="return checkForm()" method="POST" action="event_insert_pbd_api.php">
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
                                    <select class="form-control" id="user_level_type" name="user_level_type" onchange="display_user_level_row()">
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
                                    <label for="event_pbd_type">滿減類型</label>
                                    <select class="form-control" id="event_pbd_type" name="event_pbd_type"">
                                    <option value="3">每滿減價</option>
                                    <option value="4">階梯減價</option>
                                    </select>
                                    <small class="form-text"></small>
                                </div>
                            </div>
                            <div id="priceStage">

                                <div id="priceStage1" class="row border-bottom justify-content-between mt-2">
                                    <div class="form-group col-md-6">
                                        <label for="price_condition1">每滿(元)</label>
                                        <input type="text" class="form-control price_condition" id="price_condition1"
                                               name="price_condition1">
                                        <small class="form-text"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="discount_amount1">減</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control discount_amount"
                                                   id="discount_amount1"
                                                   name="discount_amount1">
                                            <select class="form-control sel_discount_type" name="discount_type"
                                                    id="discount_type" onchange="sel_type(0)">
                                                <option value="1">元</option>
                                                <option value="2">百分比</option>
                                            </select>
                                        </div>
                                        <small class="form-text"></small>
                                    </div>
                                </div>
                                <div style="display: none" id="priceStage2"
                                     class="row border-bottom justify-content-between mt-2">
                                    <div class="form-group col-md-6">
                                        <label for="price_condition2">每滿(元)</label>
                                        <input type="text" class="form-control price_condition" id="price_condition2"
                                               name="price_condition2">
                                        <small class="form-text"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="discount_amount2">減</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control discount_amount"
                                                   id="discount_amount2"
                                                   name="discount_amount2">
                                            <select class="form-control sel_discount_type" onchange="sel_type(1)">
                                                <option value="1">元</option>
                                                <option value="2">百分比</option>
                                            </select>
                                        </div>
                                        <small class="form-text"></small>
                                    </div>
                                </div>
                                <div style="display: none" id="priceStage3"
                                     class="row border-bottom justify-content-between mt-2">
                                    <div class="form-group col-md-6">
                                        <label for="price_condition3">每滿(元)</label>
                                        <input type="text" class="form-control price_condition" id="price_condition3"
                                               name="price_condition3">
                                        <small class="form-text"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="discount_amount3">減</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control discount_amount"
                                                   id="discount_amount3"
                                                   name="discount_amount3">
                                            <select class="form-control sel_discount_type" onchange="sel_type(2)">
                                                <option value="1">元</option>
                                                <option value="2">百分比</option>
                                            </select>
                                        </div>
                                        <small class="form-text"></small>
                                    </div>
                                </div>


                            </div>
                            <button style="display: none" id="addStageBtn" class="btn btn-outline-primary my-2 my-sm-0"
                                    type="button"
                                    onclick="addStage()">
                                <i class="fas fa-plus-circle"></i>新增階段
                            </button>
                    </div>

                    <button id="submit_btn" type="submit" class="btn btn-primary mr-3 ml-3 mb-3">提交</button>

                    </form>
                </div>
            </div>
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
                id: 'price_condition1',
                pattern: /^\d{1,}$/,
                info: '請輸入正確金額',
            },
            {
                id: 'discount_amount1',
                pattern: /^\d{1,}$/,
                info: '請輸入正確金額',
            },
            {
                id: 'price_condition2',
                pattern: /^\d{0,}$/,
                info: '請輸入正確金額',
            },
            {
                id: 'discount_amount2',
                pattern: /^\d{0,}$/,
                info: '請輸入正確金額',
            },
            {
                id: 'price_condition3',
                pattern: /^\d{0,}$/,
                info: '請輸入正確金額',
            },
            {
                id: 'discount_amount3',
                pattern: /^\d{0,}$/,
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
            for(let i = 0; i < 5; i++){
                if(user_level_checkboxes[i].checked == true) {
                    user_level_ischeck++;
                }
            }
            if(user_level_type.value == '1' && user_level_ischeck == 0){
                isPass = false;
                user_level_help.innerHTML = '請勾選會員等級需求';
            }

            //測試階梯減價是否符合邏輯
            if (isPass) {
                let price_condition = document.querySelectorAll('.price_condition');
                let discount_amount = document.querySelectorAll('.discount_amount');
                let price_condition_ar = [];
                let discount_ratio = [];
                let i = 0;
                while (i<3 && price_condition[i].value) {
                    price_condition_ar[i] = 1*price_condition[i].value;
                    discount_ratio[i] = discount_amount[i].value / price_condition[i].value;
                    if( i>0 && (price_condition_ar[i]<price_condition_ar[i-1] || discount_ratio[i]<discount_ratio[i-1])){
                        isPass = false;
                        document.querySelector('#price_condition'+(i+1)+' ~ small').innerHTML = '階梯減價邏輯錯誤';
                    }
                    i++;
                }
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
        function display_user_level_row(){
            let user_level_type = document.querySelector('#user_level_type');
            let user_level_row = document.querySelector('#user_level_row');
            if (user_level_type.value == '1'){
                user_level_row.style.display = 'flex';
            }else{
                let user_level_checkboxes = document.querySelectorAll('#user_level_row input')
                for(let i = 0; i < 5; i++){
                    user_level_checkboxes[i].checked = false;
                }
                user_level_row.style.display = 'none';
            }
        }


        //自動輸入當天日期
        document.querySelector('#event_start_time').value = formatDate(new Date());
        document.querySelector('#event_end_time').value = formatDate(new Date());


        //階梯減價顯示
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
                    document.querySelector('#price_condition'+i).value = '';
                    document.querySelector('#discount_amount'+i).value = '';
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