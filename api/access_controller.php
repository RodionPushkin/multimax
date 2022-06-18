<?php
function Access($token,$level) {
    if(empty($token))
    {
        return false;
    }
    $user = R::findOne('user',' token = ? ', [$token]);
    if(empty($user))
    {
        return false;
    }
    if(empty($level))
    {
        $level = 4;
    }
    if(json_decode($user)->Access == $level)
    {
        return true;
    }
}
function Auth($token){
    $user = R::findOne('user',' token = ? ', [$token]);
    if(empty($user))
    {
        return false;
    }
    return true;
}
function GenerateToken($email,$password){
    return md5(md5($email).'token'.md5($password).'multimax');
}
function GenerateLink(){
    // должна возвращать url на скачивание, у меня даже догадок нет, как это сделать
}
?>