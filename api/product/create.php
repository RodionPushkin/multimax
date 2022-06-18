<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(Access($_COOKIE["token"],4))
{
    if (!empty($_POST['idtype']) && !empty($_POST['title']) && !empty($_POST['price']))
    {
        $item = R::dispense('product');
        $item->idtype = $_POST['idtype'];
        $item->title = $_POST['title'];
        $item->price = $_POST['price'];
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