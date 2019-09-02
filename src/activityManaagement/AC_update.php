<?php
require __DIR__. '/AC__connect_db.php';
$page_name = 'AC_update';
$page_title = '品書 - 活動修改';

//-----------------------------------------------------------
$sid = isset($_GET['AC_sid']) ? intval($_GET['AC_sid']) : 0;
if(empty($sid)) {
    header('Location: AC_data_list.php');
    exit;
}
$sql = "SELECT * FROM `ac_pbook` WHERE `AC_sid`=$sid";
$row = $pdo->query($sql)->fetch();
if(empty($row)) {
    header('Location: AC_data_list.php');
    exit;
}


$sel_id = empty($_POST['mb_categories']) ? 0 : intval($_POST['mb_categories']);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$per_page = 10;

$t_sql = "SELECT COUNT(1) FROM `ac_pbook`";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $per_page);

//-----------------------------------------------------------
?>
<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }
    /* ---------------------------------------- */
    .big_container {
        position: relative;
    }

    .success_bar {
        position: absolute;
        top: 250px;
        left: 500px;
    }
    /* ---------------------------------------- */
</style>

<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/../../pbook_index/__navbar.php' ?>

    <!-- 右邊section資料欄位 -->
    <section>
         <!-- ----------------------------------------  -->
        <div class="container big_container">
        <!-- ----------------------------------------  -->
            <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
                <div>
                    <h4>活動修改</h4>
                    <div class="title_line"></div>
                </div>
                <ul class="nav justify-content-between">
                <li class="nav-item" style="margin: 0px 10px">
                <button class="btn btn-outline-primary my-2= my-sm-0" type="button" onclick="preceding_page()">
                    <i class="fas fa-arrow-circle-left"></i>
                    回到上一頁
                </button>
            </li>
        </ul>
            </nav>

            <!-- 每個人填資料的區塊 -->
            <div class="container2" style="visibility:visible;" id="main_datalist">
                <section class="d-flex" style="min-width:600px;">
                    <div class="card-body">
                        <form class="row" style="width:80vw;margin:10px 0;" name="form1" onsubmit="return checkForm()">
                        <input type="hidden" name="AC_sid" value="<?= $row['AC_sid'] ?>">
                            <div class="col-6">
                            <div class="form-group">
                                <label for="AC_name" class="update_label">申請人</label>
                                <span id="AC_nameHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_name" name="AC_name" value="<?= htmlentities($row['AC_name']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="AC_title" class="update_label">標題</label>
                                <span id="AC_titleHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_title" name="AC_title" value="<?= htmlentities($row['AC_title']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="AC_type" class="update_label">活動類型</label>
                                <span id="AC_typeHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_type" name="AC_type" value="<?= htmlentities($row['AC_type']) ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="AC_date" class="update_label">開始日期</label>
                                <span style="color:#999; margin:0 20px">格式: 2000-01-01</span>
                                <span id="AC_dateHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_date" name="AC_date" value="<?= htmlentities($row['AC_date']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="AC_eventArea" class="update_label">地點</label >
                                <span id="AC_eventAreaHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_eventArea" name="AC_eventArea" value="<?= htmlentities($row['AC_eventArea']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="AC_mobile" class="update_label">手機號碼</label>
                                <span id="AC_mobileHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_mobile" name="AC_mobile" value="<?= htmlentities($row['AC_mobile']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="AC_organizer" class="update_label">主辦單位</label>
                                <span id="AC_organizerHelp" style="margin:0px 10px; color:red"></span>
                                <input type="text" class="update form-control" id="AC_organizer" name="AC_organizer" value="<?= htmlentities($row['AC_organizer']) ?>">
                            </div>

                            <div style="position:absolute;left:34vw; margin:30px 0;">
                                <button type="submit" class="btn btn-warning" id="success">&nbsp;確&nbsp;認&nbsp;修&nbsp;改&nbsp;</button>
                            </div>
                        
                    </div>

                    <!-- 分隔線 --------------------------------------------------- -->
                    <div class="col-6">
                                <div class="form-group" style="margin:0 40px;">
                                    <label for="categories" class="update_label">・活動簡介</label>
                                    <span style="color:#999;">&nbsp;限制100字以內</span>
                                    <textarea class="update form-control" id="exampleFormControlTextarea1" rows="3"
                                    style="width:500px;height:165px;resize:none"></textarea>
                                </div>

                                <div class="form-group" style="margin:20px 40px;">
                                    
                    
                                    <label for="AC_pic" style="font-size: 20px;">・活動封面</label>
                                    <input type="file" class="form-control-file" id="AC_pic" name="AC_pic" style="display:none">
                                    
                                    <button style="margin:0 10px" class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick="selUpload()">
                                        <i class="fas fa-plus-circle" style="width:30px; "></i>上傳圖片檔案
                                    </button>

                                     <div style="width: 500px;height:340px; margin:20px 0;">
                                     <img style="object-fit: contain;width: 100%;height: 100%; margin:0 10px;" src="./AC_images/<?= htmlentities($row['AC_pic']) ?>" id="demo"/>
                                                                    
                                     </div>                  
                                </div>
                        </div>
                        <!-- --------------------------------------------------- -->

                        </form>
                        
                        </div>

                        <script>
                            // --圖片上傳函式--------------------------------------------------
                            function selUpload() {
                                document.querySelector('#AC_pic').click();
                            }
                        
                            function preceding_page() {
                                location.href = document.referrer;
                            }
                        
                            $('#AC_pic').change(function() {
                                var file = $('#AC_pic')[0].files[0];
                                var reader = new FileReader;
                                reader.onload = function(e) {
                                    $('#demo').attr('src', e.target.result);
                                };
                                reader.readAsDataURL(file);
                            });
                            // ----------------------------------------------------
                        </script>
                    </div>
                </section>  
             </div>
        

            <!-- 以下為新增成功才會跳出來的顯示框 -->
        <div class="success update card" id="submit_btn" style="display:none; position:absolute;top:300px; left:500px;">
            <div class="success card-body">
                <label class="success_text" style="background:transparent">修改成功!</label>
                <div><img class="success_img" src="../../images/icon_checked.svg"></div>
            </div>
        </div>

        <!-- 以下為新增失敗才會跳出來的顯示框 --> 
        <div class="success update card" id="my_false" style="box-shadow:0px 0px 10px red; display:none; position:absolute;top:300px; left:500px;">
            <div class="success card-body">
            <label class="success_text" style="background:transparent;color:rgb(228, 63, 63)">你沒有修改!</label>
            <div><img class="success_img" src="../../images/icon_false.svg"></div>
        </div>
