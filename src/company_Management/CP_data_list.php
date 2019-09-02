<?php
require __DIR__ . '/__admin_required.php';
require __DIR__ . '/__connect_db.php';
$page_title = '出版社總表';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$col = isset($_GET['col']) ? $_GET['col'] : '';
$ord = isset($_GET['ord']) ? $_GET['ord'] : '';
$per_page = 8;    //一頁10筆
$params = [];
$where = ' WHERE 1 ';
if (!empty($search)) {
    $params['search'] = $search;
    $search = $pdo->quote("%$search%");
    $where .= " AND (`cp_name` LIKE $search OR `cp_contact_p` LIKE $search OR `cp_phone` LIKE $search OR `cp_email` LIKE $search OR `cp_address` LIKE $search OR `cp_account` LIKE $search) ";
}
$orderby = '';
if (!empty($col)) {
    $orderby = " ORDER BY `cp_data_list`.`$col` $ord ";
    $params['col'] = $col;
    $params['ord'] = $ord;
}
$totalRows = $pdo->query("SELECT COUNT(1) FROM `cp_data_list` $where ")->fetch(PDO::FETCH_NUM)[0];    // 拿到總筆數
$totalPages = ceil($totalRows / $per_page);    //算總頁數
if ($page < 1) {
    header('Location: CP_data_list.php');
    exit;
}
if ($page > $totalPages) {
    header('Location: CP_data_list.php?page=' . $totalPages);
    exit;
}

$sql = "SELECT * FROM `cp_data_list` $where $orderby LIMIT " . ($page - 1) * $per_page . "," . $per_page;
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();
foreach ($rows as $r) {
    $every_sid = $r['sid'];
    $stock[$r['sid']] = $pdo->query("SELECT SUM(`vb_books`.`stock`) FROM `vb_books` JOIN `cp_data_list` ON  $every_sid = `vb_books`.`publishing` AND  $every_sid = `cp_data_list`.`sid`")->fetch();
}
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

    .vertical td {
        vertical-align: middle;
    }

    .test::after {
        content: "";
        background: url(../../images/admin_bg.png) no-repeat;
        width: calc(100vw - 280px);
        object-fit: contain;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
        z-index: -1;
        opacity: 0.05;
    }
</style>
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<div style="z-index:999;width:100vw;height:100vh;display:none;background:rgba(0,0,0,0.2)" id="delete_confirm" class="position-absolute">
    <div class="delete update card">
        <div class="delete card-body">
            <label class="delete_text">您確認要刪除資料嗎?</label>
            <div>
                <button type="button" class="delete btn btn-danger" onclick="delete_yes()">確認</button>
                <button type="button" class="delete btn btn-warning" onclick="delete_no()">取消</button>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../../pbook_index/__navbar.php' ?>
