<?php
if(isset($_GET['id'])){
	require_once '../db/connection.php';
	require_once 'model.php';
	try{
		$connection=connect();
		$GLOBALS['category']=read_category_by_id($connection, $_GET['id']);
		if($GLOBALS['category']){
			$GLOBALS['title']='Редактирование категории '.$GLOBALS['category']['name'].'&nbsp'.'.';
		}else{
			header('Location: http//'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибочный идентификатор: запрошенная категория не найдена'));
			return;
		}
	}catch(PDOException $e){
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
			return;
		}finally{
			$connection=null;
		}
}else{
	$GLOBALS['title']='Добавление новой категории';
	$GLOBALS['category']=[ 'name' => ''];
}
include 'editCategory.view.php';