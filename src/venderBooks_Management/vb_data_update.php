<?php
require __DIR__ . '/__admin_required.php';
require __DIR__ . '/__connect_db.php';
$page_name = 'vb_data_update';
$page_title = '修改出版社書籍';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: vb_data_list.php');
    exit;
}

$update_sql = "SELECT * FROM `vb_books` WHERE `sid`=$sid";
$update_row = $pdo->query($update_sql)->fetch();
if (empty($update_row)) {
    header('Location: vb_data_list.php');
    exit;
}

$categories_sql = "SELECT `sid`,`name` FROM `vb_categories` WHERE 1";
$stmt = $pdo->query($categories_sql);
$row = $stmt->fetchAll(PDO::FETCH_UNIQUE);


$new_row = [];

foreach ($row as $r => $s) {
    foreach ($s as $k => $v) {
        $new_row[$r] = $v;
    }
}

?>

<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>

<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
</style>

<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/../../pbook_index/__navbar.php' ?>
<!-- 右邊section資料欄位 -->

<div class="container">
    <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
        <div>
            <h4>修改出版社書籍</h4>
            <div class="title_line"></div>
        </div>
        <ul class="nav justify-content-between">
            <li class="nav-item" style="margin: 0px 10px">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick="preceding_page()">
                    <i class="fas fa-arrow-circle-left"></i>
                    回到上一頁
                </button>
            </li>
        </ul>
    </nav>

    <!-- 每個人填資料的區塊 -->
    <div class="container2" style="margin:15px 0px 0px 0px">
        <form name="form1" method="post" enctype="multipart/form-data" onsubmit="return checkForm()">
            <input type="hidden" name="sid" value="<?= $update_row['sid'] ?>">
            <div class="d-flex">
                <div style="min-width:700px;margin:0px 30px">
                    <div class="form-group">
                        <label for="isbn" class="update_label">・ISBN</label>
                        <span style="margin:0px 20px" class="my_text_blacktea_fifty">阿拉伯數字10碼或13碼</span>
                        <span style="margin:0px -10px;color:red" id="isbnHelp"></span>
                        <input type="text" class="update form-control" id="isbn" name="isbn" value="<?= htmlentities($update_row['isbn']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="name" class="update_label">・書籍名稱</label>
                        <span style="margin:0px 20px;color:red" id="nameHelp"></span>
                        <input type="text" class="update form-control" id="name" name="name" value="<?= htmlentities($update_row['name']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="author" class="update_label">・作者</label>
                        <span style="margin:0px 20px;color:red" id="authorHelp"></span>
                        <input type="text" class="update form-control" id="author" name="author" value="<?= htmlentities($update_row['author']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="publishing" class="update_label">・出版社</label>
                        <span style="margin:0px 20px;color:red" id="publishingHelp"></span>
                        <input type="text" class="update form-control" id="publishing" name="publishing" value="<?= htmlentities($update_row['publishing']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="publish_date" class="update_label">・出版日期</label>
                        <span style="margin:0px 20px" class="my_text_blacktea_fifty">格式:2000-01-01</span>
                        <span style="margin:0px -10px;color:red" id="publish_dateHelp"></span>
                        <input type="text" class="update form-control" id="publish_date" name="publish_date" value="<?= htmlentities($update_row['publish_date']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="version" class="update_label">・版次</label>
                        <span style="margin:0px 20px;color:red" id="versionHelp"></span>
                        <input type="text" class="update form-control" id="version" name="version" value="<?= htmlentities($update_row['version']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="fixed_price" class="update_label">・定價</label>
                        <span style="margin:0px 20px" class="my_text_blacktea_fifty">請填寫阿拉伯數字</span>
                        <span style="margin:0px -10px;color:red" id="fixed_priceHelp"></span>
                        <input type="text" class="update form-control" id="fixed_price" name="fixed_price" value="<?= htmlentities($update_row['fixed_price']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="page" class="update_label">・頁數</label>
                        <span style="margin:0px 20px" class="my_text_blacktea_fifty">請填寫阿拉伯數字</span>
                        <span style="margin:0px -10px;color:red" id="pageHelp"></span>
                        <input type="text" class="update form-control" id="page" name="page" value="<?= htmlentities($update_row['page']) ?>">
                    </div>
                </div>

                <div style="min-width:700px;margin:0px 30px">

                    <div class="form-group">
                        <label for="stock" class="update_label">・庫存</label>
                        <span style="margin:0px 20px" class="my_text_blacktea_fifty">請填寫阿拉伯數字</span>
                        <span style="margin:0px -10px;color:red" id="stockHelp"></span>
                        <input type="text" class="update form-control" id="stock" name="stock" value="<?= htmlentities($update_row['stock']) ?>">
                    </div>

                    <div class="form-group d-flex">
                        <div class="col-lg-5">
                            <label for="pic" style="font-size: 20px">・請選擇書籍封面照片</label>
                            <input type="file" class="form-control-file" id="pic" name="pic" style="display:none">
                            <br>
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick="selUpload()">
                                <i class="fas fa-plus-circle" style="margin-right:5px"></i>選擇檔案
                            </button>
                        </div>
                        <div style="height: 230px;width: 230px;border: 1px solid #ddd">
                            <img style="object-fit: contain;width: 100%;height: 100%" src="./vb_images/<?= htmlentities($update_row['pic']) ?>" id="demo" />
                        </div>
                    </div>

                    <div class="form-group" style="margin:-30px 0px 0px 0px">
                        <label for="categories" class="update_label">・分類</label>
                        <div class="d-flex flex-wrap">
                            <?php foreach ($new_row as $k => $v) : ?>
                                <div class="form-check" style="margin:0px 20px 10px 0px">
                                    <input class="form-check-input" type="radio" name="categories" id="categories<?= $k ?>" value="<?= $k ?>" <?= ($update_row['categories'] == $k) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="categories<?= $k ?>"><?= $v ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="introduction" class="update_label">・書籍簡介</label>
                        <span style="margin:0px 20px" class="my_text_blacktea_fifty">限制200字以內</span>
                        <span style="margin:0px -10px;color:red" id="introductionHelp"></span>
                        <textarea class="update form-control" id="introduction" rows="3" style="width:700px;height:200px;resize:none" name="introduction" placeholder="<?= htmlentities($update_row['introduction']) ?>"></textarea>
                    </div>


                    <div>
                        <button style="margin:5px 0px 0px -80px" type="submit" class="btn btn-warning" id="submit_btn">
                            &nbsp;確&nbsp;認&nbsp;修&nbsp;改&nbsp;
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- 以下為修改成功才會跳出來的顯示框 -->
    <div style="padding:150px 100px 170px 180px;display:none" id="success">
        <div class="success update card">
            <div class="success card-body">
                <label class="success_text" style="background:transparent">修改成功</label>
                <div><img class="success_img" src="../../images/icon_checked.svg"></div>
            </div>
        </div>
    </div>

    <!-- 以下為修改失敗才會跳出來的顯示框 -->
    <div style="padding:150px 100px 170px 180px;display:none" id="my_false">
        <div class="success update card" style="box-shadow:0px 0px 10px red">
            <div class="success card-body">
                <label class="success_text" style="background:transparent;color:rgb(228, 63, 63)">修改失敗,不可以偷偷來喔!</label>
            </div>
        </div>
    </div>

