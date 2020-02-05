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

	$orderDates = getAllOrdersByDate('Orange Walk');
	$orderStats = array();
	$counter = 0;		

	$connection = new con();
	$Cxn = $connection->getCon();

	for($i=0;$i<count($orderDates);$i++){

		$date = $orderDates[$i]['today'];
		$formattedDate = DateTime::createFromFormat('m-d-y',$date);
		$newDate = $formattedDate->format('Y-m-d');

		$row = array('date'=>$newDate,'value'=>$orderDates[$i]['count']);

		array_push($orderStats,$row);	
		
	}

	echo json_encode($orderStats);

	function getAllOrdersByDate($area){
		$connection = new con();
		$Cxn = $connection->getCon();
			
		$days = array();	
		$counter = 0;

		$sql ="SELECT DISTINCT(`dateToday`) as today, COUNT(`dateToday`) as count FROM `remote_delivery_details` GROUP BY `dateToday` HAVING count > 0";

		$result = mysqli_query($Cxn,$sql);

		while($row=mysqli_fetch_row($result)){

			$days[$counter]['today'] = $row[0];
			$days[$counter]['count'] = $row[1];
			$counter++;
		}

		return $days;
	}

	//SELECT DISTINCT(`dateToday`) as today, COUNT(`dateToday`) as orders FROM `remote_delivery_details` GROUP BY `dateToday` HAVING orders > 0

	//SELECT DISTINCT(`invoice_id`) as uniqueOrder, COUNT(`invoice_id`) as count FROM `remote_delivery_items` WHERE `restaurant_id` = 21 GROUP BY `invoice_id` HAVING count > 0

?>

