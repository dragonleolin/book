<?php require  '_db_connect.php' ?>
<?php

$data_item = [
    '#' => 'sid',
    '會員編號' => 'number',
    '等級' => 'personLevel',
    '姓名' => 'name',
    '密碼' => 'password',
    '電子信箱' => 'email',
    '性別' => 'gender',
    '生日' => 'birthday',
    '手機' => 'mobile',
    '職業' => 'career',
    '地址' => 'address',
    '建立時間' => 'createdDate',
];
$new_number = 'MR' . uniqid();
$a_level = [
    '品書會員',
    '品書學徒',
    '品書專家',
    '品書大師',
    '品書至尊',
]
?>
<?php include '../../pbook_index/__html_head.php' ?>
<style>
    .input_width {
        width: 500px;
    }

    .small_fix {
        width: 200px;
        margin: 0 20px 0 20px;
        line-height: 24px;
    }
</style>
<?php include '../../pbook_index/__html_body.php' ?>
<?php include '../../pbook_index/__navbar.php' ?>
<div>

</div>
<section class="p-4 container-fluid">
    <div>
        <h4>新增會員資料</h4>
        <div class="title_line"></div>
    </div>
    <div id="hello">
        <pre>
    <?php
    if (!empty($_POST)) {
        print_r($_POST);
    }
    ?>
        </pre>
    </div>
    <div class="container">
        <div class="">
            <form name="form1" style="width:800px" onsubmit="return checkForm()">
                <div class="form-group">
                    <label for="number">會員編號 : <?= $new_number ?></label>
                    <input type="text" class="form-control" id="number" name="number" value="<?= $new_number ?>" style="display:none">
                </div>
                <label class="form-group">
                    <label for="personLevel">會員等級 : </label>
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="personLevel" value="<?= $i ?>" id="personLevel<?= $i ?>">
                        <label class="form-check-label" for="personLevel<?= $i ?>"><?= $a_level[$i] ?> </label>
                    </div>
                    <?php endfor ?>
                </label>

                <div class="form-group ">
                    <label for="name">會員姓名</label>
                    <div class="d-flex">
                        <input type="text" class="form-control input_width" id="name" name="name">
                        <p id="nameHelp" class="form-text text-muted small_fix">請輸入姓名</p>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="password">密碼</label>
                    <div class="d-flex">
                        <input type="password" class="form-control input_width" id="password" name="password">
                        <p id="passwordHelp" class="form-text text-muted small_fix">請輸入正確密碼格式</p>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="email">電子信箱</label>
                    <div class="d-flex">
                        <input type="email" class="form-control input_width" id="email" name="email">
                        <p id="emailHelp" class="form-text text-muted small_fix">請輸入電子信箱格式</p>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label for="gender">性別 : </label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input ml-2" type="radio" name="gender" value="1">
                        <label class="form-check-label" for="gender">男</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="2">
                        <label class="form-check-label" for="gender">女</label>
                    </div>
                </div> -->
                <div class="form-group ">
                    <label for="birthday">生日</label>
                    <div class="d-flex">
                        <input type="text" class="form-control input_width" id="birthday" name="birthday">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="mobile">手機</label>
                    <div class="d-flex">
                        <input type="text" class="form-control input_width" id="mobile" name="mobile">
                        <p id="mobileHelp" class="form-text text-muted small_fix">請輸入正確手機格式</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="career">職業</label>
                    <input type="text" class="form-control input_width" id="career" name="career">
                </div>
                <div class="form-group">
                    <label for="address">地址</label>
                    <input type="text" class="form-control input_width" id="address" name="address">
                </div>

                <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
            </form>
        </div>

</section>


<script>
   
    function checkForm() {
        let fd = new FormData(document.form1);
        let hello=document.querySelector('#hello');
        fetch('data_insert_API.php', {
                method: 'POST',
                body: fd,
            })
            .then(response => {
                return response.json();
            })
            .then(json => {
                console.log(json);
                hello.innerHTML= json.info;
            })

        return false; // 表單不用傳統的 post 方式送出
    }
</script>

<?php include '../../pbook_index/__html_foot.php' ?>