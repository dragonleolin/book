<?php 

require __DIR__."/_connect.php";

$sql_query = "SELECT * FROM `memberbooks";

$rows = $pdo->query($sql_query)->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row){
    foreach($row as $key=>$value){
        echo $key.":".$value."<br>";
    }
}