</div>
        
    </section>
</div>

</div>
    <script>
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
            
        // ----------------------------------------------         
            function checkForm() {
        
            for (i in error_text) {
                item = error_text[i];
                item.el.style.border = '1px solid #cccccc';
                item.error_info.innerHTML = '';
            }

            let isPass = true;
            for (i in error_text) {
                item = error_text[i];

                if (!item.checker.test(item.el.value)) {
                    item.el.style.border = '1px solid red';
                    item.error_info.style.color = 'red';
                    item.error_info.innerHTML = item.info;
                    isPass = false;
                }
            }   
        // 檢查有沒有輸入----------------------------------------------
        let container2 =  document.querySelector('.container2');
        let success = document.querySelector('#submit_btn');
        let my_false = document.querySelector('#my_false');
        let main_datalist_hidden = document.querySelector('#main_datalist');

            if(isPass) {
                let fd = new FormData(document.form1);
                fetch('AC_update_api.php', {
                    method: 'POST',
                    body: fd,
                })

                .then(response=>{
                    return response.json();
                })

                //結果顯示       
                .then(json => {
                    console.log(json);
                    if (json.success){
                        submit_btn.style.display = 'block';
                        // container2.style.display = 'none';
                        main_datalist_hidden.style.visibility = 'hidden';
                        setTimeout(function(){
                        location.href = 'AC_data_list.php';
                        },1000)
                    } else {
                        my_false.style.display = 'block';
                        // container2.style.display = 'none';
                        main_datalist_hidden.style.visibility = 'hidden';
                        setTimeout(function(){
                        location.href = document.referrer;
                        },1000)
                    }
                });  
             } 
                   
            return false; // 表單不出用傳統的 post 方式送出
        }

    </script>
</div>
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>