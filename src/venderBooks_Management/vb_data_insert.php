<?php
// require __DIR__ . '/__admin_required.php';
require __DIR__ . '/__connect_db.php';
$page_name = 'vb_data_insert';
$page_title = '新增出版社書籍';

$categories_sql = "SELECT `sid`,`name` FROM `vb_categories` WHERE 1";
$stmt = $pdo->query($categories_sql);
$row = $stmt->fetchAll(PDO::FETCH_UNIQUE);

$new_row = [];

foreach ($row as $r => $s) {
    foreach ($s as $k => $v) {
        $new_row[$r] = $v;
    }
}

$my_categories = empty($_POST['categories']) ? 0 : intval($_POST['categories']);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶選取的頁數
$per_page = 10; //每頁幾筆資料

$t_sql = "SELECT COUNT(1) FROM `vb_books` ";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
$totalPages = ceil($totalRows / $per_page); //取得總頁數


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
            <h4>新增出版社書籍</h4>
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
            <div class="d-flex">
                <div style="min-width:700px;margin:0px 30px">
                    <div class="form-group">
                        <label for="isbn" class="update_label">・ISBN</label>
                        <span style="margin:0px 20px" class="my_text_blacktea_fifty">阿拉伯數字10碼或13碼</span>
                        <span style="margin:0px -10px;color:red" id="isbnHelp"></span>
                        <input type="text" class="update form-control" id="isbn" name="isbn" onchange="isbn_test()">
                    </div>

                    <div class="form-group">
                        <label for="name" class="update_label">・書籍名稱</label>
                        <span style="margin:0px 20px;color:red" id="nameHelp"></span>
                        <input type="text" class="update form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="author" class="update_label">・作者</label>
                        <span style="margin:0px 20px;color:red" id="authorHelp"></span>
                        <input type="text" class="update form-control" id="author" name="author">
                    </div>

                    <div class="form-group">
                        <label for="publishing" class="update_label">・出版社</label>
                        <span style="margin:0px 20px;color:red" id="publishingHelp"></span>
                        <input type="text" class="update form-control" id="publishing" name="publishing">
                    </div>

                    <div class="form-group">
                        <label for="publish_date" class="update_label">・出版日期</label>
                        <span style="margin:0px 20px" class="my_text_blacktea_fifty">格式:2000-01-01</span>
                        <span style="margin:0px -10px;color:red" id="publish_dateHelp"></span>
                        <input type="text" class="update form-control" id="publish_date" name="publish_date">
                    </div>

                    <div class="form-group">
                        <label for="version" class="update_label">・版次</label>
                        <span style="margin:0px 20px;color:red" id="versionHelp"></span>
                        <input type="text" class="update form-control" id="version" name="version">
                    </div>

                    <div class="form-group">
                        <label for="fixed_price" class="update_label">・定價</label>
                        <span style="margin:0px 20px" class="my_text_blacktea_fifty">請填寫阿拉伯數字</span>
                        <span style="margin:0px -10px;color:red" id="fixed_priceHelp"></span>
                        <input type="text" class="update form-control" id="fixed_price" name="fixed_price">
                    </div>
                    <div class="form-group">
                        <label for="page" class="update_label">・頁數</label>
                        <span style="margin:0px 20px" class="my_text_blacktea_fifty">請填寫阿拉伯數字</span>
                        <span style="margin:0px -10px;color:red" id="pageHelp"></span>
                        <input type="text" class="update form-control" id="page" name="page">
                    </div>
                </div>

                <div style="min-width:700px;margin:0px 30px">

                    <div class="form-group">
                        <label for="stock" class="update_label">・庫存</label>
                        <span style="margin:0px 20px" class="my_text_blacktea_fifty">請填寫阿拉伯數字</span>
                        <span style="margin:0px -10px;color:red" id="stockHelp"></span>
                        <input type="text" class="update form-control" id="stock" name="stock">
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
                            <img style="object-fit: contain;width: 100%;height: 100%" id="demo" />
                        </div>
                    </div>

                    <div class="form-group" style="margin:-30px 0px 0px 0px">
                        <label for="categories" class="update_label">・分類</label>
                        <div class="d-flex flex-wrap">
                            <?php foreach ($new_row as $k => $v) : ?>
                                <div class="form-check" style="margin:0px 20px 10px 0px">
                                    <input class="form-check-input" type="radio" name="categories" id="categories<?= $k ?>" value="<?= $k ?>" <?= $my_categories == 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="categories<?= $k ?>"><?= $v ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="introduction" class="update_label">・書籍簡介</label>
                        <span style="margin:0px 20px" class="my_text_blacktea_fifty">限制200字以內</span>
                        <span style="margin:0px -10px;color:red" id="introductionHelp"></span>
                        <textarea class="update form-control" id="introduction" rows="3" style="width:700px;height:200px;resize:none" name="introduction"></textarea>
                    </div>

                    <div>
                        <button style="margin:5px 0px 0px -80px" type="submit" class="btn btn-warning" id="submit_btn">
                            &nbsp;確&nbsp;認&nbsp;新&nbsp;增&nbsp;
                        </button>
                    </div>
                </div>
        </form>
    </div>
