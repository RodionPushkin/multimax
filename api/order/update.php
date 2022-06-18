<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(Access($_COOKIE["token"],4))
{
    if (!empty($_POST['idorder']) && !empty($_POST['products']))
    {
        $user = R::findOne('user',' token = ? ', [$_COOKIE["token"]]);
        $item = R::load('order',empty($_POST['idorder']));
        $item->iduser = json_decode($user)->ID;
        R::store($item);
        $order = R::load($item);
        foreach ($_POST['products'] as $product)
        {
            $productItem = R::load('orderproduct',$product['idorderproduct']);
            $productItem->idproduct = $product['id'];
            $productItem->count = $product['count'];
            $productItem->price = $product['price'];
            if(!empty($product['idstatus']))
            {
                $productItem->idstatus = $product['idstatus'];
            }
            if(!empty($product['downloadlink']))
            {
                $productItem->downloadlink = $product['downloadlink'];
            }
            R::store($productItem);
        }
        $result = 'запись успешно добавлена!';
    }else
    {
        array_push($error,"недостаточно данных!");
    }
}else
{
    array_push($error,"пользователь не найден!");
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