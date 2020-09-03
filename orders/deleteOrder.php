<?php
if(isset($_POST['id'])) {
    require_once '../db/connection.php';
    require_once 'model.php';
    try {
        $connection = connect();
        delete_order($connection, $_POST['id']);
         header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/orders/ordersList.php?client='.$_POST['client_id']);
    } catch(PDOException $e) {
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/error.php?message='.urlencode('Ошибка подключения к базе данных'));
    } finally {
        $connection = null;
    }
}
