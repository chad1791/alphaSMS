<?php 

	session_start();

	class con{
		function getCon(){			
			require('credentials.php');			
			$Cxn = mysqli_connect($server,$username,$password,$database);
			return $Cxn;
		}
	}

	$invoice_id = $_GET['invoice_id'];

	$counter = 0;	

	$orders = array();	

	$connection = new con();
	$Cxn = $connection->getCon();
			

	$sql = "SELECT * FROM `remote_delivery_items` WHERE invoice_id='".$invoice_id."'";
	$result = mysqli_query($Cxn,$sql);			

	while($row=mysqli_fetch_row($result)){

		$restaurantInfo = getRestaurantNameById($row[2]);

		$orders[$counter]['Id'] = $row[1];
		$orders[$counter]['restaurantName'] = $restaurantInfo['name'];
		$orders[$counter]['category'] = getCategoryByFoodId($row[3]);
		$orders[$counter]['foodName'] = getFoodNameById($row[3]);
		$orders[$counter]['quantity'] = $row[4];
		$orders[$counter]['total'] = $row[5];
		$orders[$counter]['desc'] = $row[6];
		$orders[$counter]['phone'] = $restaurantInfo['phone'];
		$orders[$counter]['cell'] = $restaurantInfo['cell'];
		
		$counter++;
	}

	echo json_encode($orders);


	function getRestaurantNameById($id){
		$connection = new con();
		$Cxn = $connection->getCon();
			
		$newRow = array();	
		$restaurant = array();

		$sql = "SELECT `restaurant_data`.`name`, `restaurant_data`.`cell_phone`, `restaurant_data`.`message_no` FROM `restaurant_data` WHERE id='".$id."'";
		$result = mysqli_query($Cxn,$sql);

		while($row=mysqli_fetch_row($result)){
			$restaurant['name'] = $row[0];
			$restaurant['phone'] = $row[1];
			$restaurant['cell'] = $row[2];
		}

		return $restaurant;
	}

	function getFoodNameById($id){
		$connection = new con();
		$Cxn = $connection->getCon();
			
		$newRow = array();	
		$foodName = 0;

		$sql = "SELECT `menu`.`plate_name` FROM `menu` WHERE id='".$id."'";
		$result = mysqli_query($Cxn,$sql);

		while($row=mysqli_fetch_row($result)){
			$foodName = $row[0];
		}

		return $foodName;
	}

	function getCategoryByFoodId($id){
		$connection = new con();
		$Cxn = $connection->getCon();
			
		$newRow = array();	
		$category = 0;

		$sql = "SELECT `menu`.`cat_name` FROM `menu` WHERE id='".$id."'";
		$result = mysqli_query($Cxn,$sql);

		while($row=mysqli_fetch_row($result)){
			$category = $row[0];
		}

		return $category;
	}

?>