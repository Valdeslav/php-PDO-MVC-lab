<?php
require_once '../db/connection.php';
require_once 'model.php';
try{
	$connection=connect();
	$GLOBALS['categories']=read_all_categories($connection);
	include 'categoriesList.view.php';
}catch(PDOException $e){
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
}finally{
	$connection=null;
}