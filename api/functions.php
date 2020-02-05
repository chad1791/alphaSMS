<?php 

/*class con{
		
	function getCon(){
		$server = "localhost";
		$username = "id3043585_root";
		$password = "sudoadmin";
		$database = "id3043585_restaurant"; 
		
		$Cxn = mysqli_connect($server,$username,$password,$database);
		return $Cxn;
	}
}*/

class con{
		
	function getCon(){

		require('credentials.php');		
		$Cxn = mysqli_connect($server,$username,$password,$database);
		return $Cxn;
	}
}

////////////// Setter functions ////////////////
	
	function addUser($data){
		
		if(!empty($data)){
			
			$email = $data['email'];
			$password = $data['password'];
			$status = $data['status'];
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "INSERT INTO `users_data` (email,password,status) VALUES('$email','$password','$status')";
			$result = mysqli_query($Cxn,$sql);
			
			return $result;
		}
		else{
			return 0;
		}
	}
	
	function addAdmin($data){
		if(!empty($data)){
			
			$email = $data['email'];
			$password = $data['password'];
			$status = $data['status'];
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "INSERT INTO `admin` (email,password,status) VALUES('$email','$password','$status')";
			$result = mysqli_query($Cxn,$sql);
			
			return $result;
		}
		else{
			return 0;
		}
	}
	
	function addMenu($data){
				
		if(!empty($data) && !empty($data['id'])){
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$id = $data['id'];
			$plate_time = mysqli_real_escape_string($Cxn,$data['plate_time']);
			$plate_name = mysqli_real_escape_string($Cxn,$data['plate_name']);
			$price = $data['price'];
			$location = $data['location'];
			$desc = mysqli_real_escape_string($Cxn,$data['desc']);
			
			$sql = "INSERT INTO `menu` (restaurant_id,cat_name,plate_name,price,location,des) VALUES('$id','$plate_time','$plate_name','$price','$location','$desc')";
			$result = mysqli_query($Cxn,$sql);
			
			if($result){
				return 1;
			}
			else{
				return 0;
			}
		}
		else{
			return 0;
		}
	}

	function updateMenuByCategoryName($catName,$newCat){
		if(!empty($catName) && !empty($newCat)){

			$connection = new con();
			$Cxn = $connection->getCon();

			$cat_name = mysqli_real_escape_string($Cxn,$newCat);

			$sql = "UPDATE `menu` SET `cat_name`='".$newCat."' WHERE `cat_name`='".$catName."'";

			$result = mysqli_query($Cxn,$sql);
			
			if($result){
				return 1;
			}
			else{
				return 0;
			}
		}
	}
	
	function updateMenu($data){
		
		if(!empty($data)){
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$id = $data['id'];
			$plate_time = mysqli_real_escape_string($Cxn,$data['plate_time']);
			$plate_name = mysqli_real_escape_string($Cxn,$data['plate_name']);
			$desc = mysqli_real_escape_string($Cxn,$data['desc']);
			$price = $data['price'];
			
			$sql = "INSERT INTO `menu` (id,cat_name,plate_name,price,des) 
				   VALUES('$id','$plate_time','$plate_name','$price','$desc')
				   ON DUPLICATE KEY UPDATE `cat_name`='$plate_time', `plate_name`='$plate_name', `price`='$price', `des`='$desc'";
			$result = mysqli_query($Cxn,$sql);
			
			if($result){
				return 1;
			}
			else{
				return 0;
			}
		}
		else{
			return 0;
		}
	}

/////////////////////////////////////////////////

function updateCategory($data){
		
		if(!empty($data)){
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$id = $data['id'];
			$cat_name = mysqli_real_escape_string($Cxn,$data['cat_name']);
			
			$sql = "INSERT INTO `category` (id,cat_name) 
				   VALUES('$id','$cat_name')
				   ON DUPLICATE KEY UPDATE `cat_name`='$cat_name'";
			$result = mysqli_query($Cxn,$sql);
			
			if($result){
				return 1;
			}
			else{
				return 0;
			}
		}
		else{
			return 0;
		}
	}

/////////////////////////////////////////////////

	function addCat($data){
				
		if(!empty($data) && !empty($data['id'])){
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$id = $data['id'];
			$location = $data['location'];
			$cat_name = mysqli_real_escape_string($Cxn,$data['cat_name']);

			$sql = "INSERT INTO `category` (restaurant_id,cat_name,location) VALUES('$id','$cat_name','$location')";
			$result = mysqli_query($Cxn,$sql);
			
			if($result){
				return 1;
			}
			else{
				return 0;
			}
		}
		else{
			return 0;
		}
	}

