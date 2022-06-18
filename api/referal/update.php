<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(!empty($_POST['id'])){
    if(Access($_COOKIE["token"],4))
    {
        $id = (int) $_POST['id'];
        $item = R::load('referal',$id);
        if($_POST['isdeleted']){
            $item->isdeleted = $_POST['isdeleted'];
        }
        if($_POST['url']){
            $item->url = $_POST['url'];
        }
        if($_POST['iduser']){
            $item->iduser = $_POST['iduser'];
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