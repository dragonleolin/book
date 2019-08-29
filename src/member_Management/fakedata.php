<?php require  'MR_db_connect.php' ?>

<?php


for ($i = 30; $i < 66; $i++) {
    $i = $i < 10 ? "0" . $i : $i;

    $ss = "INSERT INTO `mr_information`
     (`sid`, `MR_number`, `MR_name`, `MR_password`, `MR_nickname`, `MR_email`, `MR_gender`, `MR_birthday`, `MR_mobile`, `MR_career`, `MR_address`, `MR_personLevel`, `MR_createdDate`) 
    VALUES 
    (`sid`, 'MR000${i}', '人名${i}', '1234', 'nickname', '123@gmail.com', '1', '2019-08-20', '0955111222', '213', '台北市', '1', '2019-08-09')";
    // echo $i .'<br>';

    $pdo->query($ss);
}
?>