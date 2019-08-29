<?php

$page_name = 'coupon_list';
$page_title = '折價券列表';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

require __DIR__ . '/__connect_db.php';

$t_sql = 'SELECT COUNT(1) FROM `coupon`;';
$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

$per_page = 10;
$total_pages = ceil($total_rows / $per_page);

if ($page < 1) {
    header('Location: coupon_list.php');
}
if ($page > $total_pages) {
    header("Location: coupon_list.php?page=$total_pages");
}

$sql = sprintf('SELECT * FROM `coupon` ORDER BY `coupon_id` DESC LIMIT %s, %s', ($page - 1) * $per_page, $per_page);
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

$sql_limit = 'SELECT * FROM `pm_limit_by` WHERE 1';
$limit_const = $pdo->query($sql_limit)->fetchAll(PDO::FETCH_UNIQUE);

$rule_const = [
    '特殊',
    '金額',
    '百分比',
];
$send_const = [
    '自動使用',
    '全館發送',
    '優惠序號',
    '消費回饋',
    '生日禮',
];

?>


<?php
include __DIR__ . '/../../pbook_index/__html_head.php';
include __DIR__ . '/../../pbook_index/__html_body.php';
include __DIR__ . '/../../pbook_index/__navbar.php';
?>

    <div class="container-fluid pt-3 pb-5">

        <nav class="navbar justify-content-between mb-3" style="padding: 0px;width: 80vw;">
            <div>
                <h4>折價券列表</h4>
                <div class="title_line"></div>
            </div>
            <ul class="nav justify-content-between">
                <li class="nav-item">
                    <div style="padding: 0.375rem 0.75rem;">
                        <i class="fas fa-check"></i>
                        目前總計<?= $total_rows ?>筆資料
                    </div>
                </li>
                <li class="nav-item" style="margin: 0px 10px">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"
                            onclick="location.href='coupon_insert.php'">
                        <i class="fas fa-plus-circle"></i>
                        新增折價券
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


        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">編號</th>
                <th scope="col">內容</th>
                <th scope="col">券號</th>
                <th scope="col">規則</th>
                <th scope="col">折扣</th>
                <th scope="col">數量</th>
                <th scope="col">使用限制</th>
                <th scope="col">發送類型</th>
                <th scope="col">時間</th>
                <th scope="col">狀態</th>
                <th scope="col">修改</th>
                <th scope="col">刪除</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <th scope="row"><?= $r['coupon_id']; ?></th>
                    <td><?= htmlentities($r['coupon_content']); ?></td>
                    <td><?= htmlentities($r['coupon_no']); ?></td>
                    <td><?= $rule_const[$r['coupon_rule']]; ?></td>
                    <td><?= $r['coupon_price'].($r['coupon_rule'] == 2 ? '%' : '');?>
                    </td>
                    <td><?= $r['coupon_number']; ?></td>
                    <td><?= isset($limit_const[$r['coupon_limit']])?$limit_const[$r['coupon_limit']]['description']:'找不到限制規則'; ?></td>
                    <td><?= isset($send_const[$r['coupon_send_type']])?$send_const[$r['coupon_send_type']]:'找不到發送規則'; ?></td>
                    <td>
                        開始時間：<?= htmlentities($r['coupon_start_time']); ?><br>
                        結束時間：<?= htmlentities($r['coupon_end_time']); ?><br>
                        建立時間：<?= htmlentities($r['coupon_created_time']); ?>
                    </td>
                    <td><?= ($r['coupon_status'] == -1) ? '過期' : '已使用' . $r['coupon_status']; ?></td>
                    <td><a href="coupon_edit.php?coupon_id=<?= $r['coupon_id'] . '&page=' . $page ?>"><i
                                class="fas fa-edit"></i></a>
                    </td>
                    <td><a href="javascript:delete_one(<?= $r['coupon_id'] ?>)"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="?page=1"><i class="fas fa-angle-double-left"></i></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fas fa-angle-left"></i></a>
                </li>
                <?php
                if ($total_pages <= 5) {
                    $p_start = 1;
                    $p_end = $total_pages;
                } else if (($page - 2) < 1) {
                    $p_start = 1;
                    $p_end = 5;
                } else if (($page + 2) > $total_pages) {
                    $p_start = $total_pages - 4;
                    $p_end = $total_pages;
                } else {
                    $p_start = $page - 2;
                    $p_end = $page + 2;
                }
                for ($i = $p_start;
                     $i <= $p_end;
                     $i++) :
                    // if ($i < 1 or $i > $total_pages) {
                    //     continue;
                    // }
                    ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fas fa-angle-right"></i></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $total_pages ?>"><i class="fas fa-angle-double-right"></i></a>
                </li>
            </ul>
        </nav>

    </div>

    <script>
        function delete_one(coupon_id) {
            if (confirm(`是否刪除編號為${coupon_id}的資料？`)) {
                location.href = "coupon_delete.php?coupon_id=" + coupon_id + '&page=' + <?= $page ?>;
            }
        }
    </script>


<?php include __DIR__ . '/../../pbook_index/__html_foot.php'; ?>