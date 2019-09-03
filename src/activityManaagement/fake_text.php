<?php
exit;
// ---------------------------------------------------
// 編號`AC_sid`
// 姓名`AC_name`
// 標題`AC_title`
// 活動類型`AC_type`
// 時間`AC_date`
// 地點`AC_eventArea`
// 聯絡電話`AC_mobile`
// 主辦單位`AC_organizer`
// 活動簡介`AC_brief`
// 建立時間`AC_created_at`
// ---------------------------------------------------
// INSERT INTO `ac_pbook` (`AC_sid`, `AC_name`, `AC_title`, `AC_type`, `AC_date`, `AC_eventArea`, `AC_mobile`, `AC_organizer`, `AC_introduction`) 
// VALUES
// (NULL, '陳小華', '小華的私藏好書', '新書發表', '2019-09-03', '台北市大安區', '0982123456', '小華書房', '小華寫文章'),
// (NULL, '春風先生', '春風跨海而來──半生書蠹酬知己座談會', '書評座談', '2019-09-03', '台中市', '0982123456', '春風企業', '春風寫文章'),
// (NULL, '春風先生', '春風先生x品書二手物義賣', '二手惜物、為愛義賣', '2019-09-03', '彰化市', '0982333666', '春風企業', '春風寫文章'),
// (NULL, '江老師', '江老師｜新書分享', '好書分享會', '2019-09-03', '台北市板橋區', '0982666888', '東大日語書房', '江老師寫文章'),
// (NULL, '林小姐', '不給書就搗蛋！', '書評人座談會', '2019-09-03', '台北市萬華區', '0982777888', '林小姐書房', '林老師寫文章'),
// (NULL, '史小姐', '跟史小姐一起來讀書', '品茶品書會', '2019-09-03', '高雄市', '0982777888', '品書官方', '史老師寫文章'),
// (NULL, '大賢者', '春風似友 珍本古籍捐書會 預辦', '慈善捐書', '2019-09-03', '台北市松山區', '0982777888', '春風企業', '老師寫文章'),
// (NULL, '艾蜜莉', '艾蜜莉x品書【聯合倉庫特賣會】', '週年出清特賣', '2019-09-03', '台北市大同區', '0982777888', 'Smart智富', '老師寫文章'),
// (NULL, '查理．蒙格', '查理．蒙格【聯合倉庫特賣會】', '週年出清特賣', '2019-09-03', '台北市信義區', '0982777888', '商業周刊', '老師寫文章'),
// (NULL, '羅勃特‧T', 'T｜新書分享', '好書分享會', '2019-09-03', '台北市中山區', '0982777888', '高寶', '羅勃特‧T寫文章')
// ---------------------------------------------------

// require __DIR__. '/AC__connect_db.php';

// for($k=1; $k<100; $k++){
//     $s = "INSERT INTO `ac_pbook`
//             (`AC_name`, `AC_title`, `AC_type`, `AC_date`, `AC_eventArea`, `AC_mobile`, `AC_organizer`, `AC_brief`, `AC_created_at`)
//              VALUES
//               ('假的實體活動{$k}', '123@gmail.com', '0982333666', '1990-10-10', '台北市', '2019-08-27 12:00:00') ";
//    echo $s;
//    break;
//     $pdo->query($s);
// }

?>

<!-- CREATE TABLE `ac_pbook` (
  `AC_sid` int(11) NOT NULL,
  `AC_name` varchar(255) NOT NULL,
  `AC_title` varchar(255) NOT NULL,
  `AC_pic` varchar(255) DEFAULT NULL,
  `AC_type` varchar(255) NOT NULL,
  `AC_date` date NOT NULL,
  `AC_eventArea` varchar(255) NOT NULL,
  `AC_mobile` varchar(255) NOT NULL,
  `AC_organizer` varchar(255) NOT NULL,
  `AC_brief` text,
  `AC_created_at` datetime DEFAULT NULL,
  `AC_introduction` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8; -->