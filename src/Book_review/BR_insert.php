<?php include __DIR__ . '/BR__connect_db.php' ?>
<style>
    body {
        background: url(../images/bg.png) repeat center top;
    }
</style>
<?php include __DIR__ . '/BR__html_head.php' ?>
<nav class="navbar justify-content-between my_bg_seasongreen">
    <a class="navbar-brand" href="#">
        <img class="book_logo" src="../../images/icon_logo.svg" alt="">
    </a>
    <ul class="nav justify-content-between">
        <li class="nav-item">
            <a class="nav-link my_text_blacktea nav_text">管理者「大師」,您好</a>
        </li>
        <li class="nav-item dropdown">
            <a style="display: inline" class="nav-link dropdown-toggle my_text_yellow" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="my_login_img"><img class="yoko_logo" src="../../images/yoko.jpg" alt=""></div>
            </a>
            <div class="dropdown-menu" style="left: -100%;top: 90%;">
                <a class="dropdown-item" href="#">修改密碼</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">登出</a>
            </div>
        </li>
    </ul>
</nav>

<div class="d-flex flex-row my_content">
    <!-- 左邊aside選單欄位 -->
    <?php include __DIR__ . '/BR__navbar.php' ?>
    <!-- 右邊section資料欄位 -->
    <section style="width: calc(100vw - 280px);">
        
<div class="container">
    <form action="BR_insert_api.php" method="post" >
        <div class="form-group">
            <label for="BR_name">書評人姓名</label>
            <input type="text" class="form-control" id="BR_name" name="BR_name" placeholder="請輸入姓名">
            <small id="BR_nameHelp" class="form-text"></small>
        </div>
        <div class="form-group">
            <label for="BR_phone">書評人電話</label>
            <input type="text" class="form-control" id="BR_phone" name="BR_phone" placeholder="請輸入電話">
            <small id="BR_phoneHelp" class="form-text"></small>
        </div>
        <div class="form-group">
            <label for="BR_email">書評人信箱</label>
            <input type="text" class="form-control" id="BR_email" name="BR_email" placeholder="請輸入信箱">
            <small id="BR_emailHelp" class="form-text"></small>
        </div>
        <div class="form-group">
            <label for="BR_address">書評人地址</label>
            <input type="text" class="form-control" id="BR_address" name="BR_address" placeholder="請輸入地址">
            <small id="BR_addressHelp" class="form-text"></small>
        </div>
        <!-- <div class="form-group">
            <label for="BR_gender">書評人性別</label>
            <input type="text" class="form-control" id="BR_name" name="BR_name" placeholder="請輸入姓名">
            <small id="emailHelp" class="form-text"></small>
        </div> -->
        <label >書評人性別</label> <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="BR_gender" id="BR_gender" value="male">
            <label class="form-check-label" for="BR_gender">男</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="BR_gender" id="BR_gender" value="female">
            <label class="form-check-label" for="BR_gender">女</label>
        </div>
        <div class="form-group">
            <label for="BR_birthday">書評人生日</label>
            <input type="text" class="form-control" id="BR_birthday" name="BR_birthday" placeholder="請輸入生日" value="1999-07-20">
            <small id="BR_birthdayHelp" class="form-text"></small>
        </div>
        <div class="form-group">
            <label for="BR_job">書評人工作</label>
            <input type="text" class="form-control" id="BR_job" name="BR_job" placeholder="請輸入目前工作">
            <small id="BR_jobHelp" class="form-text"></small>
        </div>
        <button type="submit" class="btn btn-primary">新增</button>
    </form>

</div>
    </section>

    <script>
        function check_form(){
            let fd = new FormData(document.BR_form) ;
            fetch('BR_insert_api.php',{
                method:'POST',
                body:fd,
            })
            .then(response=>{
                return response.text();
            })
            .then(txt=>{
                alert(txt);
            });

            return false;
        }
    </script>

</div>
<?php include __DIR__ . '/BR__html_foot.php' ?>