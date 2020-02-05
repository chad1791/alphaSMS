<?php 

header("Content-Type:application/json");

include_once('functions.php');
//session_start();

$_SESSION["Error"] = '';
$_SESSION["Success"] = '';

///////////////// Registering restaurant into the system ///////////////

if(isset($_POST['addUser'])){
	if(!empty($_POST['email']) && !empty($_POST['password'])){
				
		$param['email'] = $_POST['email'];
		$param['password'] = $_POST['password'];
		$param['status'] = "inactive";
	
		$confirm = addUser($param);
		if($confirm){
			unset($_POST['addUser']);
			unset($_POST['email']);
			unset($_POST['password']);
			$_SESSION["Success"] = 'Your account has been successfully created! Your current account status is inactive, please send an e-mail to: codetech.belize@gmail.com to request account activation. ';
			header('Location:../pages/register.php');
			
		}
		else{
			unset($_POST['addUser']);
			unset($_POST['email']);
			unset($_POST['password']);
			$_SESSION['Error'] = 'Your account could not be created. Please e-mail codetech.belize@gmail.com for assistance!';
			header('Location:../pages/register.php');
		};		
	}
	else{
		$_SESSION['Error'] = 'Please fill in all spaces!';
		header('Location:../pages/register.php');
	}
}

/////////////////////////////////////////////////////////////////////

///////////////// Password refresh for restaurants  /////////////////

if(isset($_POST['changePassword'])){
	if(!empty($_POST['old']) && !empty($_POST['new']) && !empty($_POST['confirm'])){
				
		if(isset($_SESSION['id'])){
			$id = $_SESSION['id'];
		}
		
		$param['id'] = $id;
		$param['old'] = $_POST['old'];
		$param['new'] = $_POST['new'];
		$param['confirm'] = $_POST['confirm'];
		
		if($param['new'] != $param['confirm']){
			$_SESSION['Error'] = 'Passwords don\'t match!';
			header('Location:../pages/changepassword.php');
		}else{
			
			$getRawCredentials = getCredentials($id);
			//print_r($getRawCredentials);
			if(!empty($getRawCredentials)){
				if($getRawCredentials == $param['old']){
					$confirm = changePassword($param);
					if($confirm){
						$_SESSION["Success"] = 'Password was successfully changed!';
						header('Location:../pages/changepassword.php');
					}else{
						$_SESSION['Error'] = 'Passwords could not be changed at this time.';
						header('Location:../pages/changepassword.php');
					}
				}
				else{
					//echo 'wrong password!';
					$_SESSION['Error'] = 'Password is incorrect, type again old password!';
					header('Location:../pages/changepassword.php');
				}
			}
		}

		unset($_POST['changePassword']);
		unset($_POST['old']);
		unset($_POST['new']);
		unset($_POST['confirm']);
	}
	else{
				
		unset($_POST['changePassword']);
		unset($_POST['old']);
		unset($_POST['new']);
		unset($_POST['confirm']);
		$_SESSION['Error'] = 'Please fill in all spaces!';
		header('Location:../pages/changepassword.php');
	}
}

function getCredentials($id){
	if(!empty($id)){

		$connection = new con();
		$Cxn = $connection->getCon();

		$sql = "SELECT `users_data`.`password` FROM `users_data` WHERE `users_data`.`id`='".$id."'";

		$result = mysqli_query($Cxn,$sql);

		$rawPd = mysqli_fetch_assoc($result);

		return $rawPd['password'];
	}
}

/////////////////////////////////////////////////////////////////////

///////////////// Registering Administrator into the system ///////////////

if(isset($_POST['addAdmin'])){
	if(!empty($_POST['email']) && !empty($_POST['password'])){
				
		$param['email'] = $_POST['email'];
		$param['password'] = $_POST['password'];
		$param['status'] = "inactive";
	
		$confirm = addAdmin($param);
		if($confirm){
			unset($_POST['addAdmin']);
			unset($_POST['email']);
			unset($_POST['password']);
			$_SESSION["Success"] = 'Your account has been successfully created! Your current account status is inactive, please send an e-mail to: codetech.belize@gmail.com to request account activation. ';
			header('Location:../admin/register.php');
			
		}
		else{
			unset($_POST['addAdmin']);
			unset($_POST['email']);
			unset($_POST['password']);
			$_SESSION['Error'] = 'Your account could not be created. Please e-mail codetech.belize@gmail.com for assistance!';
			header('Location:../admin/register.php');
		};		
	}
	else{
		$_SESSION['Error'] = 'Please fill in all spaces!';
		header('Location:../admin/register.php');
	}
}

/////////////////////////////////////////////////////////////////////

///////////////// Adding restaurant menu into the system ///////////////

if(isset($_POST['addMenu'])){
	
	if(isset($_SESSION['id'])){
		$id = $_SESSION['id'];
	}
	
	if(!empty($_POST['plate_time']) && !empty($_POST['plate_name'])){
				
		$param['id'] = $id;
		$param['plate_time'] = $_POST['plate_time'];
		$param['plate_name'] = $_POST['plate_name'];
		$param['price'] = $_POST['price'];
		$param['location'] = $_POST['location'];
		$param['desc'] = $_POST['desc'];
	
		$confirm = addMenu($param);
		if($confirm){

			$_SESSION["Success"] = 'Menu Item ['. $_POST['plate_name'] . '] was successfully added to the database';
			unset($_POST['plate_time']);
			unset($_POST['plate_name']);
			unset($_POST['price']);
			unset($_POST['location']);
			unset($_POST['desc']);
			header('Location:../pages/newMenuItem.php');
		}
		else{
			unset($_POST['plate_time']);
			unset($_POST['plate_name']);
			unset($_POST['price']);
			unset($_POST['location']);
			unset($_POST['desc']);
			$_SESSION['Error'] = 'Unable to add Menu Item to the database. Try again later!';
			header('Location:../pages/newMenuItem.php');
			//Respond(200,"Your data could not be added to the system!","Sorry");
		}	
	}
	else{

		unset($_POST['plate_time']);
		unset($_POST['plate_name']);
		unset($_POST['price']);
		unset($_POST['location']);
		unset($_POST['desc']);
		$_SESSION['Error'] = 'Error: Item Name cannot be empty!';
		header('Location:../pages/newMenuItem.php');
	}
}

