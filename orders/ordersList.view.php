<!DOCTYPE html>
<?php
$client=$GLOBALS['client'];
$orders=$GLOBALS['orders'];
if($client['id']){
	$title='Список заказов клиента '.$client['name'];
}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
</head>
<body>
	<h1><?php echo $title; ?></h1>
	<table border="1">
		<tr>
			<th>Товары</th>
			<th>Менеджер</th>
			<th>цена</th>
			<th>Адрес</th>
			<th>Дата</th>
			<th>Статус</th>
			<th></th>
		</tr>
		<?php
		foreach($orders as $order){
			?>
			<tr>
				<td>
				<?php 
				if(count($order['order_element'])>=1){
					?>
					<ol>
						<?php
						foreach($order['order_element'] as $cur_elem){
							?>
							<li><?php echo $cur_elem['product']['name'].'&nbsp;'.'&nbsp;кол-во:&nbsp;'.$cur_elem['number']; ?></li>
							<?php
						}
						?>
						</ol>
						<?php
					}else{ echo 'нет добавленных товаров';}
					?>
					</td>
					<td><?php echo $order['manager']['name']; ?></td>
					<td><?php echo $order['order_cost']; ?></td>
					<td><?php echo $order['adress']['adress']; ?></td>
					<td><?php echo $order['date']; ?></td>
					<td><?php echo $order['status']; ?></td>
					<td><a href="editOrder.php?id=<?php echo $order['id']; ?>">редактировать</a></td>
					</tr>
						<?php
					}
					?>
				</table>
				<?php
				if($client['id']){
					?>
					<p><a href="editOrder.php?client=<?php echo $client['id']; ?>">добавить заказ</a></p>
					<?php
				}
				?>
					<p><a href="../clients/clientsList.php">назад</a></p>
				
	</table>
</body>
</html>