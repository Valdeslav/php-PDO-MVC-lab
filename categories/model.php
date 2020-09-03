<?php
function read_all_categories($connection){
	try{
		$statement=$connection->query('SELECT id, name FROM category');
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}finally{
		$statement=null;
	}
}

function read_category_by_id($connection, $id){
	try{
		$statement=$connection->prepare('SELECT id, name FROM category WHERE id=:id');
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	}finally{
		$statement=null;
	}
}

function save_category($connection, $category){
	try{
		if(isset($category['id'])){
			$statement=$connection->prepare('UPDATE category SET name=:name WHERE id=:id');
			$statement->bindValue(':id', $category['id'], PDO::PARAM_INT);
		}
		else{
			$statement=$connection->prepare('INSERT INTO category(name) VALUES (:name)');
		}
		$statement->bindValue(':name', $category['name'], PDO::PARAM_STR);
		$statement->execute();
	} finally{
		$statement=null;
	}
}

function delete_category($connection, $id){
	try{
		$statement=$connection->prepare('DELETE FROM category WHERE id=:id');
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();
	}finally{
		$statement=null;
	}
}