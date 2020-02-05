<?php 

	session_start();

	class con{
		function getCon(){			
			require('../credentials.php');			
			$Cxn = mysqli_connect($server,$username,$password,$database);
			return $Cxn;
		}
	}

	$id = $_GET['restaurant_id'];

	$colors = array('#3498DB','#E67E22','#9B59B6','#CCD1D1','#ABEBC6','#E74C3C','#1D8348','#196F3D','#1ABC9C','#76448A','#212F3C','#A04000','#16A085','#7DCEA0','#F5CBA7','#5499C7','#48C9B0','#FAD7A0','#E74C3C','#45B39D','#7DCEA0','#21618C','#B9770E','#616A6B','#A569BD','#F0B27A','#AEB6BF','#0E6655','#A04000','#979A9A','#1ABC9C','#F5CBA7','#D98880','#154360');

	$foods = getAllFoodsOrdered($id);
	$foodStats = array();
	$counter = 0;		

	$connection = new con();
	$Cxn = $connection->getCon();
	$colorId = 0;

	for($i=0;$i<count($foods);$i++){

		$colorId++;

		//get food name by foodId

		$foodName = getFoodName($foods[$i]['food_id']);	
		$shortName = mb_strimwidth($foodName, 0, 9, '...');	

		$row = array('country'=>$shortName,'visits'=>$foods[$i]['count'],'color'=>$colors[$colorId],'food'=>$foodName,'completeName'=>$foodName);

		if($colorId >= 33){
			$colorId = 0;
		}

		array_push($foodStats,$row);	
		
	}

	echo json_encode($foodStats);

	function getAllFoodsOrdered($restaurant_id){

		$start_date = $_GET['start'];
		$end_date = $_GET['end'];
		$location = $_GET['location'];

		$connection = new con();
		$Cxn = $connection->getCon();
			
		$ids = array();	
		$counter = 0;

		if($start_date != 'All'){

			$sql ="SELECT DISTINCT(`foodId`) as food_id, COUNT(`foodId`) as count FROM (SELECT `rdi`.`foodId` FROM `remote_delivery_items` `rdi` LEFT JOIN `remote_delivery_details` `rdd` ON `rdi`.`invoice_id` = `rdd`.`invoice_id` WHERE `rdi`.`restaurant_id` = '".$restaurant_id."' AND `rdd`.`dateToday` >= '".$start_date."' AND `rdd`.`dateToday` <= '".$end_date."' AND location='".$location."') `list` GROUP BY `foodId` HAVING count > 0 ORDER BY count DESC LIMIT 10 ";
		}
		else{

			$sql ="SELECT DISTINCT(`foodId`) as food_id, COUNT(`foodId`) as count FROM (SELECT `rdi`.`foodId` FROM `remote_delivery_items` `rdi` LEFT JOIN `remote_delivery_details` `rdd` ON `rdi`.`invoice_id` = `rdd`.`invoice_id` WHERE `rdi`.`restaurant_id` ='".$restaurant_id."' AND location='".$location."') `list` GROUP BY `foodId` HAVING count > 0 ORDER BY count DESC LIMIT 10 ";			

		}

		$result = mysqli_query($Cxn,$sql);

		while($row=mysqli_fetch_row($result)){

			$ids[$counter]['food_id'] = $row[0];
			$ids[$counter]['count'] = $row[1];
			$counter++;
		}

		return $ids;
	}

	function getFoodName($foodId){

		$connection = new con();
		$Cxn = $connection->getCon();		

		$sql = "SELECT `menu`.`plate_name` FROM `menu` WHERE id='".$foodId."'";
		$result = mysqli_query($Cxn,$sql);	

		$foodName=mysqli_fetch_assoc($result);


		return $foodName['plate_name'];
	}

	//SELECT DISTINCT(`foodId`) as ids, COUNT(`foodId`) as cnt FROM `remote_delivery_items` WHERE `restaurant_id` = 25 GROUP BY `foodId` HAVING cnt > 1 ORDER BY cnt DESC LIMIT 20


	////// 
		//SELECT `rdi`.`foodId` FROM `remote_delivery_items` `rdi` LEFT JOIN `remote_delivery_details` `rdd` ON `rdi`.`invoice_id` = `rdd`.`invoice_id` WHERE `rdi`.`restaurant_id` = '17' AND `rdd`.`dateToday` = '10-01-18';

		//SELECT DISTINCT(`foodId`) as food_id, COUNT(`foodId`) as count FROM (SELECT `rdi`.`foodId` FROM `remote_delivery_items` `rdi` LEFT JOIN `remote_delivery_details` `rdd` ON `rdi`.`invoice_id` = `rdd`.`invoice_id` WHERE `rdi`.`restaurant_id` = '21' AND `rdd`.`dateToday` = '10-01-18') `list`

		//SELECT DISTINCT(`foodId`) as food_id, COUNT(`foodId`) as count FROM (SELECT `rdi`.`foodId` FROM `remote_delivery_items` `rdi` LEFT JOIN `remote_delivery_details` `rdd` ON `rdi`.`invoice_id` = `rdd`.`invoice_id` WHERE `rdi`.`restaurant_id` = '21' AND `rdd`.`dateToday` = '10-01-18') `list` GROUP BY `foodId` HAVING count > 0 ORDER BY count DESC LIMIT 10 

?>

