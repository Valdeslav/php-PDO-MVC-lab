<!DOCTYPE html>
<?php
$clients=$GLOBALS['clients'];
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Список Клиентов</title>
</head>
<body>
	<h1>Список клиентов</h1>
	<table border="1">
		<tr>
			<th>Имя Клиента</th>
			<th>Телефоны</th>
			<th>Адреса</th>
			<th colspan="2"></th>
		</tr>
		<?php
		foreach($clients as $client) {
	 	?>
	 	<tr>
	 		<td><?php echo $client['name']; ?></td>
	 		<td>
	 			<?php
	 			if(count($client['phone'])>=1){
	 				?>
	 				<ol>
	 					<?php
	 					foreach ($client['phone'] as $cur_phone) {
	 					?>
	 					<li><?php echo $cur_phone['number']; ?></li>
	 					<?php
	 				}
	 				?>
	 			</ol>
	 			<?php
	 		} else {
	 			echo 'Телефоны&nbsp; не&nbsp; указаны';
	 		}
	 		?>
	 		</td>
	 		<td>
	 			<?php
	 			if(count($client['adress'])>=1){
	 				?>
	 				<ol>
	 					<?php
	 					foreach ($client['adress'] as $cur_adress) {
	 					?>
	 					<li><?php echo $cur_adress['adress']; ?></li>
	 					<?php
	 				}
	 				?>
	 			</ol>
	 			<?php
	 		} else {
	 			echo 'Адреса&nbsp; не&nbsp; указаны';
	 		}
	 		?>
	 		</td>
	 		<td><a href="../orders/ordersList.php?client=<?php echo $client['id']; ?>">список заказов клиента</a></td>
	 		<td><a href="editClient.php?id=<?php echo $client['id']; ?>">редактировать</a></td>
	 	</tr>
	<?php
	}
	?>
	</table>
	<p><a href="editClient.php">Добавить нового клента</a></p>
	<p><a href="../index.php">На главную</a></p>
</body>
</html>