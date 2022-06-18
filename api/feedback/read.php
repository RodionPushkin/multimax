<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(Auth($_COOKIE["token"]))
{
    if(!empty($_POST['id']))
    {
        $result = R::getAll('SELECT * FROM `feedback` WHERE `ISDeleted` = 0 AND ID = '.$_POST['id']);
    }
    else
    {
        $limit = (int) $_POST['limit'];
        if(empty($limit))
        {
            $limit = 0;
        }
        $result = R::getAll('SELECT * FROM `feedback` WHERE `ISDeleted` = 0 ORDER BY ID LIMIT '.$limit.',100');
    }
}else
{
    array_push($error,"недостаточно прав!");
}
if(empty($error))
{
    echo json_encode(['data'=>$result,'httpcode'=>200, 'time'=>date('Y-m-d H:i:s', time())]);
}
else
{
    echo json_encode(['error'=>$error[0],'httpcode'=>400, 'time'=>date('Y-m-d H:i:s', time())]);
}
?>