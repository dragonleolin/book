<?php
$page_name = 'event_insert';
$page_title = '選擇活動類型';
if(isset($_SESSION)){
    unset($_SESSION['event_insert_gd']);
}

require __DIR__ . '/__connect_db.php';

include __DIR__ . '/../../pbook_index/__html_head.php';
include __DIR__ . '/../../pbook_index/__html_body.php';
include __DIR__ . '/../../pbook_index/__navbar.php';


?>

    <div class="container-fluid pt-5">

        <nav class="navbar justify-content-between">
            <div>
                <h4>新增商品折扣活動</h4>
                <div class="title_line"></div>
            </div>
            <ul class="nav justify-content-between">
                <li class="nav-item" style="margin: 0px 10px">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="button"
                            onclick="location.href = 'event_list.php'">
                        <i class="fas fa-arrow-circle-left"></i>
                        回到上一頁
                    </button>
                </li>
            </ul>
        </nav>


        <div class="row mt-4 ml-auto">
            <div class="col-md-9 m-auto">
                <div class="alert alert-primary" role="alert" id="info_bar" style="display: none"></div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">選擇活動類型</h5>
                        <button class="btn-light m-2 btn-lg" onclick="location.href = 'event_insert_gd.php'">商品折扣</button>
                        <button class="btn-light m-2 btn-lg" onclick="location.href = 'event_insert_pbd.php'">滿額折扣</button>
                        <button class="btn-light m-2 btn-lg" onclick="">套裝折扣</button>
                        <button class="btn-light m-2 btn-lg" onclick="">滿額贈品</button>
                        <button class="btn-light m-2 btn-lg" onclick="">商品贈品</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/../../pbook_index/__html_foot.php'; ?>