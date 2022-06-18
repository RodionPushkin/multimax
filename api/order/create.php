<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(Auth($_COOKIE["token"]))
{
    if (!empty($_POST['products']))
    {
        $user = R::findOne('user',' token = ? ', [$_COOKIE["token"]]);
        $item = R::dispense('order');
        $item->iduser = json_decode($user)->ID;
        R::store($item);
        $order = R::load($item);
        foreach ($_POST['products'] as $product)
        {
            $productItem = R::dispense('orderproduct');
            $productItem->idproduct = $product['id'];
            $productItem->count = $product['count'];
            $productItem->price = $product['price'];
            //должен быть url на скачивание
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