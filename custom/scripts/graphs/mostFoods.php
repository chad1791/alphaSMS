<?php 

	session_start();

	class con{
		function getCon(){			
			require('../credentials.php');			
			$Cxn = mysqli_connect($server,$username,$password,$database);
			return $Cxn;
		}
	}

	//$invoice_id = $_GET['invoice_id'];

	$colors = array('#3498DB','#E67E22','#9B59B6','#CCD1D1','#ABEBC6','#E74C3C','#1D8348','#196F3D','#1ABC9C','#76448A','#212F3C','#A04000','#16A085','#7DCEA0','#F5CBA7','#5499C7','#48C9B0','#FAD7A0','#E74C3C','#45B39D','#7DCEA0','#21618C','#B9770E','#616A6B','#A569BD','#F0B27A','#AEB6BF','#0E6655','#A04000','#979A9A','#1ABC9C','#F5CBA7','#D98880','#154360');

	$foods = getAllFoodsOrdered();
	$foodStats = array();
	$counter = 0;		

	$connection = new con();
	$Cxn = $connection->getCon();
	$colorId = 0;

	for($i=0;$i<count($foods);$i++){

		$colorId++;

		//get restaurant id

		$rest_id = getRestaurantIdByFoodId($foods[$i]['foodId']);

		//get restaurant name by id

		$restaurantName = getRestaurantName($rest_id);
		$shortName = mb_strimwidth($restaurantName, 0, 9, '...');

		//get food name by foodId

		$foodName = getFoodName($foods[$i]['foodId']);		
	

		$row = array('country'=>$shortName,'visits'=>$foods[$i]['count'],'color'=>$colors[$colorId],'food'=>$foodName,'completeName'=>$restaurantName);

		if($colorId >= 33){
			$colorId = 0;
		}

		array_push($foodStats,$row);	
		
	}

	echo json_encode($foodStats);

	function getAllFoodsOrdered(){

		$start_date = $_GET['start'];
		$end_date = $_GET['end'];
		$location = $_GET['location'];

		$connection = new con();
		$Cxn = $connection->getCon();
			
		$ids = array();	
		$counter = 0;

		if($start_date != 'All'){

			$sql ="SELECT DISTINCT(`foodId`) as ids, COUNT(`foodId`) as cnt FROM (SELECT `rdi`.`restaurant_id`, `rdi`.`foodId` FROM `remote_delivery_items` `rdi` LEFT JOIN `remote_delivery_details` `rdd` ON `rdi`.`invoice_id` = `rdd`.`invoice_id` WHERE `rdd`.`dateToday` >= '".$start_date."' AND `rdd`.`dateToday` <= '".$end_date."' AND `rdd`.`location` = '".$location."') `list` GROUP BY `foodId` HAVING cnt > 1 ORDER BY cnt DESC LIMIT 20";
		}
		else{

			$sql ="SELECT DISTINCT(`foodId`) as ids, COUNT(`foodId`) as cnt FROM (SELECT `rdi`.`restaurant_id`, `rdi`.`foodId` FROM `remote_delivery_items` `rdi` LEFT JOIN `remote_delivery_details` `rdd` ON `rdi`.`invoice_id` = `rdd`.`invoice_id` WHERE `rdd`.`location` ='".$location."') `list` GROUP BY `foodId` HAVING cnt > 1 ORDER BY cnt DESC LIMIT 20";
		}

		$result = mysqli_query($Cxn,$sql);

		while($row=mysqli_fetch_row($result)){

			$ids[$counter]['foodId'] = $row[0];
			$ids[$counter]['count'] = $row[1];
			$counter++;
		}

		return $ids;
	}

	function getRestaurantName($rest_id){

		$connection = new con();
		$Cxn = $connection->getCon();		

		$sql = "SELECT `restaurant_data`.`name` FROM `restaurant_data` WHERE id='".$rest_id."'";
		$result = mysqli_query($Cxn,$sql);	

		$restaurantName=mysqli_fetch_assoc($result);


		return $restaurantName['name'];
	}

	function getFoodName($foodId){

		$connection = new con();
		$Cxn = $connection->getCon();		

		$sql = "SELECT `menu`.`plate_name` FROM `menu` WHERE id='".$foodId."'";
		$result = mysqli_query($Cxn,$sql);	

		$foodName=mysqli_fetch_assoc($result);


		return $foodName['plate_name'];
	}

	function getRestaurantIdByFoodId($foodId){

		$connection = new con();
		$Cxn = $connection->getCon();		

		$sql = "SELECT `menu`.`restaurant_id` FROM `menu` WHERE id='".$foodId."'";
		$result = mysqli_query($Cxn,$sql);	

		$rest_id=mysqli_fetch_assoc($result);

		return $rest_id['restaurant_id'];
	}


	//////// sample queries 

		//SELECT DISTINCT(`foodId`) as ids, COUNT(`foodId`) as cnt FROM (SELECT `rdi`.`restaurant_id`, `rdi`.`foodId` FROM `remote_delivery_items` `rdi` LEFT JOIN `remote_delivery_details` `rdd` ON `rdi`.`invoice_id` = `rdd`.`invoice_id` WHERE `rdd`.`dateToday` >= '10-01-18' AND `rdd`.`dateToday` <= '10-05-18' AND `rdd`.`location` = 'Orange Walk') `list` GROUP BY `foodId` HAVING cnt > 1 ORDER BY cnt DESC LIMIT 20

?>

