<?php
function connect(){
	$configuration=require_once '../config.php';
	return new PDO($configuration['pdo_url'], $configuration['pdo_user'], $configuration['pdo_password']);
}