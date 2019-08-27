<?php
require __DIR__ . '/__connect_db.php';
$page_title = '出版社總表';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$per_page = 8;    //一頁10筆
$totalRows = $pdo->query("SELECT COUNT(1) FROM `cp_data_list`")->fetch(PDO::FETCH_NUM)[0];    // 拿到總筆數
$totalPages = ceil($totalRows / $per_page);    //算總頁數
if ($page < 1) {
    header('Location: CP_data_list.php');
    exit;
}
if ($page > $totalPages) {
    header('Location: CP_data_list.php?page=' . $totalPages);
    exit;
}

$sql = sprintf(
    "SELECT * FROM `cp_data_list` ORDER BY `sid` ASC LIMIT %s, %s",
    ($page - 1) * $per_page,    //從第幾筆開始
    $per_page    //一頁幾筆
);
$stmt = $pdo->query($sql);
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
<section class="position-relative">
    <div class="container">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h4>出版社總表</h4>
                <div class="title_line"></div>
            </div>
            <ul class="nav justify-content-between">
                <li class="nav-item">
                    <div style="padding: 0.375rem 0.75rem;">
                        <i class="fas fa-check"></i>
                        目前總計___筆資料
                    </div>
                </li>
                <li class="nav-item" style="margin: 0px 10px">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" onclick="insert()">
                        <i class="fas fa-plus-circle"></i>
                        新增出版社
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
            <table class="table table-striped table-bordered" style="width: 80vw ; text-align: center; font-size:16px; height:75vh">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">出版社名</th>
                        <th scope="col">聯絡人</th>
                        <th scope="col">電話</th>
                        <th scope="col">電子郵件</th>
                        <th scope="col">地址</th>
                        <th scope="col">統一編號</th>
                        <th scope="col">書籍庫存</th>
                        <th scope="col">帳號</th>
                        <th scope="col">密碼</th>
                        <th scope="col">logo</th>
                        <th scope="col">註冊日期</th>
                        <th scope="col">修改</th>
                        <th scope="col">刪除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $stmt->fetch()) : ?>
                    <tr>
                        <td><?= $r['sid'] ?></td>
                        <td><?= htmlentities($r['cp_name']) ?></td>
                        <td><?= htmlentities($r['cp_contact_p']) ?></td>
                        <td><?= htmlentities($r['cp_phone']) ?></td>
                        <td><?= htmlentities($r['cp_email']) ?></td>
                        <td><?= htmlentities($r['cp_address']) ?></td>
                        <td><?= htmlentities($r['cp_tax_id']) ?></td>
                        <td><?= htmlentities($r['cp_stock']) ?></td>
                        <td><?= htmlentities($r['cp_account']) ?></td>
                        <td><?= htmlentities($r['cp_password']) ?></td>
                        <td><?= htmlentities($r['cp_logo']) ?></td>
                        <td><?= htmlentities($r['cp_created_date']) ?></td>
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