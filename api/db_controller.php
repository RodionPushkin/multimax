<?php
include __DIR__.'./rb.php';
R::setup( 'mysql:host=localhost;dbname=multimax', 'root', 'root' );
R::freeze(true);
if(!R::testConnection())
{
    exit('Нет подключения к Базе Данных!');
}
?>