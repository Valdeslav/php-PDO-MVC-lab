<?php
try{
	require_once '../db/connection.php';
	$connection=connect();
	if(isset($_GET['category'])){
		require_once '../categories/model.php';
		$GLOBALS['category']=read_category_by_id($connection, $_GET['category']);
	}
	if($GLOBALS['category']){
		require_once 'model.php';
		$GLOBALS['products']=read_products_by_category($connection,$GLOBALS['category']['id']);
		include 'productsList.view.php';
	}else{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибочный идентификатор: запрошенный автор не найден'));
	}
}catch(PDOException $e){
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urldecode('Ошибка подключения к базе данных'));
}finally{
	$connection=null;
}