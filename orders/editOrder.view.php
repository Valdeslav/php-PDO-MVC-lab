<!DOCTYPE html>
<?php
$categories=$GLOBALS['categories'];
$title=$GLOBALS['title'];
$order=$GLOBALS['order'];
$managers=$GLOBALS['managers'];
$adreses=$GLOBALS['adreses'];
$statuses=['new','confirmed by the manager', 'paid', 'transferred to the courier', 'deliverd'];
?>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
</head>
<body>
	<h1><?php echo $title; ?></h1>
         <form action="editProductsSet.php" method="post">
                   <?php
                if(isset($order['id'])){
                        ?>
                  <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>" >      
                Добавить товары:<br>
             
                        <select name="products[]" size="10" multiple>
                                <?php
                                foreach($categories as $category){
                                        ?>
                                         <optgroup label="<?php echo $category['name']; ?>">
                                                <?php
                                                foreach($category['products'] as $product){
                                                ?>
                                                <option value="<?php echo $product['id']; ?>"><?php echo $product['name'].'&nbsp;цена:&nbsp;'.$product['cost']; ?></option>
                                                <?php
                                        }
                                        }
                                        ?>
                        </select>
                         <br>
                         Количество единиц каждого товара:<br>
                         <input type="text" name='number'><br>
                <button name="addP" type="submit" value="1"> добавить выбранные товары</button><br>

        Выбранные товары:<br>
        <select name="order_element[]" size="10" multiple>
                <?php
                foreach($order['order_element'] as $cur_elem){
                        ?>
                        <option value="<?php echo $cur_elem['id']; ?>"><?php echo $cur_elem['product']['name'].'&nbsp;'.'&nbsp;кол-во:&nbsp;'.$cur_elem['number']; ?></option>
                        <?php
                }
                ?>
                        
        </select>
        <br>
        <button name="delP" type="submit" value="1">удалить выбранные товары</button>
                        <?php
                }
                ?>
               
        </form>

         
    

        <form action="saveOrder.php" method="post">
        	<?php
        	if(isset($order['id'])){
        		?>
        		<input type="hidden" name="id" value="<?php echo $order['id']; ?>">
        		<?php
        	}
        	?>

                <input type="hidden" name="client_id" value="<?php echo $order['client_id'];?>">
        	Менеджер оформляющий заказ:<br>
        	<select name="manager">
        		<?php
        		foreach($managers as $manager){
        			?>
        			<option value="<?php echo $manager['id']; ?>"<?php
        			if($manager['id'] ==$order['manager_id']){?> selected<?php } ?>><?php echo $manager['name']; ?></option>
        			<?php
        		}
        		?>
        	</select>
        	<br>
        	Адрес доставки:<br>
        	<select name="adress">
        		<?php
        		foreach($adreses as $adress){
        			?>
        			<option value="<?php echo $adress['id']; ?>"<?php
        			if($adress['id'] ==$order['adress_id']){?> selected<?php } ?>><?php echo $adress['adress']; ?></option>
        			<?php
        		}
        		?>
        	</select>
        	<br>
        	<?php 
        	if(!isset($order['id'])){
        		?>
        		<button type="submit">далее</button>
        		<?php
        	}
        	?>
                <?php
                if(isset($order['id'])){
                        ?>
                Статус:<br>
                <select name="status">
                        <?php
                        foreach($statuses as $status){
                                ?>
                                <option value="<?php echo $order['status']; ?>"<?php
                                if($status ==$order['status']){?> selected<?php } ?>><?php echo $status; ?></option>
                                <?php
                        }
                        ?>
                </select>
                <br>
                 <button type="submit">сохранить</button>
       <button type="submit" formaction="deleteOrder.php">удалить</button><br>
                <?php

        }
        ?>
        <a href="../clients/clientsList.php">к списку клиентов</a>
        </form>
        
</body>
</html>