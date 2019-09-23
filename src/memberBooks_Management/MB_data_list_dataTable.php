<?php
require __DIR__ . '/../../vendor/autoload.php';

use Tracy\Debugger;

Debugger::enable();

require __DIR__ . '/__admin_required.php';

require __DIR__ . '/__connect_db.php';

$page_name = 'MB_data_list';
$page_title = '會員書籍總表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10;

//搜尋功能
$search = isset($_GET['search']) ? $_GET['search'] : '';
$params = [];
$where = ' WHERE 1 ';
if (!empty($search)) {
    $params['search'] = $search;
    $search = $pdo->quote("%$search%");
    $where .= " AND (`mb_name` LIKE $search  OR `mb_categories` LIKE $search OR `mb_author` LIKE $search OR `mb_publishing` LIKE $search OR `mb_shelveMember` LIKE $search) ";
}

$t_sql = "SELECT COUNT(1) FROM `mb_books` $where";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $per_page);




$page_sql = "SELECT `mb_books`.*, `vb_categories`.`name` categories_name 
FROM `mb_books`  LEFT JOIN `vb_categories` ON `mb_books`.`mb_categories` = `vb_categories`.`sid` $where ORDER BY `mb_sid`";

$t_stmt = $pdo->query($page_sql);
$row = $t_stmt->fetchAll();
?>

<?php include __DIR__ . '/../../pbook_index/__html_head.php' ?>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link href="./css/lightbox.css" rel="stylesheet" />
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }

    .page-position {
        position: absolute;
        bottom: 3%;
        left: 50%;
    }

    .textHidden {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>
<?php include __DIR__ . '/../../pbook_index/__html_body.php' ?>
<?php include __DIR__ . '/../../pbook_index/__navbar.php' ?>

<!-- 右邊section資料欄位 -->
<section class="position-relative">
    <div class="container">
        <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
            <div>
                <h4>會員書籍總表</h4>
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
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" id="addData">
                        <i class="fas fa-plus-circle"></i>
                        新增會員書籍
                    </button>
                </li>
            </ul>
        </nav>

        <!-- 每個人填資料的區塊 -->
        <div style="margin-top: 1rem; min-width: 80vw">
            <form method="post" id="form1" enctype="multipart/form-data" action="">
                <table class="table table-striped table-bordered" style="text-align: center ; " id="sortable">
                    <thead>
                        <tr>
                            <th scope="col"><input type="checkbox" id="checkAll" name="checkAll"></th>
                            <th scope="col" data-sort="number">SID</th>
                            <th scope="col" data-sort="number">ISBN</th>
                            <th scope="col" data-sort="name">書籍名稱</th>
                            <th scope="col">書籍圖片</th>
                            <th scope="col">分類</th>
                            <th scope="col" data-sort="name">作者</th>
                            <th scope="col" data-sort="name">出版社</th>
                            <th scope="col" data-sort="date">出版日期</th>
                            <th scope="col">版次</th>
                            <th scope="col" class="textHidden">定價</th>
                            <th scope="col" class="textHidden">頁數</th>
                            <th scope="col">狀況</th>
                            <th scope="col" data-sort="name">上架會員</th>
                            <th scope="col" data-sort="date">上架時間</th>
                            <th scope="col" class="textHidden">修改</th>
                            <th scope="col" class="textHidden">刪除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($row as $r) : ?>
                            <tr>
                                <td style="vertical-align:middle;"><input type="checkbox" class="j-checkbox" name="check[]" value="<?= $r['mb_sid'] ?>"></td>
                                <td id="sid"><?= $r['mb_sid'] ?></td>
                                <td><?= htmlentities($r['mb_isbn']) ?></td>
                                <td class="textHidden"><?= htmlentities($r['mb_name']) ?></td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary textHidden" data-toggle="modal" data-target="#<?= 'book' . $r['mb_sid']; ?>">
                                        <i class="fas fa-plus-circle"></i>
                                        顯示
                                    </button>
                                    <div class="modal fade" id="<?= 'book' . $r['mb_sid']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= 'book' . $r['mb_sid']; ?>Title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="<?= 'book' . $r['mb_sid']; ?>Title"><?= $r['mb_name']; ?></h5>

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>


                                                <?php
                                                    $a = json_decode($r['mb_pic']);
                                                    ?>
                                                <a href="<?= 'mb_images/' . $a[0]; ?>" data-lightbox="image">
                                                    <img src="<?= 'mb_images/' . $a[0]; ?>" class="d-block w-100" alt="...">
                                                </a>
                                                <a href="<?= 'mb_images/' . $a[1]; ?>" data-lightbox="image">
                                                    <img src="<?= 'mb_images/' . $a[1]; ?>" class="d-block w-100" alt="...">
                                                </a>
                                                <a href="<?= 'mb_images/' . $a[2]; ?>" data-lightbox="image">
                                                    <img src="<?= 'mb_images/' . $a[2]; ?>" class="d-block w-100" alt="...">
                                                </a>

                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                                    <button type="button" id="changeImg" class="btn btn-primary" onclick="change_img(<?= $r['mb_sid'] ?>)">修改圖片</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="textHidden"><?= htmlentities($r['categories_name']) ?></td>
                                <td class="textHidden"><?= htmlentities($r['mb_author']) ?></td>
                                <td class="textHidden"><?= htmlentities($r['mb_publishing']) ?></td>
                                <td class="textHidden"><?= htmlentities($r['mb_publishDate']) ?></td>
                                <td class="textHidden"><?= htmlentities($r['mb_version']) ?></td>
                                <td><?= htmlentities($r['mb_fixedPrice']) ?></td>
                                <td><?= htmlentities($r['mb_page']) ?></td>
                                <td class="textHidden"><?= htmlentities($r['mb_savingStatus']) ?></td>
                                <td class="textHidden"><?= htmlentities($r['mb_shelveMember']) ?></td>
                                <td class="textHidden"><?= htmlentities($r['mb_shelveDate']) ?></td>
                                <td><a href="MB_update.php?mb_sid=<?= $r['mb_sid'] ?>"><i class="fas fa-edit"></i></a></td>
                                <td><a href="javascript:delete_one(<?= $r['mb_sid'] ?>)"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        <?php
                        endforeach; ?>

                    </tbody>
                </table>
                <nav class="navbar justify-content-between" style="padding: 0px;width: 20vw;margin:10px 0px -10px 0px">
                    <ul class="nav justify-content-between">
                        <li class="nav-item">
                            <div id="btnGroupDrop1" class="position-relative" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button type="submit" class="btn btn-outline-dark" id="delete_multiple">
                                    <i class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp;批次刪除
                                </button>
                            </div>
                        </li>
                    </ul>
                </nav>
            </form>

            



            <!-- 刪除提示框 -->
            <div class="delete update card" id="deleteType" style="display: none;">
                <div class="delete card-body">
                    <label class="delete_text" id="delete_info"></label>
                    <div>
                        <button type="button" class="delete btn btn-danger" id="confirm">確認</button>
                        <button type="button" class="delete btn btn-warning" id="cancel">取消</button>
                    </div>
                </div>
            </div>

</section>

<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="./js/lightbox.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': false,
        'showImageNumberLabel': false
    })
