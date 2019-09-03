<?php
$page_name = 'event_insert_pbd2';
$page_title = '選擇滿減促銷活動適用商品範圍';
require __DIR__ . '/__connect_db.php';

include __DIR__ . '/../../pbook_index/__html_head.php';
include __DIR__ . '/../../pbook_index/__html_body.php';
include __DIR__ . '/../../pbook_index/__navbar.php';

$_SESSION['event_insert_pbd2'] = $_POST;

$cate_sql = "SELECT `sid`,`name` FROM `vb_categories` WHERE 1";
$cate_stmt = $pdo->query($cate_sql);
$temp_row = $cate_stmt->fetchAll(PDO::FETCH_UNIQUE);
$cate_row = [];
foreach ($temp_row as $r => $s) {
    foreach ($s as $k => $v) {
        $cate_row[$r] = $v;
    }
}

$sql = "SELECT `sid`,`cp_name` FROM `cp_data_list` WHERE 1";
$temp_cp_row = $pdo->query($sql)->fetchAll(PDO::FETCH_UNIQUE);
$cp_row=[];
foreach ($temp_cp_row as $r => $s){
    $cp_row[$r] = $s['cp_name'];
}


?>
    <style>
        body {
            background: url(../../images/bg.png) repeat center top;
        }
        small.form-text {
            color: red;
        }
    </style>

    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-9">
                <div class="alert alert-primary" role="alert" id="info_bar" style="display: none"></div>
                <div class="card-body">
                    <h5 class="card-title">選擇適用範圍</h5>
                    <form name="form2" onsubmit="return checkForm()" method="POST"
                          action="event_insert_pbd_api.php">


                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                            1.選擇參與廠商
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                     data-parent="#accordionExample">
                                    <div class="card-body">

                                        <div class="row border-bottom mt-2">
                                            <div class="form-group col-md-6">
                                                <label for="cp_group_set">選擇廠商</label>
                                                <select class="form-control" id="cp_group_set" name="cp_group_set"
                                                        onchange="cp_group_display()">
                                                    <option selected value="0">所有廠商</option>
                                                    <option value="1">選擇廠商</option>
                                                </select>
                                                <small class="form-text"></small>
                                            </div>
                                        </div>
                                        <div id="checkboxes_block1" class="row border-bottom" style="display: none">
                                            <div class="form-group col-md-12">
                                                <label for="cp_group" class="update_label">使用分類</label>
                                                <div class="d-flex mt-2 mb-2">
                                                    <button type="button" class="btn btn-info btn-sm mr-2"
                                                            onclick="checkAll(1,true)">
                                                        全選
                                                    </button>
                                                    <button type="button" class="btn btn-info btn-sm"
                                                            onclick="checkAll(1,false)">
                                                        全部取消
                                                    </button>
                                                </div>
                                                <div class="d-flex flex-wrap">
                                                    <?php foreach ($cp_row as $k => $v) : ?>
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
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed btn-block" type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                            2.選擇適用書籍
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                     data-parent="#accordionExample">
                                    <div class="card-body">


                                        <div class="row border-bottom mt-2">
                                            <div class="form-group col-md-6">
                                                <label for="group_type">選擇分類方式</label>
                                                <select class="form-control" id="group_type" name="group_type"
                                                        onchange="group_type_display()">
                                                    <option selected value="0">全站適用</option>
                                                    <option value="1">書籍分類</option>
                                                    <option value="2">自訂群組</option>
                                                </select>
                                                <small class="form-text"></small>
                                            </div>
                                        </div>

                                        <div id="checkboxes_block2" class="row border-bottom" style="display: none">
                                            <div class="form-group col-md-12">
                                                <label for="categories" class="update_label">使用分類</label>
                                                <div class="d-flex mt-2 mb-2">
                                                    <button type="button" class="btn btn-info btn-sm mr-2"
                                                            onclick="checkAll(2,true)">
                                                        全選
                                                    </button>
                                                    <button type="button" class="btn btn-info btn-sm"
                                                            onclick="checkAll(2,false)">
                                                        全部取消
                                                    </button>
                                                </div>
                                                <div class="d-flex flex-wrap">
                                                    <?php foreach ($cate_row as $k => $v) : ?>
                                                        <div class="form-check" style="margin:0px 20px 10px 0px">
                                                            <input class="form-check-input" type="checkbox"
                                                                   name="categories[]"
                                                                   id="categories<?= $k ?>" value="<?= $k ?>">
                                                            <label class="form-check-label"
                                                                   for="categories<?= $k ?>"><?= $v ?></label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="book_id_block" class="row mt-2" style="display: none;">
                                            <div class="form-group col-md-4">
                                                <label for="book_id_type">新增品項</label>
                                                <select class="form-control" id="book_id_type" name="book_id_type">
                                                    <option value="1">ISBN</option>
                                                    <option value="2">書籍編號</option>
                                                </select>
                                                <small class="form-text"></small>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="book_id[]">　</label>
                                                <input type="text" class="form-control" id="book_id[]"
                                                       name="book_id[]">
                                                <small class="form-text"></small>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <button id="submit_btn" type="submit" class="btn btn-primary m-3">完成</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        "use strict"


        let item;
        const submit_btn = document.querySelector('#submit_btn');
        const coupon_limit = document.querySelector('#coupon_limit');
        //let limit_const = <?//= json_encode($limit_const); ?>//;
        //limit_const.forEach((val, ind) => {
        //    let limit_opt = document.createElement('option');
        //    limit_opt.value = val.sid;
        //    limit_opt.innerHTML = val.description;
        //    coupon_limit.appendChild(limit_opt);
        //});

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

        // for (let s in required_fields) {
        //     item = required_fields[s];
        //     item.el = document.querySelector('#' + item.id);
        //     item.infoEl = item.el.closest('.form-group').querySelector('small');
        // }

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


        function checkAll(k, bool) {
            let checkboxes = document.querySelectorAll('#checkboxes_block'+ k +' input');
            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = bool;
            }
        }


        function cp_group_display() {
            let cp_group_set = document.querySelector('#cp_group_set');
            let cp_block = document.querySelector('#checkboxes_block1');
            if (cp_group_set.value == 1) {
                cp_block.style.display = 'flex';
            }else{
                cp_block.style.display = 'none';
            }
        }

        function group_type_display() {
            let group_type = document.querySelector('#group_type');
            let categories_block = document.querySelector('#checkboxes_block2');
            let book_id_block = document.querySelector('#book_id_block');
            if (group_type.value == 0) {
                categories_block.style.display = 'none';
                book_id_block.style.display = 'none';
            } else if (group_type.value == 1) {
                categories_block.style.display = 'flex';
                book_id_block.style.display = 'none';
            } else {
                categories_block.style.display = 'none';
                book_id_block.style.display = 'flex';
            }
        }

    </script>

<?php include __DIR__ . '/../../pbook_index/__html_foot.php'; ?>