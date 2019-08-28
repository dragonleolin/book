<?php
require __DIR__. '/AC__connect_db.php';
$page_name = 'AC_date_list';
$page_title = '活動資料修改'

?>
<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
</style>
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/AC__navbar.php' ?>
    <!-- 右邊section資料欄位 -->
    <section>
        <div class="container">
            <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
                <div>
                    <h4>活動資料修改</h4>
                    <div class="title_line"></div>
                </div>
            </nav>

            <!-- 每個人填資料的區塊 -->
            <div class="container">
                <section class="d-flex" style="min-width:600px;">
                    <div class="card-body d-flex">
                        <form style="width:800px;margin:-15px 50px" method="post">
                            <div class="form-group">
                                <label for="AC_name" class="update_label">申請人</label>
                                <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span>
                                <input type="text" class="update form-control" id="AC_name" name="AC_name">
                            </div>
                            <div class="form-group">
                                <label for="AC_title" class="update_label">標題</label>
                                <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span>
                                <input type="text" class="update form-control" id="AC_title" name="AC_title">
                            </div>
                            <div class="form-group">
                                <label for="AC_type" class="update_label">活動類型</label>
                                <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span>
                                <input type="text" class="update form-control" id="AC_type" name="AC_type">
                                
                            </div>
                            <div class="form-group">
                                <label for="AC_date" class="update_label">時間</label>
                                <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span>
                                <input type="text" class="update form-control" id="AC_date" name="AC_date">
                            </div>
                            <div class="form-group">
                                <label for="AC_eventArea" class="update_label">地點</label>
                                <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span>
                                <input type="text" class="update form-control" id="AC_eventArea" name="AC_eventArea">
                            </div>
                            <div class="form-group">
                                <label for="AC_mobile" class="update_label">連絡電話</label>
                                <!-- <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span> -->
                                <input type="text" class="update form-control" id="AC_mobile" name="AC_mobile">
                            </div>
                            <div class="form-group">
                                <label for="AC_organizer" class="update_label">主辦方</label>
                                <!-- <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span> -->
                                <input type="text" class="update form-control" id="AC_organizer" name="AC_organizer">
                            </div>
                            <!-- <div class="form-group">
                                <label for="AC_price" class="update_label">參加費</label>
                                <span style="margin:0px 10px;color:red">示意:錯誤顯示訊息</span>
                                <input type="text" class="update form-control" id="AC_price" name="AC_price">
                            </div> -->

                            

                            <div style="position:absolute;left:900px;">
                                <button type="submit" class="btn btn-warning" id="submit_btn">&nbsp;確&nbsp;認&nbsp;修&nbsp;改&nbsp;</button>
                            </div>

                        </form>

                        <!-- <div class="form-group" style="margin:20px 60px;">
                            <label for="exampleFormControlFile1"><h4>上傳活動封面</h4></label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div> -->
                    </div>
                    <div >
                        <div class="form-group" style="">
                            <label for="categories" class="update_label">活動介紹</label>
                            <textarea class="update form-control" id="exampleFormControlTextarea1" rows="3"
                            style="width:500px;height:165px;resize:none"></textarea>
                        </div>

                        <form action="/somewhere/to/upload" enctype="multipart/form-data">
                        <input style="margin:50px" type="file" onchange="readURL(this)" targetID="AC_img" accept="image/gif, image/jpeg, image/png"/ >
                        <img id="AC_img" src="#" />

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
            </form>

                <!-- 以下為修改或新增成功才會跳出來的顯示框 -->
                <!-- <div class="success update card">
                        <div class="success card-body">
                            <label class="success_text">修改成功</label>
                            <div><img class="success_img" src="../images/icon_checked.svg"></div>
                        </div>
                </div> -->
            </div>
    </section>

</div>
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>