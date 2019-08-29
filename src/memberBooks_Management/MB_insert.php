<?php
require __DIR__ . '/__connect_db.php';
$page_name = 'MB_data_list';
$page_title = '新增資料';

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

        <div class="container">

            <form name="form1" onsubmit="return checkForm();" style="margin-top: 10px;">

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
                            <label for="mb_version" class="update_label">版本</label>
                            <span id="mb_mb_versionHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_version" name="mb_version">
                        </div>
                        <div class="form-group">
                            <label for="mb_fixedPrice">定價</label>
                            <span id="mb_fixedPriceHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_fixedPrice" name="mb_fixedPrice">
                        </div>

                    </section>
                    <section style="min-width:700px;margin:0px 30px">

                        <div class="form-group">
                            <label for="mb_page">頁數</label>
                            <span id="mb_pageHelp" style="margin:0px 10px;color:red"></span>
                            <input type="text" class="form-control" id="mb_page" name="mb_page">
                        </div>
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

                        <div class="form-group">
                            <label for="mb_pic">Example file input</label>
                            <input type="file" class="form-control-file" id="mb_pic" name="mb_pic">
                        </div>
                        <div class="form-group">
                            <label for="mb_categories" class="update_label">分類</label>
                            <div class="form-check d-flex" style="background:#ddd;margin:0px 0px 20px 0px">
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                            </div>
                            <div class="form-check d-flex" style="background:#ddd;margin:0px 0px 20px 0px">
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                            </div>
                            <div class="form-check d-flex" style="background:#ddd;margin:0px 0px 20px 0px">
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px;background:#ddaaad">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                                <div style="width:100px">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">文學小說</label>
                                </div>
                            </div>
                        </div>
                        <div class="from-group">
                            <label for="mb_remarks" class="update_label">備註</label>
                            <textarea class="update form-control" name="mb_remarks" id="mb_remarks" cols="30" rows="10" style="width:700px;height:50px;resize:none"></textarea>
                        </div>
                    </section>
                </section>
                <div class="" style="text-align: center">
                    <button type="submit" class="btn btn-warning " id="submit_btn">&nbsp;新&nbsp;增&nbsp;</button>
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
    let success_bar = document.querySelector('#success_bar')
    const submit_btn = document.querySelector('#submit_btn');
    let i, s, item;

    const require_fields = [{
            id: 'mb_isbn',
            pattern: /\d{6,13}/,
            info: '請輸入正確的ISBN',
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
            id: 'mb_shelveMember',
            pattern: /^\w\d{2,}/,
            info: '請輸入正確的會員編號',
        },

    ];

    for (s in require_fields) {
        item = require_fields[s];
        item.el = document.querySelector('#' + item.id);
        item.infoEl = document.querySelector('#' + item.id + 'Help');
    }



    function checkForm() {

        for (s in require_fields) {
            item = require_fields[s];
            item.el.style.border = '1px solid #CCCCCC';
            item.infoEl.innerHTML = '';
        }
        // info_bar.style.display = 'none';
        // info_bar.innerHTML = '';

        //TODO: 檢查必要欄位，欄位值的格式
        let isPass = true;
        //方法二
        for (s in require_fields) {
            item = require_fields[s];

            if (!item.pattern.test(item.el.value)) {
                item.el.style.border = '1px solid red';
                item.infoEl.innerHTML = item.info;
                isPass = false;
            }
        }

        let fd = new FormData(document.form1);

        if (isPass) {
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
                            location.href = 'MB_data_list.php';
                        }, 1000);
                    } else {
                        success_bar.style.display = 'none'
                    }
                });
        } else {

        }
        return false;
    };
</script>

</div>

<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>