/////////////////////////////////////////////////////////////////////

////////// Adding restaurant menu category into the system //////////

if(isset($_POST['addCat'])){
	
	if(isset($_SESSION['id'])){
		$id = $_SESSION['id'];
	}
	
	if(!empty($_POST['cat_name'])){
				
		//$param['id'] = $id;
		$param['id'] = $_POST['id'];
		$param['cat_name'] = $_POST['cat_name'];
		$param['location'] = $_POST['location'];
	
		$confirm = addCat($param);
		if($confirm){
			$_SESSION["Success"] = 'Category ['. $_POST['cat_name'] . '] was successfully added to the database';
			unset($_POST['cat_name']);
			unset($_POST['location']);
			header('Location:../pages/newCategory.php');
		}
		else{
			$_SESSION['Error'] = 'Unable to add Category to the database. Try again later!';
			unset($_POST['cat_name']);
			unset($_POST['location']);
			header('Location:../pages/newCategory.php');
			//Respond(200,"Your data could not be added to the system!","Sorry");
		}	
	}
	else{

		unset($_POST['cat_name']);
		unset($_POST['location']);
		$_SESSION['Error'] = 'Error: Category Name cannot be empty!';
		header('Location:../pages/newCategory.php');
	}
}

/////////////////////////////////////////////////////////////////////

///////////////// Adding restaurant review into the system ///////////////

if(isset($_POST['addReview'])){
	
	if(!empty($_POST['id']) && !empty($_POST['review'])){
				
		$param['id'] = $_POST['id'];
		$param['review'] = $_POST['review'];
	
		$confirm = addReview($param);
		if($confirm){
			unset($_POST['id']);
			unset($_POST['review']);
			//Respond(200,"You have successfully registered to the system.","Success");
		}
		else{
			unset($_POST['id']);
			unset($_POST['review']);
			//Respond(200,"Your data could not be added to the system!","Sorry");
		};		
	}
	else{
		$_SESSION['Error'] = 'Error: Please fill in all empty fields!';
		//header('Location:../pages/forms.php');
	}
}

/////////////////////////////////////////////////////////////////////

//////////////// Adding new Taxi to the system ///////////////////

if(isset($_POST['addTaxi'])){
	if(!empty($_POST['driverName'])&& !empty($_POST['fon']) && !empty($_POST['address']) && !empty($_POST['location']) && !empty($_POST['capacity']) && !empty($_POST['rating'])){

		$param['name'] = $_POST['driverName'];
		$param['cell_no'] = $_POST['fon'];
		$param['address'] = $_POST['address'];
		$param['location'] = $_POST['location'];
		$param['capacity'] = $_POST['capacity'];
		$param['rating'] = $_POST['rating'];

		$confirm = addTaxi($param);

		if($confirm){
			unset($_POST['driverName']);
			unset($_POST['fon']);
			unset($_POST['address']);
			unset($_POST['location']);
			unset($_POST['capacity']);
			unset($_POST['rating']);
			$_SESSION['Success'] = 'Taxi data was successfully added to the database!';
			header('Location:../admin/pages/taxis.php');

		}else{
			unset($_POST['driverName']);
			unset($_POST['fon']);
			unset($_POST['address']);
			unset($_POST['location']);
			unset($_POST['capacity']);
			unset($_POST['rating']);
			$_SESSION['Error'] = 'Taxi data could not be added at this time. Try again later!';
			header('Location:../admin/pages/taxis.php');
		}
	}else{
		$_SESSION['Error'] = 'Please fill in all empty spaces!';
		header('Location:../admin/pages/taxis.php');
	}
}

///////////////////////////////////////////////////////////////////

////////////////  Adding Admin data to the system //////////////////

if(isset($_POST['addAdminData'])){
	if(!empty($_POST['name']) && !empty($_POST['fon']) && !empty($_POST['address'])){

		if(isset($_SESSION['Admin'])){
			$admin = $_SESSION['Admin'];
		}

		$param['admin'] = $admin;
		$param['name'] = $_POST['name'];
		$param['fon'] = $_POST['fon'];
		$param['address'] = $_POST['address'];

		$confirm = addAdminData($param);

		if($confirm){
			unset($_POST['addAdminData']);
			unset($_POST['name']);
			unset($_POST['fon']);
			unset($_POST['address']);
			
			$_SESSION['Success'] = 'Your profile data was successfully added to the database!';
			header('Location:../admin/pages/profile.php');
		}
		else{
			unset($_POST['addAdminData']);
			unset($_POST['name']);
			unset($_POST['fon']);
			unset($_POST['address']);
			$_SESSION['Error'] = 'Your data could not be updated at this time. Try again later!';
			header('Location:../admin/pages/profile.php');
		}

	}
	else{
		$_SESSION['Error'] = 'Please fill in all empty spaces!';
		header('Location:../admin/pages/profile.php');
	}
}

///////////////////////////////////////////////////////////////////

///////////////// Entering restaurant data into the system ///////////////

