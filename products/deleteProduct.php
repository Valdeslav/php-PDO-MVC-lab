<?php
if(isset($_POST['id'])){
	require_once '../db/connection.php';
	require_once 'model.php';
	try{
		$connection=connect();
		delete_product($connection, $_POST['id']);
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/categories/categoriesList.php');
	} catch(PDOException $e){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
	} finally{
		$connection=null;
	}
}