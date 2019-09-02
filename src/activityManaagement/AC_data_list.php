<?php
require __DIR__. '/AC__connect_db.php';
$page_name = 'AC_date_list';
$page_title = '品書 - 活動總表';

// ---------------------------------------------------------------
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶選頁

$per_page = 10; //每筆顯示頁數

$ac_sql = "SELECT COUNT(1) FROM `ac_pbook`";
$totalRows = $pdo->query($ac_sql)->fetch(PDO::FETCH_NUM)[0];//總筆數
$totalPages = ceil($totalRows/$per_page);//總頁數

//分頁上限轉向
if($page < 1){
    header('Location: AC_data_list.php?page='. $totalPages);
    exit;
}
if($page > $totalPages){
    header('Location: AC_data_list.php');
    exit;
}

$sql = sprintf("SELECT * FROM `ac_pbook` ORDER BY `AC_sid` DESC LIMIT %s,%s",//limit
($page-1)*$per_page,
$per_page    //呈現的頁數
);

$stmt = $pdo->query($sql);
// --------------------------------------
?>
<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<style>
    body{
        background: url(../../images/bg.png) repeat center top;
    }
</style>
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/../../pbook_index/__navbar.php' ?>


<!--印出---------------------------------------------------------->
<script src="../../lib/jquery-3.4.1.js"></script>
<script>
function renderBooks(books){
    var tbody = document.getElementById('books');
    var html = '';
    for(var i = 0; i < books.length; i++){
        html += '<tr>';
        html += '<td>' + books[i].AC_sid+'</td>';
        html += '<td>' + books[i].AC_name+'</td>';
        html += '<td>' + books[i].AC_title+'</td>';
        html += '<td>' + books[i].AC_type+'</td>';
        html += '<td>' + books[i].AC_date+'</td>';
        html += '<td>' + books[i].AC_eventArea+'</td>';
        html += '<td>' + books[i].AC_mobile+'</td>';
        html += '<td>' + books[i].AC_organizer+'</td>';
        html += '<td>' + books[i].AC_brief+'</td>';
        html += '<td>' + books[i].AC_created_at+'</td>';
        html += '<td><a href="AC_update.php?AC_sid='+books[i].AC_sid+'"><i class="fas fa-edit"></i></a></td>';
        html += '<td><a href="javascript:delete_one('+books[i].AC_sid+')"><i class="fas fa-trash-alt"></i></a></td>';
        html += '</tr>';
    }
    tbody.innerHTML = html;
    return false;
}

//--Enter監聽---------------------------------------------------------------------------
document.onkeypress = function(e){ //對整個頁面監聽 
var keyNum = window.event ? e.keyCode :e.which; //獲取被按下的鍵值
//判斷使用者按下Enter鍵 (監聽13）
if(keyNum==13){  
    search() ;
    return false;
}};


