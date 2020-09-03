<?php
$phones=[];
$adreses=[];
require_once '../db/connection.php';
require_once 'model.php';
if(isset($_POST['deleteP']) && isset($_POST['id'])){
	if(isset($_POST['phones'])){
		$phones=$_POST['phones'];
		try{
			$connection=connect();
			foreach($phones as $phone){
				delete_phone($connection, $phone);
			}
		} catch(PDOException $e){
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
			return;
		}finally {
                $connection = null;
            }
	}
}
if(isset($_POST['deleteA']) && isset($_POST['id'])){
	if(isset($_POST['adreses'])){
		$adreses=$_POST['adreses'];
		try{
			$connection=connect();
			foreach($adreses as $adress){
				delete_adress($connection, $adress);
			}
		} catch(PDOException $e){
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
			return;
		}finally {
                $connection = null;
            }
	}
}
if(isset($_POST['addA']) && isset($_POST['id'])){
	$adress['client_id']=$_POST['id'];
		$adress['adress']=$_POST['adress'];
		try{
			$connection=connect();
			save_adress($connection, $adress);
		} catch(PDOException $e){
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
			return;
		}finally {
                $connection = null;
            }
	}

if(isset($_POST['addP']) && isset($_POST['id'])){
	$phone['client_id']=$_POST['id'];
		$phone['number']=$_POST['phone'];
		try{
			$connection=connect();
			save_phone($connection, $phone);
		} catch(PDOException $e){
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode('Ошибка подключения к базе данных'));
			return;
		}finally {
                $connection = null;
            }
	}
header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/clients/editClient.php?id='.urlencode($_POST['id']));