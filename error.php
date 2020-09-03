<?php
if(isset($_GET['message'])){
	$message=$_GET['message'];
}else{
	$message='Неизвестная ошибка';
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	<title>Ошибка: <?php echo $message; ?></title>
	</head>
	<body>
		<h1>Ошибка</h1>
		<p><?php echo $message; ?></p>
		<p><a href="/laba6/">на главную</a></p>
	</body>
</html>