</div>



</div>
<script>
    function selUpload() {
        document.querySelector('#pic').click();
    }

    function preceding_page() {
        location.href = document.referrer;
    }

    $('#pic').change(function() {
        var file = $('#pic')[0].files[0];
        var reader = new FileReader;
        reader.onload = function(e) {
            $('#demo').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });

    function checkForm() {
        // 判斷書籍名稱,作者,出版社,版次是否有填寫
        let name = document.querySelector('#name');
        let publishing = document.querySelector('#publishing');
        let author = document.querySelector('#author');
        let version = document.querySelector('#version');

        let isPass = true;
        if (name.value.length < 1) {
            name.style.border = '1px solid red';
            document.querySelector('#nameHelp').innerHTML = '請填寫書籍名稱';
            isPass = false;
        } else {
            name.style.border = '1px solid #CCCCCC';
            document.querySelector('#nameHelp').innerHTML = '';
            isPass = true;
        };

        if (publishing.value.length < 1) {
            publishing.style.border = '1px solid red';
            document.querySelector('#publishingHelp').innerHTML = '請填寫出版社名稱';
            isPass = false;
        } else {
            publishing.style.border = '1px solid #CCCCCC';
            document.querySelector('#publishingHelp').innerHTML = '';
            isPass = true;
        };

        if (author.value.length < 1) {
            author.style.border = '1px solid red';
            document.querySelector('#authorHelp').innerHTML = '請填寫作者名稱';
            isPass = false;
        } else {
            author.style.border = '1px solid #CCCCCC';
            document.querySelector('#authorHelp').innerHTML = '';
            isPass = true;
        };

        if (version.value.length < 1) {
            version.style.border = '1px solid red';
            document.querySelector('#versionHelp').innerHTML = '請填寫版次';
            isPass = false;
        } else {
            version.style.border = '1px solid #CCCCCC';
            document.querySelector('#versionHelp').innerHTML = '';
            isPass = true;
        };



        // 判斷isbn碼,出版日期,定價,頁數,庫存,書籍簡介格式是否正確                       
        let s, item;

        const required_fields = [{
                id: 'isbn',
                pattern: /(^\d{10}$)|(^\d{13}$)/,
                info: '請填寫正確的isbn碼'
            },
            {
                id: 'publish_date',
                pattern: /^\d{4}\-?\d{2}\-?\d{2}$/,
                info: '請填寫正確的出版日期格式'
            },
            {
                id: 'fixed_price',
                pattern: /^\d+$/,
                info: '請填寫正確的定價格式'
            },
            {
                id: 'page',
                pattern: /^\d+$/,
                info: '請填寫正確的頁數格式'
            },
            {
                id: 'stock',
                pattern: /^\d+$/,
                info: '請填寫正確的庫存格式'
            },
            {
                id: 'introduction',
                pattern: /\S{0,200}$/,
                info: '超過字數限制,請重新輸入'
            },
        ];

        // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        for (s in required_fields) {
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        };

        // 先讓所有欄位外觀回復到原本的狀態
        for (s in required_fields) {
            item = required_fields[s];
            item.el.style.border = '1px solid #CCCCCC';
            item.infoEl.innerHTML = '';
        };

        for (s in required_fields) {
            item = required_fields[s];
            if (!item.pattern.test(item.el.value)) {
                item.el.style.border = '1px solid red';
                item.infoEl.innerHTML = item.info;
                isPass = false;
            };
        };

        // 全部都正確送出表單到後台
        let container2 = document.querySelector('.container2');
        let success = document.querySelector('#success');
        let my_false = document.querySelector('#my_false');

        if (isPass) {
            let fd = new FormData(document.form1);
            fetch('vb_data_update_api.php', {
                    method: 'POST',
                    body: fd,
                })

                .then(response => {
                    return response.json();
                })
                // 收到後台回傳的修改判斷(是否成功,然後顯示到前台讓用戶知道)
                // 修改成功跳回出版社書籍的datalist,失敗就回到上一層
                .then(json => {
                    console.log(json);
                    if (json.success) {
                        success.style.display = 'block';
                        container2.style.display = 'none';
                        setTimeout(function() {
                            location.href = document.referrer;
                        }, 1000)
                    } else {
                        my_false.style.display = 'block';
                        container2.style.display = 'none';
                        setTimeout(function() {
                            location.href = document.referrer;
                        }, 1000)
                    }
                });
        }

        //不讓表單直接送出
        return false;
    }
</script>

<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>