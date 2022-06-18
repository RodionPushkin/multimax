<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(Access($_COOKIE["token"],4))
{
    if (!empty($_POST['id']))
    {
        $item = R::load('product',$_POST['id']);
        if(!empty($_POST['idtype'])){
            $item->idtype = $_POST['idtype'];
        }
        if(!empty($_POST['title'])){
            $item->title = $_POST['title'];
        }
        if(!empty($_POST['price'])){
            $item->price = $_POST['price'];
        }
        if(!empty($_POST['previewimage'])){
            $item->previewimage = $_POST['previewimage'];
        }
        if(!empty($_POST['active'])){
            $item->active = $_POST['active'];
        }
        if(!empty($_POST['description'])){
            $item->description = $_POST['description'];
        }
        if(!empty($_POST['discount'])){
            $item->discount = $_POST['discount'];
        }
        if(!empty($_POST['guidelink'])){
            $item->guidelink = $_POST['guidelink'];
        }
        if(!empty($_POST['isdeleted'])){
            $item->isdeleted = $_POST['isdeleted'];
        }
        $item->edited = date('Y-m-d H:i:s', time());
        R::store($item);
        $result = 'запись успешно добавлена!';
    }else
    {
        array_push($error,"не указан id!");
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