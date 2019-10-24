<?php $sequence = 0;
$sid = [];
data;
foreach ($rows as $a) : $sequence++ ?>
    <tr>
        <td>
            <input type="checkbox" name="check[]" id="check<?= $sequence ?>" value="<?= $a['sid'] ?>">
        </td>
        <td> ['sid'] ?></td>
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
        <td>
            <a href="" class="showDetails" data-toggle="modal" data-target="#exampleModalCenter" data-sid="<?= $a['sid'] ?>">
                <i class="fas fa-plus-circle"></i>&nbsp&nbsp顯示
            </a>
        </td>
        <td><a href="MR_memberData_update.php?sid=<?= $a['sid'] ?>"><i class="fas fa-edit"></i></a></td>
        <td><a href="javascript:delete_one(<?= $a['sid'] ?>)"><i class="fas fa-trash-alt"></i></a></td>
        <input type="hidden" id=`tdsid<?= $a['sid'] ?>` value="<?= $a['sid'] ?>">

    </tr>
<?php $sid[] = $a['sid'];
endforeach ?>