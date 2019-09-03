<?php require __DIR__ . '/__admin_required.php' ?>
<?php require  'MR_db_connect.php' ?>
<?php
$page_title = '編輯資料';

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

$a_level = [
    '品書會員',
    '品書學徒',
    '品書專家',
    '品書大師',
    '品書至尊',
];

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if (empty($sid)) {
    header('Location: MR_memberDataList.php');
    exit;
}
$sql = "SELECT * FROM `mr_information` WHERE `sid`=$sid";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: MR_memberDataList.php');
    exit;
}

?><?php include '../../pbook_index/__html_head.php' ?>
<link rel="stylesheet" href="lib/memberlist.css">
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }

    .nike {
        position: absolute;
        top: 20%;
        left: 20%;
        display: none;
    }
</style>
<?php include '../../pbook_index/__html_body.php' ?>
<?php include '../../pbook_index/__navbar.php' ?>
<div>

</div>
<section class="p-4 container-fluid dis_relative">
    <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw; margin-left:25px;">
        <div class="d-flex">
            <div>
                <h4>修改會員資料</h4>
                <div class="title_line"></div>
            </div>
            <ul class="nav justify-content-between">
                <li class="nav-item" style="margin: 0px 10px">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick="history.back()">
                        <i class="fas fa-arrow-circle-left"></i>
                        回到上一頁
                    </button>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container" id="container1">
        <div class="row " style="margin-top:-5px ">
            <div class="col-md-6">
                <div class="alert alert-primary " role="alert" id="info-bar" style="padding:8px;"></div>
            </div>
        </div>
        <div class="">
            <form name="form1" style="width:1100px" onsubmit="return checkForm()" class="d-flex">
                <div>
                    <div class="form-group">
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                        <label for="number">會員編號 :<?= $row['MR_number'] ?></label>
                        <input type="text" class="form-control" id="number" name="number" value="<?= $row['MR_number'] ?>" style="display:none">
                    </div>
                    <label class="form-group">
                        <label for="personLevel">會員等級 : </label>
                        <?php for ($i = 0; $i < 5; $i++) : ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="personLevel" value="<?= $i ?>" id="personLevel<?= $i ?>" <?= ($i == $row['MR_personLevel']) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="personLevel<?= $i ?>"><?= $a_level[$i] ?> </label>
                            </div>
                        <?php endfor ?>
                    </label>
                    <div>
                        <div class="form-group  d-flex">
                            <div>
                                <label for="name">會員姓名</label>
                                <div class="">
                                    <input type="text" class="form-control right_input1" id="name" name="name" value="<?= $row['MR_name'] ?>">
                                    <small id="nameHelp" class="form-text  small_fix"></small>
                                </div>
                            </div>
                            <div class="right_input ">
                                <label for="nickname">暱稱</label>
                                <div class="">
                                    <input type="text" class="form-control right_input1 " id="nickname" name="nickname" value="<?= $row['MR_nickname'] ?>">
                                </div>
                            </div>
                            <div class="form-group gender_fix">
                                <label for="gender">性別 : </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input ml-2" type="radio" name="gender" value="1" <?= ($row['MR_gender'] == 1) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="gender">男</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="2" <?= ($row['MR_gender'] == 2) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="gender">女</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group ">
                            <label for="password">密碼</label>
                            <div class="dis_relative">
                                <input type="password" class="form-control input_width " id="password" name="password" value="<?= $row['MR_password'] ?>">
                                <i class="fas fa-eye-slash ps_hide" id="eye1" style="cursor: pointer"></i>
                            </div>
                        </div>
                        <div class="form-group right_input ">
                            <label for="password_confirm">確認密碼</label>
                            <div class="dis_relative">
                                <input type="password" class="form-control input_width " id="password_confirm" name="password_confirm" value="<?= $row['MR_password'] ?>">
                                <i class="fas fa-eye-slash ps_hide" id="eye2" style="cursor: pointer"></i>
                            </div>
                        </div>
                    </div>
                    <small id="" class="form-text text-muted pass_comment">
                        至少有一個數字、一個小寫英文字母、一個大寫英文字母、密碼長度在 6 ~ 15 之間</small>
                    <small id="passwordHelp" class="form-text small_fix"></small>
                    <div class="d-flex">
                        <div class="form-group ">
                            <label for="email">電子信箱</label>
                            <div class="d-flex">
                                <input type="email" class="form-control input_width" id="email" name="email" value="<?= $row['MR_email'] ?>">
                            </div>
                        </div>
                        <div class="form-group right_input">
                            <label for="mobile">手機</label>
                            <div class="d-flex">
                                <input type="text" class="form-control input_width" id="mobile" name="mobile" value="<?= $row['MR_mobile'] ?>">

                            </div>
                        </div>
                    </div>
                    <div class=" d-flex">
                        <small id="emailHelp" class="form-text  small_fix small_help"></small>
                        <small id="mobileHelp" class="form-text  small_fix small_help"></small>
                    </div>
                    <div class="form-group ">
                        <label for="birthday">生日</label>
                        <div class="d-flex">
                            <input type="date" class="form-control input_width" id="birthday" name="birthday" value="<?= $row['MR_birthday'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="career">職業</label>
                        <input type="text" class="form-control input_width" id="career" name="career" value="<?= $row['MR_career'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">地址</label>
                        <input type="text" class="form-control input_width2" id="address" name="address" value="<?= $row['MR_address'] ?>">
                    </div>

                    <div>
                        <button style="width:130px" type="submit" class="btn btn-warning" id="submit_btn">
                            &nbsp;確&nbsp;認&nbsp;修&nbsp;改&nbsp;
                        </button>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <label for="pic">會員頭像</label>
                        <div class="d-flex ">
                            <figure id="demo-fig">
                                <img src="./MR_uploads_img/<?= $row['MR_pic'] ?>" alt="" id="demo" style="transform: translate3d(
                                    <?= $row['MR_imageloactionX'] ?>px,
                                    <?= $row['MR_imageloactionY'] ?>px, 0)">
                            </figure>
                            <input type="file" class="form-control-file" id="pic" name="pic">
                            <input type="hidden" class="form-control-file" id="pic1" name="pic1" value="<?= $row['MR_pic'] ?>">
                            <input type="hidden" name="imageLocationX" id="imageLocationX" value="0">
                            <input type="hidden" name="imageLocationY" id="imageLocationY" value="0">
                        </div>
                    </div>
                </div>
            </form>
            <div>
                <pre>
             <?php
                if (!empty($_POST)) {
                    print_r($_POST);
                }
                ?>
            </pre>
            </div>
        </div>
        <div class="success update card nike" id="nike7">
            <div class="success card-body">
                <label class="success_text">新增成功</label>
                <div><img class="success_img" src="../../images/icon_checked.svg"></div>
            </div>
        </div>

