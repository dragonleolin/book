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
                        <form name="form2" onsubmit="return checkForm()" method="POST" action="event_insert_pbd_api.php">
                            <div class="row border-bottom">
                                <div id="categories_block" class="form-group col-md-12">
                                    <label for="categories" class="update_label">使用分類</label>
                                    <div class="d-flex mt-2 mb-2">
                                        <button type="button" class="btn btn-info btn-sm mr-2" onclick="checkAll(true)">全選</button>
                                        <button type="button" class="btn btn-info btn-sm" onclick="checkAll(false)">全部取消</button>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <?php foreach ($cate_row as $k => $v) : ?>
                                            <div class="form-check" style="margin:0px 20px 10px 0px">
                                                <input class="form-check-input" type="checkbox" name="categories[]"
                                                       id="categories<?= $k ?>" value="<?= $k ?>">
                                                <label class="form-check-label"
                                                       for="categories<?= $k ?>"><?= $v ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="form-group col-md-4">
                                    <label for="book_id_type">新增品項</label>
                                    <select class="form-control" id="book_id_type" name="book_id_type">
                                        <option value="1">ISBN</option>
                                        <option value="2">書籍編號</option>
                                    </select>
                                    <small class="form-text"></small>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="book_id">　</label>
                                    <input type="text" class="form-control" id="book_id" name="book_id">
                                    <small class="form-text"></small>
                                </div>
                            </div>

                    </div>

                    <button id="submit_btn" type="submit" class="btn btn-primary mr-3 ml-3 mb-3">完成</button>

                    </form>
                </div>
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


        function checkAll(k) {
            let cate_boxes = document.querySelectorAll('#categories_block input');
            for (let i = 0; i < cate_boxes.length; i++){
                cate_boxes[i].checked = k;
            }
        }

    </script>

<?php include __DIR__ . '/../../pbook_index/__html_foot.php'; ?>