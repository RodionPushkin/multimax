<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$result = null;
if(!empty($_POST['id']))
{
    $result = R::getAll('SELECT * FROM `referal` WHERE `ISDeleted` = 0 AND ID ='.$_POST['id']);
}
else if(!empty($_POST['iduser']))
{
    $result = R::getAll('SELECT * FROM `referal` WHERE `ISDeleted` = 0 AND IDUser ='.$_POST['iduser']);
}
else
{
    $limit = (int) $_POST['limit'];
    if(empty($limit))
    {
        $limit = 0;
    }
    $result = R::getAll('SELECT * FROM `referal` WHERE `ISDeleted` = 0 ORDER BY ID LIMIT '.$limit.',100');
}
echo json_encode(['data'=>$result,'httpcode'=>200, 'time'=>date('Y-m-d H:i:s', time())]);
?>