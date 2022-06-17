<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(!empty($_POST['id'])){
    $id = (int) $_POST['id'];
    if(Access($_COOKIE["token"]))
    {
        $item = R::load('product',$id);
        if(!empty($item))
        {
            $item->ISDeleted = 1;
            R::store($item);
            $result = 'запись с id='.$_POST['id'].', успешно удалена!';
        }else{
            array_push($error,"id для удаления не найден!");
        }
    }else
    {
        array_push($error,"недостаточно прав!");
    }
}
else
{
    array_push($error,"не указан id для удаления!");
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