<!DOCTYPE html>
<?php
$title=$GLOBALS['title'];
$client=$GLOBALS['client'];
$user=['login'=>'', 'password'=>'', 'role'=>3];
?>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
</head>
<body>
	 <h1><?php echo $title; ?></h1>
	 <form id="edit" action="saveClient.php" method="post">
	 	<?php
	 	if(isset($client['id'])){
	 		?>
	 		<input type="hidden" name="id" value="<?php echo $client['id']; ?>">
	 		<?php
	 	}
	 	?>
	 		Имя клиента:<br>
	 		<input type="text" name="name" value="<?php echo $client['name']; ?>"><br>
	 </form>
	 <?php
	 		if(isset($client['id'])){
	 			?>
	 <form action="editPhones_Adreses.php" method="post">
	 	<input type="hidden" name="id" value="<?php echo $client['id']; ?>">
	 			Номера телефонов:<br>
	 			<select name="phones[]" size="10" multiple>
	 			<?php 
	 			foreach($client['phone'] as $cur_phone){
	 				?>
	 				<option value="<?php echo $cur_phone['id']; ?>">
	 					<?php echo $cur_phone['number']; ?></option>
	 					<?php
	 				}
	 				?>
	 			</select>
	 			<br>
	 			<button type="submit" name="deleteP" value="1">удалить выбранные номера</button><br>
	 			Новый номер телефона:<br>
	 			<input type="text" name="phone"><br>
	 			<button type="submit" name="addP" value="1">Добавить номер</button>	
	 </form>
	<form action="editPhones_Adreses.php" method="post">
		<input type="hidden" name="id" value="<?php echo $client['id']; ?>">
	 			Адреса для доставки:<br>
	 			<select name="adreses[]" size="10" multiple>
	 			<?php 
	 			foreach($client['adress'] as $cur_adress){
	 				?>
	 				<option value="<?php echo $cur_adress['id']; ?>">
	 					<?php echo $cur_adress['adress']; ?></option>
	 					<?php
	 				}
	 				?>
	 			</select>
	 			<br>
	 			<button type="submit" name="deleteA" value="1">удалить выбранные адреса</button><br>
	 			Новый адрес:<br>
	 			<input type="text" name="adress"><br>
	 			<button type="submit" name="addA" value="1">Добавить адрес</button>	
	 			<br>
	 </form>
	 <?php
	}
	?>
	<br>
	<button type="submit" form="edit">сохранить</button>
	<?php
	if(isset($client['id'])){
		?>
	<button type="submit" form="edit" formaction="deleteClient.php">удалить пользователя</button>
	<?php 
}
?>
	<p><a href="clientsList.php">назад</a></p>
</body>
</html>