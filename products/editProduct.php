<?php
try {
	require_once '../db/connection.php';
	require_once '../categories/model.php';
	require_once 'model.php';
	$connection=connect();
	$GLOBALS['categories']=read_all_categories($connection);
	if(isset($_GET['id'])){
		$GLOBALS['product']=read_product_by_id($connection, $_GET['id']);
		if($GLOBALS['product']){
			$GLOBALS['title']='Редактирование товара &laquo;'.$GLOBALS['product']['name'].'&raquo;';
		}else{
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибочный идентификатор: запрошенный товар не найден'));
			return;
		}
	}else{
		$GLOBALS['title']='Добавление товара';
		$GLOBALS['product']=['name'=>'', 'category_id'=>'', 'cost'=>'', 'description'=>''];
		if(isset($_GET['category'])){
			$category=read_category_by_id($connection, $_GET['category']);
			if($category){
				$GLOBALS['product']['category_id']=$category['id'];
			}
		}
	}
	include 'editProduct.view.php';
} catch(PDOException $e){
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urldecode('Ошибка подключения к базе данных'));
}finally{
	$connection=null;
}