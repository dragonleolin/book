<?php //require __DIR__ . '/__admin_required.php' 
?>
<?php require  'MR_db_connect.php' ?>
<?php
$thead_item = [
    '#', '編號', '等級', '姓名', '暱稱', '電子信箱', '性別', '生日', '手機',
];

$page_title = '資料列表';

$item_switch = [
    'sid' => 'SID',
    'MR_number' => '會員編號',
    'MR_name' => '會員姓名',
    'MR_password' => '會員密碼',
    'MR_nickname' => '暱&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp稱',
    'MR_email' => '電子信箱',
    'MR_gender' => '性&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp別',
    'MR_birthday' => '生&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp日',
    'MR_mobile' => '手&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp機',
    'MR_career' => '職&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp業',
    'MR_address' => '地&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp址',
    'MR_pic' => '頭像路徑',
    'MR_imageloactionX' => '頭像位置X',
    'MR_imageloactionY' => '頭像位置Y',
    'MR_personLevel' => '會員等級',
    'MR_createdDate' => '創建日期'
];
$a_level = [
    '',
    '品書會員',
    '品書學徒',
    '品書專家',
    '品書大師',
    '品書至尊',
];

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;


$per_page = 10; // 每頁顯示的筆數

$search = isset($_GET['search']) ? $_GET['search'] : '';
$params = [];
$where = ' WHERE 1 ';
if (!empty($search)) {
    $params['search'] = $search;
    $search1 = $pdo->quote("%$search%");
    $where .= " AND (`MR_name` LIKE $search1 OR `MR_email` LIKE $search1 OR `MR_mobile` LIKE $search1 OR `MR_number` LIKE $search1 )";
}

$count = "SELECT COUNT(1) FROM `mr_information` $where"; //用count計算出總筆數

$totalRows = $pdo->query($count)->fetch(PDO::FETCH_NUM)[0];

// echo "$totalRows <br>";
$totalPage = ceil($totalRows / $per_page); //ceil()無條件進位


if (($page < 1) | ($totalPage == 0)) {
    // header('Refresh:2; url=MR_memberDataList.php');
    header('Location: searchFail.php');
    exit;
}

if ($page > $totalPage) {
    header('Location: MR_memberDataList.php?page=' . $totalPage);
    exit;
}


$sql = "SELECT * FROM `mr_information` $where ORDER BY `sid` LIMIT " . ($page - 1) * $per_page . "," . $per_page;
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

?>
<?php include '../../pbook_index/__html_head.php' ?>
<style>
    body {
        background: url(../../images/bg.png) repeat center top;
    }

    ul li {
        list-style-type: none;
    }
    .check_icon1{
        top:0;
        right: 0;
    }   

    .modal-header {
        padding-left: 40px;
    }
