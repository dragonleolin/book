<?php
require __DIR__. '/AC__connect_db.php';
$page_name = 'AC_date_insert';
$page_title = '活動資料新增'

?>
<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
    /* small.form-text {
        color: red;
    } */
</style>
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/AC__navbar.php' ?>
    <!-- 右邊section資料欄位 -->
    <section>
        <div class="container">
        
        <!-- <div class="row">
            <div class="col">
                <div class="alert alert-primary" role="alert" id="success" style="display: none"></div>
            </div>
        </div> -->

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
                                <!-- <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span> -->
                                <input type="text" class="update form-control" id="AC_name" name="AC_name" value="">
                            </div>
                            <div class="form-group">
                                <label for="AC_title" class="update_label">標題</label>
                                <!-- <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span> -->
                                <input type="text" class="update form-control" id="AC_title" name="AC_title" value="test">
                            </div>
                            <div class="form-group">
                                <label for="AC_type" class="update_label">活動類型</label>
                                <!-- <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span> -->
                                <input type="text" class="update form-control" id="AC_type" name="AC_type" value="test">
                                
                            </div>
                            <div class="form-group">
                                <label for="AC_date" class="update_label">日期</label>
                                <!-- <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span> -->
                                <input type="text" class="update form-control" id="AC_date" name="AC_date" value="2019-10-10">
                            </div>
                            <div class="form-group">
                                <label for="AC_eventArea" class="update_label">地點</label >
                                <!-- <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span> -->
                                <input type="text" class="update form-control" id="AC_eventArea" name="AC_eventArea" value="test">
                            </div>
                            <div class="form-group">
                                <label for="AC_mobile" class="update_label">連絡電話</label>
                                <!-- <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span> -->
                                <input type="text" class="update form-control" id="AC_mobile" name="AC_mobile" value="0912666888">
                            </div>
                            <div class="form-group">
                                <label for="AC_organizer" class="update_label">主辦方</label>
                                <!-- <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span> -->
                                <input type="text" class="update form-control" id="AC_organizer" name="AC_organizer" value="test">
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
                            <textarea class="update form-control" id="exampleFormControlTextarea1" rows="3"
                            style="width:500px;height:165px;resize:none"></textarea>
                        </div>

                        <div class="form-group" style="margin:20px 0;">
                            <label for="exampleFormControlFile1"><h4>上傳活動封面</h4></label>
                            
                            <form action="/somewhere/to/upload" enctype="multipart/form-data">
                                <input style="margin:0px" type="file" onchange="readURL(this)" targetID="AC_img" accept="image/gif, image/jpeg, image/png"/ >
                                <img style="margin:10px 0; width:500px; background-size:cover;" id="AC_img" src="" />
                            </form>
                        </div>

                        <script>
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
    
       function checkForm(){
            let fd = new FormData(document.form1);

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
                            location.href = document.referrer;
                        },1000)
                    }
                });
                   
            return false; // 表單不出用傳統的 post 方式送出
        }

    </script>
</div>
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>