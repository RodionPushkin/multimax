<?php
include __DIR__.'/db_controller.php';
include __DIR__.'/access_controller.php';

$order = R::getAll('SELECT * FROM `order` WHERE `ISDeleted` = 0 ORDER BY ID LIMIT 0,100');
$result = [];
foreach ($order as $item)
{
    array_push($result,['order'=>$item,'products'=>R::getAll('SELECT * FROM `orderproduct` WHERE `IDOrder` = '.$item['ID'])]);
}
echo json_encode($result)

?>