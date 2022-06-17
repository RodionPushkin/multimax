<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(Access($_COOKIE["token"]))
{
    if (!empty($_POST['title']))
    {
        $item = R::dispense('status');
        $item->title = $_POST['title'];
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