//--Ajax搜尋功能---------------------------------------------------------------------------
function search(){
    //取得搜尋字串
    var searchItem = document.getElementById('AC_search'); //取ID
    var value = searchItem.value; //取值
    //ajax
$.ajax({
    method:"GET",
    url:"./AC_search.php", //進api
    data: {search: value}
})

.done(function(msg){
    var books = JSON.parse(msg);
    renderBooks(books);
});
    return false;
}
</script>


    <!-- 右邊section資料欄位 -->
    <section>
        <div class="container">
            <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
                <div>
                    <h4>品書官方 - 活動總表</h4>
                    <div class="title_line"></div>
                </div>
                
                <ul class="nav justify-content-between">
                    <li class="nav-item">
                        <div style="padding: 0.375rem 0.75rem;">
                            <i class="fas fa-check"></i>
                            目前總計<?= $totalRows ?>筆資料
                        </div>
                    </li>
                    <li class="nav-item" style="margin: 0px 10px">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" onclick="location.href='AC_insert.php'">
                            <i class="fas fa-plus-circle"></i>
                            新增活動
                        </button>
                    </li>
                    <li class="nav-item" style="flex-grow: 1">
                        <form class="form-inline my-2 my-lg-0">
                            <!-- #AC_search -->
                            <input id="AC_search" class="search form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-warning my-2 my-sm-0" type="button" onclick="search()">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- 每個人填資料的區塊 -->
            <div style="margin-top: 1rem">
                <table class="table table-striped table-bordered" style="text-align: center; width:80vw">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">姓名</th>
                            <th scope="col">標題</th>
                            <th scope="col">活動類型</th>
                            <th scope="col">時間</th>
                            <th scope="col">地點</th>
                            <th scope="col">聯絡電話</th>
                            <th scope="col">主辦單位</th>
                            <th scope="col">活動簡介</th>
                            <th scope="col">建立時間</th>
                            <th scope="col">修改</th>
                            <th scope="col">刪除</th>
                        </tr>
                    </thead>
                    <!-- #books -->
                    <tbody id="books">
                        <?php while($r=$stmt->fetch()){ ?>
                        <tr>
                            <td><?= htmlentities($r['AC_sid']) ?></td>
                            <td><?= htmlentities($r['AC_name']) ?></td>
                            <td><?= htmlentities($r['AC_title']) ?></td>
                            <td><?= htmlentities($r['AC_type']) ?></td>
                            <td><?= htmlentities($r['AC_date']) ?></td>
                            <td><?= htmlentities($r['AC_eventArea']) ?></td>
                            <td><?= htmlentities($r['AC_mobile']) ?></td>
                            <td><?= htmlentities($r['AC_organizer']) ?></td>
                            <td><?= htmlentities($r['AC_brief']) ?></td>
                            <td><?= htmlentities($r['AC_created_at']) ?></td>
                            <!-- 圖片 -->
                            

                            <td><a href="AC_update.php?AC_sid=<?= $r['AC_sid'] ?>"><i class="fas fa-edit"></i></a>
                            <td><a href="javascript:delete_one(<?= $r['AC_sid'] ?>)"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <?php } ?>
                       
                    </tbody>
                </table>
            </div>

            <!-- 我是分頁按鈕列 請自取並調整頁面擺放位置 -->
            <nav aria-label="Page navigation example" style="position:absolute;left:800px;margin:5px 0;">
                <ul class="pagination">
                    <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    
                    <?php
                    $p_start = $page - 5;
                    $p_end = $page + 5;
                     if ($page < 5) :
                         for ($i = $p_start; $i <= 10; $i++) :
                            if ($i < 1 or $i > $totalPages) continue;
                            ?>

                    <li class="page-item">
                    <a class="page-link" style="<?= $i == $page ? 'background: rgba(156, 197, 161, 0.5) ;color: #ffffff;':'' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    <?php endif; ?>
                    <?php
                    if ($page >= 5) :
                      for ($i = 1; $i <= $p_end; $i++) :
                        if ($i < 1 or $i > $totalPages) continue;
                        ?>
                        
                    <li class="page-item ">
                    <a class="page-link" style="<?= $i == $page ? 'background: rgba(156, 197, 161, 0.5) ;color: #ffffff;':'' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    <?php endif; ?>

                    <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
            </nav>

            <!-- 刪除提示框 -->
            <div class="delete update card" id="my_delete" style="display:none">
            <div class="delete card-body">
                <label class="delete_text">您確認要刪除資料嗎?</label>
                <div>
                    <button type="button" class="delete btn btn-danger" onclick="delete_yes()">確認</button>
                    <button type="button" class="delete btn btn-warning" onclick="delete_no()">取消</button>
                </div>
            </div>
            </div>     
    </section>
 
    <script>
    let a;
    function delete_one(sid) {
        a = sid;
        let my_delete = document.querySelector('#my_delete');
        my_delete.style.display = 'block';      
    }

    function delete_yes() {
        location.href = 'AC_delete.php?sid=' + a;
    }

    function delete_no() {
        location.href = 'AC_data_list.php?page=' + <?= $page ?>;
    }
    </script>

<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>