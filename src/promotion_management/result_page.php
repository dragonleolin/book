<?php
$page_title = '新增成功';

include __DIR__ . '/../../pbook_index/__html_head.php';
include __DIR__ . '/../../pbook_index/__html_body.php';
include __DIR__ . '/../../pbook_index/__navbar.php';
?>

<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
</style>


<div style="padding:150px 100px 170px 180px">
    <div class="success update card" id="success">
        <div class="success card-body">
            <label class="success_text" style="background:transparent">新增成功</label>
            <div><img class="success_img" src="../../images/icon_checked.svg"></div>
        </div>
    </div>
</div>

<script>
    setTimeout(()=>{
        location.href = 'event_list.php';
    },1000)
</script>