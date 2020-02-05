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
	$start_date = $_GET['start'];
	$end_date = $_GET['end'];
	$location = $_GET['location'];

	$restaurantIds = getAllRestaurantIdsByArea($location,$start_date,$end_date);

	$colors = array('#3498DB','#E67E22','#9B59B6','#CCD1D1','#ABEBC6','#E74C3C','#1D8348','#196F3D','#1ABC9C','#76448A','#212F3C','#A04000','#16A085','#7DCEA0','#F5CBA7','#5499C7','#48C9B0','#FAD7A0','#E74C3C','#45B39D','#7DCEA0','#21618C','#B9770E','#616A6B','#A569BD','#F0B27A','#AEB6BF','#0E6655','#A04000','#979A9A','#1ABC9C','#F5CBA7','#D98880','#154360');

	$counter = 0;
	$restStats = array();	

	$connection = new con();
	$Cxn = $connection->getCon();

	for($i=0;$i<count($restaurantIds);$i++){

		if($start_date != 'All'){
			$sql = "SELECT COUNT(*) AS total FROM `remote_delivery_items` `rd` LEFT JOIN `remote_delivery_details` `rdd` ON `rd`.`invoice_id` = `rdd`.`invoice_id` WHERE `rdd`.`dateToday`>='".$start_date."' AND `rdd`.`dateToday`<='".$end_date."' AND restaurant_id='".$restaurantIds[$i]['id']."'";
		}
		else{
			$sql = "SELECT COUNT(*) AS total FROM `remote_delivery_items` WHERE restaurant_id='".$restaurantIds[$i]['id']."'";
		}

		$result = mysqli_query($Cxn,$sql);	

		$rowsCount=mysqli_fetch_assoc($result);
		$restName = $restaurantIds[$i]['name'];

		$shortName = mb_strimwidth($restName, 0, 9, '...');

		if($rowsCount['total'] > 0){

			$row = array('country'=>$shortName,'visits'=>$rowsCount['total'],'color'=>$colors[$i],'completeName'=>$restName);
			array_push($restStats,$row);
		}
		
	}

	echo json_encode($restStats);


	function getAllRestaurantIdsByArea($area){
		$connection = new con();
		$Cxn = $connection->getCon();
			
		$ids = array();	
		$counter = 0;

		$sql = "SELECT `restaurant_data`.`id`, `restaurant_data`.`name` FROM `restaurant_data` WHERE location='".$area."'";				

		$result = mysqli_query($Cxn,$sql);

		while($row=mysqli_fetch_row($result)){
			$ids[$counter]['id'] = $row[0];
			$ids[$counter]['name'] = $row[1];
			$counter++;
		}

		return $ids;
	}

?>