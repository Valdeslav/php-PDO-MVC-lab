<?php
$products=[];
$order_element=[];
$order_id=$_POST['order_id'];
require_once '../db/connection.php';
require_once 'model.php';
if(isset($_POST['addP'])){
if(isset($_POST['products'])){
	$products=$_POST['products'];
	if(isset($_POST['number']) && ctype_digit($_POST['number'])){
		$number=$_POST['number'];
	try{
		$connection=connect();
		foreach($products as $product){
			save_order_element($connection, $product, $order_id, $number);
		}
	}catch(PDOException $e){
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
			return;
		}finally {
                $connection = null;
            }
}else{
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Поле &laquo;Количество каждого товара&raquo; не заполнено или содержит не целое число'));
	return;
}
}
}
if(isset($_POST['delP'])){
	if(isset($_POST['order_element'])){
		$order_element=$_POST['order_element'];
		try{
		$connection=connect();
		foreach($order_element as $cur_elem){
			delete_order_element($connection, $cur_elem);
		}
	}catch(PDOException $e){
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
			return;
		}finally {
                $connection = null;
            }
	}
}
header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/orders/editOrder.php?id='.urlencode($order_id));