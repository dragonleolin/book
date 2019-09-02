<?php require __DIR__ . '/__admin_required.php' ?>
<?php $page_title = '資料列表'; ?>

<?php include '../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
</style>
<?php include '../../pbook_index/__html_body.php' ?>
<?php include '../../pbook_index/__navbar.php' ?>
<!-- 搜尋失敗提視窗 -->
<div class="delete update card" id="search_failed">
    <div class="delete card-body">
        <label class="delete_text " id="">查無資料，請重新輸入搜尋條件</label>
    </div>
</div>
<script>
    location2();

    function location2() {
        setTimeout(() => {
            location.href = "MR_memberDataList.php";
        }, 1000);

    }
</script>
<?php include '../../pbook_index/__html_foot.php' ?>