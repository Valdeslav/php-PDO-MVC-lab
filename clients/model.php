<?php
function read_all_clients($connection){
	try{
		$statement1=$connection->query('SELECT id, name FROM client');
		$clients=$statement1->fetchAll(PDO::FETCH_ASSOC);
		$statement2=$connection->prepare('SELECT id, number, client_id FROM phone WHERE client_id=:client_id');
		foreach($clients as $index=>$client){
			$statement2->bindValue(':client_id', $client['id'], PDO::PARAM_INT);
			$statement2->execute();
			$phones=$statement2->fetchAll(PDO::FETCH_ASSOC);
			$clients[$index]['phone']=[];
			foreach($phones as $phone){
				$clients[$index]['phone'][]=$phone;
			}
		}
		$statement3=$connection->prepare('SELECT id, adress, client_id from adress where client_id=:client_id');
		foreach($clients as $index=>$client){
			$statement3->bindValue(':client_id', $client['id'], PDO::PARAM_INT);
			$statement3->execute();
			$adreses=$statement3->fetchAll(PDO::FETCH_ASSOC);
			$clients[$index]['adress']=[];
			foreach($adreses as $adress){
				$clients[$index]['adress'][]=$adress;
			}
		}
		return $clients;
	}finally{
		$statement1=null;
		$statement2=null;
		$statement3=null;
	}
}

function delete_adress($connection, $id){
	try{
		$statement=$connection->prepare('DELETE FROM adress WHERE id=:id');
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		 $statement->execute();
	} finally {
        $statement = null;
    }
}

function delete_phone($connection, $id){
	try{
		$statement=$connection->prepare('DELETE FROM phone WHERE id=:id');
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		 $statement->execute();
	} finally {
        $statement = null;
    }
}

function read_client_by_id($connection, $id){
	try{
		$statement1=$connection->prepare('SELECT id, name FROM client WHERE id=:id');
		$statement1->bindValue(':id', $id, PDO::PARAM_INT);
		$statement1->execute();
		$client=$statement1->fetch(PDO::FETCH_ASSOC);
		$statement2=$connection->prepare('SELECT id, number, client_id FROM phone WHERE client_id=:client_id');
		$statement2->bindValue(':client_id', $client['id'], PDO::PARAM_INT);
		$statement2->execute();
		$phones=$statement2->fetchAll(PDO::FETCH_ASSOC);
		$client['phone']=[];
			foreach($phones as $phone){
				$client['phone'][]=$phone;
			}
		$statement3=$connection->prepare('SELECT id, adress, client_id FROM adress WHERE client_id=:client_id');
		$statement3->bindValue(':client_id', $client['id'], PDO::PARAM_INT);
		$statement3->execute();
		$adreses=$statement3->fetchAll(PDO::FETCH_ASSOC);
		$client['adress']=[];
			foreach($adreses as $adress){
				$client['adress'][]=$adress;
			}
		return $client;
	}finally{
		$statement=null;
	}
}
function save_adress($connection, $adress){
	try{
		$statement=$connection->prepare('INSERT INTO adress (adress, client_id) VALUES (:adress, :client_id)');
		$statement->bindValue(':adress', $adress['adress'], PDO::PARAM_STR);
		$statement->bindValue(':client_id', $adress['client_id'], PDO::PARAM_INT);
		$statement->execute();
	} finally{
		$statement=null;
	}
}

function save_phone($connection, $phone){
	try{
		$statement=$connection->prepare('INSERT INTO phone (number, client_id) VALUES (:number, :client_id)');
		$statement->bindValue(':number', $phone['number'], PDO::PARAM_STR);
		$statement->bindValue(':client_id', $phone['client_id'], PDO::PARAM_INT);
		$statement->execute();
	} finally{
		$statement=null;
	}
}

function save_client($connection, $client){
	try{
		if(isset($client['id'])){
			$statement=$connection->prepare('UPDATE client SET name=:name WHERE id=:id');
			$statement->bindValue(':id', $client['id'], PDO::PARAM_INT);
		}
		else{
			$statement1=$connection->prepare('INSERT INTO "user" (login, password, role) values(:login, :password, 3)');
			$statement1->bindValue(':login', 'login', PDO::PARAM_STR);
			$statement1->bindValue(':password', 'pass', PDO::PARAM_STR);
			$statement1->execute();
			$statement2=$connection->query('SELECT id from "user"');
			$users_id=$statement2->fetchAll(PDO::FETCH_ASSOC);
			$n=count($users_id);
			$statement=$connection->prepare('INSERT INTO client(id, name) VALUES (:id,:name)');
			$statement->bindValue(':id', $users_id[$n-1]['id'], PDO::PARAM_INT);
		}
		$statement->bindValue(':name', $client['name'], PDO::PARAM_STR);
		$statement->execute();
	} finally{
		$statement=null;
		$statement1=null;
		$statement2=null;
	}
}

function delete_client($connection, $id){
	try{
		$statement=$connection->prepare('DELETE FROM client WHERE id=:id');
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();
	}finally{
		$statement=null;
	}
}