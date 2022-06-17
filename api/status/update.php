<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(!empty($_POST['id'])){
    if(Access($_COOKIE["token"]))
    {
        $id = (int) $_POST['id'];
        $item = R::load('status',$id);
        if($_POST['title']){
            $item->title = $_POST['title'];
        }
        R::store($item);
        $result = 'запись с id='.$_POST['id'].', успешно изменена!';
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