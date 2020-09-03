<?php
$product=[];
if(isset($_POST['id'])){
	$product['id']=$_POST['id'];
}
if(isset($_POST['name']) && mb_strlen($_POST['name'])){
	$product['name']=$_POST['name'];
	if(isset($_POST['category_id'])){
		$product['category_id']=$_POST['category_id'];
		if(isset($_POST['cost']) && is_numeric($_POST['cost'])){
			$product['cost']=$_POST['cost'];
			if(isset($_POST['description'])){
				$product['description']=$_POST['description'];
			}
			else{
				$product['description']=null;
			}
			require_once '../db/connection.php';
			require_once 'model.php';
			try{
				$connection=connect();
				save_product($connection, $product);
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/categories/categoriesList.php');
			} catch(PDOException $e){
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
				return;
			}finally{
				$connection=null;
			}
		} else{
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Поле &laquo;Цена&raquo; не заполнено или содержит не числовые данные'));
		}
	}
} else{
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Поле &laquo;Название&raquo; не заполнено'));
}