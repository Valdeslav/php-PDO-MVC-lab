<?php
if(isset($_GET['id'])){
	require_once '../db/connection.php';
	require_once 'model.php';
	try{
		$connection=connect();
		$GLOBALS['client']=read_client_by_id($connection, $_GET['id']);
		if($GLOBALS['client']){
			$GLOBALS['title']='Редактирование клиента '.$GLOBALS['client']['name'].'.';
		} else{
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибочный идентификатор: запрошенный клиент не найден'));
			return;
		}
	} catch(PDOException $e){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
		return;
	} finally{
		$connection=null;
	}
} else{
	$GLOBALS['title']='Добавление нового клиента';
	$GLOBALS['client']=[
		'name'=>'',
		'phone'=>'',
		'adress'=>'',
	];
}
include 'editClient.view.php';