if(isset($_POST['addRestaurantData'])){
	
	if(isset($_SESSION['id'])){
		$id = $_SESSION['id'];
	}

	if(isset($_FILES)){
		if(!empty($_FILES['banner']['name'])){
			//echo 'Files array is not empty';
			//// upload image here... 
			$param['banner'] = uploadImage("banner");		
		}
		else{
			//// keep the image that is in the database...
			//echo 'Files array is empty!';

			if(isset($_POST['bannerText'])){
				if(!empty($_POST['bannerText'])){
					$param['banner'] = $_POST['bannerText'];
					//echo 'Your banner is: '. $_POST['bannerText'];
				}
				else{
					$param['banner'] = 'default.png';
					//echo 'No banner has been selected!';
				}
			}

		}
	}
	
	if(!empty($_POST['name']) && !empty($_POST['location']) &&
	   !empty($_POST['foodType']) && !empty($_POST['localeType']) && 
	   !empty($_POST['cell_phone']) && !empty($_POST['message_no']) &&
	   !empty($_POST['distance']) && !empty($_POST['shedule1']) && 
	   !empty($_POST['schedule1OpenHour']) && !empty($_POST['schedule1CloseHour']) &&	   
	   !empty($_POST['latitude']) && !empty($_POST['longitude'])
	){				
		$param['id'] = $id;
		$param['name'] = $_POST['name'];
		$param['location'] = $_POST['location'];
		$param['foodType'] = $_POST['foodType'];
		$param['localeType'] = $_POST['localeType'];
		$param['cell_phone'] = $_POST['cell_phone'];
		$param['message_no'] = $_POST['message_no'];
		$param['distance'] = $_POST['distance'];		
		$param['shedule1'] = $_POST['shedule1'];
		$param['schedule1OpenHour'] = $_POST['schedule1OpenHour'];
		$param['schedule1CloseHour'] = $_POST['schedule1CloseHour'];
		$param['shedule2'] = $_POST['shedule2'];
		$param['schedule2OpenHour'] = $_POST['schedule2OpenHour'];
		$param['schedule2CloseHour'] = $_POST['schedule2CloseHour'];		
		$param['latitude'] = $_POST['latitude'];
		$param['longitude'] = $_POST['longitude'];
		$param['delivery'] = $_POST['delivery'];
		$param['delivery_details'] = $_POST['delivery_details'];

		if(isset($_POST['drinks'])){
			if(!empty($_POST['drinks'])){
				$param['drinks'] = $_POST['drinks'];
			}
			else{
				$param['drinks'] = 'off';
			}
		}
		else{
			$param['drinks'] = 'off';
		}

		if(isset($_POST['wifi'])){
			if(!empty($_POST['wifi'])){
				$param['wifi'] = $_POST['wifi'];
			}
			else{
				$param['wifi'] = 'off';
			}
		}
		else{
			$param['wifi'] = 'off';
		}

		if(isset($_POST['ac'])){
			if(!empty($_POST['ac'])){
				$param['ac'] = $_POST['ac'];
			}
			else{
				$param['ac'] = 'off';
			}
		}
		else{
			$param['ac'] = 'off';
		}
		
		if(isset($_POST['tv'])){
			if(!empty($_POST['tv'])){
				$param['tv'] = $_POST['tv'];
			}
			else{
				$param['tv'] = 'off';
			}
		}
		else{
			$param['tv'] = 'off';
		}
		
		if(isset($_POST['family'])){
			if(!empty($_POST['family'])){
				$param['family'] = $_POST['family'];
			}
			else{
				$param['family'] = 'off';
			}
		}
		else{
			$param['family'] = 'off';
		}


		//print_r($param);
		
		$confirm = addRestaurantData($param);
		
		if($confirm){
			unset($_POST['name']);
			unset($_POST['location']);
			unset($_POST['foodType']);
			unset($_POST['localeType']);
			unset($_POST['cell_phone']);
			unset($_POST['message_no']);
			unset($_POST['distance']);
			unset($_POST['shedule1']);
			unset($_POST['schedule1OpenHour']);
			unset($_POST['schedule1CloseHour']);
			unset($_POST['shedule2']);
			unset($_POST['schedule2OpenHour']);
			unset($_POST['schedule2CloseHour']);
			unset($_POST['latitude']);
			unset($_POST['longitude']);
			unset($_POST['delivery']);
			unset($_POST['delivery_details']);
			unset($_POST['banner']);
			unset($_POST['addRestaurantData']);
			$_SESSION['Success'] = 'Your profile data was successfully added to the database!';
			header('Location:../pages/profile.php');
		}
		else{
			unset($_POST['name']);
			unset($_POST['location']);
			unset($_POST['foodType']);
			unset($_POST['localeType']);
			unset($_POST['cell_phone']);
			unset($_POST['message_no']);
			unset($_POST['distance']);
			unset($_POST['shedule1']);
			unset($_POST['schedule1OpenHour']);
			unset($_POST['schedule1CloseHour']);
			unset($_POST['shedule2']);
			unset($_POST['schedule2OpenHour']);
			unset($_POST['schedule2CloseHour']);
			unset($_POST['latitude']);
			unset($_POST['longitude']);
			unset($_POST['delivery']);
			unset($_POST['delivery_details']);
			unset($_POST['banner']);
			unset($_POST['addRestaurantData']);
			$_SESSION['Error'] = 'Your data could not be updated at this time. Try again later!';
			header('Location:../pages/profile.php');
			//Respond(200,"Your data could not be added to the system!","Sorry");
		}		
	}
    else{
        $_SESSION['Error'] = 'Please fill in all required fields before updating your profile. Update failed!';
        header('Location:../pages/profile.php');    
    }
}