</style>
<?php include '../../pbook_index/__html_body.php' ?>
<?php include '../../pbook_index/__navbar.php' ?>
<div id="outerSpace">
    <section class="justify-content-center p-4 container-fluid" id="table_content">
        <div class="container-fluid">
            <nav class="navbar justify-content-between" style="padding: 0px;width: 80vw;">
                <div class="d-flex">
                    <div>
                        <h4>會員列表</h4>
                        <div class="title_line"></div>
                    </div>
                    <?php if (!empty($search)) : ?>
                        <ul class="nav justify-content-between">
                            <li class="nav-item" style="margin: 0px 10px">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick='location.href = "MR_memberDataList.php"'>
                                    <i class="fas fa-arrow-circle-left"></i>
                                    回到上一頁
                                </button>
                            </li>
                        </ul>
                    <?php endif ?>
                </div>
                <ul class="nav justify-content-between">
                    <li class="nav-item">
                        <div style="padding: 0.375rem 0.75rem;">
                            <i class="fas fa-check"></i>
                            目前總計 <?= $totalRows ?> &nbsp筆資料
                        </div>
                    </li>
                    <li class="nav-item" style="margin: 0px 10px">
                        <button class="btn btn-outline-primary my-2 my-sm-0" onclick="location.href='MR_memberData_insert.php'">
                            <i class="fas fa-plus-circle"></i>
                            新增會員
                        </button>
                    </li>
                    <li class="nav-item" style="flex-grow: 1">
                        <form name="form2" class="form-inline my-2 my-lg-0">
                            <input class="search form-control mr-sm-2" id="search_bar" name="search" type="search" placeholder="請輸入會員編號、姓名、電子信、手機" aria-label="Search" style="width:320px">
                            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- 每個人填資料的區塊 -->
        <div class="container-fluid" style="margin-top: 1rem">


            <table class="table table-striped table-bordered" style="text-align: center">
                <thead>
                    <tr>
                        <ul class="nav" style="visibility: hidden" id="delete1">
                            <button class="btn btn-outline-primary my-2 my-sm-0 " id="multi_delete" onclick="delete_multiple(event)"><i class="fas fa-trash-alt"></i> &nbsp刪除</button>
                        </ul>
                    </tr>
                    <tr>
                        <!-- <th><a href="" id="all_check">
                            <div style="width:15px;height:15px;border: 2px solid #bbb"></div>
                            <i class="fas fa-angle-down" style="color:#bbb;margin-left:5px"></i></a></th> -->
                        <th>
                            <input type="checkbox" onclick="check_all(this,'c')" id="all_check">
                            <i class="fas fa-angle-down" style="color:#bbb;margin-left:5px"></i>
                        </th>
                        <?php for ($i = 0; $i < count($thead_item); $i++) : ?>
                            <th scope="col"><?= $thead_item[$i] ?></th>
                        <?php endfor ?>
                        <th scope="col">詳細</th>
                        <th scope="col">修改</th>
                        <th scope="col">刪除</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $sequence = 0;
                    $sid = [];
                    foreach ($rows as $a) : $sequence++ ?>
                        <tr>
                            <td class="dis_relative">
                                <input type="checkbox" name="check[]" id="check<?= $sequence ?>" value="<?= $a['sid'] ?>">
                                <i class="far fa-square dis_absolute check_icon1" ></i>
                                <i class="far fa-check-square dis_absolute check_icon2"></i>
                            </td>

                            <td><?= $a['sid'] ?></td>
                            <td><?= htmlentities($a['MR_number']) ?></td>
                            <td><?php
                                    if ($a['MR_personLevel'] > 0 && $a['MR_personLevel'] <= 5) {
                                        echo htmlentities($a_level[$a['MR_personLevel']]);
                                    } else {
                                        echo '';
                                    } ?></td>
                            <td><?= htmlentities($a['MR_name']) ?></td>
                            <td><?= htmlentities($a['MR_nickname']) ?></td>
                            <td><?= htmlentities($a['MR_email']) ?></td>
                            <td><?= (htmlentities($a['MR_gender'])) ? '男' : '女' ?></td>
                            <td><?= htmlentities($a['MR_birthday']) ?></td>
                            <td><?= htmlentities($a['MR_mobile']) ?></td>
                            <td><a href="" data-toggle="modal" data-target="#exampleModalCenter<?= $sequence ?>">
                                    <i class="fas fa-plus-circle"></i>&nbsp&nbsp顯示
                                </a></td>
                            <td><a href="MR_memberData_update.php?sid=<?= $a['sid'] ?>"><i class="fas fa-edit"></i></a></td>
                            <td><a href="javascript:delete_one(<?= $a['sid'] ?>)"><i class="fas fa-trash-alt"></i></a></td>
                            <input type="hidden" id=`tdsid<?= $a['sid'] ?>` value="<?= $a['sid'] ?>">

                        </tr>
                    <?php $sid[] = $a['sid'];
                    endforeach ?>
                </tbody>
            </table>
        </div>
        <nav class="mt-5" aria-label="Page navigation example ">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link my_text_blacktea" href="?page=1" aria-label="Next">
                        <i class="fas fa-angle-double-left"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= ($page - 1 <= 0) ? 1 : $page - 1 ?>">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
                <?php
                $p_start = $page - 3;
                $p_end = $page + 3;
                if ($p_start <= 0) $p_end += -($p_start) + 1;
                if ($p_end > $totalPage) $p_start -= -($totalPage - $p_end);
                for ($i = $p_start; $i <= $p_end; $i++) :
                    if ($i < 1 or $i > $totalPage) continue;
                    //continue跳過該次迴圈
                    $params['page'] = $i;
                    ?>
                    <li class="page-item " style="<?= $i == $page ? 'background: rgba(156, 197, 161, 0.5) ;color: #ffffff;' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query($params) ?>"><?= $i ?></a></li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link my_text_blacktea" href="?page=<?= ($page + 1 > $totalPage) ? $totalPage : $page + 1 ?> ?>" aria-label="Next">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link my_text_blacktea" href="?page=<?= $totalPage ?>" aria-label="Next">
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <form action="" method="POST" name="form2">
            <input type="hidden" name="json">
        </form>

        <!-- Modal -->
        <?php for ($i = 0; $i < count($rows); $i++) : ?>
            <?php $details = $rows[$i]; ?>
            <?php $MR_number = $details['MR_number']; ?>
            <div class="modal fade" id="exampleModalCenter<?= $i + 1; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:1200px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">會員資料 </h5>
                            <div class="nav-item" style="margin-left:50px">
                                <button class="btn btn-outline-primary my-2 my-sm-0" onclick=" location.href = `MR_MBList.php?MR_number=<?= $MR_number ?>`">
                                    <i class="fas fa-arrow-circle-right"></i>
                                    會員二手書清單
                                </button>
                                <button class="btn btn-outline-primary my-2 my-sm-0" onclick="location.href = `MR_BRDataList.php?MR_number=<?= $MR_number ?>`;">
                                    <i class="fas fa-arrow-circle-right"></i>
                                    追蹤書評人清單
                                </button>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="min-height:500px">
                            <!-- body -->
                            <?php foreach ($details as $k => $v) : ?>
                                <?php if ($k == 'MR_imageloactionX' or $k == 'MR_imageloactionY') continue; ?>
                                <ul class="d-flex">
                                    <li class="" style="text-align:right">
                                        <h5><?= $item_switch[$k]; ?>
                                            <?php
                                                    if ($k == 'MR_number') {
                                                        echo "<input type='hidden' value='${v}' id='hand2_number'>";
                                                    }
                                                    // strlen($k)>3 ? substr($k, 3, strlen($k) - 3): $k
                                                    ?> &nbsp : &nbsp </h5>
                                    </li>
                                    <li><?php if ($k == 'MR_gender') {
                                                    echo  $v == 1 ? '男' : '女';
                                                } else if ($k == 'MR_personLevel') {
                                                    if ($a['MR_personLevel'] > 0 && $a['MR_personLevel'] <= 5) {
                                                        echo htmlentities($a_level[$a['MR_personLevel']]);
                                                    }
                                                } else {
                                                    echo $v;
                                                }; ?>
                                    </li>
                                </ul>
                            <?php endforeach ?>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href='MR_memberData_update.php?sid=<?= $sid[$i]; ?>'">修改內容</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        <?php endfor ?>


        <!-- 刪除提示框 -->
        <div class="delete update card" id="delete_confirm" style="display:none">
            <div class="delete card-body">
                <label class="delete_text " id="delete_info"></label>
                <div>
                    <button type="button" class="delete btn btn-danger" id="deltet_yes">確認</button>
                    <!-- onclick="delete_yes()" -->
                    <button type="button" class="delete btn btn-warning" id="deltet_no">取消</button>
                    <!-- onclick="delete_no()" -->
                </div>
            </div>
        </div>
    </section>
