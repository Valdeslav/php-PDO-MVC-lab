<?php
function read_orders_by_client($connection, $client_id){
	try{
		if($client_id!=null){
			$statement1=$connection->prepare('SELECT id , client_id, manager_id, order_cost, adress_id, date, status FROM orderr  WHERE client_id=:client_id');
			$statement1->bindValue(':client_id', $client_id, PDO::PARAM_INT);
			$statement1->execute();
			$orders=$statement1->fetchAll(PDO::FETCH_ASSOC);
			$statement2=$connection->prepare('SELECT id, adress, client_id FROM adress WHERE id=:id');
			$statement3=$connection->prepare('SELECT id, name FROM manager WHERE id=:id');
			$statement4=$connection->prepare('SELECT id, order_id, product_id, number FROM order_element where order_id=:order_id');
			foreach ($orders as $key => $order) {
				$orders[$key]['adress']='';
				$orders[$key]['manager']='';
				$orders[$key]['order_element']='';
				$statement2->bindValue(':id', $order['adress_id'], PDO::PARAM_INT);
				$statement2->execute();
				$orders[$key]['adress']=$statement2->fetch(PDO::FETCH_ASSOC);
				$statement3->bindValue(':id', $order['manager_id'], PDO::PARAM_INT);
				$statement3->execute();
				$orders[$key]['manager']=$statement3->fetch(PDO::FETCH_ASSOC);
				$statement4->bindValue(':order_id',$order['id'], PDO::PARAM_INT);
				$statement4->execute();
				$orders[$key]['order_element']=$statement4->fetchAll(PDO::FETCH_ASSOC);
				$statement5=$connection->prepare('SELECT name, cost FROM product WHERE id=:id');
				foreach($orders[$key]['order_element'] as $index => $element){
					$statement5->bindValue(':id', $element['product_id'], PDO::PARAM_INT);
					$statement5->execute();
					$orders[$key]['order_element'][$index]['product']=$statement5->fetch(PDO::FETCH_ASSOC);
				}
			}
			return $orders;
	
}
	} finally{
		$statement1=null;
		$statement2=null;
		$statement3=null;
		$statement4=null;
		$statement5=null;
	}
}

function read_order_by_id($connection, $id){
	try{
		$statement1=$connection->prepare('SELECT id , client_id, manager_id, order_cost, adress_id, date, status FROM orderr  WHERE id=:id');
			$statement1->bindValue(':id', $id, PDO::PARAM_INT);
			$statement1->execute();
			$order=$statement1->fetch(PDO:: FETCH_ASSOC);
			$order['adress']='';
			$order['manager']='';
			$order['order_element']='';
			$statement2=$connection->prepare('SELECT id, adress, client_id FROM adress WHERE id=:id');
			$statement3=$connection->prepare('SELECT id, name FROM manager WHERE id=:id');
			$statement4=$connection->prepare('SELECT id, order_id, product_id, number FROM order_element where order_id=:order_id');
			$statement2->bindValue(':id', $order['adress_id'], PDO::PARAM_INT);
				$statement2->execute();
				$order['adress']=$statement2->fetch(PDO::FETCH_ASSOC);
				$statement3->bindValue(':id', $order['manager_id'], PDO::PARAM_INT);
				$statement3->execute();
				$order['manager']=$statement3->fetch(PDO::FETCH_ASSOC);
				$statement4->bindValue(':order_id',$order['id'], PDO::PARAM_INT);
				$statement4->execute();
				$order['order_element']=$statement4->fetchAll(PDO::FETCH_ASSOC);
				$statement5=$connection->prepare('SELECT name, cost FROM product WHERE id=:id');
				foreach($order['order_element'] as $index => $element){
					$statement5->bindValue(':id', $element['product_id'], PDO::PARAM_INT);
					$statement5->execute();
					$order['order_element'][$index]['product']=$statement5->fetch(PDO::FETCH_ASSOC);
				}
				return $order;
	}finally{
		$statement1=null;
		$statement2=null;
		$statement3=null;
		$statement4=null;
		$statement5=null;
	}
}

function read_all_managers($connection){
	try{
		$statement=$connection->query('SELECT id, name FROM manager');
		$managers=$statement->fetchAll(PDO::FETCH_ASSOC);
		return $managers;
	} finally{
		$statement=null;
	}
}