/////////////////////////////////////////////////////////////////////

///////////////// Login Authentication Call ///////////////

if(isset($_POST['loginUser'])){
	if(!empty($_POST['email']) && !empty($_POST['password'])){
		
		$param['email'] = $_POST['email'];
		$param['password'] = $_POST['password'];
		
		$confirm = login($param);
		if($confirm['response']){
			unset($_POST['loginUser']);
			unset($_POST['email']);
			unset($_POST['password']);
			
			if($confirm['status'] == 'active'){
				//session_start();
				$_SESSION["id"] = $confirm['id'];
				//echo json_encode($confirm['id']);
				//header("Location:../pages/index.php");			
			}
			else
			if($confirm['status'] == 'inactive'){
				$_SESSION['Error'] = 'Your account is not active at the moment. Please e-mail: codetech.belize@gmail.com to request activation!';
                              // session_destroy()
				//header('Location:../pages/login.php');
			}
		}
		else{
			unset($_POST['loginUser']);
			unset($_POST['email']);
			unset($_POST['password']);
			//Respond(200,"Incorrect password or username","Try Again!");
			$_SESSION['Error'] = 'Incorrect username or password!';
			//header('Location:../pages/login.php');
		}	
	}
	else{
		$_SESSION['Error'] = 'Please fill in all spaces!';
		header('Location:../pages/login.php');
	}
}

/////////////////////////////////////////////////////////////////////

///////////////// Login Administrator Authentication Call ///////////////

if(isset($_POST['loginAdmin'])){
	if(!empty($_POST['email']) && !empty($_POST['password'])){
		
		$param['email'] = $_POST['email'];
		$param['password'] = $_POST['password'];
		
		$confirm = loginAdmin($param);
		if($confirm['response']){
			unset($_POST['loginAdmin']);
			unset($_POST['email']);
			unset($_POST['password']);
			
			if($confirm['status'] == 'active'){
				//session_start();
				$_SESSION["Admin"] = $confirm['id'];
				
				header("Location:../admin/index.php");	
				//echo 'Successfully logged in user with id: ' .$_SESSION['Admin'];
			}
			else
			if($confirm['status'] == 'inactive'){
				$_SESSION['Error'] = 'Your account is not active at the moment. Please come back later!';
                              // session_destroy()
				header('Location:../admin/login.php');
			}
		}
		else{
			unset($_POST['loginAdmin']);
			unset($_POST['email']);
			unset($_POST['password']);
			//Respond(200,"Incorrect password or username","Try Again!");
			$_SESSION['Error'] = 'Incorrect username or password!';
			header('Location:../admin/login.php');
		}		
	}
	else{
		$_SESSION['Error'] = 'Please fill in all spaces!';
		header('Location:../admin/login.php');
	}
}

///////////////// Select restaurant by id ///////////////

if(isset($_POST['getRestById'])){
	
	if(!empty($_POST['getRestById'])){
		
		$id = $_POST['getRestById'];
		$data = getRestaurantById($id);	
		unset($_POST['getRestById']);
		//TODO: handle mysqli_result_object $data;
	}
	else{
		unset($_POST['getRestById']);
		$data = null;
		return $data;
	}
}

///////////////// Select all restaurant ///////////////

if(isset($_POST['getAllRestaurants'])){
	
	if(!empty($_POST['getAllRestaurants'])){
		
		$data = getAllRestaurants();
                
        echo json_encode($data);
		//TODO: handle mysqli_result_object $data;
                
        unset($_POST['getAllRestaurants']);
	}
	else{
		unset($_POST['getAllRestaurants']);
		$data = null;
		return $data;
	}
}

////////////// Select restaurant by location /////////////

if(isset($_POST['getRestaurantsByLocation'])){
	
	if(!empty($_POST['getRestaurantsByLocation']) && !empty($_POST['location'])){

		$param['location']	= $_POST['location'];	
		$data = getRestaurantsByLocation($param);
                
        return $data;
                
        unset($_POST['getRestaurantsByLocation']);
        unset($_POST['location']);

	}
}

///////////////// Select all events ///////////////

if(isset($_POST['getAllEvents'])){

		$data = getAllEvents();
                
        return $data;
		//TODO: handle mysqli_result_object $data;
                
        unset($_POST['getAllEvents']);
	 
}

///////////// Select categories by location /////////////

if(isset($_POST['getCategoriesByLocation'])){

	if(!empty($_POST['getCategoriesByLocation']) && !empty($_POST['location'])){
		$param['location'] = $_POST['location'];

		$data = getCategoriesByLocation($param);
	}  

	unset($_POST['getCategoriesByLocation']);
	unset($_POST['location']);              
    
    return $data;	 
}

///////////////// Select all taxis ///////////////

//this block will get all information of the taxis by location.

if(isset($_POST['getTaxisByLocation'])){
                
	if(!empty($_POST['getTaxisByLocation']) && !empty($_POST['location'])){

		$param['location']	= $_POST['location'];	
		$data = getTaxisByLocation($param);
                
        return $data;
                
        unset($_POST['getTaxisByLocation']);
        unset($_POST['location']);
	}
}



////////// Code for old version of Vistro ////////////

///////// Select all taxis  for old version //////////

if(isset($_POST['getAllTaxis'])){

	$data = getAllTaxis();
                
    return $data;
                
    unset($_POST['getAllTaxis']);
	
}

///////////////// Select all categories ///////////////

if(isset($_POST['getAllCategories'])){

		$data = getAllCategories();
                
        echo json_encode($data);

        //print_r($data);


		//TODO: handle mysqli_result_object $data;
                
        unset($_POST['getAllCategories']);
	 
}