</div>

<!-- 搜尋失敗提視窗 -->
<div class="delete update card" id="search_failed" style="display:none">
    <div class="delete card-body">
        <label class="delete_text " id="">查無資料，請重新輸入搜尋條件</label>
    </div>
</div>

<script>
    // // 全選刪除
    function check_all() {
        if ($("#all_check").prop('checked')) {
            // delete1.style.visibility = "visible";
            $('#delete1').css('visibility', 'visible');
            $("input[name='check[]']").each(function() {
                $(this).prop('checked', true);
            });
        } else {
            // delete1.style.visibility = "hidden";
            $('#delete1').css('visibility', 'hidden');
            $('input[name="check[]"]').each(function() {
                $(this).prop('checked', false);
            });
        }
    }
    $('input[name="check[]"]').click(function() {
        if ($('input[name="check[]"]').prop('checked')) {
            $('#delete1').css('visibility', 'visible');
        } else {
            $('#delete1').css('visibility', 'hidden');
        }
    });

    // for (let i = 0; i < 10; i++) {
    //     checkboxs[i].addEventListener('click', showButton);
    // }
    // function showButton() {
    //     let s = '';
    //     for (let i = 0; i < 10; i++) {
    //         if (checkboxs[i].checked) {
    //             s += 's';
    //         }
    //     }
    //     if (s.length > 0) {
    //         delete1.style.visibility = "visible";
    //     } else {
    //         delete1.style.visibility = "hidden";
    //     }
    // }


    // 刪除資料功能
    let delete_info = document.querySelector('#delete_info');
    let delete_confirm = document.querySelector('#delete_confirm')

    function delete_one(sid) {
        delete_confirm.style.display = "block";
        delete_info.innerHTML = `確定要刪除編號${sid}的資料嗎?`;
        delete_sid = sid;
        // if (confirm(`確定要刪除編號${sid}的資料嗎?`)) {
        //     location.href = 'MR_memberData_delete.php?sid=' + sid;
        // }
    }
    let delete_sid;
    let deltet_yes = document.querySelector('#deltet_yes');
    let deltet_no = document.querySelector('#deltet_no');
    let muti_delete = document.querySelector('#multi_delete');

    deltet_yes.addEventListener('click', delete_yes);
    deltet_no.addEventListener('click', delete_no);


    function delete_yes(event) {
        if (event.target == deltet_yes) {
            location.href = 'MR_memberData_delete.php?sid=' + delete_sid;
        }
        if (delete_eventTarget == multi_delete) {
            document.cookie = "delete_sid=" + ar;
            location.href = 'MR_memberData_delete.php';
        }
    }


    function delete_no(event) {
        delete_confirm.style.display = "none";
    }
    let ar = [];
    let delete_eventTarget;

    function delete_multiple(event) {
        delete_eventTarget = event.target;
        ar = [];
        for (i = 0; i < 10; i++) {
            if (checkboxs[i].checked) {
                ar.push(checkboxs[i].value);
            }
        }
        delete_confirm.style.display = "block";
        let string1 = '';
        for (i = 0; i < ar.length; i++) {
            string1 += `${ar[i]}, `;
        }
        string1 = string1.slice(0, string1.length - 2);
        delete_info.innerHTML = `確定要刪除編號 ${string1} 的資料嗎?`;

        // delete_sid = sid;
        // if (confirm(`確定要刪除編號${sid}的資料嗎?`)) {
        //     location.href = 'MR_memberData_delete.php?sid=' + sid;
        // }
    }

    //二手書連結
    let hand2_number = document.querySelector('#hand2_number');
    let MR_number = hand2_number.value;

    function secondHandBook() {
        location.href = `MR_MBList.php?MR_number=${MR_number}`;
    }

    function fans() {
        location.href = `MR_BRDataList.php?MR_number=${MR_number}`;
    }
</script>

<?php include '../../pbook_index/__html_foot.php' ?>