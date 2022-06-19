<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(!empty($_COOKIE['token']))
{
    $user = R::findOne('user',' token = ? ', [$_COOKIE['token']]);
    if(!empty($user))
    {
        $result = ['token'=>$_COOKIE['token'],'access'=>json_decode($user)->Access];
    }else
    {
        array_push($error,"ошибка авторизации!");
    }
}
else
{
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $user = R::findOne('user',' token = ? ', [GenerateToken($_POST['email'],$_POST['password'])]);
        if(!empty($user))
        {
            setcookie("token",GenerateToken($_POST['email'],$_POST['password']),time()+3600*24, "/");
            $result = ['token'=>GenerateToken($_POST['email'],$_POST['password']),'access'=>json_decode($user)->Access];
        }else
        {
            array_push($error,"ошибка авторизации!");
        }
    }
    else
    {
        array_push($error,"не указаны данные для аутентификации!");
    }
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