///////////////// Select all menu ///////////////

if(isset($_POST['getAllMenus'])){

	if(isset($_POST['restaurant_id']) && isset($_POST['category_id'])){
		$param['restaurant_id'] = $_POST['restaurant_id'];
		$param['category_id'] = $_POST['category_id'];
		$data = getAllMenus($param);
	}
	else{
		$data = getAllMenusOld();
	}	
                
    return $data;
	//TODO: handle mysqli_result_object $data;
                
    unset($_POST['getAllMenus']);
	
}

////// Select today specials by location //////

if(isset($_POST['getTodaySpecialsByLocation'])){

	$location = $_POST['location'];

	$data = getTodaySpecialsByLocation($location);
                
    return $data;
	//TODO: handle mysqli_result_object $data;
                
    unset($_POST['getTodaySpecialsByLocation']);
	
}

//////////////////////////////////////////////////////

////////////// Select Menu by location ///////////////

if(isset($_POST['getMenuByLocation'])){

	if(!empty($_POST['getMenuByLocation']) && !empty($_POST['location'])){
		$param['location'] = $_POST['location'];

		$data = getMenuByLocation($param);
	}  

	unset($_POST['getMenuByLocation']);
	unset($_POST['location']);              
    
    return $data;	 
}

/////////////////////////////////////////////////////////

if(isset($_POST['getFoodTime']) && isset($_POST['id'])){
		
	if(!empty($_POST['getFoodTime']) && !empty($_POST['id'])){
		
		$foodTime = $_POST['getFoodTime'];
		$id = $_POST['id'];
		$result = getFoodTime($id,$foodTime);	
		//TODO: handle mysqli_result_object $data;
		
		$counter = 0;
		$MenuItems = array();
                
        while($row=mysqli_fetch_row($result)){
                       
            $counter=$counter+1;			
            $MenuItems["MenuItem".$counter] = $row;

        }
                                        
        echo json_encode($MenuItems);
		
		unset($_POST['getFoodTime']);
		unset($_POST['id']);
	}	
}

if(isset($_POST['getCats']) && isset($_POST['id'])){
		
	if(!empty($_POST['getCats']) && !empty($_POST['id'])){
		
		$id = $_POST['id'];
		$result = getAllCats($id);
			
        $count = 0;
		$Categories = array();
                
        while($row=mysqli_fetch_row($result)){
                       
            $count=$count+1;			
            $Categories["Category".$count] = $row;

        }
                                        
        echo json_encode($Categories);                    
			
		//TODO: handle mysqli_result_object $data;
		
		unset($_POST['getCats']);
		unset($_POST['id']);
		
	}	
}

if(isset($_POST['getReviews'])){
	
	if(!empty($_POST['getReviews'])){
		
		$id = $_POST['getReviews'];
		$data = getReviews($id);	
		//TODO: handle mysqli_result_object $data;
	}
	
	unset($_POST['getReviews']);
}

///////////////// Delete food from menu table /////////////////////

if(isset($_POST['foodIdDel'])){
	
	if(!empty($_POST['foodIdDel'])){
		$confirm = delMenu($_POST['foodIdDel'],$_SESSION['id']);
		
		if($confirm){
			unset($_POST['foodIdDel']);
			unset($_POST['id']);
			header("Location:../pages/viewAllMenus.php");	
		}
		else{
			unset($_POST['foodIdDel']);
			unset($_POST['id']);
			header("Location:../pages/viewAllMenus.php");
		}
	}
	else{
		unset($_POST['foodIdDel']);
		unset($_POST['id']);
		header("Location:../pages/viewAllMenus.php");
	}
}

///////////// Delete category from database /////////////////

if(isset($_POST['delCategory'])){

	if(!empty($_POST['catIdDel'])){

		///// getting category name code here...
		$catName = getCategoryById($_POST['catIdDel']);

		///// getting category name code here...
		$confirm = delCategory($_POST['catIdDel'],$_SESSION['id']);
		
		if($confirm){

			//print_r($catName);

			///// delete menu category code here...
			$delMenuByCat = delMenuByCategoryName($catName[0][2],$_SESSION['id']);

			if($delMenuByCat){
				unset($_POST['catIdDel']);
				unset($_POST['id']);
				header("Location:../pages/viewAllCategories.php");
			}
			else{
				unset($_POST['catIdDel']);
				unset($_POST['id']);
				header("Location:../pages/viewAllCategories.php");
			}	
		}
		else{
			unset($_POST['catIdDel']);
			unset($_POST['id']);
			header("Location:../pages/viewAllCategories.php");
		}
	}
	else{
		unset($_POST['catIdDel']);
		unset($_POST['id']);
		header("Location:../pages/viewAllCategories.php");
	}
}

///////////////// Update food from menu table /////////////////////

if(isset($_POST['save'])){
	
	if(!empty($_POST['foodId']) && !empty($_POST['foodName']) && !empty($_POST['foodPrice']) && !empty($_POST['categories'])){
		
		$param['id'] = $_POST['foodId'];
		$param['plate_name'] = $_POST['foodName'];
		$param['price'] = $_POST['foodPrice'];
		$param['plate_time'] = $_POST['categories'];
		$param['desc'] = $_POST['desc'];
		
		$confirm = updateMenu($param);
		
		if($confirm){
			unset($_POST['save']);
			unset($_POST['foodId']);
			unset($_POST['foodName']);
			unset($_POST['foodPrice']);
			unset($_POST['categories']);
			unset($_POST['desc']);
			header("Location:../pages/viewAllMenus.php");	
		}
		else{
			unset($_POST['save']);
			unset($_POST['foodId']);
			unset($_POST['foodName']);
			unset($_POST['foodPrice']);
			unset($_POST['categories']);
			unset($_POST['desc']);
			header("Location:../pages/viewAllMenus.php");
		}	
	}
	else{
		header("Location:../pages/viewAllMenus.php");
	}
}