function read_all_products($connection){
	try{
		$statement=$connection->query('SELECT id, name FROM category');
		$categories=$statement->fetchAll(PDO::FETCH_ASSOC);
		$statement2=$connection->prepare('SELECT id, name, category_id, cost FROM product WHERE category_id=:category_id');
		foreach($categories as $key=>$category){
			$categories[$key]['products']='';
			$statement2->bindValue(':category_id', $category['id'], PDO::PARAM_INT);
			$statement2->execute();
			$categories[$key]['products']=$statement2->fetchAll(PDO::FETCH_ASSOC);
		}
		return $categories;
	} finally{
		$statement=null;
		$statement2=null;
	}
}

function read_adreses_by_client_id($connection, $client_id){
	try{
		$statement=$connection->prepare('SELECT id, adress, client_id FROM adress WHERE client_id=:client_id');
		$statement->bindValue(':client_id', $client_id, PDO::PARAM_INT);
		$statement->execute();
		$adreses=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $adreses;
	} finally{
		$statement=null;
	}
}

function save_order_element($connection, $product_id, $order_id, $number){
	try{
		$statement=$connection->prepare('INSERT INTO order_element (order_id, product_id, number) VALUES (:order_id, :product_id, :number)');
		$statement->bindValue(':order_id', $order_id, PDO::PARAM_INT);
		$statement->bindValue(':product_id', $product_id, PDO::PARAM_INT);
		$statement->bindValue('number', $number, PDO::PARAM_INT);
		$statement->execute()
;	}finally{
	$statement=null;
}
}

function save_order($connection, $order){
	try{
		if(isset($order['id'])){
			$statement=$connection->prepare('UPDATE orderr SET client_id=:client_id, manager_id=:manager_id, order_cost=:order_cost, adress_id=:adress_id, date=CURRENT_DATE, status=:status WHERE id=:id');
			$statement->bindValue(':id', $order['id'], PDO::PARAM_INT);
		}
		else{
		$statement=$connection->prepare('INSERT INTO orderr (client_id, manager_id, order_cost, adress_id, date, status) VALUES (:client_id, :manager_id, :order_cost, :adress_id, CURRENT_DATE, :status)');
	}
		$statement->bindValue(':client_id', $order['client_id'], PDO::PARAM_INT);
		$statement->bindValue(':manager_id', $order['manager_id'], PDO::PARAM_INT);
		$statement->bindValue(':order_cost', $order['order_cost'], PDO::PARAM_INT);
		$statement->bindValue(':adress_id', $order['adress_id'], PDO::PARAM_INT);
		$statement->bindValue(':status', $order['status'], PDO::PARAM_INT);
		$statement->execute();
	}catch(PDOException $e){
		echo $e;
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/laba6/error.php?message='.urlencode($e));
	} 
	finally{
		$statement=null;
	}
}



function delete_order_element($connection, $id){
try{
	$statement=$connection->prepare('DELETE FROM order_element WHERE id=:id');
	$statement->bindValue(':id', $id, PDO::PARAM_INT);
	$statement->execute();
} finally{
	$statement=null;
}
}

function find_order_cost($connection, $order_id){
	try{
		$statement=$connection->prepare('SELECT id, product_id, number FROM order_element WHERE order_id=:order_id');
		$statement->bindValue(':order_id', $order_id, PDO::PARAM_INT);
		$statement->execute();
		$order_elements=$statement->fetchAll(PDO::FETCH_ASSOC);
		$statement2=$connection->prepare('SELECT cost FROM product WHERE id=:id');
		$cost=0;
		foreach($order_elements as $key =>$order_element){
			$statement2->bindValue(':id', $order_element['product_id'], PDO::PARAM_INT);
			$statement2->execute();
			$product_cost=$statement2->fetch(PDO::FETCH_ASSOC);
			$cost=$cost+$product_cost['cost']*$order_element['number'];
		}
		return $cost;
	}finally{
		$statement=null;
		$statement2=null;
	}
}

function read_orders($connection){
	try{
	$statement=$connection->query('SELECT id FROM orderr');
	$orders=$statement->fetchAll(PDO::FETCH_ASSOC);
	return $orders[count($orders)-1]['id'];
}finally{
	$statement=null;
}
}

function delete_order($connection, $id){
	try{
		 $statement = $connection->prepare('DELETE FROM orderr WHERE id=:id');
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    } finally {
        $statement = null;
    }
	}