<!-- 右邊section資料欄位 -->
<section class="position-relative test">
    <div class="container">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h4>出版社書籍總表</h4>
                <div class="title_line"></div>
            </div>
        </nav>
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;margin-top:10px">

            <ul class="nav justify-content-between">
                <li class="nav-item">
                    <div style="padding: 0.375rem 0.75rem;">
                        資料排序：
                    </div>
                </li>
                <li class="nav-item">
                    <div id="btnGroupDrop1" class="position-relative" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-outline-dark">
                            <i class="fas fa-sort"></i>&nbsp;&nbsp;&nbsp;sid
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'sid';
                                                                                        $params['ord'] = 'ASC';
                                                                                        echo http_build_query($params) ?>')">小→大</a>
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'sid';
                                                                                        $params['ord'] = 'DESC';
                                                                                        echo http_build_query($params) ?>')">大→小</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div id="btnGroupDrop1" class="position-relative" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-outline-dark">
                            <i class="fas fa-sort"></i>&nbsp;&nbsp;&nbsp;出版社名
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'cp_name';
                                                                                        $params['ord'] = 'ASC';
                                                                                        echo http_build_query($params) ?>')">小→大</a>
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'cp_name';
                                                                                        $params['ord'] = 'DESC';
                                                                                        echo http_build_query($params) ?>')">大→小</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div id="" class="position-relative" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-outline-dark">
                            <i class="fas fa-sort"></i>&nbsp;&nbsp;&nbsp;註冊日期
                        </button>
                        <div class="dropdown-menu" aria-labelledby="">
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'cp_created_date';
                                                                                        $params['ord'] = 'ASC';
                                                                                        echo http_build_query($params) ?>')">小→大</a>
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'cp_created_date';
                                                                                        $params['ord'] = 'DESC';
                                                                                        echo http_build_query($params) ?>')">大→小</a>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="nav justify-content-between">
                <li class="nav-item">
                    <div style="padding: 0.375rem 0.75rem;">
                        <i class="fas fa-check"></i>
                        目前總計<?= $totalRows ?>筆資料
                    </div>
                </li>
                <li class="nav-item" style="margin: 0px 10px">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" onclick="data_insert()">
                        <i class="fas fa-plus-circle"></i>
                        新增出版社
                    </button>
                </li>
                <li class="nav-item" style="flex-grow: 1">
                    <form class="form-inline my-2 my-lg-0" name="form1">
                        <input class="search form-control mr-sm-2" type="search" autocomplete="off" placeholder="Search" aria-label="Search" id="search" name="search">
                        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- 每個人填資料的區塊 -->
        <div style="margin-top: 1rem">
            <table class="table table-striped table-bordered" style="width: 80vw ; text-align: center; font-size:16px; max-height:75vh">
                <thead>
                    <tr>
                        <th scope="col">
                            <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'sid' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            <i class="fas fa-sort-amount-down" style="<?= ($col == 'sid' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            #</th>
                        <th scope="col">
                            <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'cp_name' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            <i class="fas fa-sort-amount-down" style="<?= ($col == 'cp_name' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            出版社名</th>
                        <th scope="col">聯絡人</th>
                        <th scope="col">電話</th>
                        <th scope="col">電子郵件</th>
                        <th scope="col">地址</th>
                        <th scope="col">統一編號</th>
                        <th scope="col">
                            <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'cp_stock' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            <i class="fas fa-sort-amount-down" style="<?= ($col == 'cp_stock' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            庫存</th>
                        <th scope="col">帳號</th>
                        <th scope="col">密碼</th>
                        <th scope="col">
                            <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'cp_created_date' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            <i class="fas fa-sort-amount-down" style="<?= ($col == 'cp_created_date' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            註冊日期</th>
                        <th scope="col">logo</th>
                        <th scope="col">修改</th>
                        <th scope="col">刪除</th>
                    </tr>
                </thead>
                <tbody class="vertical">
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td><?= $r['sid'] ?></td>
                            <td><?= htmlentities($r['cp_name']) ?></td>
                            <td><?= htmlentities($r['cp_contact_p']) ?></td>
                            <td><?= htmlentities($r['cp_phone']) ?></td>
                            <td><?= htmlentities($r['cp_email']) ?></td>
                            <td><?= htmlentities($r['cp_address']) ?></td>
                            <td><?= htmlentities($r['cp_tax_id']) ?></td>
                            <td style="width:3vw"><?= htmlentities($stock[$r['sid']]["SUM(`vb_books`.`stock`)"]) ?></td>
                            <td><?= htmlentities($r['cp_account']) ?></td>
                            <td><?= htmlentities($r['cp_password']) ?></td>
                            <td><?= htmlentities($r['cp_created_date']) ?></td>
                            <td style="width:5.3vw">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#<?= 'logo' .  $r['sid']; ?>">
                                    <i class="fas fa-plus-circle"></i>
                                    顯示
                                </button>
                                <div class="modal fade" id="<?= 'logo' . $r['sid']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= 'logo' .  $r['sid']; ?>Title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="<?= $r['cp_name']; ?>Title"><?= $r['cp_name']; ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="width:450px;width:450px;margin:0 auto">
                                                <img style="object-fit: contain;width: 100%;height: 100%;" src="<?= 'logo/' . $r['cp_logo']; ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="CP_data_edit.php?sid=<?= $r['sid'] ?>">
                                    <button type="button" class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:delete_one(<?= $r['sid'] ?>)">
                                    <button type="button" class="btn btn-outline-primary">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- 我是分頁按鈕列 請自取並調整頁面擺放位置 -->
        <nav aria-label="Page navigation example">
            <ul class="pagination page-position ">
                <li class="page-item">
                    <a class="page-link" href="?page=1" aria-label="Previous">
                        <i class="fas fa-angle-double-left"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
                <?php
                if ($totalPages <= 5) {
                    $p_start = 1;
                    $p_end = $totalPages;
                } else if (($page - 2) < 1) {
                    $p_start = 1;
                    $p_end = 5;
                } else if (($page + 2) > $totalPages) {
                    $p_start = $totalPages - 4;
                    $p_end = $totalPages;
                } else {
                    $p_start = $page - 2;
                    $p_end = $page + 2;
                }
                for (
                    $i = $p_start;
                    $i <= $p_end;
                    $i++
                ) : $params['page'] = $i;
                    ?>
                    <li class="page-item ">
                        <a class="page-link" style="<?= $i == $page ? 'background: rgba(156, 197, 161, 0.5) ;color: #ffffff;' : '' ?>" href="?<?php
                                                                                                                                                    switch ($col) {
                                                                                                                                                        case 'sid':
                                                                                                                                                            $params['col'] = 'sid';
                                                                                                                                                            break;
                                                                                                                                                        case 'cp_name':
                                                                                                                                                            $params['col'] = 'cp_name';
                                                                                                                                                            break;
                                                                                                                                                        case 'created_date':
                                                                                                                                                            $params['col'] = 'created_date';
                                                                                                                                                            break;
                                                                                                                                                        case '':
                                                                                                                                                            $params['col'] = '';
                                                                                                                                                            break;
                                                                                                                                                    };
                                                                                                                                                    switch ($ord) {
                                                                                                                                                        case 'ASC':
                                                                                                                                                            $params['ord'] = 'ASC';
                                                                                                                                                            break;
                                                                                                                                                        case 'DESC':
                                                                                                                                                            $params['ord'] = 'DESC';
                                                                                                                                                            break;
                                                                                                                                                        case '':
                                                                                                                                                            $params['ord'] = '';
                                                                                                                                                            break;
                                                                                                                                                    };
                                                                                                                                                    echo http_build_query($params) ?>"><?= $i < 10 ? '0' . $i : $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next" style="width:100%">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $totalPages ?>" aria-label="Next">
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
</section>
</div>
<script>
    function data_insert() {
        location = "CP_data_insert.php";
    }
    let delete_confirm = document.querySelector('#delete_confirm');
    let a;

    function delete_one(sid) {
        a = sid;
        delete_confirm.style.display = 'block';
    }

    function delete_yes() {
        location.href = 'CP_data_delete.php?sid=' + a;
    }

    function delete_no() {
        location.href = window.location.href;
    }

    function goto_orderby(str) {
        location.href = '?' + str;
    }
</script>
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>