///////////////// Update category record from database /////////////////////

if(isset($_POST['updateCategory'])){
	
	if(!empty($_POST['catId']) && !empty($_POST['categoryName'])){
		
		$param['id'] = $_POST['catId'];
		$param['cat_name'] = $_POST['categoryName'];

		///// getting category name code here...
		$catName = getCategoryById($_POST['catId']);
		
		$confirm = updateCategory($param);
		
		if($confirm){

			///// delete menu category code here...
			$updateMenuByCat = updateMenuByCategoryName($catName[0][2],$_POST['categoryName']);


			if($updateMenuByCat){
				unset($_POST['catId']);
				unset($_POST['categoryName']);
				header("Location:../pages/viewAllCategories.php");
			}
			else{
				unset($_POST['catId']);
				unset($_POST['categoryName']);
				header("Location:../pages/viewAllCategories.php");
			}	
		}
		else{
			unset($_POST['updateCategory']);
			unset($_POST['catId']);
			unset($_POST['categoryName']);
			header("Location:../pages/viewAllCategories.php");
		}	
	}
	else{
		header("Location:../pages/viewAllCategories.php");
	}
}

///////////////// Function to respond based on the query ////////////

function Respond($status, $message,$info){
	header("HTTP/1.1 $status $message");
	
	$response['Status'] = $status;
	$response['Message'] = $message;
	$response['Data'] = $info;
	
	$data = json_encode($response);
	echo $data;
}

//////////////////////////////////////////////////////////////////

//////////// function to upload images to the server  ////////////

function uploadImage($file){
	
	$dir = "../pics/";
	$targetFile = $dir. basename($_FILES["$file"]["name"]);
	$imageName = basename($_FILES["$file"]["name"]);
	
	$uploadOk = 1;
	$imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);
	
	// Check if the image file is an actual image or fake
	
	if(isset($_POST['addRestaurantData'])){
		$check = getimagesize($_FILES["$file"]["tmp_name"]);
		if($check !== false){
			//echo "File is an image - ". $check["mime"].".";
			$uploadOk = 1;
		}
		else{
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	
	// Check if file already exists //
	
	if(file_exists($targetFile)){
		$uploadOk = 0;
	}
	
	// Check file size //
	
	if($_FILES["$file"]["size"] > 500000){
		$uploadOk = 0;
	}
	
	// Allow certain file formats //
	
	if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png"){
		$uploadOk = 0;
	}
	
	// Check if $uploadOk is set to 0 by any error.
	
	if($uploadOk == 0){
		//echo "Your file was not uploaded!";
	}
	else
	if(move_uploaded_file($_FILES["$file"]["tmp_name"],$targetFile)){
		// if everything is ok, try upload the file.
			
	}
	else{
		//echo "File could not be uploaded!";
	}
	
	return $imageName;	
}
//////////////////////////////////////////////////////////////////////

//////////////         handle Vistro Delivery Request      ///////////

if(isset($_POST['placeRemoteDelivery'])){
	
	if(!empty($_POST['invoice_id']) && !empty($_POST['username']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['lat']) && !empty($_POST['long']) && !empty($_POST['address']) && !empty($_POST['subtotal']) && !empty($_POST['location']) && !empty($_POST['zones']) && !empty($_POST['stops'])){
		
		$param['id'] = $_POST['invoice_id'];
		$param['username'] = $_POST['username'];
		$param['phone'] = $_POST['phone'];
		$param['email'] = $_POST['email'];
		$param['lat'] = $_POST['lat'];
		$param['long'] = $_POST['long'];
		$param['address'] = $_POST['address'];
		$param['subtotal'] = $_POST['subtotal'];
		$param['status'] = $_POST['status'];
		$param['time'] = $_POST['time'];
		$param['location'] = $_POST['location'];
		$param['player_id'] = $_POST['player_id'];
		$param['zones'] = $_POST['zones'];
		$param['stops'] = $_POST['stops'];

		$confirm = placeRemoteDelivery($param);

		///////// Orange Walk player id /////////////

		$Edgar = '77c0aba3-5219-4da4-ae7e-0bf8803c60cf';
		$Annie = '14981a3c-0f47-40db-88fe-ac67f5e85cd3';
		$keila = 'cefd02ee-d707-4a3a-8e78-ffb4e13a5e29';
		$Aziel = 'cd719042-62ef-4272-b811-0e1c58eaf2bc';
		$Danny = 'c04bfdd4-60c1-4f0f-bb77-156250db8f85';
		$Office_ow = 'bd0cacda-adf3-407b-bd00-c18dc1319e5d';
		$wil = '306f1a03-3a45-4cce-a38e-d92b166acb17';
		$Ernesto = '9bf73fa7-3b4d-472f-99b0-f0607653ca48';
		$Shaheed = 'be617273-4326-49c5-aff7-48038715aa8e';
		$Victor = '05a8ba5f-13c9-45e6-94a7-9b70f4abc515';

		//////////// Corozal player id /////////////////

		$Ilia = '146f07ee-4ef5-4f4d-bed1-1395017e9fba';
		
		if($confirm['status']){

			switch ($confirm['area']) {
				case 'Corozal':
						$ids = array($Office_ow,$Ilia,$Edgar);
						notifyArea($ids);
					break;
				case 'Orange Walk':
						$ids = array($Office_ow,$Edgar,$Annie,$keila,$Aziel,$Danny,$wil,$Ernesto,$Shaheed,$Victor);
						notifyArea($ids);
					break;
				case 'Belize':
						//$ids = array();
						//notifyArea($ids);
					break;
				case 'Belmopan':
						//$ids = array();
						//notifyArea($ids);
					break;
				case 'San Ignacio':
						//$ids = array();
						//notifyArea($ids);
					break;
				case 'Stann Creek':
						//$ids = array();
						//notifyArea($ids);
					break;
				case 'Placencia':
						//$ids = array();
						//notifyArea($ids);
					break;
				case 'Toledo':
						//$ids = array();
						//notifyArea($ids);
					break;
				case 'Punta Gorda':
						//$ids = array();
						//notifyArea($ids);
					break;
				case 'Ambergris Caye':
						//$ids = array();
						//notifyArea($ids);
					break;
				case 'Caye Caulker':
						//$ids = array();
						//notifyArea($ids);
					break;
				case 'Chetumal':
						//$ids = array();
						//notifyArea($ids);
					break;
				default:
					# code...
					break;
			}

			unset($_POST['placeRemoteDelivery']);
			unset($_POST['id']);
			unset($_POST['username']);
			unset($_POST['phone']);
			unset($_POST['email']);
			unset($_POST['lat']);
			unset($_POST['long']);
			unset($_POST['address']);
			unset($_POST['subtotal']);
			unset($_POST['player_id']);

			//echo 'Success';
			echo json_encode(array('response1'=>array('orderStatus'=>$confirm['status'],'totalCost'=>$confirm['totalCost'])));

		}
		else{
			unset($_POST['placeRemoteDelivery']);
			unset($_POST['id']);
			unset($_POST['username']);
			unset($_POST['phone']);
			unset($_POST['email']);
			unset($_POST['lat']);
			unset($_POST['long']);
			unset($_POST['address']);
			unset($_POST['subtotal']);
			unset($_POST['player_id']);

			//echo 'Error';
			echo json_encode(array('response1'=>array('orderStatus'=>$confirm['status'],'totalCost'=>$confirm['totalCost'])));
		}	
	}
	else{
		echo 'Fill in all Fields!';
	}
}

