<?php
require __DIR__. '/__connect_db.php';
$page_name = 'vb_data_insert';
$page_title = '新增出版社書籍';

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
        </nav>

        <!-- 每個人填資料的區塊 -->
        <div class="container2" style="margin:20px 0px 0px 0px">
            <form name="form1" onsubmit="return checkForm()">
                <div class="d-flex">
                    <div style="min-width:700px;margin:0px 30px">
                        <div class="form-group">
                            <label for="isbn" class="update_label">ISBN</label>
                            <span style="margin:0px 20px" class="my_text_blacktea_fifty">阿拉伯數字10碼或13碼</span>
                            <span style="margin:0px -10px;color:red" id="isbnHelp"></span>
                            <input type="text" class="update form-control" id="isbn" name="isbn">
                        </div>

                        <div class="form-group">
                            <label for="name" class="update_label">書籍名稱</label>
                            <span style="margin:0px 20px;color:red" id="nameHelp"></span>
                            <input type="text" class="update form-control" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label for="author" class="update_label">作者</label>
                            <span style="margin:0px 20px;color:red" id="authorHelp"></span>
                            <input type="text" class="update form-control" id="author" name="author">
                        </div>

                        <div class="form-group">
                            <label for="publishing" class="update_label">出版社</label>
                            <span style="margin:0px 20px;color:red" id="publishingHelp"></span>
                            <input type="text" class="update form-control" id="publishing" name="publishing">
                        </div>

                        <div class="form-group">
                            <label for="publish_date" class="update_label">出版日期</label>
                            <span style="margin:0px 20px" class="my_text_blacktea_fifty">格式:2000-01-01</span>
                            <span style="margin:0px -10px;color:red" id="publish_dateHelp"></span>
                            <input type="text" class="update form-control" id="publish_date" name="publish_date">
                        </div>

                        <div class="form-group">
                            <label for="version" class="update_label">版次</label>
                            <span style="margin:0px 20px;color:red" id="versionHelp"></span>
                            <input type="text" class="update form-control" id="version" name="version">
                        </div>

                        <div class="form-group">
                            <label for="fixed_price" class="update_label">定價</label>
                            <span style="margin:0px 20px" class="my_text_blacktea_fifty">請填寫阿拉伯數字</span>
                            <span style="margin:0px -10px;color:red" id="fixed_priceHelp"></span>
                            <input type="text" class="update form-control" id="fixed_price" name="fixed_price">
                        </div>
                    </div>

                    <div style="min-width:700px;margin:0px 30px">
                        <div class="form-group">
                            <label for="page" class="update_label">頁數</label>
                            <span style="margin:0px 20px" class="my_text_blacktea_fifty">請填寫阿拉伯數字</span>
                            <span style="margin:0px -10px;color:red" id="pageHelp"></span>
                            <input type="text" class="update form-control" id="page" name="page">
                        </div>

                        <div class="form-group">
                            <label for="stock" class="update_label">庫存</label>
                            <span style="margin:0px 20px" class="my_text_blacktea_fifty">請填寫阿拉伯數字</span>
                            <span style="margin:0px -10px;color:red" id="stockHelp"></span>
                            <input type="text" class="update form-control" id="stock" name="stock">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">請選擇書籍封面照片</label>
                            <input type="file" class="form-control-file" id="pic">
                        </div>

                        <div class="form-group">
                            <label for="categories" class="update_label">分類</label>
                            <div class="d-flex flex-column">
                                <div class="d-flex" style="margin:0px 0px 10px 0px">
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            文學小說
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">
                                            商業理財
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                        <label class="form-check-label" for="exampleRadios3">
                                            藝術設計
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="option4">
                                        <label class="form-check-label" for="exampleRadios4">
                                            人文史地
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5" value="option5">
                                        <label class="form-check-label" for="exampleRadios5">
                                            社會科學
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6" value="option6">
                                        <label class="form-check-label" for="exampleRadios6">
                                            自然科普
                                        </label>
                                    </div>
                                </div>
                                <div class="d-flex" style="margin:0px 0px 10px 0px">
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios7" value="option7">
                                        <label class="form-check-label" for="exampleRadios7">
                                            心理勵志
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios8" value="option8">
                                        <label class="form-check-label" for="exampleRadios8">
                                            醫療保健
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios9" value="option9">
                                        <label class="form-check-label" for="exampleRadios9">
                                            飲食
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios10" value="option10">
                                        <label class="form-check-label" for="exampleRadios10">
                                            生活風格
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios11" value="option11">
                                        <label class="form-check-label" for="exampleRadios11">
                                            旅遊
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios12" value="option12">
                                        <label class="form-check-label" for="exampleRadios12">
                                            宗教命理
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios13" value="option13">
                                        <label class="form-check-label" for="exampleRadios13">
                                            親子教養
                                        </label>
                                    </div>
                                </div>
                                <div class="d-flex" style="margin:0px 0px 10px 0px">
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios14" value="option14">
                                        <label class="form-check-label" for="exampleRadios14">
                                            童書/青少年文學
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios15" value="option15">
                                        <label class="form-check-label" for="exampleRadios15">
                                            輕小說
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios16" value="option16">
                                        <label class="form-check-label" for="exampleRadios16">
                                            漫畫
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios17" value="option17">
                                        <label class="form-check-label" for="exampleRadios17">
                                            語言學習
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios18" value="option18">
                                        <label class="form-check-label" for="exampleRadios18">
                                            考試用書
                                        </label>
                                    </div>
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios19" value="option19">
                                        <label class="form-check-label" for="exampleRadios19">
                                            電腦資訊
                                        </label>
                                    </div>
                                </div>
                                <div class="d-flex" style="margin:0px 0px 10px 0px">
                                    <div class="form-check" style="margin:0px 20px 0px 0px">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios20" value="option20">
                                        <label class="form-check-label" for="exampleRadios20">
                                            專業/教科書/政府出版品
                                        </label>
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="form-group">
                            <label for="introduction" class="update_label">書籍簡介</label>
                            <span style="margin:0px 20px" class="my_text_blacktea_fifty">限制200字以內</span>
                            <span style="margin:0px -10px;color:red" id="introductionHelp"></span>
                            <textarea class="update form-control" id="introduction" rows="3"
                            style="width:700px;height:145px;resize:none"></textarea>
                        </div>

                        <div>
                            <button style="margin:30px 0px 0px -80px" type="submit" class="btn btn-warning" id="submit_btn">
                            &nbsp;確&nbsp;認&nbsp;新&nbsp;增&nbsp;
                            </button>
                        </div>
                    </div>
            </form>                      
        </div>

        <!-- 以下為新增成功才會跳出來的顯示框 -->
        <div class="success update card" id="success" style="display:none">
            <div class="success card-body">
                <label class="success_text" style="background:transparent">新增成功</label>
                <div><img class="success_img" src="../../images/icon_checked.svg"></div>
            </div>
        </div>

        <!-- 以下為新增失敗才會跳出來的顯示框 -->
        <div class="success update card" id="my_false" style="box-shadow:0px 0px 10px red;display:none" >
            <div class="success card-body">
                <label class="success_text" style="background:transparent;color:rgb(228, 63, 63)">新增失敗,不可以偷偷來喔!</label>
            </div>
        </div>
    </div>
    
    <script>
        function checkForm() {
            // 判斷書籍名稱,作者,出版社,版次是否有填寫
            let name = document.querySelector('#name');
            let publishing = document.querySelector('#publishing');
            let author = document.querySelector('#author');
            let version = document.querySelector('#version');
  
            let isPass = true;
            if(name.value.length<1){
                name.style.border = '1px solid red';
                document.querySelector('#nameHelp').innerHTML = '請填寫書籍名稱';              
                isPass = false;
            };
            if(publishing.value.length<1){
                publishing.style.border = '1px solid red';
                document.querySelector('#publishingHelp').innerHTML = '請填寫出版社名稱';              
                isPass = false;
            };
            if(author.value.length<1){
                author.style.border = '1px solid red';
                document.querySelector('#authorHelp').innerHTML = '請填寫作者名稱';              
                isPass = false;
            };
            if(version.value.length<1){
                version.style.border = '1px solid red';
                document.querySelector('#versionHelp').innerHTML = '請填寫版次';              
                isPass = false;
            };



            // 判斷isbn碼,出版日期,定價,頁數,庫存,書籍簡介格式是否正確                       
            let s, item;

            const required_fields = [
                {
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
                    pattern: /^\S{1,200}$/,
                    info: '超過字數限制,請重新輸入'
                },
            ];

            // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
            for(s in required_fields){
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
            };

             // 先讓所有欄位外觀回復到原本的狀態
            for(s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid #CCCCCC';
                item.infoEl.innerHTML = '';
            };

            for(s in required_fields) {
            item = required_fields[s];
                if(! item.pattern.test(item.el.value)){
                    item.el.style.border = '1px solid red';
                    item.infoEl.innerHTML = item.info;
                    isPass = false;
                };
            };

            // 全部都正確送出表單到後台
            let container2 =  document.querySelector('.container2');
            let success = document.querySelector('#success');
            let my_false = document.querySelector('#my_false');
            
            if(isPass){
            let fd = new FormData(document.form1);
            fetch('vb_data_insert_api.php',{
                method: 'POST',
                body: fd,
            })

            .then(response=>{
                return response.json();
            })
            // 收到後台回傳的新增判斷(是否成功,然後顯示到前台讓用戶知道)
            // 新增成功跳回出版社書籍的datalist,失敗就回到上一層
            .then(json=>{
                console.log(json);
                if(json.success){
                    mysuccess.style.display = 'block';
                    container2.style.display = 'none';
                    setTimeout(function(){
                        location.href = 'vb_data_list.php';
                    },1000)
                } else {
                    myfalse.style.display = 'block';
                    container2.style.display = 'none';
                    setTimeout(function(){
                        location.href = document.referrer;
                    },1000)
                }
            });
        }            
           
            //不讓表單直接送出
            return false;
        }
    </script>

    <?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>