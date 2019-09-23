<?php
require __DIR__ . '/__admin_required.php';
require __DIR__ . '/__connect_db.php';


$page_name = 'vb_data_list';
$page_title = '出版社書籍總表';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶選取的頁數
$per_page = 10; //每頁幾筆資料

$search = isset($_GET['search']) ? $_GET['search'] : '';
$col = isset($_GET['col']) ? $_GET['col'] : '';
$ord = isset($_GET['ord']) ? $_GET['ord'] : '';
$allow = $_SESSION['loginUser2']['sid'];

$params = [];
$where = ' WHERE 1 ';
$where .= "  AND( `vb_books`.`publishing` = $allow )";
if (!empty($search)) {
    $params['search'] = $search;
    $search = $pdo->quote("%$search%");
    $where .= "AND (`isbn` LIKE $search OR `vb_books`.`name` LIKE $search OR `publishing` LIKE $search )";
}
$orderby = '';
if (!empty($col)) {
    $orderby = " ORDER BY `vb_books`.`$col` $ord ";
    $params['col'] = $col;
    $params['ord'] = $ord;
}

$t_sql = "SELECT COUNT(1) FROM `vb_books` $where";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
$totalPages = ceil($totalRows / $per_page); //取得總頁數


if ($page < 1) {
    $params['page'] = 1;
    $params['col'] = isset($_GET['col']) ? $_GET['col'] : '';
    $params['ord'] = isset($_GET['ord']) ? $_GET['ord'] : '';
    header('Location: vb_data_list.php?' . http_build_query($params));
};

if ($page > $totalPages) {
    $params['page'] = $totalPages;
    $params['col'] = isset($_GET['col']) ? $_GET['col'] : '';
    $params['ord'] = isset($_GET['ord']) ? $_GET['ord'] : '';
    header('Location: vb_data_list.php?' . http_build_query($params));
};


$books_sql = "SELECT `vb_books`.*, `cp_data_list`.`cp_name` publishing
                    FROM `vb_books`  LEFT JOIN `cp_data_list` ON `vb_books`.`publishing` = `cp_data_list`.`sid` $where
                    $orderby LIMIT " . (($page - 1) * $per_page) . "," . $per_page;
$books_stmt = $pdo->query($books_sql);


$cat_sql = "SELECT * FROM `vb_categories` ";
$cates = $pdo->query($cat_sql)->fetchAll();
$cate_dict = [];
foreach ($cates as $r) {
    $cate_dict[$r['sid']] = $r['name'];
}


?>

<?php include __DIR__ . '/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }

    .page-position {
        position: absolute;
        bottom: 2%;
        left: 50%;
    }

    .page-item.active .page-link {
        z-index: 99;
        color: #ffffff;
        background-color: rgba(156, 197, 161, 0.5);
        border-color: transparent;
    }
</style>
<?php include __DIR__ . '/__html_body.php' ?>
<!-- <div style="z-index:999;width:100vw;height:100vh;display:none;background:rgba(0,0,0,0.2)" id="my_delete" class="position-absolute">
    <div class="delete update card">
        <div class="delete card-body">
            <label class="delete_text">您確認要刪除資料嗎?</label>
            <div>
                <button type="button" class="delete btn btn-danger" onclick="delete_yes()">確認</button>
                <button type="button" class="delete btn btn-warning" onclick="delete_no()">取消</button>
            </div>
        </div>
    </div>
