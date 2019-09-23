<?php
require __DIR__ . '/../../vendor/autoload.php';

use Tracy\Debugger;

Debugger::enable();

require __DIR__ . '/__admin_required.php';
require __DIR__ . '/__connect_db.php';

$page_name = 'MB_data_list';
$page_title = '新增資料';

$categories_data = [
    1 => '文學小說',
    2 => '商業理財',
    3 => '藝術設計',
    4 => '人文史地',
    5 => '社會科學',
    6 => '自然科普',
    7 => '心理勵志',
    8 => '醫療保健',
    9 => '飲食',
    10 => '生活風格',
    11 => '旅遊',
    12 => '宗教命理',
    13 => '親子教養',
    14 => '童書/青少年文學',
    15 => '輕小說',
    16 => '漫畫',
    17 => '語言學習',
    18 => '考試用書',
    19 => '電腦資訊',
    20 => '專業/教科書/政府出版品',
];

$sjdi;

$sel_id = empty($_POST['mb_categories']) ? 0 : intval($_POST['mb_categories']);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$per_page = 10;

$t_sql = "SELECT COUNT(1) FROM `mb_books`";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $per_page);

$mrNo_sql = "SELECT `MR_number` FROM `mr_information`";
$mrNo_s = $pdo->query($mrNo_sql);
$mr_no = $mrNo_s->fetchAll();


?>
<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }

    .big_container {
        position: relative;
    }

    .success_bar {
        position: absolute;
        top: 250px;
        left: 500px;
    }

    .pre_img {
        position: flex;
        justify-content: left;
        object-fit: contain;
        width: 100%;
        height: 100%;
        padding-left: 5px; 
        
    }

    .pre_pic {
        display: flex;
        height: 230px;
        width: 200px;
        /* border: 1px solid #ddd; */
    }
</style>
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/../../pbook_index/__navbar.php' ?>
<!-- 右邊section資料欄位 -->

<section>
    <div class="container big_container">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h4>新增會員書籍</h4>
                <div class="title_line"></div>
            </div>
        </nav>

        <div class="container" style="margin:15px 0px 0px 0px">

            <form name="form1" onsubmit="return checkForm();" enctype="multipart/form-data" style="margin-top: 10px;">

                <section name="" id="" class="d-flex">
                    <section style="min-width:700px;margin:0px 30px">
                        <div class="form-group">
                            <label for="mb_isbn">ISBN</label>
                            <span id="mb_isbnHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_isbn" name="mb_isbn">
                        </div>
                        <div class="form-group">
                            <label for="mb_name">書名</label>
                            <span id="mb_nameHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_name" name="mb_name">
                        </div>
                        <div class="form-group">
                            <label for="mb_author">作者</label>
                            <span id="mb_authorHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_author" name="mb_author">
                        </div>
                        <div class="form-group">
                            <label for="mb_publishing">出版社</label>
                            <span id="mb_publishingHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_publishing" name="mb_publishing">
                        </div>
                        <div class="form-group">
                            <label for="mb_publishDate">出版日期</label>
                            <span id="mb_publishDateHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_publishDate" name="mb_publishDate">
                        </div>
                        <div class="form-group">
                            <label for="mb_version">版本</label>
                            <span id="mb_mb_versionHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_version" name="mb_version">
                        </div>
                        <div class="form-group">
                            <label for="mb_fixedPrice">定價</label>
                            <span id="mb_fixedPriceHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_fixedPrice" name="mb_fixedPrice">
                        </div>
                        <div class="form-group">
                            <label for="mb_page">頁數</label>
                            <span id="mb_pageHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_page" name="mb_page">
                        </div>
                    </section>
                    <section style="min-width:700px;margin:0px 30px">
                        <div class="form-group">
                            <label for="mb_savingStatus">書況</label>
                            <span id="mb_savingStatusHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_savingStatus" name="mb_savingStatus">
                        </div>
                        <div class="form-group">
                            <label for="mb_shelveMember">上架會員</label>
                            <span id="mb_shelveMemberHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_shelveMember" name="mb_shelveMember">
                        </div>

                        <div class="form-group d-flex">
                            <div id="chose_pic" class="col-lg-4">
                                <label for="mb_pic" style="font-size: 20px">・請選擇書籍照片</label>
                                <input type="file" class="form-control-file" id="mb_pic" name="mb_pic[]" style="display:none" multiple>
                                <br>
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick="uploadFile()">
                                    <i class="fas fa-plus-circle" style="margin-right:5px"></i>選擇檔案
                                </button>
                                <div style="height:50px; margin-top:10px">
                                    <span style="margin:0px 20px" class="my_text_blacktea_fifty">最多上傳三張圖片</span>
                                </div>
                            </div>
                            <div class="pre_pic col-lg-3">
                                <!-- <img style="object-fit: contain;width: 100%;height: 100%" id="demo" /> -->
                            </div>

                        </div>
                        <div class="form-group" style="margin: -50px -20px 10px 0px; padding: 20px 50px 20px 30px;">
                            <label for="mb_categories" class="update_label">分類</label>
                            <span id="mb_categoriesHelp" style="margin:0px 10px;color:red"></span>
                            <div class="d-flex flex-wrap" style="padding-left: 20px;">
                                <?php
                                $i = 0;
                                foreach ($categories_data as $k => $v) :
                                    ?>
                                    <div style="width:150px">
                                        <input class="form-check-input" type="radio" name="mb_categories" id="mb_categories" value="<?= $k ?>" <?= $k == 1 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="mb_categories"><?= $v ?></label>

                                    </div>
                                <?php
                                    $i++;
                                endforeach ?>
                            </div>
                        </div>
                        <div class="from-group" style="margin: -70px -20px 10px 0px; padding: 20px 50px 20px 30px;">
                            <label for="mb_remarks" class="update_label">備註</label>
                            <span style="margin:0px 20px" class="my_text_blacktea_fifty"></span>
                            <span style="margin:0px -10px;color:red" id="introductionHelp"></span>
                            <textarea class="update form-control" name="mb_remarks" id="mb_remarks" rows="5" style="width:650px;height:90px;resize:none"></textarea>
                        </div>
                    </section>
                </section>
                <div class="d-flex justify-content-end" style="text-align: center;">
                    <button type="submit" class="btn btn-warning " id="submit_btn" style="width: 200px;">&nbsp;新&nbsp;增&nbsp;</button>
                </div>
            </form>
        </div>
    </div>
    <div class="success update card success_bar" id="success_bar" style="background:#fff; display: none">
        <div class="success card-body">
            <label class="success_text" id="info-bar"></label>
            <div><img class="success_img" src="../../images/icon_checked.svg"></div>
        </div>
    </div>
