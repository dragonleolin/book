<?php require __DIR__. '/__connect_db.php';
    $page_title = '出版社書籍總表';
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶選取的頁數
    $per_page = 15; //每頁幾筆資料
    
    $t_sql = "SELECT COUNT(1) FROM `vb_books` ";
    $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
    $totalPages = ceil($totalRows/$per_page); //取得總頁數
    
    if($page<1){
        header('Location: vb_data_list.php');
    };
    
    if($page>$totalPages){
        header('Location: vb_data_list.php?page='.$totalPages);
    };  
    
    
    $sql = sprintf("SELECT * FROM `vb_books` ORDER BY `sid` ASC LIMIT %s, %s",
            ($page-1)*$per_page,
                $per_page
    );

    $stmt = $pdo->query($sql);

    $categories_sql = "SELECT `name` FROM `vb_categories` where 1";
    $categories_stmt = $pdo->query($categories_sql);
    $categories_rows = $categories_stmt->fetchAll(); 
       

?>

<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<style>
    body{
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
                            <input class="search form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- 每個人填資料的區塊 -->
            <div style="margin-top: 1rem">
                <table class="table table-striped table-bordered" style="text-align: center;width:80vw">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">書名</th>
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
                        <?php while($row = $stmt->fetch()): ?>
                        <tr>
                            <td><?= $row['sid']; ?></td>
                            <td><?= $row['isbn']; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $categories_rows[$row['categories']-1]['name']; ?></td>
                            <td><?= $row['author']; ?></td>
                            <td><?= $row['publishing']; ?></td>
                            <td><?= $row['publish_date']; ?></td>
                            <td><?= $row['version']; ?></td>
                            <td><?= $row['fixed_price']; ?></td>
                            <td><?= $row['page']; ?></td>
                            <td><?= $row['stock']; ?></td>
                            <td><a href="#"><i class="fas fa-edit"></i></a></td>
                            <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <?php endwhile; ?>
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