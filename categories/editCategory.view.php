<!DOCTYPE html>
<?php
$title=$GLOBALS['title'];
$category=$GLOBALS['category'];
?>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
</head>
<body>
	<h1><?php echo $title; ?></h1>
	<form action="saveCategory.php" method="post">
		<?php
		if(isset($category['id'])){
			?>
			<input type="hidden" name="id" value="<?php echo $category['id']; ?>">
			<?php
		}
		?>
		Название категории:<br>
		<input type="text" name="name" value="<?php echo $category['name']; ?>"><br>
		<button type="submit">сохранить</button>
		<?php
		if(isset($category['id'])){
			?>
			<button type="submit" formaction="deleteCategory.php">удалить</button>
			<?php
		}
		?>
		<a href="categoriesList.php">назад</a>
	</form>
</body>
</html>