//////////////////////////////////////////////////
	
	function addReview($data){
		
		if(!empty($data)){
			
			$id = $data['id'];
			$review = $data['review'];
			$date = NOW();
			$time = NOW();
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "INSERT INTO `reviews` (restaurant_id,review,date,time) VALUES('$id','$review','$plate_name','$date','$time')";
			$result = mysqli_query($Cxn,$sql);
			
			if($result){
				return 1;
			}
			else{
				return 0;
			}
		}
		else{
			return 0;
		}
		
	}

	function addTaxi($data){
		if(!empty($data)){

			$connection = new con();
			$Cxn = $connection->getCon();

			$name = $data['name'];
			$cell_no = $data['cell_no'];
			$rating = $data['rating'];
			$capacity = $data['capacity'];
			$address = $data['address'];
			$location = $data['location'];

			$sql = "INSERT INTO `taxis` (name,cell_no,rating,capacity,address,location) 
				   VALUES('$name','$cell_no','$rating','$capacity','$address','$location')";

			$result = mysqli_query($Cxn,$sql);
			
			if($result){
				return 1;				
			}
			else{
				return 0;
			}
		}else{
			return 0;
		}
	}

	function addAdminData($data){
		if(!empty($data)){
			$connection = new con();
			$Cxn = $connection->getCon();

			$id = $data['admin'];
			$name = $data['name'];
			$phone = $data['fon'];
			$address = $data['address'];

			$sql = "INSERT INTO `admin_data` (id,name,phone,address) 
				   VALUES('$id','$name','$phone','$address')
				   ON DUPLICATE KEY UPDATE `name`='$name', `phone`='$phone', `address`='$address'";

			$result = mysqli_query($Cxn,$sql);
			
			if($result){
				return 1;				
			}
			else{
				return 0;
			}
		}
		else{
			return 0;
		}
	}
	
	function addRestaurantData($data){
		if(!empty($data)){
			
			$connection = new con();
			$Cxn = $connection->getCon();
                        
            $id = $data['id'];
			$name = mysqli_real_escape_string($Cxn,$data['name']);
			$location = mysqli_real_escape_string($Cxn,$data['location']);
			$food_type = mysqli_real_escape_string($Cxn,$data['foodType']);
			$locale_type = mysqli_real_escape_string($Cxn,$data['localeType']);
			$cell_phone = $data['cell_phone'];
			$message_no = $data['message_no'];
			$distance = mysqli_real_escape_string($Cxn,$data['distance']);
			$sch_one_string = mysqli_real_escape_string($Cxn,$data['shedule1']);
			$sch_one_open = mysqli_real_escape_string($Cxn,$data['schedule1OpenHour']);
			$sch_one_close = mysqli_real_escape_string($Cxn,$data['schedule1CloseHour']);
			$sch_two_string = mysqli_real_escape_string($Cxn,$data['shedule2']);
			$sch_two_open = mysqli_real_escape_string($Cxn,$data['schedule2OpenHour']);
			$sch_two_close = mysqli_real_escape_string($Cxn,$data['schedule2CloseHour']);
			$latitude = mysqli_real_escape_string($Cxn,$data['latitude']);
			$longitude = mysqli_real_escape_string($Cxn,$data['longitude']);
			$delivery = mysqli_real_escape_string($Cxn,$data['delivery']);
			$delivery_details = mysqli_real_escape_string($Cxn,$data['delivery_details']);
			$banner = mysqli_real_escape_string($Cxn,$data['banner']);

			$drinks = $data['drinks'];
			if($drinks == ''){
				$drinks = 'off';
			}
			$wifi = $data['wifi'];
			if($wifi == ''){
				$wifi = 'off';
			}
			$ac = $data['ac'];
			if($ac == ''){
				$ac = 'off';
			}
			$tv = $data['tv'];
			if($tv == ''){
				$tv = 'off';
			}
			$family = $data['family'];
			if($family == ''){
				$family = 'off';
			}
			
			//echo $drinks;
			
			$sql = "INSERT INTO `restaurant_data` (id,name,location,food_type,locale_type,cell_phone,message_no,distance,sch_one_string,sch_one_open,sch_one_close,sch_two_string,sch_two_open,sch_two_close,banner,latitude,longitude,delivery,delivery_details,drinks,wifi,ac,tv,family) 
				   VALUES('$id','$name','$location','$food_type','$locale_type','$cell_phone','$message_no','$distance','$sch_one_string','$sch_one_open','$sch_one_close','$sch_two_string','$sch_two_open','$sch_two_close','$banner','$latitude','$longitude','$delivery','$delivery_details','$drinks','$wifi','$ac','$tv','$family')
				   ON DUPLICATE KEY UPDATE `name`='$name', `location`='$location', `food_type`='$food_type'
				   ,`locale_type`='$locale_type', `cell_phone`='$cell_phone', `message_no`='$message_no'
				   ,`distance`='$distance', `sch_one_string`='$sch_one_string', `sch_one_open`='$sch_one_open', `sch_one_close`='$sch_one_close', `sch_two_string`='$sch_two_string', `sch_two_open`='$sch_two_open', `sch_two_close`='$sch_two_close',
				   `banner`='$banner', `latitude`='$latitude', `longitude`='$longitude', `delivery`='$delivery',`delivery_details`='$delivery_details', `drinks`='$drinks', `wifi`='$wifi', `ac`='$ac', `tv`='$tv', `family`='$family'";
			
			//echo $sql;
			//print_r($data);
			$result = mysqli_query($Cxn,$sql);
			
			if($result){
				return 1;				
			}
			else{
				return 0;
			}			
		}
		else{
			return 0;
		}
	}
		
	/////////////////////////////////////// getter functions ////////////////////////////////////////////
	
	function getAllRestaurants(){
        
        $connection = new con();
		$Cxn = $connection->getCon();
			
		$sql = "SELECT a.* , b.status FROM `restaurant_data` a LEFT JOIN `users_data` b ON a.id=b.id WHERE b.status='active'";

		$result = mysqli_query($Cxn,$sql);			
		$Restaurants = array();

		//echo $result;
		
		if($result){
			
            $count = 0;
                
            while($row=mysqli_fetch_row($result)){
                       
                $count=$count+1;			
                $Restaurants["Restaurant".$count] = $row;

            }
				
            return $Restaurants;                    
		}                
    }

    function getRestaurantsByLocation($data){
        if(!empty($data)){

	        $connection = new con();
			$Cxn = $connection->getCon();
			$location = $data['location'];
				
			//$sql = "SELECT * FROM `restaurant_data` WHERE location='".$location."'";
			$sql = "SELECT a.* , b.status FROM `restaurant_data` a LEFT JOIN `users_data` b ON a.id=b.id WHERE b.status='active' AND a.location='".$location."'";

			$result = mysqli_query($Cxn,$sql);			
			$Restaurants = array();
			
			if($result){
				
	            $count = 0;
	                
	            while($row=mysqli_fetch_row($result)){
	                       
	                $count=$count+1;			
	                $Restaurants["Restaurant".$count] = $row;

	            }
					
	            echo json_encode($Restaurants);              
			}
        }                
    }

    function getCategoriesByLocation($data){
        if(!empty($data)){

	        $connection = new con();
			$Cxn = $connection->getCon();
			$location = $data['location'];
				
			$sql = "SELECT * FROM `category` WHERE location='".$location."'";

			$result = mysqli_query($Cxn,$sql);			
			$Categories = array();
			
			if($result){
				
	            $count = 0;
	                
	            while($row=mysqli_fetch_row($result)){
	                       
	                $count=$count+1;			
	                $Categories["Category".$count] = $row;

	            }
					
	            echo json_encode($Categories);              
			}
        }                
    }

    function getMenuByLocation($data){
        if(!empty($data)){

	        $connection = new con();
			$Cxn = $connection->getCon();
			$location = $data['location'];
				
			$sql = "SELECT * FROM `menu` WHERE location='".$location."' AND active='1'";

			$result = mysqli_query($Cxn,$sql);			
			$Menus = array();
			
			if($result){
				
	            $count = 0;
	                
	            while($row=mysqli_fetch_row($result)){
	                       
	                $count=$count+1;			
	                $Menus["MenuItem".$count] = $row;

	            }
					
	            echo json_encode($Menus);              
			}
        }                
    }

    function getAllLocale(){
        
        $connection = new con();
		$Cxn = $connection->getCon();
			
		$sql = "SELECT * FROM `restaurant_data`";
		$result = mysqli_query($Cxn,$sql);			
		$Restaurants = array();
		
		if($result){
                
            while($row=mysqli_fetch_row($result)){
                       			
                $Restaurants[] = $row;

            }
				
            return $Restaurants;
                    
		}                
    }
	
	function getAllCategories(){
        
        $connection = new con();
		$Cxn = $connection->getCon();
			
		$sql = "SELECT * FROM `category` WHERE location='Orange Walk'";
		$result = mysqli_query($Cxn,$sql);	
		$Categories = array();		
			
		if($result){
			
            $count = 0;
                
            while($row=mysqli_fetch_row($result)){
                       
                $count=$count+1;			
                $Categories["Category".$count] = $row;

            }
				
			return $Categories; 
			
			//echo 'from functions!';
		}                
    }

	function getTodaySpecialsByLocation($location){
        
        $connection = new con();
		$Cxn = $connection->getCon();
			
		$sql = "SELECT m.*, rd.`specials` FROM `menu` m LEFT JOIN `restaurant_data` rd ON m.`restaurant_id` = rd.`id` WHERE m.`cat_name` = 'Todays Special' AND m.`location`='".$location."' AND deleted = '0' ORDER BY rd.`specials` DESC";
		$result = mysqli_query($Cxn,$sql);	
		$Categories = array();		
			
		if($result){
			
            $count = 0;
                
            while($row=mysqli_fetch_row($result)){
                       
                $count=$count+1;			
                $Categories["Special".$count] = $row;

            }
				
            echo json_encode($Categories);
                    
		}                
    }
	
	function getAllMenus($data){

		$result = getFoodTime($data['restaurant_id'],$data['category_id']);
		        
		$Menus = array();		
			
		if($result){
			
            $cnt = 0;
                
            while($row=mysqli_fetch_row($result)){
                       
                $cnt=$cnt+1;			
                $Menus["MenuItem".$cnt] = $row;

            }
				
            echo json_encode($Menus);
                    
		}                
    }//getAllMenusOld

	function getAllMenusOld(){

		$connection = new con();
		$Cxn = $connection->getCon();

		$sql = "SELECT * FROM `menu` WHERE active='1' AND deleted='0'";
		$result = mysqli_query($Cxn,$sql);	
		        
		$Menus = array();		
			
		if($result){
			
            $cnt = 0;
                
            while($row=mysqli_fetch_row($result)){
                       
                $cnt=$cnt+1;			
                $Menus["MenuItem".$cnt] = $row;

            }
				
            echo json_encode($Menus);
                    
		}                
    }

    function getAllMenuById($id){
    	if(!empty($id)){
    		$connection = new con();
			$Cxn = $connection->getCon();

			$sql = "SELECT * FROM `menu` WHERE restaurant_id='".$id."'";
			$result = mysqli_query($Cxn,$sql);	

			if($result){	                                        
	        	return $result;                    
			}
    	}
    }
        
    function getAllEvents(){
        
        $connection = new con();
		$Cxn = $connection->getCon();
			
		$sql = "SELECT * FROM `events`";
		$result = mysqli_query($Cxn,$sql);
		$Events = array();			
			
		if($result){
			
            $count = 0;
                
            while($row=mysqli_fetch_row($result)){
                       
                $count=$count+1;			
                $Events["Event".$count] = $row;

            }
                                        
            echo json_encode($Events);
                    
		}
        else{
            echo 'No data was found!';
        }
    }

    function getEvents(){
    	$connection = new con();
		$Cxn = $connection->getCon();
			
		$sql = "SELECT * FROM `events`";
		$result = mysqli_query($Cxn,$sql);		
		$Events = array();	
			
		if($result){
                
            while($row=mysqli_fetch_row($result)){        			
                $Events[] = $row;
            }
                                        
            return $Events;                    
		}
    }

    //////////// code for taxis for old version /////////

    function getAllTaxis(){
                
        $connection = new con();
		$Cxn = $connection->getCon();
				
		$sql = "SELECT * FROM `taxis`";

		$result = mysqli_query($Cxn,$sql);			
		$Taxis = array();
			
		if($result){
				
	        $count = 0;
	                
	        while($row=mysqli_fetch_row($result)){
	                       
	            $count=$count+1;			
	            $Taxis["Taxi".$count] = $row;
	        }
					
	        echo json_encode($Taxis);            
		}
    }

    ////////////////////////////////////////////////////
        
    function getTaxisByLocation($data){
                
        if(!empty($data)){

	        $connection = new con();
			$Cxn = $connection->getCon();
			$location = $data['location'];
				
			$sql = "SELECT * FROM `taxis` WHERE location='".$location."'";

			$result = mysqli_query($Cxn,$sql);			
			$Taxis = array();
			
			if($result){
				
	            $count = 0;
	                
	            while($row=mysqli_fetch_row($result)){
	                       
	                $count=$count+1;			
	                $Taxis["Taxi".$count] = $row;

	            }
					
	            echo json_encode($Taxis);            
			}
        }  
    }

    function getTaxis(){
    	$connection = new con();
		$Cxn = $connection->getCon();
			
		$sql = "SELECT * FROM `taxis` ORDER BY location ASC";
		$result = mysqli_query($Cxn,$sql);	
		$Taxis = array();		
			
		if($result){
			
            while($row=mysqli_fetch_row($result)){
                $Taxis[] = $row;
            }
                                        
        	return $Taxis;                    
		}
    }
	
	function changePassword($data){
		if(!empty($data)){
			$id = $data['id'];
			$newPassword = $data['new'];
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "UPDATE `users_data` SET `password`='".$newPassword."' WHERE `id`='".$id."'";
			
			$result = mysqli_query($Cxn,$sql);
			
			if($result){
				return 1;
			}else{
				return 0;
			}
		}
	}
	
	function getAllCredentials(){
		
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "SELECT * FROM `users_data` GROUP BY id ASC";
			$result = mysqli_query($Cxn,$sql);
			
			$cred = array();
			
			if($result){
				while($row=mysqli_fetch_array($result)){
					$cred[] = $row;
				}
				
				return $cred;
			}
	}
        
        
    function login($data){
		if(!empty($data)){
			
			$email = $data['email'];
			$passcode = $data['password'];
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "SELECT * FROM `users_data` WHERE email='".$email."' AND password='".$passcode."'";
			$result = mysqli_query($Cxn,$sql);			
			
			if($result){

				$newarray = mysqli_fetch_array($result);
				$db_email = $newarray['email'];
				$db_passcode = $newarray['password'];
				$userId = $newarray['id'];
				$status = $newarray['status'];
				
				if($email == $db_email && $passcode == $db_passcode){					
					$info['response'] = "1";
					$info['id'] = $userId;
					$info['status'] = $status;
					return $info;
				}
				else{
					$info['response'] = "0";
					return $info;
				}
			}
		}
		else{
			return 0;
		}
	}
	
	function loginAdmin($data){
		if(!empty($data)){
			
			$email = $data['email'];
			$passcode = $data['password'];
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "SELECT * FROM `admin` WHERE email='".$email."' AND password='".$passcode."'";
			$result = mysqli_query($Cxn,$sql);			
			
			if($result){

				$newarray = mysqli_fetch_array($result);
				$db_email = $newarray['email'];
				$db_passcode = $newarray['password'];
				$userId = $newarray['id'];
				$status = $newarray['status'];
				
				if($email == $db_email && $passcode == $db_passcode){					
					$info['response'] = "1";
					$info['id'] = $userId;
					$info['status'] = $status;
					return $info;
				}
				else{
					$info['response'] = "0";
					return $info;
				}
			}
		}
		else{
			return 0;
		}
	}
	
	function getAllUsers(){
			
		$connection = new con();
		$Cxn = $connection->getCon();
			
		$sql = "SELECT * FROM `users_data`";
		$result = mysqli_query($Cxn,$sql);			
			
		if($result){
			while($row=mysqli_fetch_row($result)){
				$newarray[] = $row;
			}
				
			return $newarray;
		}
	}

	function getUserById($id){
		if(!empty($id)){
			$connection = new con();
			$Cxn = $connection->getCon();
			$data = array();
			
			$sql = "SELECT * FROM `users_data` WHERE id='".$id."'";
			$result = mysqli_query($Cxn,$sql);	

			if($result)	{
				while ($row=mysqli_fetch_row($result)) {
					$data[] = $row;
				}
			}	
			
			return $data;
		}
	}

    function getAllMenu(){
					
	       $connection = new con();
	       $Cxn = $connection->getCon();
			
	       $sql = "SELECT * FROM `menu` ORDER BY cat_name ASC";
	       $result = mysqli_query($Cxn,$sql);			
			
	       return $result;
	}	
 

	function getRestaurantById($id){
		if(!empty($id)){
			
			$connection = new con();
			$Cxn = $connection->getCon();
			//$data = array();
			
			$sql = "SELECT * FROM `restaurant_data` WHERE id='".$id."'";
			$result = mysqli_query($Cxn,$sql);	

			if($result)	{
				return $result;
			}	
			
			return $result;
		}
	}

	function getPlaceById($id){
		if(!empty($id)){
			
			$connection = new con();
			$Cxn = $connection->getCon();
			$data = array();
			
			$sql = "SELECT * FROM `restaurant_data` WHERE id='".$id."'";
			$result = mysqli_query($Cxn,$sql);	

			if($result)	{

				while ($row=mysqli_fetch_row($result)) {
					$data[] = $row;				
				}

				return $data;
			}	
			
			return $data;
		}
	}
