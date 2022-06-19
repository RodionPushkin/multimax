<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$error = [];
$result = null;
if(!empty($_COOKIE['token']))
{
    array_push($error,"пользователь уже авторизирован!");
}
else if(!empty($_POST['email']) && !empty($_POST['password'])){
    if(!empty(R::findOne('user',' email = ? ', [$_POST['email']])))
    {
        array_push($error,"пользователь уже зарегистрирован!");
    }
    else
    {
        $user = R::dispense('user');
        $user->email = $_POST['email'];
        $user->token = GenerateToken($_POST['email'],$_POST['password']);
        if(!empty($_POST['referal']))
        {
            $id = (int) $_POST['referal'];
            $user->idreferal = $id;
        }
        R::store($user);
        setcookie("token",GenerateToken($_POST['email'],$_POST['password']),time()+3600*24, "/");
        $result = ['token'=>GenerateToken($_POST['email'],$_POST['password'])];
    }
}
else
{
    array_push($error,"не указаны данные для регистрации!");
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