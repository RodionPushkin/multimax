<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(Access($_COOKIE["token"],4))
{
    if(!empty($_POST['id']))
    {
        $order = R::getAll('SELECT * FROM `order` WHERE `ISDeleted` = 0 AND ID ='.$_POST['id']);
        $result = ['order'=>$order,'products'=>R::getAll('SELECT * FROM `orderproduct` WHERE `IDOrder` = '.$order[0]['ID'])];
    }
    else
    {
        $limit = (int) $_POST['limit'];
        if(empty($limit))
        {
            $limit = 0;
        }
        $order = R::getAll('SELECT * FROM `order` WHERE `ISDeleted` = 0 ORDER BY ID LIMIT '.$limit.',100');
        $result = [];
        foreach ($order as $item)
        {
            array_push($result,['order'=>$item,'products'=>R::getAll('SELECT * FROM `orderproduct` WHERE `IDOrder` = '.$item['ID'])]);
        }
    }
}else if(!empty($_POST['iduser']))
{

    $order = R::getAll('SELECT * FROM `order` WHERE `ISDeleted` = 0 ORDER BY ID');
    $result = [];
    foreach ($order as $item)
    {
        array_push($result,['order'=>$item,'products'=>R::getAll('SELECT * FROM `orderproduct` WHERE `IDOrder` = '.$item['ID'])]);
    }
    $result = R::getAll('SELECT * FROM `order` WHERE `ISDeleted` = 0 AND IDUser ='.$_POST['iduser']);
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