</script>
<script>
    $(document).ready(function() {
        $('#sortable').DataTable();
    });

    $(function() {
        //全選全不選功能模塊
        $('#checkAll').change(function() {
            $(".j-checkbox").prop("checked", $(this).prop('checked'))
            // $("tr").css("background", "transparent")
            // $(":checked").closest('tr').css("background", "#9cc5a1")
        })

        //若複選按鈕個數為全部，要把全選按鈕打勾
        $('.j-checkbox').change(function() {
            if ($('.j-checkbox:checked').length === $('.j-checkbox').length) {
                $('#checkAll').prop("checked", true)
            } else {
                $('#checkAll').prop("checked", false)
            }
            // $("tr").css("background", "transparent")
            // $(":checked").closest('tr').css("background", "#9cc5a1")
        })

    })


    // var form = document.getElementById('form1')
    //JQ的getElement要使用[0]
    let form = $('#form1')[0]

    $('#delete_multiple').click(function() {
        form.action = 'MB_deleteMuti.php'
        console.log(form.action)
        form.submit();
    })



    $(function() {
        $('#addData').click(function() {
            location = "MB_insert.php";
        })
    })


    function change_img(mb_sid) {
        let b = mb_sid;
        location = "MB_update.php?mb_sid=" + b;
    }



    function delete_one(mb_sid) {
        let delete_info = document.querySelector('#delete_info');
        $('#deleteType').css("display", "block")

        delete_info.innerHTML = `確定要刪除編號${mb_sid}的資料嗎?`;
        $('#confirm').click(function() {
            location.href = 'MB_delete.php?mb_sid=' + mb_sid;
        })
        $('#cancel').click(function() {
            location.href = window.location.href;
        })
    }




    // }
</script>
</div>
<?php include __DIR__ . '/../../pbook_index/__html_foot.php' ?>