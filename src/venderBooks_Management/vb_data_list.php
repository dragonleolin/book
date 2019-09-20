<?php
// require __DIR__ . '/__admin_required.php';
require __DIR__ . '/__connect_db.php';
$page_name = 'vb_data_list';
$page_title = '出版社書籍總表';


$books_sql = "SELECT `vb_books`.*, `cp_data_list`.`cp_name` publishing
                    FROM `vb_books`  LEFT JOIN `cp_data_list` ON `vb_books`.`publishing` = `cp_data_list`.`sid`";

$books_stmt = $pdo->query($books_sql);


$cat_sql = "SELECT * FROM `vb_categories`";
$cates = $pdo->query($cat_sql)->fetchAll();
$cate_dict = [];
foreach ($cates as $r) {
    $cate_dict[$r['sid']] = $r['name'];
}

?>

<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

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
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<div style="z-index:999;width:100vw;height:100vh;display:none;background:rgba(0,0,0,0.2)" id="my_delete" class="position-absolute">
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
<section class="pt-3">
    <div class="container-fluid">
        <nav class="navbar justify-content-between mb-2">
            <div>
                <h4>出版社書籍總表</h4>
                <div class="title_line"></div>
            </div>
            <div class="d-flex">
                <ul class="nav">
                    <li class="nav-item">
                        <div id="btnGroupDrop1" class="position-relative" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <button type="submit" class="btn btn-outline-dark" onclick="vb_data_delete('check[]')">
                                <i class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;批次刪除
                            </button>
                        </div>
                    </li>
                </ul>
                <ul class="nav">
                    <li class="nav-item" style="margin-right:10px">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick="vb_data_insert()">
                            <i class="fas fa-plus-circle"></i>
                            新增出版社書籍
                        </button>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- 每個人填資料的區塊 -->
        <div class="container-fluid">
            <table id="table" class="table table-striped table-bordered text-center compact">
                <thead>
                    <tr>
                        <th scope="col"><input type="checkbox" id="all_check" value="all_check" name="all_check" onclick="check_all(this,'check[]')"></th>
<<<<<<< HEAD
                        <th scope="col">SID</th>
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
=======
                        <th scope="col">No.</th>
                        <th scope="col">
                            <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'sid' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            <i class="fas fa-sort-amount-down" style="<?= ($col == 'sid' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            SID</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">書籍名稱</th>
                        <th scope="col">詳細資料</th>
                        <th scope="col">
                            <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'categories' &&  $ord == 'ASC') ? 'display:inline-block;;color:#ffc408' : 'display:none;' ?>"></i>
                            <i class="fas fa-sort-amount-down" style="<?= ($col == 'categories' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            分類</th>
                        <th scope="col">作者</th>
                        <th scope="col">
                            <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'publishing' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            <i class="fas fa-sort-amount-down" style="<?= ($col == 'publishing' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            出版社</th>
                        <th scope="col">
                            <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'publish_date' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            <i class="fas fa-sort-amount-down" style="<?= ($col == 'publish_date' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            出版日期</th>
                        <th scope="col">
                            <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'fixed_price' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            <i class="fas fa-sort-amount-down" style="<?= ($col == 'fixed_price' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            定價</th>
                        <th scope="col">狀態</th>
                        <th scope="col">
                            <i class="fas fa-sort-amount-down-alt" style="<?= ($col == 'stock' &&  $ord == 'ASC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            <i class="fas fa-sort-amount-down" style="<?= ($col == 'stock' && $ord == 'DESC') ? 'display:inline-block;color:#ffc408' : 'display:none;' ?>"></i>
                            庫存</th>
>>>>>>> 6dee688bfd23993737a985c4f5538930fce72557
                        <th scope="col">修改</th>
                        <th scope="col">刪除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $books_stmt->fetchAll();
                    for ($i = 0; $i < count($row); $i++) : ?>

                        <tr>
                            <td style="vertical-align:middle;"><input type="checkbox" name="check[]" id="check<?= $row[$i]['sid'] ?>" value="<?= $row[$i]['sid'] ?>"></td>

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
                                                    <img style="object-fit: contain;width: 100%;height: 100%;" src="<?= 'vb_images/' . $row[$i]['pic']; ?>" alt="">
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
                            <td style="vertical-align:middle;"><?= $row[$i]['fixed_price']; ?></td>
                            <td style="vertical-align:middle;"><?= $row[$i]['status']; ?></td>
                            <td style="vertical-align:middle;"><?= $row[$i]['stock']; ?></td>
                            <td style="vertical-align:middle;"><a href="vb_data_update.php?sid=<?= $row[$i]['sid'] ?>"><i class="fas fa-edit"></i></a></td>
                            <td style="vertical-align:middle;"><a href="#" onclick="delete_one(<?= $row[$i]['sid'] ?>)" id="btn_delete"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>

<<<<<<< HEAD
=======
        <!-- 我是分頁按鈕列 請自取並調整頁面擺放位置 -->
        <nav aria-label="Page navigation example" class="page-position">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="?<?php
                                                $params['page'] = 1;
                                                $params['col'] = isset($_GET['col']) ? $_GET['col'] : '';
                                                $params['ord'] = isset($_GET['ord']) ? $_GET['ord'] : '';
                                                echo http_build_query($params) ?>" aria-label="Next">
                        <i class="fas fa-angle-double-left"></i>
                    </a>
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
                        <button type="submit" class="btn btn-outline-dark" onclick="vb_data_delete('check[]')">
                            <i class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;批次刪除
                        </button>
                    </div>
                </li>
                <!-- <li class="nav-item">
                    <div id="btnGroupDrop1" class="position-relative" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-outline-dark" onclick="vb_data_update('check[]')">
                            <i class="fas fa-edit"></i>&nbsp;&nbsp;&nbsp;修改
                        </button>
                    </div>
                </li> -->
                <!-- <li class="nav-item">
                    <div id="btnGroupDrop1" class="position-relative" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="submit" class="btn btn-outline-dark">
                            <i class="fas fa-copy"></i>&nbsp;&nbsp;&nbsp;複製
                        </button>
                    </div>
                </li> -->
            </ul>
        </nav>

>>>>>>> 6dee688bfd23993737a985c4f5538930fce72557
    </div>
</section>
</div>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $("#table").DataTable();

    function check_all(obj, cName) {
        var checkboxes = document.getElementsByName(cName);
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = obj.checked;
        }
    }

    function vb_data_delete(cName) {
        var checkboxes = document.getElementsByName(cName);
        let ar = [];
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                ar.push(checkboxes[i].value);
            }
        }
        document.cookie = "checkbox_sid=" + ar;
        location = "vb_data_delete.php";
    }


    function vb_data_insert() {
        location = "vb_data_insert.php";
    }


    let b;
    function change_data(sid) {
        b = sid;
        location = 'vb_data_update.php?sid=' + b;
    }

    function next_data(i){
        i++;
        return i;
    }


    let a;
    function delete_one(sid) {
        a = sid;
        let my_delete = document.querySelector('#my_delete');
        my_delete.style.display = 'block';
    }


    function delete_yes() {
        location.href = 'vb_data_delete.php?sid=' + a;
    }


    function delete_no() {
        location.href = 'vb_data_list.php?page=';
    }


    function goto_orderby(str) {
        location.href = '?' + str;
    }
</script>
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>