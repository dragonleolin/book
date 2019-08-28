<?php
die("不要灌資料");
exit;
require __DIR__.'/__connect_db.php';
for($i=0; $i<100; $i++){
    $coupon_no = md5(uniqid().$i);
    echo $coupon_no.'<br>';
    $pdo -> query("INSERT INTO `coupon`
        (`coupon_id`, `coupon_user_id`, `coupon_no`, `coupon_content`,
        `coupon_price`, `coupon_rule`, `coupon_type`, `coupon_start_time`, `coupon_end_time`,
        `coupon_created_time`, `coupon_status`)
         VALUES
         (NULL, RAND()*30, '$coupon_no', '滿額折100元',
         '100', RAND()*4, RAND()*3, '2019-08-27', '2019-08-31', NOW(), '0');
        ");
}
