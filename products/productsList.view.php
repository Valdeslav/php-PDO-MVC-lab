<!DOCTYPE html>
<?php
$category=$GLOBALS['category'];
$products=$GLOBALS['products'];
if($category['id']){
	$title='Список товаров категории '.$category['name'].'&nbsp;'.'.';
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
			<th>Названиe</th>
			<th>Цена</th>
			<th>Описание</th>
			<th></th>
		</tr>
		<?php
		foreach($products as $product){
			?>
			<tr>
				<td><?php echo $product['name']; ?></td>
				<td><?php echo $product['cost']; ?></td>
				<td><?php echo $product['description']; ?></td>
				<td><a href="editProduct.php?id=<?php echo $product['id']; ?>">редактировать</a></td>
			</tr>
			<?php 
		}
		?>
	</table>
	<p><a href="editProduct.php?gategory=<?php echo $category['id']; ?>">добавить продукт</a></p>
	<p><a href="../categories/categoriesList.php">назад</a></p>
</body>
</html>