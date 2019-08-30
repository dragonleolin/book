<?php
require __DIR__ . '/__admin_required.php';
require __DIR__ . '/__connect_db.php';
$page_title = '基本資料';
$account = $_SESSION['loginUser2']['cp_account'];
$sql = "SELECT *  FROM `cp_data_list` WHERE `cp_account` =  '$account'";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();
$sid =$row['sid'];
$stock = $pdo->query("SELECT SUM(`vb_books`.`stock`) FROM `vb_books` JOIN `cp_data_list` ON $sid = `vb_books`.`publishing` AND  $sid = `cp_data_list`.`sid`")->fetch();
$form_data1 = [
    '出版社名' => 'cp_name',
    '聯絡人' => 'cp_contact_p',
    '電話' => 'cp_phone',
    '電子郵件' => 'cp_email',
    '地址' => 'cp_address',
    '統一編號' => 'cp_tax_id',
];
$form_data2 = [
    '建立日期' => 'cp_created_date',
];

?>
<?php include __DIR__ . '/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }

    .edit_button {
        right: -13%;
        top: -6%; 
    }

    .data {
        border-radius: 20px;
        margin: 0px 0px 0px 4rem;
        width: 62vw;
        border: none;
    }

    .data_head {
        font-size: 1.5rem;
        color: #fff;
    }

    .data_body {
        font-size: 1.2rem;
        color: #fff;
    }
    
    .card_shad {
        border-radius: 20px;
        margin: 2rem 0px 0px 4rem;
        width: 62vw;
        height: 72vh;
        left: -2.5vw;
        top: -1vh;
        background-color: #9cc5a1;
        z-index: -1;

    }
    /* .logo2 {
        height: 70px;
        position: absolute;
        top: 10vh;
        right: -5vh;
    } */
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
            <div style="text-align: center;">
                <button type="button" class="btn btn-outline-primary position-absolute edit_button" onclick="location.href='data_edit.php'">
                <i class="fas fa-edit"style="font-size:1.5rem;"></i>
                <span style="font-size:1.5rem;">修改資料</span>
                </button>
            </div>
            <div class="card data">
                <div class="card-body d-flex pl-5 pb-5" style="background:#2d3a3a;border-radius: 20px;">
                    <div class="container">
                        <?php foreach ($form_data1 as $k => $v) : ?>
                            <div class="pt-3 data_head">・<?= $k ?></div>
                            <div class="px-5 pt-3 data_body"><?= $row[$v] ?></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="container pl-5">
                        <div class="pt-3 data_head">・書籍庫存</div>
                        <div class="px-5 pt-3 data_body"><?= $stock["SUM(`vb_books`.`stock`)"] ?></div>
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
            <!-- <div>
                <img class="logo2" src="../../images/icon_logo2.svg" alt="">
            </div> -->
        </div>
</section>
</div>
<?php include __DIR__ . '/__html_foot.php' ?>