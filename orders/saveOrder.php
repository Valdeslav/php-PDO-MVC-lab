<?php
$order=[];
require_once '../db/connection.php';
require_once 'model.php';
if(!isset($_POST['id'])){
	if(isset($_POST['manager'])){
		$order['manager_id']=$_POST['manager'];
	}
	if(isset($_POST['adress'])){
		$order['adress_id']=$_POST['adress'];
	}
	if(isset($_POST['client_id'])){
		$order['client_id']=$_POST['client_id'];
	}
	$order['status']='new';
	$order['order_cost']=0;
	try{
		$connection=connect();
	save_order($connection, $order);
	$id=read_orders($connection);
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/orders/editOrder.php?id='.$id);
}catch(PDOException $e) {
                header('Location: http://'.$_SERVER['HTTP_HOST'].'laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
                return;
            } finally {
                $connection = null;
            }
            
}
else {
	$order['id']=$_POST['id'];
	if(isset($_POST['manager'])){
		$order['manager_id']=$_POST['manager'];
	}
	if(isset($_POST['adress'])){
		$order['adress_id']=$_POST['adress'];
	}
	if(isset($_POST['client_id'])){
		$order['client_id']=$_POST['client_id'];
	}
	if(isset($_POST['status'])){
		$order['status']=$_POST['status'];
	}
	try{
		$connection=connect();
	$order['order_cost']=find_order_cost($connection, $order['id']);
	save_order($connection, $order);
}catch(PDOException $e) {
                header('Location: http://'.$_SERVER['HTTP_HOST'].'laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
                return;
            } finally {
                $connection = null;
            }
            header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/orders/ordersList.php?client='.$_POST['client_id'].urlencode($order_id));
}
