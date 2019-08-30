<?php
require __DIR__. '/AC__connect_db.php';
$page_name = 'AC_date_insert';
$page_title = '品書 - 活動新增';

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
    <section>
        <div class="container">
            <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
                <div>
                    <h4>新增活動</h4>
                    <div class="title_line"></div>
                </div>
            </nav>

            <!-- 每個人填資料的區塊 -->
            <div class="container2" style="visibility:visible;" id="main_datalist">
                <section class="d-flex" style="min-width:600px;">
                    <div class="card-body d-flex">
                                                                <!-- action="AC_insert_api.php" method="post"-->
                        <form style="width:800px;margin:-15px 50px;" name="form1" onsubmit="return checkForm()">
                            <div class="form-group">
                                <label for="AC_name" class="update_label">申請人</label>
                                <span id="AC_nameHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_name" name="AC_name" value="">
                            </div>
                            <div class="form-group">
                                <label for="AC_title" class="update_label">標題</label>
                                <span id="AC_titleHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_title" name="AC_title" value="">
                            </div>
                            <div class="form-group">
                                <label for="AC_type" class="update_label">活動類型</label>
                                <span id="AC_typeHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_type" name="AC_type" value="">
                                
                            </div>
                            <div class="form-group">
                                <label for="AC_date" class="update_label">活動開始日期</label>
                                <span style="color:#999; margin:0 20px">格式: 2000-01-01</span>
                                <span id="AC_dateHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_date" name="AC_date" value="">
                            </div>
                            <div class="form-group">
                                <label for="AC_eventArea" class="update_label">地點</label >
                                <span id="AC_eventAreaHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_eventArea" name="AC_eventArea" value="">
                            </div>
                            <div class="form-group">
                                <label for="AC_mobile" class="update_label">手機號碼</label>
                                <span id="AC_mobileHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_mobile" name="AC_mobile" value="">
                            </div>
                            <div class="form-group">
                                <label for="AC_organizer" class="update_label">主辦方</label>
                                <span id="AC_organizerHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_organizer" name="AC_organizer" value="">
                            </div>
                            <!-- <div class="form-group">
                                <label for="AC_price" class="update_label">參加費</label>
                                <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span>
                                <input type="text" class="update form-control" id="AC_price" name="AC_price">
                            </div> -->

                            <div style="position:absolute;left:900px;">
                                <button type="submit" class="btn btn-warning" id="success">&nbsp;確&nbsp;認&nbsp;新&nbsp;增&nbsp;</button>
                            </div>
                        </form>
                    </div>

                    <div >
                        <div class="form-group" style="">
                            <label for="categories" class="update_label">活動介紹</label>
                            <span style="color:#999;">　限200字</span>
                            <textarea class="update form-control" id="exampleFormControlTextarea1" rows="3"
                            style="width:500px;height:165px;resize:none"></textarea>
                        </div>

                        <div class="form-group" style="margin:20px 0;">
                        <div class="col-lg-5 ">
                            <div>
                            <label for="pic" style="font-size: 20px;">・上傳活動封面</label>
                            <input type="file" class="form-control-file" id="pic" name="pic" style="display:none">
                            </div>
                            <div>
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick="selUpload()">
                                <i class="fas fa-plus-circle" style="width:30px;"></i>選擇檔案
                            </button>
                            </div>
                        </div>
                    </div>
                    <div style="width: 500px;">
                            <img style="object-fit: contain;width: 100%;height: 100%" id="demo"/>
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

                            function readURL(input){
                              if(input.files && input.files[0]){
                                var imageTagID = input.getAttribute("targetID");
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                   var img = document.getElementById(imageTagID);
                                   img.setAttribute("src", e.target.result)
                                }
                                reader.readAsDataURL(input.files[0]);
                              }
                            }
                        </script>         
                    </div>
                </section>  
             </div>
        

            <!-- 以下為新增成功才會跳出來的顯示框 -->
        <div class="success update card" id="submit_btn" style="display:none; position:absolute;top:300px; left:500px;">
            <div class="success card-body">
                <label class="success_text" style="background:transparent">新增成功!</label>
                <div><img class="success_img" src="../../images/icon_checked.svg"></div>
            </div>
        </div>

        <!-- 以下為新增失敗才會跳出來的顯示框 --> 
        <!-- <div class="success update card" id="my_false" style="box-shadow:0px 0px 10px red; display:none; position:absolute;top:300px; left:500px;">
            <div class="success card-body">
            <label class="success_text" style="background:transparent;color:rgb(228, 63, 63)">新增失敗!</label>
            <div><img class="success_img" src="../../images/icon_false.svg"></div>
        </div> -->
</div>
        
    </section>
</div>

</div>
    <script>
        let container2 =  document.querySelector('.container2');
        let success = document.querySelector('#submit_btn');
        let my_false = document.querySelector('#my_false');
        let main_datalist_hidden = document.querySelector('#main_datalist');
        // 檢查有沒有輸入----------------------------------------------
        let i, s, item;

        const error_text = [{
                id: 'AC_name',
                checker: /^\S{2,}/,
                info: '請輸入正確姓名格式'
            },{
            id: 'AC_title',
                checker: /^\S{2,}/,
                info: '請輸入正確活動格式'
            },{
            id: 'AC_type',
                checker: /^\S{2,}/,
                info: '請輸入正確類型格式'
            },{
            id: 'AC_date',
                checker: /^20\d{2}\-?\d{1,2}\-?\d{2}$/,
                info: '請輸入正確活動開始日期'
            },{
            id: 'AC_eventArea',
                checker: /.+/,
                info: '請輸入活動地點'
            },{
                id: 'AC_mobile',
                checker: /^09\d{2}\-?\d{3}\-?\d{3}$/,
                info: '請輸入正確手機格式'
            },{
            id: 'AC_organizer',
                checker: /.+/,
                info: '請輸入主辦單位'
            },
            ];
        
            for (i in error_text) {
                item = error_text[i];
                item.el = document.querySelector('#' + item.id);
                item.error_info = document.querySelector('#' + item.id + 'Help');
            }

            function checkForm() {
            let fd = new FormData(document.form1);

            for (i in error_text) {
                item = error_text[i];
                item.el.style.border = '1px solid #cccccc';
                item.error_info.innerHTML = '';
            }

            let passcheck = true;
            for (i in error_text) {
                item = error_text[i];

                if (!item.checker.test(item.el.value)) {
                    item.el.style.border = '1px solid red';
                    item.error_info.style.color = 'red';
                    item.error_info.innerHTML = item.info;
                    passcheck = false;
                }
            }   

        // 輸入成功或失敗，跳出圖片及轉向----------------------------------------------
       

                fetch('AC_insert_api.php', {
                    method: 'POST',
                    body: fd,
                })

                .then(response=>{
                    return response.json();
                })

                
                .then(json => {
                    console.log(json);
                    // success.innerHTML = json.info;
                    if (json.success){
                        submit_btn.style.display = 'block';
                        main_datalist_hidden.style.visibility = 'hidden';
                        setTimeout(function(){
                        location.href = 'AC_data_list.php';
                        },1000)
                    } else {
                        my_false.style.display = 'block';
                        main_datalist_hidden.style.visibility = 'hidden';
                        setTimeout(function(){
                            location.href = 'AC_insert.php';
                        },500)
                    }
                });
                   
            return false; // 表單不出用傳統的 post 方式送出
        }

    </script>
</div>
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>