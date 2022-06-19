<?php
if (isset($_COOKIE['token'])) {
    unset($_COOKIE['token']);
    setcookie('token', null, -1, '/');
    echo json_encode(['data'=>"куки удалена",'httpcode'=>200, 'time'=>date('Y-m-d H:i:s', time())]);
}else
{
    echo json_encode(['data'=>"куки не удалена",'httpcode'=>400, 'time'=>date('Y-m-d H:i:s', time())]);
}
?>
