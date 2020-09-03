<!DOCTYPE html>
<?php
$categories=$GLOBALS['categories'];
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Категории товаров</title>
</head>
<body>
	<h1>Категории товаров</h1>
	<table border="1">
		<tr>
			<th>Список категорий</th>
			<th colspan="2"></th>
		</tr>
		<?php
		foreach ($categories as $category) {
	 	?>
	 	<tr>
	 		<td><?php echo $category['name']; ?></td>
	 		<td><a href="../products/productsList.php?category=<?php echo $category['id']; ?>">список товаров категории</a></td>
	 		<td><a href="editCategory.php?id=<?php echo $category['id']; ?>">редактировать</a></td>
	 	</tr>
	<?php
	}
	?>
	</table>
	<p><a href="editCategory.php">Добавить новую категорию</a></p>
	<p><a href="../index.php">На главную</a></p>
</body>
</html>