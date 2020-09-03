<!DOCTYPE html>
<?php
$categories=$GLOBALS['categories'];
$title=$GLOBALS['title'];
$product=$GLOBALS['product'];
?>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
</head>
<body>
	<h1><?php echo $title; ?></h1>
	<form action="saveProduct.php" method="post">
		<?php
		if(isset($product['id'])){
			?>
			<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
			<?php
		}
		?>
		Название:<br>
		<input type="text" name="name" value="<?php echo $product['name']; ?>"><br>
		Категория:<br>
		<select name="category_id">
			<?php 
			foreach ($categories as $category) {
				?>
				<option value="<?php echo $category['id']; ?>"
					<?php if($category['id']==$product['category_id']){ ?> selected<?php } ?>><?php echo $category['name'] ?>
					</option>
					<?php
				}
				?>
		</select><br>
		Цена товара:<br>
		<input type="text" name="cost" value="<?php echo $product['cost']; ?>"><br>
		Описание:<br>
		<textarea name="description" value="<?php echo $product['description']; ?>"></textarea><br>
		<button type="submit">сохранить</button>
		<?php
		if(isset($product['id'])){
			?>
			<button type="submit" formaction="deleteProduct.php">Удалить товар</button>
			<?php
		}
		?>
		<a href="../categories/categoriesList.php">к списку категорий</a>
	</form>
</body>
</html>