</section>


<script>
    let item;
    let isPass = true;
    let info_bar = document.querySelector('#info-bar');
    let required_fields = [{
            id: 'name',
            pattern: /^\S{2,}/,
            info: '請輸入正確姓名',
        },
        {
            id: 'email',
            pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
            info: '請輸入正確email',
        },
        {
            id: 'mobile',
            pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
            info: '請輸入正確手機格式',
        },
        {
            id: 'password',
            id_confirm: 'password_confirm',
            pattern: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/,
            info: '請輸入正確密碼格式',
            info2: '請輸入相同確認密碼',
        }
    ];
    for (a in required_fields) {
        item = required_fields[a];
        item.input = document.querySelector('#' + item.id);
        item.inputText = document.querySelector('#' + item.id + 'Help');
    }
    let password_confirm = document.querySelector("#password_confirm");
    let password = document.querySelector('#password');
    let eye1 = document.querySelector('#eye1');
    let eye2 = document.querySelector('#eye2');

    const showPassword = (evt) => {
        if (evt.currentTarget.id == 'eye1') {
            password.type = (password.type == "password") ? "text" : "password";
        }
        if (evt.currentTarget.id == 'eye2') {
            password_confirm.type = (password_confirm.type == "password") ? "text" : "password";
        }
    }
    eye1.addEventListener('click', showPassword);
    eye2.addEventListener('click', showPassword);

    //頭像預覽
    $(pic).change(function() {
        var file = $('#pic')[0].files[0];
        var reader = new FileReader;
        reader.onload = function(e) {
            $('#demo').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });


    //頭像圖片移動
    var active = false;
    var currentX = 0,
        currentY = 0,
        initialX = 0,
        initialY = 0;
    xOffset = 0;
    yOffset = 0;
    let demo = document.querySelector('#demo');
    let demo_fig = document.querySelector('#demo-fig');
    let imageLocationX = document.querySelector('#imageLocationX');
    let imageLocationY = document.querySelector('#imageLocationY');
    demo_fig.addEventListener('mousedown', dragStart);
    demo_fig.addEventListener('mousemove', drag);
    container1.addEventListener('mouseup', dragEnd);

    function dragStart(event) {

        initialX = event.clientX - xOffset;
        initialY = event.clientY - yOffset;
        if (event.target === demo) {
            active = true;
        }
    }

    function drag(event) {
        if (active) {
            event.preventDefault();
            currentX = event.clientX - initialX;
            currentY = event.clientY - initialY;
            xOffset = currentX;
            yOffset = currentY;
            setTranslate(currentX, currentY, demo);
        }
    }

    function setTranslate(xPos, yPos, el) {
        el.style.transform = "translate3d(" + xPos + "px, " + yPos + "px, 0)";
        imageLocationX.value = xOffset;
        imageLocationY.value = yOffset;
    }

    function dragEnd(event) {
        initialX = currentX;
        initialY = currentY;
        active = false;
    }



    //表單傳輸
    function checkForm() {
        isPass = true;
        for (a in required_fields) {
            item = required_fields[a]
            item.input.style.border = "1px solid #ccc";
            item.inputText.innerHTML = '';
        }
        for (a in required_fields) {
            item = required_fields[a];
            if (!item.pattern.test(item.input.value)) {
                item.input.style.border = "1px solid red";
                item.inputText.innerHTML = item.info;
                isPass = false;
            }
        }
        if (password_confirm.value != password.value) {
            document.querySelector('#passwordHelp').innerHTML = '請輸入相同確認密碼';
            isPass = false;
        }

        if (isPass) {
            let fd = new FormData(document.form1);
            let nike7 = document.querySelector('#nike7');
            fetch('MR_memberData_updateAPI.php', {
                    method: 'POST',
                    body: fd,
                })
                .then(response => {
                    return response.json();
                })
                .then(json => {
                    console.log(json);
                    if (json.success) {
                        info_bar.style.display = 'none';
                        nike7.style.display = "block";
                        setTimeout(() => {
                            location.href = 'MR_memberDataList.php';
                        }, 1500);
                    } else {
                        info_bar.style.display = 'block';
                        info_bar.innerHTML = json.info;
                        info_bar.className = "alert alert-danger";
                    }
                })
        }
        return false; // 表單不用傳統的 post 方式送出
    }
</script>

<?php include '../../pbook_index/__html_foot.php' ?>