<?php
include __DIR__.'/../db_controller.php';
include __DIR__.'/../access_controller.php';
$result = null;
if(!empty($_POST['id']))
{
    $result = R::getAll('SELECT P.ID AS ID, T.Title AS Type, P.Title AS Title, P.Description AS Description, P.Price AS Price, P.Discount AS Discount FROM `Product` P LEFT JOIN `Type` T ON T.ID = P.IDType WHERE P.ISDeleted = 0 AND P.ID = '.$_POST['id']);
    echo json_encode(['data'=>$result,'httpcode'=>200, 'time'=>date('Y-m-d H:i:s', time())]);
}else{

    $limit = (int) $_POST['limit'];
    if(empty($limit))
    {
        $limit = 0;
    }
    $result = R::getAll('SELECT P.ID AS ID, T.Title AS Type, P.Title AS Title, P.Description AS Description, P.Price AS Price, P.Discount AS Discount FROM `Product` P LEFT JOIN `Type` T ON T.ID = P.IDType WHERE P.ISDeleted = 0 ORDER BY ID LIMIT '.$limit.',100');
    echo json_encode(['data'=>$result,'httpcode'=>200, 'time'=>date('Y-m-d H:i:s', time())]);
}
?>