//////////////////////////////////////////////////////////
    
	function getAllCats($id){
              if(!empty($id)){
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "SELECT * FROM `category` WHERE restaurant_id='".$id."'";
			$result = mysqli_query($Cxn,$sql);			
			
			return $result;
		}
		else{
			return 0;
		}
    }
/////////////////////////////////////////////////////////
	
	function getFoodTime($id,$food){
		if(!empty($id) && !empty($food)){
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$food = mysqli_real_escape_string($Cxn,$food);
			
			$sql = "SELECT * FROM `menu` WHERE restaurant_id='".$id."' AND cat_name='".$food."' AND deleted=0";
			$result = mysqli_query($Cxn,$sql);			
			
			return $result;
		}
		else{
			return 0;
		}
	}
	
	function getReviews($id){
		if(!empty($id)){
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "SELECT * FROM `reviews` WHERE restaurant_id='".$id."'";
			$result = mysqli_query($Cxn,$sql);			
			
			return $result;
		}
		else{
			return 0;
		}
	}
	
	function delMenu($id, $resId){
		
		if(!empty($id) && !empty($resId)){
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "DELETE FROM `menu` WHERE id='".$id."' AND restaurant_id='".$resId."'";
			$result = mysqli_query($Cxn,$sql);			
			
			if($result){
				return 1;				
			}
			else{
				return 0;
			}			
		}
		else{
			return 0;
		}
	}

	function delMenuByCategoryName($catName,$rest_id){
		if(!empty($catName)){
			$connection = new con();
			$Cxn = $connection->getCon();

			$sql = "DELETE FROM `menu` WHERE cat_name='".$catName."' AND restaurant_id='".$rest_id."'";
			$result = mysqli_query($Cxn,$sql);			
			
			if($result){
				return 1;				
			}
			else{
				return 0;
			}
		}
	}

	function getCategoryById($id){
		if(!empty($id)){

			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "SELECT * FROM `category` WHERE id='".$id."'";
			$result = mysqli_query($Cxn,$sql);	
			$data = array();		
			
			if($result){
				while ($row=mysqli_fetch_row($result)) {
					$data[] = $row;
				}

				return $data;
			}
		}
	}

	function getAllNotificationsById($id){
		if(!empty($id)){

			$connection = new con();
			$Cxn = $connection->getCon();

			$status = 'unread';
			
			$sql = "SELECT * FROM `notifications` WHERE restaurant_id='".$id."' AND status='".$status."'";
			$result = mysqli_query($Cxn,$sql);				

			return $result;
			
		}
	}

	function getAllInboxById($id){
		if(!empty($id)){

			$connection = new con();
			$Cxn = $connection->getCon();

			$status = 'unread';
			
			$sql = "SELECT * FROM `messages` WHERE restaurant_id='".$id."' AND status='".$status."'";
			$result = mysqli_query($Cxn,$sql);				

			return $result;
			
		}
	}

	function delCategory($id, $resId){
		
		if(!empty($id) && !empty($resId)){
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "DELETE FROM `category` WHERE id='".$id."' AND restaurant_id='".$resId."'";
			$result = mysqli_query($Cxn,$sql);			
			
			if($result){
				return 1;				
			}
			else{
				return 0;
			}			
		}
		else{
			return 0;
		}
	}

	function getAdminById($id){
		if(!empty($id)){
			
			$connection = new con();
			$Cxn = $connection->getCon();
			
			$sql = "SELECT * FROM `admin_data` WHERE id='".$id."'";
			$result = mysqli_query($Cxn,$sql);	
			$data = array();		
			
			if($result){
				while ($row=mysqli_fetch_row($result)) {
					$data[] = $row;
				}

				return $data;
			}
		}
	}

	function placeRemoteDelivery($data){
		if(!empty($data)){

			$connection = new con();
			$Cxn = $connection->getCon();

			$id = $data['id'];			
			$username = $data['username'];
			$phone = $data['phone'];
			$email = $data['email'];
			$lat = $data['lat'];
			$long = $data['long'];
			$address = $data['address'];
			$subtotal = $data['subtotal'];
			$status = $data['status'];
			$timeNow = $data['time'];
			$onesignal_msg = '0';
			$zones = $data['zones'];
			$stops = $data['stops'];

			//////// setting up date for belize time zone ////////

			$timezone = new \DateTimeZone('America/Belize');
            $date = new \DateTime('@' . time(), $timezone);
            $date->setTimezone($timezone);
			$dateToday = $date->format('m-d-y');
			
			/////////////////////////////////////////////////////

			$location = $data['location'];	
			$displayed = 'No';
			$player_id = $data['player_id'];

			$fee = getFeeByArea($location);	
			$zonesFee = getZoneCost($location);
			$stopCost = getStopsCost($location);
			$extraMileCost = $zones * $zonesFee;
			$totalStopsCost = $stops * $stopCost;
			$totalCost = $subtotal + $fee + $extraMileCost + $totalStopsCost;

			$sql = "INSERT INTO `remote_delivery_details` (invoice_id,username,phone,email,lat,longitude,address,subtotal,status,timeNow,dateToday,location,displayed,player_id,onesignal_msg,delivery_fee,mileage_fee,stops) 
				   VALUES('$id','$username','$phone','$email','$lat','$long','$address','$totalCost','$status','$timeNow','$dateToday','$location','$displayed','$player_id','$onesignal_msg','$fee','$extraMileCost','$totalStopsCost')";

			$result = mysqli_query($Cxn,$sql);
			
			if($result){

				$response['status'] = 1;
				$response['area'] = $location;
				$response['totalCost'] = $totalCost;

				return $response;				
			}
			else{
				$response['status'] = 0;
				$response['area'] = $location;
				$response['totalCost'] = 0;

				return $response;	
			}
		}else{
			return 0;
		}
	}

	function getFeeByArea($location){
		if(!empty($location)){

			$connection = new con();
			$Cxn = $connection->getCon();

			$sql = "SELECT `delivery_fees`.`fee_amount` FROM `delivery_fees` WHERE `delivery_fees`.`area_name`='".$location."'";

			$result = mysqli_query($Cxn,$sql);

			$fee = mysqli_fetch_assoc($result);

			return $fee['fee_amount'];

		}
	}

	function getZoneCost($location){
		if(!empty($location)){

			$connection = new con();
			$Cxn = $connection->getCon();

			$sql = "SELECT `delivery_fees`.`zone_fee` FROM `delivery_fees` WHERE `delivery_fees`.`area_name`='".$location."'";

			$result = mysqli_query($Cxn,$sql);

			$fee = mysqli_fetch_assoc($result);

			return $fee['zone_fee'];

		}	
	}

	function getStopsCost($location){
		if(!empty($location)){

			$connection = new con();
			$Cxn = $connection->getCon();

			$sql = "SELECT `delivery_fees`.`stops` FROM `delivery_fees` WHERE `delivery_fees`.`area_name`='".$location."'";

			$result = mysqli_query($Cxn,$sql);

			$fee = mysqli_fetch_assoc($result);

			return $fee['stops'];

		}	
	}

	function placeRemoteDeliveryItems($data){
		if(!empty($data)){

			$connection = new con();
			$Cxn = $connection->getCon();

			$id = $data['invoice_id'];
			$restaurant_id = $data['restaurant_id'];
			$foodId = $data['foodId'];
			$quantity = $data['quantity'];
			$price = $data['price'];
			$total = $data['total'];
			$des = $data['des'];

			$sql = "INSERT INTO `remote_delivery_items` (invoice_id,restaurant_id,foodId,quantity,price,description,total) 
				   VALUES('$id','$restaurant_id','$foodId','$quantity','$price','$des','$total')";

			$result = mysqli_query($Cxn,$sql);
			
			if($result){

				//save stat here...

				$saveStat = insertStat($id,$restaurant_id,$foodId,$quantity,$total);

				return 1;				
			}
			else{
				return 0;
			}
		}else{
			return 0;
		}
	}

	function insertStat($invoice_id,$restaurant_id,$foodId,$quantity,$total){

		$connection = new con();
		$Cxn = $connection->getCon();

		$invoiceDetails = getInvoiceDetailsByInvoiceId($invoice_id);

		$username = '';
		$phone = '';
		$email = '';
		$date = '';
		$time = '';

		while($row=mysqli_fetch_row($invoiceDetails)){
			$username 	= $row[2];
			$phone 		= $row[3];
			$email 		= $row[4];
			$date 		= $row[11];
			$time 		= $row[10];

			echo 'Return Row: ';
			print_r($row);
		}

		$sql = "INSERT INTO `stats` (`id`, `invoice_id`, `restaurant_id`, `food_id`, `quantity`, `total`, `cus_name`, `cus_cell`, `cus_email`, `dateToday`, `timeNow`) VALUES (NULL, '$invoice_id', '$restaurant_id', '$foodId', '$quantity', '$total', '$username', '$phone', '$email', '$date', '$time');";

		$result = mysqli_query($Cxn,$sql);

		echo $sql;

		echo 'Main result: <br/>';
		print_r($result);

	}

	function getInvoiceDetailsByInvoiceId($invoice_id){

		$connection = new con();
		$Cxn = $connection->getCon();

		$details = array();

		$sql = "SELECT * FROM `remote_delivery_details` WHERE `invoice_id`='".$invoice_id."'";

		$result = mysqli_query($Cxn,$sql);

		return $result;

	}

	function searchByMenu($data){

		$connection = new con();
		$Cxn = $connection->getCon();

		$queryString = $data['queryString'];
		$location = $data['location'];

		$details = array();

		$sql = "SELECT * FROM `menu` WHERE `menu`.`plate_name` LIKE '".$queryString."%' AND `menu`.`location` = '".$location. "'";

		$result = mysqli_query($Cxn,$sql);

		return $result;		
	}

	///////////////////////////  functions for Vistro Deliveries App  ///////////////////////////////

	function getAllRemoteDeliveries($location){

		$status = 'Pending';
		$status2 = 'inProgress';
             
        $connection = new con();
		$Cxn = $connection->getCon();
			
		$sql = "SELECT * FROM `remote_delivery_details` WHERE location ='".$location."' AND status='".$status."' OR status='".$status2."'";

		$result = mysqli_query($Cxn,$sql);			
			
		return $result;

	}

	function getAllRemoteDeliveriesByStatus($status){
             
        $connection = new con();
		$Cxn = $connection->getCon();
			
		$sql = "SELECT * FROM `remote_delivery_details` WHERE status='".$status."'";

		$result = mysqli_query($Cxn,$sql);			
			
		return $result;

	}

	function getAllDeliveryFees(){
        $connection = new con();
		$Cxn = $connection->getCon();
			
		$sql = "SELECT * FROM `delivery_fees`";

		$result = mysqli_query($Cxn,$sql);			
			
		return $result;
	}

	function getAllRemoteDeliveryItemsByID($invoice_id){

		if(!empty($invoice_id)){
			
			$connection = new con();
			$Cxn = $connection->getCon();

			$sql = "SELECT `dd`.`id`, `dd`.`invoice_id`, `dd`.`quantity`, `dd`.`price`, `dd`.`description`, `dd`.`total`, `r`.`name`, `r`.`latitude`, `r`.`longitude`, `m`.`plate_name`, `rdd`.`status`  FROM `remote_delivery_items` `dd` LEFT JOIN `restaurant_data` `r` ON `dd`.`restaurant_id` = `r`.`id` LEFT JOIN `menu` `m` ON `dd`.`foodID` = `m`.`id` LEFT JOIN `remote_delivery_details` `rdd` ON `dd`.`invoice_id` = `rdd`.`invoice_id` WHERE `rdd`.`status` = 'Pending' OR `rdd`.`status` = 'inProgress'";

			$result = mysqli_query($Cxn,$sql);			
			
			return $result;
		}
	}

	function changeOrderStatus($status,$id){ //will need to add email,time extra parameter.

		if(!empty($status) && !empty($id)){

			$connection = new con();
			$Cxn = $connection->getCon();

			$sql = "UPDATE `remote_delivery_details` SET `status`='".$status."' WHERE `invoice_id`='".$id."'";

			$result = mysqli_query($Cxn,$sql);

			if($status == 'inProgress'){
				
				//add delivery stats to table.
				//$addDeliveryStat = addDelStat($email,$id,$date,$s_time, '0');

				//change driver availability to false.
				//$toggleDriverAvail = toggleDriverAvail($email,'0');

			}
			else
			if($status =='completed'){

				//update delivery stats on table.
				//$addDeliveryStat = updateDelStat($email,$id,$e_time);

				//update driver availability to true.
				//$toggleDriverAvail = toggleDriverAvail($email,'1');
			}

			return $sql;
		}
		else{
			return 0;
		}

	}

	function updateDriverGPS($data){
		
		$email = $data['email'];
		$lat   = $data['lat'];
		$lang  = $data['lang'];

		$connection = new con();
		$Cxn = $connection->getCon();

		$sql = "UPDATE `drivers_settings` SET `lat`='".$lat."', `lang`='".$lang."' WHERE `email`='".$email."'";

		$result = mysqli_query($Cxn,$sql);
			
		if($result){
			return 1;
		}
		else{
			return 0;
		}
	}

	function getAllDrivers($location){

        $connection = new con();
		$Cxn = $connection->getCon();

		if($location == ''){
			$sql = "SELECT * FROM `drivers_settings`";
		}
		else{
			$sql = "SELECT * FROM `drivers_settings` WHERE `location`='".$location."'";
		}

		$result = mysqli_query($Cxn,$sql);			
			
		return $result;
	}

	function addDelStat($email,$id,$date,$s_time,$e_time){

		$connection = new con();
		$Cxn = $connection->getCon();

		$sql = "INSERT INTO `drivers_stats` (`email`,`invoice_id`,`charge`,`date`,`s_time`,`e_time`,) VALUES ('$email','$id','$charge','$date','$s_time','$e_time')";

		$result = mysqli_query($Cxn,$sql);
			
		if($result){
			return 1;
		}
		else{
			return 0;
		}

	}

	function updateDelStat($email,$id,$e_time){

		$connection = new con();
		$Cxn = $connection->getCon();

		$sql = "UPDATE `drivers_stats` SET `e_time`='".$e_time."' WHERE `invoice_id`='".$id."' AND `email`=".$email."'";

		$result = mysqli_query($Cxn,$sql);
			
		if($result){
			return 1;
		}
		else{
			return 0;
		}

	}

	function toggleDriverAvail($email,$avail){

		$connection = new con();
		$Cxn = $connection->getCon();

		$sql = "UPDATE `drivers_settings` SET `availability`='".$avail."' WHERE `email`='".$email."'";

		$result = mysqli_query($Cxn,$sql);
			
		if($result){
			return 1;
		}
		else{
			return 0;
		}
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////

?>