function notifyArea($players_id){

	$app_id		= '9bd8af51-a07d-44b2-87dc-99bcdaa234f0';
	$player_id 	= $players_id;
	$auth 		= 'ZTNiMGE4MzktZDM0Zi00YzlhLTg3YTktZDMzNDhiY2Q4NGU0';
	$title 		= 'New Delivery';
	$body 		= 'There\'s a delivery. Tap here to check order details!';

	$notifyDriver = sendMessage($app_id,$player_id,$auth,$title,$body);

}

if(isset($_POST['placeRemoteDeliveryItems'])){
	
	if(!empty($_POST['invoice_id']) && !empty($_POST['restaurant_id']) && !empty($_POST['foodId']) && !empty($_POST['quantity']) && !empty($_POST['price']) && !empty($_POST['total'])){
		
		$param['invoice_id'] = $_POST['invoice_id'];
		$param['restaurant_id'] = $_POST['restaurant_id'];
		$param['foodId'] = $_POST['foodId'];
		$param['quantity'] = $_POST['quantity'];
		$param['price'] = $_POST['price'];
		$param['total'] = $_POST['total'];
		$param['des'] = $_POST['description'];

		$res_id = $_POST['restaurant_id'];

		$app_id_web = '459e5ab9-48eb-4b49-8b40-e8ac8d41cf6a';
		$player_tag = array("user_id" => $res_id);
		$auth_web = 'ZWQ0YWQ0YzgtZWZjYi00OTQ3LWJjOTctZTk5NTg2YmJiN2Rk';
		$title_web = 'There\'s a new order!';
		$body_web = 'Click to check details.';

		//$notifyWeb = sendMessageByTag($app_id_web,$player_tag,$auth_web,$title_web,$body_web);  //$app_id,$tagss,$auth,$title,$body
		//$app_id, $tag, $auth, $title, $body

		//$webNotify = sendNoteByTag($app_id_web,$player_tag,$auth_web,$title_web,$body_web);
		
		$confirm = placeRemoteDeliveryItems($param);
		
		if($confirm){
			unset($_POST['placeRemoteDeliveryItems']);
			unset($_POST['invoice_id']);
			unset($_POST['foodId']);
			unset($_POST['quantity']);
			unset($_POST['total']);

			echo 'Success';
		}
		else{
			unset($_POST['placeRemoteDeliveryItems']);
			unset($_POST['invoice_id']);
			unset($_POST['foodId']);
			unset($_POST['quantity']);
			unset($_POST['total']);

			echo 'Error';
		}	
	}
	else{
		echo 'Fill in all Fields!';
	}
}

if(isset($_POST['searchByMenu'])){
	if(!empty($_POST['queryString']) && !empty($_POST['location'])){

		$param['queryString'] = $_POST['queryString'];
		$param['location'] = $_POST['location'];
		
		$result = searchByMenu($param);
			
	    $count = 0;
		$searchArray = array();
	                
	    while($row=mysqli_fetch_row($result)){
	                       
	        $count=$count+1;			
	        $searchArray["Result".$count] = $row;

	    }
	                                        
	    echo json_encode($searchArray);                    
				
		//TODO: handle mysqli_result_object $data;
			
		unset($_POST['searchByMenu']);
	}
	else{
		unset($_POST['searchByMenu']);
	}	
}

/////////////////////////////////////////////////////////////////////

/////////////////     Vistro Deliveries App     ////////////////////

