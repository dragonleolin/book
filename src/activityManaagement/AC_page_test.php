<?php //拿資料
require __DIR__. '/AC__connect_db.php';
$stmt = $pdo->query("SELECT * FROM `ac_pbook` ORDER BY `ac_pbook`.`AC_sid` DESC");

// $rows =$stmt->fetchAll();


// $row = $stmt->fetchAll();
// print_r($row);

while($row = $stmt->fetch()) {
    echo "{$row['AC_name']} {$row['AC_title']} <br>";
}


<?php foreach($rows as $r):?>
    <tr>
        <td><?= $r['AC_sid'] ?></td>
        <td><?= $r['AC_name'] ?></td>
        <td><?= $r['AC_title'] ?></td>
        <td><?= $r['AC_type'] ?></td>
        <td><?= $r['AC_date'] ?></td>
        <td><?= $r['AC_eventArea'] ?></td>
        <td><?= $r['AC_mobile'] ?></td>
        <td><?= $r['AC_organizer'] ?></td>
        <td><?= $r['AC_price'] ?></td>
        
        <td><a href="#"><i class="fas fa-edit"></i></a></td>
        <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
    </tr>
    <?php endforeach; ?>