<?php require __DIR__. '/__connect_db.php';
    $page_title = '出版社書籍總表';
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶選取的頁數
    $per_page = 10; //每頁幾筆資料
    
    $t_sql = "SELECT COUNT(1) FROM `vb_books` ";
    $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
    $totalPages = ceil($totalRows/$per_page); //取得總頁數

    
    if($page<1){
        header('Location: vb_data_list.php');
    };
    
    if($page>$totalPages){
        header('Location: vb_data_list.php?page='.$totalPages);
    };  
    

    $categories_sql = sprintf("SELECT `vb_books`.*, `vb_categories`.`name` categories_name 
    FROM `vb_categories` JOIN `vb_books` ON `vb_books`.`categories` = `vb_categories`.`sid` ORDER BY `sid` ASC LIMIT %s, %s",
    ($page-1)*$per_page,$per_page);
    $stmt = $pdo->query($categories_sql);     

?>

<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }

    .page-position {
        position: absolute;
        bottom: 3%;
        left: 50%;
    }
</style>
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/../../pbook_index/__navbar.php' ?>
<!-- 右邊section資料欄位 -->
<section>
    <div class="container">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h4>出版社書籍總表</h4>
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
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">
                        <i class="fas fa-plus-circle"></i>
                        新增廠商
                    </button>
                </li>
                <li class="nav-item" style="flex-grow: 1">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="search form-control mr-sm-2" type="search" placeholder="Search"
                            aria-label="Search">
                        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- 每個人填資料的區塊 -->
       
        <div style="margin-top: 1rem">
            <table class="table table-striped table-bordered" style="text-align: center;width:83vw">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">書籍名稱</th>
                        <th scope="col">封面</th>
                        <th scope="col">分類</th>
                        <th scope="col">作者</th>
                        <th scope="col">出版社</th>
                        <th scope="col">出版日期</th>
                        <th scope="col">版次</th>
                        <th scope="col">定價</th>
                        <th scope="col">頁數</th>
                        <th scope="col">庫存</th>
                        <th scope="col">修改</th>
                        <th scope="col">刪除</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $row = $stmt->fetchAll();
                    for($i = 0 ; $i < count($row) ; $i++): ?>
                    <tr>
                        <td><?= $row[$i]['sid']; ?></td>
                        <td><?= $row[$i]['isbn']; ?></td>
                        <td><?= $row[$i]['name']; ?></td>
                        <td>                          
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#<?= 'book'.$row[$i]['sid']; ?>">
                                <i class="fas fa-plus-circle"></i>
                                顯示
                            </button>
                            
                            <div class="modal fade" id="<?= 'book'.$row[$i]['sid']; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="<?= 'book'.$row[$i]['sid']; ?>Title" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">                                    
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="<?= 'book'.$row[$i]['sid']; ?>Title"><?= $row[$i]['name']; ?></h5>
                                            
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <img src="<?= 'vb_images/'.$row[$i]['pic']; ?>" alt=""> 
                                        </div>                                      
                                    </div>
                                </div>
                            </div>
                        <td><?= $row[$i]['categories_name']; ?></td>
                        <td><?= $row[$i]['author']; ?></td>
                        <td><?= $row[$i]['publishing']; ?></td>
                        <td><?= $row[$i]['publish_date']; ?></td>
                        <td><?= $row[$i]['version']; ?></td>
                        <td><?= $row[$i]['fixed_price']; ?></td>
                        <td><?= $row[$i]['page']; ?></td>
                        <td><?= $row[$i]['stock']; ?></td>
                        <td><a href="#"><i class="fas fa-edit"></i></a></td>
                        <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php endfor; ?>                    
                </tbody>
               
            </table>
        </div>

        <!-- 我是分頁按鈕列 請自取並調整頁面擺放位置 -->
        <nav aria-label="Page navigation example">
            <ul class="pagination page-position ">
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
                    <a class="page-link"
                        style="<?= $i == $page ? 'background: rgba(156, 197, 161, 0.5) ;color: #ffffff;':'' ?>"
                        href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <?php endif; ?>
                <?php
                if ($page >= 5) :
                    for ($i = 1; $i <= $p_end; $i++) :
                        if ($i < 1 or $i > $totalPages) continue;
                        ?>
                <li class="page-item ">
                    <a class="page-link"
                        style="<?= $i == $page ? 'background: rgba(156, 197, 161, 0.5) ;color: #ffffff;':'' ?>"
                        href="?page=<?= $i ?>"><?= $i ?></a>
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
        <!-- <div class="delete update card">
                    <div class="delete card-body">
                        <label class="delete_text">您確認要刪除資料嗎?</label>
                        <div>
                            <button type="button" class="delete btn btn-danger">確認</button>
                            <button type="button" class="delete btn btn-warning">取消</button>
                        </div>
                    </div>
                </div> -->

</section>
</div>
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>