if(isset($_POST['getAllRemoteDeliveries'])){

	if(!empty($_POST['location'])){

		$location = $_POST['location'];
		
		$result = getAllRemoteDeliveries($location);
			
	    $count = 0;
		$Orders = array();
	                
	    while($row=mysqli_fetch_row($result)){
	                       
	        $count=$count+1;			
	        $Orders["Order".$count] = $row;

	    }
	                                        
	    echo json_encode($Orders);                    
				
		//TODO: handle mysqli_result_object $data;
			
		unset($_POST['getAllRemoteDeliveries']);
	}
	else{
		unset($_POST['getAllRemoteDeliveries']);
	}
}

if(isset($_POST['getAllRemoteDeliveryItems'])){

	if(!empty($_POST['invoice_id'])){

		$invoice_id = $_POST['invoice_id'];
	
		$result = getAllRemoteDeliveryItemsByID($invoice_id);
		
    	$count = 0;
		$OrderItems = array();
                
    	while($row=mysqli_fetch_row($result)){
                       
        	$count=$count+1;			
        	$OrderItems["Item".$count] = $row;

    	}
                                        
    	echo json_encode($OrderItems);                    
			
		//TODO: handle mysqli_result_object $data;
		
		unset($_POST['getAllRemoteDeliveryItems']);
	}
}

if(isset($_POST['getAllRemoteDeliveriesByStatus'])){
	if(!empty($_POST['status'])){

		$status = $_POST['status'];

		$result = getAllRemoteDeliveriesByStatus($status);
		
	    $count = 0;
		$Orders = array();
	                
	    while($row=mysqli_fetch_row($result)){
	                       
	        $count=$count+1;			
	        $Orders["Order".$count] = $row;

	    }
	                                        
	    echo json_encode($Orders);                    
				
		//TODO: handle mysqli_result_object $data;
			
		unset($_POST['getAllRemoteDeliveriesByStatus']);
	}
	else{
		unset($_POST['getAllRemoteDeliveriesByStatus']);
	}
}

if(isset($_POST['changeOrderStatus'])){

	if(!empty($_POST['status']) && !empty($_POST['invoice_id'])){

		$status = $_POST['status'];
		$id = $_POST['invoice_id'];

		$newStatus = changeOrderStatus($status,$id);

		unset($_POST['changeOrderStatus']);
	}
	else{		
		unset($_POST['changeOrderStatus']);		
	}
}

if(isset($_POST['getDeliveryFees'])){

	$result = getAllDeliveryFees();

	$count = 0;
	$fees = array();

	while($row=mysqli_fetch_row($result)){
		$count = $count+1;
		$fees["Fee".$count] = $row;
	}

	echo json_encode($fees);

	unset($_POST['getDeliveryFees']);

}

if(isset($_POST['updateDriverGPS'])){
	if(!empty($_POST['email']) && !empty($_POST['lat']) && !empty($_POST['lang'])){

			$param['email'] = $_POST['email'];
			$param['lat'] = $_POST['lat'];
			$param['lang'] = $_POST['lang'];

			$confirm = updateDriverGPS($param);

			if($confirm){

				echo 'GPS was successfully updated!';

				unset($_POST['email']);
				unset($_POST['lat']);
				unset($_POST['lang']);

			}
			else{

				echo 'GPS could not be updated!';

				unset($_POST['email']);
				unset($_POST['lat']);
				unset($_POST['lang']);
			}
	}
}

if(isset($_POST['getDrivers'])){

	if(isset($_POST['location'])){
		$location = $_POST['location'];
	}
	else{
		$location = '';
	}

	$result = getAllDrivers($location);

	$count = 0;
	$drivers = array();

	while($row=mysqli_fetch_row($result)){
		$count = $count+1;
		$drivers["Driver".$count] = $row;
	}

	echo json_encode($drivers);

	unset($_POST['getDrivers']);


}

////////////////////////////////////////////////////////////////////

/////////////  	api call for push notifications		 ////////////

if(isset($_POST['sendNotification'])){
	if(!empty($_POST['app_id']) && !empty($_POST['player_id']) && !empty($_POST['auth']) && !empty($_POST['title']) && !empty($_POST['body'])){
		
		$app_id		= $_POST['app_id'];
		$player_id	= array($_POST['player_id']);
		$auth		= $_POST['auth'];
		$title 		= $_POST['title'];
		$body 		= $_POST['body'];

		$response = sendMessage($app_id,$player_id,$auth,$title,$body);
	}
}

//////////////////////////////////////////////////////////////////////

	function sendMessage($app_id,$player_id,$auth,$title,$body){

		$content = array(
			"en" => $body
			);
		$heading = array(
			"en" => $title 
		);
		
		$fields = array(
			'app_id' => $app_id,
			//'include_player_ids' => array("6392d91a-b206-4b7b-a620-cd68e32c3a76","76ece62b-bcfe-468c-8a78-839aeaa8c5fa","8e0f21fa-9a5a-4ae7-a9a6-ca1f24294b86"),
			'include_player_ids' => $player_id,
			//'data' => array($title => $body),
			'contents' => $content,
			'headings' => $heading
		);
		
		$fields = json_encode($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic '.$auth));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
	}

/*	sendNoteByTag($app_id, $tag, $auth, $title, $body){

		$content = array(
			"en" => 'There\'s a new delivery',
			);
		
		$fields = array(
			'app_id' => $app_id,
			'filters' => array($tag),//array(array("field" => "tag", "key" => "level", "relation" => "=", "value" => "10"),array("operator" => "OR"),array("field" => "amount_spent", "relation" => "=", "value" => "0")),
			'contents' => $content
		);
		
		$fields = json_encode($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic '.$auth));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		//return $response;
	}*/

?>