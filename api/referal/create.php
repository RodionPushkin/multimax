<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(Access($_COOKIE["token"],4))
{
    if (!empty($_POST['url']) && !empty($_POST['iduser']))
    {
        $item = R::dispense('referal');
        $item->iduser = $_POST['iduser'];
        $item->url = $_POST['url'];
        R::store($item);
        $result = 'запись успешно добавлена!';
    }else
    {
        array_push($error,"недостаточно данных!");
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