</section>
<!-- 以下為修改或新增成功才會跳出來的顯示框 -->

</div>

<script>
    let info_bar = document.querySelector('#info-bar');

    function uploadFile() {
        document.querySelector('#mb_pic').click();

    }
    $('#mb_pic').change(function() {
        $('.pre_pic').find(".pre_img").remove();
        let input_file = document.getElementById('mb_pic')
        let files_len = input_file.files.length
        // console.log(files_len);
        if (files_len <= 3) {
            for (let i = 0; i < files_len; i++) {
                var file = input_file.files[i];
                console.log(file);
                var reader = new FileReader;
                reader.readAsDataURL(file);
                reader.onload = function(e) {
                    // $('#demo').attr('src', e.target.result);
                    let img = $("<img>").addClass("pre_img").attr('src', e.target.result)
                    $('.pre_pic').append(img)
                }
            }
        } else {
            alert('最多只能三張')
        }

    })
    

    function isbn_test() {
        let mb_isbn = document.querySelector('#mb_isbn').value;
        let test = 0;
        let isPass = false;
        mb_isbn = mb_isbn.trim();

        if (mb_isbn.length == 10) {
            for (let i = 0; i < 9; i++) {
                test += isbn[i] * (10 - i);
            }
            test = 11 - test % 11;
            test = test == 10 ? 'X' : test;
            isPass = mb_isbn[9] == test ? true : false;
        } else if (mb_isbn.length == 13) {
            for (let i = 0; i < 12; i++) {
                let weighting = (i % 2) ? 3 : 1;
                test += mb_isbn[i] * weighting;
            }

            test = 10 - test % 10;
            isPass = mb_isbn[12] == test ? true : false;
        } else if (mb_isbn.length == 8) {
            for (let i = 0; i < 7; i++) {
                test += mb_isbn[i] * (8 - i);
            }
            test = 11 - test % 11;
            test = test == 10 ? 'X' : test;
            isPass = mb_isbn[7] == test ? true : false;
        } else {
            console.log('格式錯誤');
        }


        var isbn_border = document.querySelector('#mb_isbn');
        if (!isPass) {
            setTimeout(function() {
                isbn_border.style.border = '1px solid red';
                document.querySelector('#mb_isbnHelp').innerHTML = '請填寫正確ISBN碼格式';
            }, 500)

        } else {
            isbn_border.style.border = '1px solid #CCCCCC';
            document.querySelector('#mb_isbnHelp').innerHTML = '';
        }
        // console.log("驗證ISBN="+isPass);
        return isPass;
    }




    function checkForm() {
        let info_bar = document.querySelector('#info-bar');
        let success_bar = document.querySelector('#success_bar')
        const submit_btn = document.querySelector('#submit_btn');
        // let mb_shelveMember = document.querySelector('#mb_shelveMember')
        let i, s, item;

        let isPass = true;

        const require_fields = [{
                id: 'mb_isbn',
                pattern: /(^\d{10}$)|(^\d{13}$)/,
                info: '請填寫正確ISBN碼格式',
            },
            {
                id: 'mb_name',
                pattern: /^\S{1,}/,
                info: '請輸入正確的書名',
            },
            {
                id: 'mb_author',
                pattern: /^\S{1,}/,
                info: '請輸入正確的作者',
            },
            {
                id: 'mb_publishing',
                pattern: /^\S{2,}/,
                info: '請輸入正確的出版社',
            },
            {
                id: 'mb_publishDate',
                pattern: /\d{4}\-?\d{2}\-?\d{2}/,
                info: '請輸入正確的出版日期',
            },
            {
                id: 'mb_fixedPrice',
                pattern: /\d{2,}/,
                info: '請輸入正確的定價',
            },
            {
                id: 'mb_page',
                pattern: /\d{2,}/,
                info: '請輸入正確的頁數',
            },
            {
                id: 'mb_savingStatus',
                pattern: /\S{1,}/,
                info: '請輸入正確的書況',
            },
            {
                id: 'mb_categories',
                pattern: /\d{1,}/,
                info: '請選擇類別',
            },

        ];

        for (s in require_fields) {
            item = require_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }

        for (s in require_fields) {
            item = require_fields[s];
            item.el.style.border = '1px solid #CCCCCC';
            item.infoEl.innerHTML = '';
        }
        // info_bar.style.display = 'none';
        // info_bar.innerHTML = '';


        for (s in require_fields) {
            item = require_fields[s];

            if (!item.pattern.test(item.el.value)) {
                item.el.style.border = '1px solid red';
                item.infoEl.innerHTML = item.info;
                isPass = false;
            }
        }

        itemEl = document.querySelector('#mb_shelveMember');
        itemInfoEl = document.querySelector('#mb_shelveMemberHelp');


        let memberNo = false;
        let fd = new FormData(document.form1);

        //判斷ISBN碼正確性
        isPass = isbn_test();

        //判斷會員編號的API
        fetch('MB_searchMember_api.php', {
                method: 'POST',
                body: fd,
            })
            .then(response => {
                return response.json();
            })
            .then(json => {
                if (json.success) {
                    itemEl.style.border = '1px solid #CCCCCC';
                    itemInfoEl.innerHTML = '';
                    memberNo = [true, isPass];
                    console.log("memberNo1=" + memberNo);
                    //判斷各個選項的API，因為有執行順序問題所以用函式包起來
                    memberNoCheck(memberNo, isPass);
                    // return memberNoAndisPass;
                } else {

                    itemEl.style.border = '1px solid red';
                    itemInfoEl.innerHTML = json.info;
                    memberNo = false;
                    console.log("memberNo2=" + memberNo);
                }
            })
        // .then( memberNoAndisPass =>{
        //     if(memberNoAndisPass[0]==true && memberNoAndisPass[]==true){
        //         console.log(377);
        //     }
        // })






        function memberNoCheck(memberNo, isPass) {
            console.log("isPass=" + isPass);
            console.log("memberNo3=" + memberNo);
            if (memberNo && isPass) {
                fetch('MB_insert_api.php', {
                        method: 'POST',
                        body: fd,
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        success_bar.style.display = 'block';
                        info_bar.innerHTML = json.info;
                        if (json.success) {
                            setTimeout(function() {
                                location.href = 'MB_data_list.php?page=<?= $totalPages ?>';
                            }, 1000);
                        } else {
                            success_bar.style.display = 'none'
                        }
                    });
            }
        }

        return false;
    };
</script>

</div>

<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>