</div>

<!-- 以下為新增成功才會跳出來的顯示框 -->
<div class="success update card" id="success" style="display:none">
    <div class="success card-body">
        <label class="success_text" style="background:transparent">新增成功</label>
        <div><img class="success_img" src="../../images/icon_checked.svg"></div>
    </div>
</div>

<!-- 以下為新增失敗才會跳出來的顯示框 -->
<div class="success update card" id="my_false" style="box-shadow:0px 0px 10px red;display:none">
    <div class="success card-body">
        <label class="success_text" style="background:transparent;color:rgb(228, 63, 63)">新增失敗,不可以偷偷來喔!</label>
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


    function isbn_test() {
        let isbn = document.querySelector('#isbn').value;
        let test = 0;
        let isPass = false;
        isbn = isbn.trim();

        if (isbn.length == 10) {
            for (let i = 0; i < 9; i++) {
                test += isbn[i] * (10 - i);
            }
            test = 11 - test % 11;
            test = test == 10 ? 'X' : test;
            isPass = isbn[9] == test ? true : false;
        } else if (isbn.length == 13) {
            for (let i = 0; i < 12; i++) {
                let weighting = (i % 2) ? 3 : 1;
                test += isbn[i] * weighting;
            }

            test = 10 - test % 10;
            isPass = isbn[12] == test ? true : false;
        } else if (isbn.length == 8) {
            for (let i = 0; i < 7; i++) {
                test += isbn[i] * (8 - i);
            }
            test = 11 - test % 11;
            test = test == 10 ? 'X' : test;
            isPass = isbn[7] == test ? true : false;
        } else {
            console.log('格式錯誤');
        }
        console.log(isPass);

        var isbn_border = document.querySelector('#isbn');
        if (!isPass) {
            setTimeout(function() {
                isbn_border.style.border = '1px solid red';
                document.querySelector('#isbnHelp').innerHTML = '請填寫正確isbn碼格式';
            }, 500)
        } else {
            isbn_border.style.border = '1px solid #CCCCCC';
            document.querySelector('#isbnHelp').innerHTML = '';
        }
        return isPass;
    }

    function checkForm() {
        // 判斷書籍名稱,作者,出版社,版次是否有填寫
        let name = document.querySelector('#name');
        let publishing = document.querySelector('#publishing');
        let author = document.querySelector('#author');
        let version = document.querySelector('#version');

        let isPass = true;
        isPass = isbn_test();

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
            fetch('vb_data_insert_api.php', {
                    method: 'POST',
                    body: fd,
                })

                .then(response => {
                    return response.json();
                })
                // 收到後台回傳的新增判斷(是否成功,然後顯示到前台讓用戶知道)
                // 新增成功跳回出版社書籍的datalist,失敗就回到上一層
                .then(json => {
                    console.log(json);
                    if (json.success) {
                        success.style.display = 'block';
                        container2.style.display = 'none';
                        setTimeout(function() {
                            location.href = 'vb_data_list.php?page=' + <?= $totalPages ?>;
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