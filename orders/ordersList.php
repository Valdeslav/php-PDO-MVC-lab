<?php
try {
    require_once '../db/connection.php';
    $connection = connect();
    if(isset($_GET['client'])) {
        require_once '../clients/model.php';
        $GLOBALS['client'] = read_client_by_id($connection, $_GET['client']);
    } else {
        $GLOBALS['client'] = [];
        $GLOBALS['client']['id'] = null;
    }
    if($GLOBALS['client']) {
        require_once 'model.php';
        $GLOBALS['orders'] = read_orders_by_client($connection, $GLOBALS['client']['id']);
        include 'ordersList.view.php';
    } else {
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибочный идентификатор: запрошенный клиент не найден'));
    }
} catch(PDOException $e) {
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
} finally {
    $connection = null;
}