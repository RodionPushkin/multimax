<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(!empty($_COOKIE['token'])){
    $user = R::findOne('user',' token = ? ', [$_COOKIE['token']]);
    if(!empty($user))
    {
        if(!empty($_POST['referal']))
        {
            $id = (int) $_POST['referal'];
            $user->idreferal = $id;
        }
        if(!empty($_POST['isdeleted']))
        {
            $id = (int) $_POST['isdeleted'];
            $user->isdeleted = $id;
        }
        if(!empty($_POST['access']))
        {
            if(Access($_COOKIE['token'])){
                $id = (int) $_POST['access'];
                $user->access = $id;
            }
        }
        if(!empty($_POST['email']) && !empty($_POST['password']))
        {
            $user->email = $_POST['email'];
            $user->token = GenerateToken($_POST['email'],$_POST['password']);
        }else if(!empty($_POST['password']))
        {
            $user->token = GenerateToken(json_decode($user)->Email,$_POST['password']);
        }
        $user->edited = date('Y-m-d H:i:s', time());
        R::store($user);
        $result = ['token'=>json_decode($user)->token];
    }else
    {
        array_push($error,"пользователь не найден!");
    }
}
else
{
    array_push($error,"пользователь не авторизирован!");
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