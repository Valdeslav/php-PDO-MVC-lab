<?php
$category=[];
if(isset($_POST['id'])){
	$category['id']=$_POST['id'];
}
if(isset($_POST['name']) && mb_strlen($_POST['name'])){
	$category['name']=$_POST['name'];
	require_once '../db/connection.php';
	require_once 'model.php';
	try{
		$connection=connect();
		save_category($connection,  $category);
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/categories/categoriesList.php');
	} catch(PDOException $e){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/error.php?message='.urlencode('Ошибка подключения к базе данных'));
	} finally{
		$connection=null;
	}
}else{
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Поле &laquo;название категории&raquo; не заполнено'));
}