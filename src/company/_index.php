<?php
if (!isset($_SESSION)) {
    session_start();
}
$page_title = '品書';
?>
<?php include __DIR__ . '/__html_head.php' ?>

<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
</style>
<?php include __DIR__ . '/__html_body.php' ?>
<?php include __DIR__ . '/__navbar.php' ?>
<!-- 右邊section資料欄位 -->
<section style="width: calc(100vw - 280px);">
    <img src="../../images/admin_bg.png" alt="" style="height: 100%;object-fit: contain;width:100%">
</section>
</div>
<?php include __DIR__ . '/__html_foot.php' ?>