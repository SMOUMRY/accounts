<?php

$query = $dbCo->prepare('SELECT * FROM transaction;');
$query->execute([
]);

$pay = 0;

foreach ($query->fetchAll() as $amount){
    $pay = $pay + $amount['amount'];
}

echo $pay;