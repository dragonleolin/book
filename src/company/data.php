<?php
require __DIR__ . '/__admin_required.php';
require __DIR__ . '/__connect_db.php';
$page_title = '基本資料';
$account = $_SESSION['loginUser2']['cp_account'];
$sql = "SELECT *  FROM `cp_data_list` WHERE `cp_account` =  '$account'";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();
$form_data1 = [
    '出版社名' => 'cp_name',
    '聯絡人' => 'cp_contact_p',
    '電話' => 'cp_phone',
    '電子郵件' => 'cp_email',
    '地址' => 'cp_address',
];
$form_data2 = [
    '統一編號' => 'cp_tax_id',
    '書籍庫存' => 'cp_stock',
    'logo' => 'cp_logo',
    '建立日期' => 'cp_created_date',
];
?>
<?php include __DIR__ . '/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }

    .rand_button {
        right: 10%;
        top: 0;
    }
</style>
<?php include __DIR__ . '/__html_body.php' ?>
<?php include __DIR__ . '/__navbar.php' ?>
<!-- 右邊section資料欄位 -->
<section class="p-4 container-fluid">
    <div class="container">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h2>基本資料</h2>
                <div class="title_line"></div>
            </div>
        </nav>

        <div class="container position-relative">
            <div style="text-align: center">
                <button type="button" class="btn btn-warning position-absolute rand_button">修改資料</button>
            </div>
            <div class="data card mx-auto">
                <div class="card-body d-flex pl-5" >
                    <div class="container ">
                        <?php foreach ($form_data1 as $k => $v) : ?>
                            <div class="pt-3" style="font-size:2rem">・<?= $k ?></div>
                            <div class="px-5 py-1" style="font-size:1.2rem ;color:#2d3a3aaf"><?= $row[$v] ?></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="container pl-5">
                        <?php foreach ($form_data2 as $k => $v) : ?>
                            <div class="pt-3" style="font-size:2rem">・<?= $k ?></div>
                            <div class="px-5 py-1" style="font-size:1.2rem ;color:#2d3a3aaf"><?= $row[$v] ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- <div class="container position-relative" style="margin-left:calc( 50% - 314px)">
            
            <div class="row">
                <div class="form-group d-flex">
                    
                </div>
            </div>
        </div> -->
        </div>
</section>
</div>
<?php include __DIR__ . '/__html_foot.php' ?>