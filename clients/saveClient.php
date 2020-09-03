<?php
$client=[];
if(isset($_POST['id'])){
	$client['id']=$_POST['id'];
}
require_once '../db/connection.php';
require_once 'model.php';
if(isset($_POST['name']) && mb_strlen($_POST['name'])){
	$client['name']=$_POST['name'];
	$connection=connect();
	save_client($connection, $client);
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/clients/clientsList.php');
}
else{
	 header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Поле &laquo;Имя&raquo; не заполнено'));
}