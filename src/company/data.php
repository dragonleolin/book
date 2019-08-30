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
    '統一編號' => 'cp_tax_id',
];
$form_data2 = [
    '書籍庫存' => 'cp_stock',
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

    .data {
        border-radius: 20px;
        margin: 2rem 0px 0px 4rem;
        width: 62vw;
        border: none;
    }
    .card_shad{
        border-radius: 20px;
        margin: 2rem 0px 0px 4rem;
        width: 62vw;
        height: 80vh;
        left: -2.5vw;
        top: -1vh;
        background-color: #9cc5a1;
        z-index: -1;
        
    }
    .data_head {
        font-size: 2rem;
        color: #fff;
    }

    .data_body {
        font-size: 1.2rem;
        color: #fff;
    }

    .logo2 {
        height: 70px;
        position: absolute;
        top: 10vh;
        right: -5vh;
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
            <!-- <div style="text-align: center">
                <button type="button" class="btn btn-warning position-absolute rand_button">修改資料</button>
            </div> -->
            <div class="card data">
                <div class="card-body d-flex pl-5 pb-5" style="background:#2d3a3a;border-radius: 20px;">
                    <div class="container">
                        <?php foreach ($form_data1 as $k => $v) : ?>
                            <div class="pt-3 data_head">・<?= $k ?></div>
                            <div class="px-5 pt-3 data_body"><?= $row[$v] ?></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="container pl-5">
                        <?php foreach ($form_data2 as $k => $v) : ?>
                            <div class="pt-3 data_head">・<?= $k ?></div>
                            <div class="px-5 pt-3 data_body"><?= $row[$v] ?></div>
                        <?php endforeach; ?>
                        <div>
                            <div class="pt-3 data_head mb-5">・logo</div>
                            <div class="ml-5" style="height: 230px;width: 230px;border: 1px solid #ddd;background-color:#fff">
                                <img style="object-fit: contain;width: 100%;height: 100%" src="../company_Management/logo/<?= htmlentities($row['cp_logo']) ?>" id="demo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card position-absolute card_shad"></div>
            </div>
            <div>
                <img class="logo2" src="../../images/icon_logo2.svg" alt="">
            </div>
        </div>
</section>
</div>
<?php include __DIR__ . '/__html_foot.php' ?>