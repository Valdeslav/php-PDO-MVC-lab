<?php
try{
	require_once '../db/connection.php';
    require_once '../clients/model.php';
    require_once 'model.php';
    $connection=connect();
    $GLOBALS['categories']=read_all_products($connection);
    $GLOBALS['managers']=read_all_managers($connection);
     $GLOBALS['adreses']='';
    if(isset($_GET['id'])){
    	$GLOBALS['order']=read_order_by_id($connection, $_GET['id']);
    	$GLOBALS['adreses']=read_adreses_by_client_id($connection, $GLOBALS['order']['client_id']);
    	if($GLOBALS['order']){
    		$GLOBALS['title']='Редактирование заказа';
    	}else{
    		header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибочный идентификатор: запрошенный заказ не найдена'));
            return;
    	}
    }  else{
    	$GLOBALS['title']='Добавление нового заказа';
    	$GLOBALS['order']=[
    		'client_id'=>$_GET['client'],
    		'manager_id'=>'',
    		'order_cost'=>'',
    		'adress_id'=>'',
    		'date'=>'',
    		'status'=>''
    	];
    	$GLOBALS['adreses']=read_adreses_by_client_id($connection, $_GET['client']);
    }
    include 'editOrder.view.php';
}catch(PDOException $e) {
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
}finally {
    $connection = null;
}