</div> -->
<?php include __DIR__ . '/__navbar.php' ?>
<!-- 右邊section資料欄位 -->
<div>
    <div class="container">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h4>出版社書籍總表</h4>
                <div class="title_line"></div>
            </div>
        </nav>
        <nav class="navbar justify-content-between" style="padding: 0px;width: 83vw;margin:10px 0px -10px 0px">
            <ul class="nav justify-content-between">
                <li class="nav-item">
                    <div style="padding: 0.375rem 0.75rem;">
                        資料排序：
                    </div>
                </li>
                <li class="nav-item">
                    <div id="btnGroupDrop1" class="position-relative" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-outline-dark">
                            <i class="fas fa-sort"></i>&nbsp;&nbsp;&nbsp;依SID
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
                            <i class="fas fa-sort"></i>&nbsp;&nbsp;&nbsp;依分類
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'categories';
                                                                                        $params['ord'] = 'ASC';
                                                                                        echo http_build_query($params) ?>')">小→大</a>
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'categories';
                                                                                        $params['ord'] = 'DESC';
                                                                                        echo http_build_query($params) ?>')">大→小</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div id="btnGroupDrop1" class="position-relative" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-outline-dark">
                            <i class="fas fa-sort"></i>&nbsp;&nbsp;&nbsp;依出版日期
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'publish_date';
                                                                                        $params['ord'] = 'ASC';
                                                                                        echo http_build_query($params) ?>')">小→大</a>
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'publish_date';
                                                                                        $params['ord'] = 'DESC';
                                                                                        echo http_build_query($params) ?>')">大→小</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div id="" class="position-relative" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-outline-dark">
                            <i class="fas fa-sort"></i>&nbsp;&nbsp;&nbsp;依定價
                        </button>
                        <div class="dropdown-menu" aria-labelledby="">
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'fixed_price';
                                                                                        $params['ord'] = 'ASC';
                                                                                        echo http_build_query($params) ?>')">小→大</a>
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'fixed_price';
                                                                                        $params['ord'] = 'DESC';
                                                                                        echo http_build_query($params) ?>')">大→小</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div id="btnGroupDrop1" class="position-relative" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-outline-dark">
                            <i class="fas fa-sort"></i>&nbsp;&nbsp;&nbsp;依庫存
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'stock';
                                                                                        $params['ord'] = 'ASC';
                                                                                        echo http_build_query($params) ?>')">小→大</a>
                            <a class="dropdown-item" href="#" onclick="goto_orderby('<?php $params['col'] = 'stock';
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
                <li class="nav-item" style="margin-right:10px">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick="vb_data_insert()">
                        <i class="fas fa-plus-circle"></i>
                        新增出版社書籍
                    </button>
                </li>
                <li class="nav-item" style="flex-grow: 1">
                    <form name="form2" class="form-inline my-2 my-lg-0">
                        <input class="search form-control mr-sm-2" id="search" name="search" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit" onclick="search_text()">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- 每個人填資料的區塊 -->
        <div style="margin-top: 1.5rem">
            <form method="post" id="delete_form" enctype="multipart/form-data">
                <table class="table table-striped table-bordered" style="text-align: center;width:83vw">
                    <thead>
                        <tr>
                            <th scope="col"><input type="checkbox" id="all_check" value="all_check" name="all_check"></th>
                            <th scope="col">No.</th>
                            <th scope="col">
                                <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'sid' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                                <i class="fas fa-sort-amount-down" style="<?= ($col == 'sid' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                                SID</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">書籍名稱</th>
                            <th scope="col">詳細內容</th>
                            <th scope="col">
                                <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'categories' &&  $ord == 'ASC') ? 'display:inline-block;;color:#ffc408' : 'display:none;' ?>"></i>
                                <i class="fas fa-sort-amount-down" style="<?= ($col == 'categories' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                                分類</th>
                            <th scope="col">作者</th>
                            <th scope="col">出版社</th>
                            <th scope="col">
                                <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'publish_date' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                                <i class="fas fa-sort-amount-down" style="<?= ($col == 'publish_date' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                                出版日期</th>
                            <th scope="col">版次</th>
                            <th scope="col">
                                <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'fixed_price' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                                <i class="fas fa-sort-amount-down" style="<?= ($col == 'fixed_price' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                                定價</th>
                            <th scope="col">頁數</th>
                            <th scope="col">
                                <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'stock' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                                <i class="fas fa-sort-amount-down" style="<?= ($col == 'stock' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                                庫存</th>
                            <th scope="col">修改</th>
                            <th scope="col">刪除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row = $books_stmt->fetchAll();
                        for ($i = 0; $i < count($row); $i++) : ?>
                            <tr>
                                <td style="vertical-align:middle;"><input class="checkbox" type="checkbox" name="check[]" id="check<?= $row[$i]['sid'] ?>" value="<?= $row[$i]['sid'] ?>"></td>
                                <td style="vertical-align:middle;"><?= (($page - 1) * $per_page) + ($i + 1) ?></td>
                                <td style="vertical-align:middle;"><?= $row[$i]['sid']; ?></td>
                                <td style="vertical-align:middle;"><?= $row[$i]['isbn']; ?></td>
                                <td style="vertical-align:middle;"><?= $row[$i]['name']; ?></td>
                                <td style="vertical-align:middle;">
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#<?= 'book' . $row[$i]['sid']; ?>">
                                        <i class="fas fa-plus-circle"></i>
                                        顯示
                                    </button>
                                    <div class="modal fade" id="<?= 'book' . $row[$i]['sid']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= 'book' . $row[$i]['sid']; ?>Title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="<?= 'book' . $row[$i]['sid']; ?>Title"><?= $row[$i]['name']; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="d-flex" style="padding:20px">
                                                    <div style="width:350px">
                                                        <img style="object-fit: contain;width: 100%;height: 100%;" src="<?= '../venderBooks_Management/vb_images/' . $row[$i]['pic']; ?>" alt="">
                                                    </div>
                                                    <div style="text-align:left;width:300px">
                                                        <h5>・ISBN：<?= $row[$i]['isbn']; ?></h5>
                                                        <h5>・分類：<?= $cate_dict[$row[$i]['categories']]; ?></h5>
                                                        <h5>・作者：<?= $row[$i]['author']; ?></h5>
                                                        <h5>・出版社：<?= $row[$i]['publishing']; ?></h5>
                                                        <h5>・出版日期：<?= $row[$i]['publish_date']; ?></h5>
                                                        <h5>・版次：<?= $row[$i]['version']; ?></h5>
                                                        <h5>・定價：NT<?= $row[$i]['fixed_price']; ?></h5>
                                                        <h5>・頁數：<?= $row[$i]['page']; ?>頁</h5>
                                                    </div>
                                                    <div style="text-align:left;width:400px;z-index:999">
                                                        <h5>書籍簡介：</h5>
                                                        <h5><?= $row[$i]['introduction']; ?></h5>
                                                    </div>
                                                    <div style="width:130px;height:130px;position:absolute;bottom:15%;right:3%;">
                                                        <img style="object-fit: contain;width: 100%;height: 100%;" src="../../images/品書印章.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                                    <button type="button" class="btn btn-primary" onclick="change_data(<?= $row[$i]['sid'] ?>)">修改資料</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align:middle;"><?= $cate_dict[$row[$i]['categories']]; ?></td>
                                <td style="vertical-align:middle;"><?= $row[$i]['author']; ?></td>
                                <td style="vertical-align:middle;"><?= $row[$i]['publishing']; ?></td>
                                <td style="vertical-align:middle;"><?= $row[$i]['publish_date']; ?></td>
                                <td style="vertical-align:middle;"><?= $row[$i]['version']; ?></td>
                                <td style="vertical-align:middle;"><?= $row[$i]['fixed_price']; ?></td>
                                <td style="vertical-align:middle;"><?= $row[$i]['page']; ?></td>
                                <td style="vertical-align:middle;"><?= $row[$i]['stock']; ?></td>
                                <td style="vertical-align:middle;"><a href="vb_data_update.php?sid=<?= $row[$i]['sid'] ?>"><i class="fas fa-edit"></i></a></td>
                                <td style="vertical-align:middle;"><a href="#" onclick="delete_one(<?= $row[$i]['sid'] ?>)" id="btn_delete"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </form>
        </div>

        <!-- 我是分頁按鈕列 請自取並調整頁面擺放位置 -->
        <nav aria-label="Page navigation example" class="page-position">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="?<?php
                                                $params['page'] = 1;
                                                $params['col'] = isset($_GET['col']) ? $_GET['col'] : '';
                                                $params['ord'] = isset($_GET['ord']) ? $_GET['ord'] : '';
                                                echo http_build_query($params) ?>"><i class="fas fa-angle-double-left"></i></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?<?php
                                                $params['page'] = $page - 1;
                                                $params['col'] = isset($_GET['col']) ? $_GET['col'] : '';
                                                $params['ord'] = isset($_GET['ord']) ? $_GET['ord'] : '';
                                                echo http_build_query($params) ?>"><i class="fas fa-angle-left"></i></a>
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
                    // if ($i < 1 or $i > $totalPages) {
                    //     continue;
                    // }
                    ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?<?php
                                                        $params['col'] = isset($_GET['col']) ? $_GET['col'] : '';
                                                        $params['ord'] = isset($_GET['ord']) ? $_GET['ord'] : '';
                                                        echo http_build_query($params) ?>"><?= $i < 10 ? '0' . $i : $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="?<?php
                                                $params['page'] = $page + 1;
                                                $params['col'] = isset($_GET['col']) ? $_GET['col'] : '';
                                                $params['ord'] = isset($_GET['ord']) ? $_GET['ord'] : '';
                                                echo http_build_query($params) ?>"><i class="fas fa-angle-right"></i></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?<?php
                                                $params['page'] = $totalPages;
                                                $params['col'] = isset($_GET['col']) ? $_GET['col'] : '';
                                                $params['ord'] = isset($_GET['ord']) ? $_GET['ord'] : '';
                                                echo http_build_query($params) ?>"><i class="fas fa-angle-double-right"></i></a>
                </li>
            </ul>
        </nav>

        <nav class="navbar justify-content-between" style="padding: 0px;width: 20vw;margin:10px 0px -10px 0px">
            <ul class="nav justify-content-between">
                <li class="nav-item">
                    <div id="btnGroupDrop1" class="position-relative" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="submit" class="btn btn-outline-dark" onclick="vb_data_delete()">
                            <i class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;批次刪除
                        </button>
                    </div>
                </li>
            </ul>
        </nav>

    </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $("#all_check").click(function() {
        let checkAll = $(this).prop("checked");
        $("tbody .checkbox").prop("checked", checkAll);
        $("tbody .checkbox").prop("checked") ? $("tbody .checkbox").closest("tr").addClass('table-active') : $("tbody .checkbox").closest("tr").removeClass('table-active');
    })

    $("tbody").on("click", ".checkbox", function() {
        dataCount()
        let checked = $(this).prop("checked");
        if (checked) {
            $(this).closest("tr").addClass("table-active");
        } else {
            $(this).closest("tr").removeClass("table-active");
        }
    })

    function dataCount() {
        let dataCount = $("tbody .checkbox").length;
        let checkedCount = $("tbody :checked").length;
        if (checkedCount == dataCount) {
            $("#all_check").prop("checked", true)
        } else {
            $("#all_check").prop("checked", false)
        }
    }


    function vb_data_delete() {
        Swal.fire({
            title: '您確認要刪除資料嗎?',
            text: "刪除後無法恢復原狀喔!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '確認!',
            cancelButtonText: '取消!',
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '確認刪除!',
                    '您所選取的資料已經成功刪除',
                    'success'
                )
                setTimeout(function() {
                    $("#delete_form")[0].action = 'vb_data_delete.php'
                    $("#delete_form")[0].submit();
                }, 2000)
            }
        })
    }


    function vb_data_insert() {
        location = "vb_data_insert.php";
    }

    let b;

    function change_data(sid) {
        b = sid;
        location = 'vb_data_update.php?sid=' + b;
    }

    let a;

    function delete_one(sid) {
        Swal.fire({
            title: '您確認要刪除資料嗎?',
            text: "刪除後無法恢復原狀喔!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '確認!',
            cancelButtonText: '取消!',
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '確認刪除!',
                    '您所選取的資料已經成功刪除',
                    'success'
                )
                setTimeout(function() {
                    location.href = 'vb_data_delete.php?sid=' + sid;
                }, 2000)
            }
        })
    }


    function goto_orderby(str) {
        location.href = '?' + str;
    }
</script>
<?php include __DIR__ . '/__html_foot.php' ?>