<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$result = null;
$limit = (int) $_POST['limit'];
if(empty($limit))
{
    $limit = 0;
}
$result = R::getAll('SELECT * FROM `status` WHERE `ISDeleted` = 0 ORDER BY ID LIMIT '.$limit.',100');
echo json_encode(['data'=>$result,'httpcode'=>200, 'time'=>date('Y-m-d H:i:s', time())]);
?>