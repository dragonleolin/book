<?php

$page_name = 'event_list';
$page_title = '活動列表';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

require __DIR__ . '/__connect_db.php';

$t_sql = 'SELECT COUNT(1) FROM `pm_event`;';
$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

$per_page = 10;
$total_pages = ceil($total_rows / $per_page);

if ($page < 1) {
    header('Location: event_list.php');
}
if ($page > $total_pages) {
    header("Location: event_list.php?page=$total_pages");
}

$sql = sprintf('SELECT * FROM `pm_event` ORDER BY `sid` DESC LIMIT %s, %s', ($page - 1) * $per_page, $per_page);
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

$sql = "SELECT * FROM `vb_categories` WHERE 1";
$cate_const = $pdo->query($sql)->fetchAll(PDO::FETCH_UNIQUE);

?>


<?php
include __DIR__ . '/../../pbook_index/__html_head.php';
include __DIR__ . '/../../pbook_index/__html_body.php';
include __DIR__ . '/../../pbook_index/__navbar.php';

$sql = 'SELECT * FROM `pm_rule` WHERE 1';
$rule_const = $pdo->query($sql)->fetchAll(PDO::FETCH_UNIQUE);
$user_level_const = [
    '無限制',
    '品書會員',
    '品書學徒',
    '品書專家',
    '品書大師',
    '品書至尊',
];

?>

    <div class="container-fluid pt-3 pb-5">

        <nav class="navbar justify-content-between mb-3" style="padding: 0px;width: 80vw;">
            <div>
                <h4>活動列表</h4>
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
                            onclick="location.href='event_insert.php'">
                        <i class="fas fa-plus-circle"></i>
                        新增活動
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
                <th scope="col">名稱</th>
                <th scope="col">適用會員</th>
                <th scope="col">規則</th>
                <th scope="col">折扣</th>
                <th scope="col">時間</th>
                <th scope="col">狀態</th>
                <th scope="col">適用品項</th>
                <th scope="col">修改</th>
                <th scope="col">刪除</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <th scope="row"><?= $r['sid']; ?></th>
                    <td><?= htmlentities($r['name']); ?></td>
                    <td><?= $user_level_const[$r['user_level']]; ?></td>
                    <td>
                        <?php
                        $parent_id = $rule_const[$r['rule']]['parent_id'];
                        echo empty($parent_id) ? "" : ($rule_const[$parent_id]['type'] . ':<br>');
                        ?>
                        <?= $rule_const[$r['rule']]['type']; ?>
                    </td>
                    <td>
                        <?php
                        if ($r['rule'] == 3 or $r['rule'] == 4) {
                            $sql = "SELECT d.* 
                                    FROM `pm_price_break_discounts` d JOIN `pm_event` e ON 
                                    d.`event_id` = e.`sid` WHERE e.`sid` = {$r['sid']}";
                            $discount_row = $pdo->query($sql)->fetchAll();
                            if (empty($discount_row)) {
                                echo '錯誤<br>請重新輸入';
                            } else {
                                $discount_type = $discount_row[0]['discount_type'] == 1 ? '元' : '%';
                                foreach ($discount_row as $k => $v) {
                                    printf("滿 %s元折 %s%s<br>", $v['price_limit'], $v['discounts'], $discount_type);
                                }
                            }
                        }
                        ?>
                    </td>
                    <td>
                        開始時間：<?= htmlentities($r['start_time']); ?><br>
                        結束時間：<?= htmlentities($r['end_time']); ?><br>
                    </td>
                    <td>
                        <?php
                        if ($r['status'] == -1) {
                            echo '過期';
                        } elseif ($r['status'] == 0) {
                            echo '未開始';
                        } elseif ($r['status'] == 1) {
                            echo '進行中';
                        } else {
                            echo '錯誤';
                        }
                        ?>
                    </td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#groupModal<?= $r['sid']; ?>">
                            <i class="fas fa-plus-circle"></i>
                            顯示
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="groupModal<?= $r['sid']; ?>" tabindex="-1" role="dialog"
                             aria-labelledby="groupModalLabel<?= $r['sid']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="groupModalLabel<?= $r['sid']; ?>">
                                            <?php
                                            if ($r['group_type'] == 1) {
                                                echo '適用類別';
                                            } elseif ($r['group_type'] == 2) {
                                                echo '書籍群組';
                                            } elseif ($r['group_type'] == 3) {
                                                echo '活動廠商';
                                            } else {
                                                echo '錯誤';
                                            }
                                            ?>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $sql = "SELECT bg.* 
                                            FROM `pm_books_group` bg JOIN `pm_event` e ON 
                                            bg.`event_id` = e.`sid` WHERE e.`sid` = {$r['sid']}";
                                        $book_group = $pdo->query($sql)->fetchAll();
                                        if(empty($book_group)){
                                            echo '全館適用';
                                        }
                                        else if($r['group_type']==1){
                                            foreach ($book_group as $k => $v){
                                                echo $cate_const[$v['categories_id']]['name'].'<br>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉
                                        </button>
                                        <button type="button" class="btn btn-primary">編輯</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><a href="event_edit.php?event_id=<?= $r['sid'] . ' & page = ' . $page ?>"><i
                                    class="fas fa-edit"></i></a>
                    </td>
                    <td><a href="javascript:delete_one(<?= $r['sid'] ?>)"><i class="fas fa-trash-alt"></i></a>
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
        function delete_one(event_id) {
            if (confirm(`是否刪除編號為${event_id}的資料？`)) {
                location.href = "event_delete.php?event_id=" + event_id + ' & page = ' + <?= $page ?>;
            }
        }
    </script>


<?php include __DIR__ . '/../../pbook_index /__html_foot.php'; ?>