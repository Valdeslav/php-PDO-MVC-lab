<?php
function read_products_by_category($connection, $category_id){
	try{
		if($category_id!=null){
			$statement=$connection->prepare('SELECT id, name, category_id, cost, description FROM product WHERE category_id=:category_id');
			$statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
			$statement->execute();
			$products=$statement->fetchAll(PDO::FETCH_ASSOC);
			require_once '../categories/model.php';
			return $products;
		}
	}finally{
		$statement=null;
	}
}

function read_product_by_id($connection, $id){
	try{
		$statement=$connection->prepare('SELECT id, name, category_id, cost, description FROM product WHERE id=:id');
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();
		$product=$statement->fetch(PDO::FETCH_ASSOC);
		return $product;
	}finally{
		$statement=null;
	}
}

function save_product($connection, $product){
	try{
		if(isset($product['id'])){
			$statement=$connection->prepare('UPDATE product SET name=:name, category_id=:category_id, cost=:cost, description=:description WHERE id=:id');
			$statement->bindValue(':id', $product['id'], PDO::PARAM_INT);
		}else{
			$statement=$connection->prepare('INSERT INTO product(name, category_id, cost, description) VALUES (:name, :category_id, :cost, :description)');
		}
		$statement->bindValue(':name', $product['name'], PDO::PARAM_STR);
		$statement->bindValue(':category_id', $product['category_id'], PDO::PARAM_INT);
		$statement->bindValue(':cost',$product['cost'], PDO::PARAM_STR);
		$statement->bindValue(':description', $product['description'], PDO::PARAM_STR);
		$statement->execute();
	}finally{
		$statement=null;
	}
}

function delete_product($connection, $id){
	try{
		$statement=$connection->prepare('DELETE FROM product WHERE id=:id');
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();
	}finally{
		$statement=null;
	}
}