<?php
$page_name = 'event_insert';
$page_title = '選擇活動類型';
require __DIR__ . '/__connect_db.php';

include __DIR__ . '/../../pbook_index/__html_head.php';
include __DIR__ . '/../../pbook_index/__html_body.php';
include __DIR__ . '/../../pbook_index/__navbar.php';


?>

    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="alert alert-primary" role="alert" id="info_bar" style="display: none"></div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">選擇活動類型</h5>
                        <button class="btn-light m-2" onclick="">商品折扣</button>
                        <button class="btn-light m-2" onclick="location.href = 'event_insert_pbd.php'">滿額折扣</button>
                        <button class="btn-light m-2" onclick="">套裝折扣</button>
                        <button class="btn-light m-2" onclick="">滿額贈品</button>
                        <button class="btn-light m-2" onclick="">商品贈品</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/../../pbook_index/__html_foot.php'; ?>