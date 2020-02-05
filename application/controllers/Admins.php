<?php 

	class Admins extends CI_Controller {

		//register page functionality

		public function register(){
			$enc_pass = md5($this->input->post('password'));
			$this->admin_model->register($enc_pass);
			$this->session->set_flashdata('acc_created','Your account was successfully created! Please proceed to login');
			redirect('login');
		}

		// login page functionality
		
		public function login(){

			$email 	  = $this->input->post('email');
			//$password = $this->input->post('password');
			$password = md5($this->input->post('password'));

			
			$user_id = $this->admin_model->login($email, $password);

			if($user_id){
				//create session
				$admin_data = array(
					'admin_id' => $user_id,
					'email' => $email,
					'logged_in' => true
				);

				$this->session->set_userdata($admin_data);

				//redirect to dashboard

				redirect('dashboard');
			}
			else {
				redirect('/'); 
			}
		}

		public function logout(){
			$this->session->unset_userdata('admin_id');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('logged_in');

			$this->session->set_flashdata('admin_loggedout','You have been successfully logged out!');
			redirect('/');
		}

		// search page functionality. 

		public function search(){

			header('Content-Type: application/json');

			//unset previous search results.

			$this->session->unset_userdata('studentSearchResult'); 

			//create search parameter variable.

			$search_param = $this->input->post('query');

			
			$results = $this->admin_model->search($search_param);  
			$this->session->set_userdata($results);	

			$id = '';	

			if(isset($results['studentSearchResult'])){

				if(count($results['studentSearchResult']) == 1){
					$id =  $results['studentSearchResult'][0]['student_id']; 
				}
			}

			echo json_encode($id);
		}

		//dashboard page functionality 

		public function updateMyEvent(){
			//header('Content-Type: application/json');
			$this->admin_model->updateMyEvent();
			//redirect('profile');
		}		

		public function addMyEvent(){
			header('Content-Type: application/json');
			$result = $this->admin_model->addMyEventAjax();
			echo json_encode($result); 
		}

		public function updateMyEventUrlShares(){
			header('Content-Type: application/json');
			$result = $this->admin_model->updateMyEventUrlSharesAjax();
			echo json_encode($result); 
		}

		public function delDEventById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->delDEventByIdAjax();
			echo json_encode($result);
		}

		public function delMyEventById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->delMyEventByIdAjax();
			echo json_encode($result);
		}

		public function addDefaultEvent(){
			//header('Content-Type: application/json');
			$result = $this->admin_model->addDefaultEvent();
			//echo json_encode($result); 
			redirect('dashboard');
		}

		public function getAllMyEvents(){
			header('Content-Type: application/json');
			$result = $this->admin_model->getAllMyEventsAjax();
			echo json_encode($result); 
		}

		public function getAllSharedEvents(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->getAllSharedEventsAjax();
			echo json_encode($result); 
		}

		public function getMyEventById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->getMyEventByIdAjax();
			echo json_encode($result); 
		}

		public function getAllDefaultEvents(){
			header('Content-Type: application/json');
			$result = $this->admin_model->getAllDefaultEventsAjax();
			echo json_encode($result); 
		}

		// profile page functionality 

		public function updateProfile(){
			//header('Content-Type: application/json');
			$this->admin_model->updateProfile($this->session->userdata('admin_id'));
			redirect('profile');
		}

		// settings page functionality

		public function addSettings(){
			header('Content-Type: application/json');
			$result = $this->admin_model->addSettingsAjax($this->session->userdata('admin_id'));
			echo json_encode($result);

			//redirect('settings');
		}		

		public function updateSettings(){
			header('Content-Type: application/json');
			$result = $this->admin_model->updateSettingsAjax();
			echo json_encode($result);

			//redirect('settings');
		}

		// administrators page functionality

		public function addAdmin(){
			//header('Content-Type: application/json'); 
			$this->admin_model->addAdmin();
			redirect('administrators');
		}

		public function getAdminById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->getAdminByIdAjax();
			echo json_encode($result); 
		}

		// teachers page functionality

		public function addTeacher(){
			header('Content-Type: application/json'); 
			$result = $this->admin_model->addTeacher();
			echo json_encode($result); 
			//redirect('teachers');
		}

		public function getTeacherById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->getTeacherByIdAjax();
			echo json_encode($result); 
		}

		public function updateTeacherEmail(){
			//header('Content-Type: application/json');
			$this->admin_model->updateTeacherEmail();
			redirect('teachers');
		}

		public function delTeacherById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->delTeacherByIdAjax();
			echo json_encode($result);
		}

		/*public function deleteAdmin(){ 
			$this->admin_model->delOrderHistory();
		}*/

		// students page functionality

		/*public function addStudent(){
			//header('Content-Type: application/json');
			$this->admin_model->addStudent();
			redirect('students');
		}*/

		public function getStudentById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->getStudentByIdAjax();
			echo json_encode($result); 
		}

		public function updateStudent(){
			//header('Content-Type: application/json');
			$this->admin_model->updateStudent(); 
			redirect('students');
		}

		public function delStudentById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->delStudentByIdAjax();
			echo json_encode($result);
		}

		// classes page functionality

		public function addClass(){
			header('Content-Type: application/json');
			$result = $this->admin_model->addClass();
			echo json_encode($result); 
			//redirect('classes');
		}

		public function getClassById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->getClassByIdAjax(); 
			echo json_encode($result); 
		}

		public function updateClass(){
			//header('Content-Type: application/json');
			$this->admin_model->updateClass();
			redirect('classes');
		}	

		public function delClassById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->delClassByIdAjax();
			echo json_encode($result);
		}	

		// courses page functionality 

		public function addCourse(){
			header('Content-Type: application/json');
			$result = $this->admin_model->addCourse();
			//redirect('courses');
			echo json_encode($result);
		}

		public function getCourseById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->getCourseByIdAjax();
			echo json_encode($result); 
		}

		public function updateCourse(){
			//header('Content-Type: application/json');
			$this->admin_model->updateCourse();
			redirect('courses');
		}

		public function delCourseById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->delCourseByIdAjax();
			echo json_encode($result);
		}

		public function delAdminById(){ //
			//header('Content-Type: application/json');
			$this->admin_model->delAdminById(); 
			//echo json_encode($result);
		}

		// individual class page

		public function addCourseToClass(){

			header('Content-Type: application/json');
			//$class = $this->input->post('class');
			$result = $this->admin_model->addCourseToClass();
			echo json_encode($result);
			//redirect('class/'.$class);
		}

		public function getCourseToClassById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->getCourseToClassByIdAjax();
			echo json_encode($result); 
		}

		public function updateCourseToClass(){ 
			//header('Content-Type: application/json');
			$class = $this->input->post('classId');
			$this->admin_model->updateCourseToClass();
			redirect('class/'.$class);
		}

		public function delCourseToClassById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->delCourseToClassByIdAjax(); 
			echo json_encode($result);
		}

		// administrators page 

		public function updateAdmin(){ //
			//header('Content-Type: application/json');
			$this->admin_model->updateAdmin();
			redirect('administrators');
		}

		//change password page

		public function getUserPassById(){
			header('Content-Type: application/json');
			$result = $this->admin_model->getUserPassByIdAjax(); 
			echo json_encode($result); 
		}

		public function updatePassword(){
			header('Content-Type: application/json');
			$result = $this->admin_model->updatePasswordAjax(); 
			echo json_encode($result);
		}

		public function addStudent(){ 
			header('Content-Type: application/json');
			$result = $this->admin_model->addStudent(); 
			echo json_encode($result); 
			//redirect('dashboard');
		}

		public function toggleAccStatus(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->toggleAccStatusAjax(); 
			echo json_encode($result); 
		}		

		public function toggleCanLogin(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->toggleCanLoginAjax(); 
			echo json_encode($result); 
		}

		public function toggleCanViewGrades(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->toggleCanViewGradesAjax(); 
			echo json_encode($result); 
		}							

		public function toggleCanViewAttendance(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->toggleCanViewAttendanceAjax(); 
			echo json_encode($result); 
		}

		public function assignHomeRoom(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->assignHomeRoomAjax();  
			echo json_encode($result); 
		}

		public function addDemerit(){
			header('Content-Type: application/json');
			$result = $this->admin_model->addDemeritAjax();  
			echo json_encode($result); 
			//redirect('dashboard');
		}

		public function addLastTab(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->addLastTabAjax();  
			echo json_encode($result); 
			//redirect('dashboard');
		}		

		public function updateLastTab(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->updateLastTabAjax();  
			echo json_encode($result); 
			//redirect('dashboard');
		}	

		public function getDemeritById(){ // 
			header('Content-Type: application/json');
			$result = $this->admin_model->getDemeritByIdAjax();  
			echo json_encode($result); 
		}

		public function updateDemeritRecord(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->updateDemeritRecordAjax();  
			echo json_encode($result); 
			//redirect('dashboard');
		}

		public function delDemeritById(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->delDemeritByIdAjax(); 
			echo json_encode($result);
		}

		public function addJug(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->addJugAjax();  
			echo json_encode($result); 
			//redirect('dashboard');
		}

		public function getJugById(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->getJugByIdAjax();  
			echo json_encode($result); 
		}	

		public function updateJugRecord(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->updateJugRecordAjax();  
			echo json_encode($result); 
			//redirect('dashboard');
		}

		public function delJugById(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->delJugByIdAjax(); 
			echo json_encode($result);
		}

		public function addSuspension(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->addSuspensionAjax();  
			echo json_encode($result); 
			//redirect('dashboard');
		}

		public function getSuspensionById(){ // 
			header('Content-Type: application/json');
			$result = $this->admin_model->getSuspensionByIdAjax();  
			echo json_encode($result); 
		}

		public function updateSuspensionRecord(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->updateSuspensionRecordAjax();  
			echo json_encode($result); 
			//redirect('dashboard');
		}	

		public function delSuspensionById(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->delSuspensionByIdAjax(); 
			echo json_encode($result);
		}

		public function addExpulsion(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->addExpulsionAjax();  
			echo json_encode($result); 
			//redirect('dashboard');
		}

		public function getExpulsionById(){ // 
			header('Content-Type: application/json');
			$result = $this->admin_model->getExpulsionByIdAjax();  
			echo json_encode($result); 
		}

		public function updateExpulsionRecord(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->updateExpulsionRecordAjax();  
			echo json_encode($result); 
			//redirect('dashboard');
		}

		public function delExpulsionById(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->delExpulsionByIdAjax(); 
			echo json_encode($result);
		}

		public function getMyCoursesByClassId(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->getmyCoursesByClassId($this->input->post('class_id'));
			echo json_encode($result); 
		}

		public function getCourseAttByStudentId(){ //getCourseGradesByStudentId

			$student_id = $this->input->post('student_id');
			$class_id   = $this->input->post('class_id');
			$course_id  = $this->input->post('course_id');


			header('Content-Type: application/json');
			$result = $this->admin_model->getAttendanceByStudentId($student_id, $class_id, $course_id);
			echo json_encode($result); 
		}																															

		public function getAllCourses(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->getAllCourses(); 
			echo json_encode($result); 
		}

		public function getAllClasses(){ //
			header('Content-Type: application/json');
			$result = $this->admin_model->getAllClassesAjax(); 
			echo json_encode($result); 
		}		

		public function getCourseGradesByStudentId(){ //

			$student_id = $this->input->post('student_id');
			$class_id   = $this->input->post('class_id');
			$course_id  = $this->input->post('course_id');

			header('Content-Type: application/json');
			$result = $this->admin_model->getGradesByStudentId($student_id, $class_id, $course_id);
			echo json_encode($result); 
		}

		public function getStdCoursesNGrades(){  //////
			$id = $this->input->post('id');
			$student_id = $this->input->post('student_id');
			header('Content-Type: application/json');
			$result = $this->admin_model->getStdCoursesNGrades($id,$student_id);
			echo json_encode($result); 
		}

		public function getStudentCoursesById(){  //////
			$id = $this->input->post('id');
			header('Content-Type: application/json');
			$result = $this->admin_model->getmyCoursesByClassId($id);
			echo json_encode($result); 
		}

		public function getAllStdsByClassId(){  //////
			header('Content-Type: application/json');
			$result = $this->admin_model->getAllStdsByClassIdAjax();
			echo json_encode($result); 
		}

		public function getAllCoursesByClassId(){  //////
			header('Content-Type: application/json');
			$result = $this->admin_model->getAllCoursesByClassIdAjax();
			echo json_encode($result); 
		}				

		public function getGradesByStudentId(){  //////  
			
			$student_id = $this->input->post('student_id');
			$class_id = $this->input->post('class_id');
			$course_id = $this->input->post('course_id');

			header('Content-Type: application/json');
			$result = $this->admin_model->getGradesByStudentId($student_id, $class_id, $course_id);
			echo json_encode($result); 
		}														
		
		public function uploadFiles(){

			if($_FILES['files']['name'] != '')	{

				$admin_id = $this->session->userdata('admin_id');
				$pic_name = '';
				$pic_path = '';

				$output = '';
				$config['upload_path'] = './custom/uploads/admin/images';
				$config['allowed_types'] = 'gif|jpeg|png|jpg';
				$config['max_size'] = '10240';

				$this->load->library('upload', $config);

				for ($count=0; $count < count($_FILES['files']['name']); $count++) { 

					//get the real name of the file before renaming it..
					$pic_name = $_FILES['files']['name'][$count];
					
					$path = $_FILES['files']['name'][$count];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					$newfilename = md5($_FILES['files']['name'][$count].$admin_id).'.'.$ext;

					$_FILES['file']['name'] = $newfilename;	
					$_FILES['file']['type'] = $_FILES['files']['type'][$count];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$count];
					$_FILES['file']['error'] = $_FILES['files']['error'][$count];
					$_FILES['file']['size'] = $_FILES['files']['size'][$count];				

					if($this->upload->do_upload('file')){
						
						$output .= $_FILES['file']['name'] .' was uploaded successfully';
						$pic_path = 'custom/uploads/admin/images/';

						//add assignment reccord to the database...
						$this->admin_model->updateAdminProPic($admin_id, $pic_name, $pic_path,$newfilename);

					}
				}
			}

			echo $output;		
		}

		public function uploadStudentPic(){

			$newfilename = '';

			if($_FILES['files']['name'] != '')	{

				$student_id = $_POST['id'];
				$pic_name = '';
				$pic_path = '';

				$output = '';
				$config['upload_path'] = './custom/uploads/students/images';
				$config['allowed_types'] = 'gif|jpeg|png|jpg';
				$config['max_size'] = '10240';

				$this->load->library('upload', $config);

				for ($count=0; $count < count($_FILES['files']['name']); $count++) { 

					//get the real name of the file before renaming it..
					$pic_name = $_FILES['files']['name'][$count];
					
					$path = $_FILES['files']['name'][$count];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					$newfilename = md5($_FILES['files']['name'][$count].$student_id).'.'.$ext;

					$_FILES['file']['name'] = $newfilename;	
					$_FILES['file']['type'] = $_FILES['files']['type'][$count];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$count];
					$_FILES['file']['error'] = $_FILES['files']['error'][$count];
					$_FILES['file']['size'] = $_FILES['files']['size'][$count];				

					if($this->upload->do_upload('file')){
						
						$output .= $_FILES['file']['name'] .' was uploaded successfully';
						$pic_path = 'custom/uploads/students/images/';

						//add assignment reccord to the database...
						$this->admin_model->updateStudentProPic($student_id, $pic_name, $pic_path,$newfilename);

					}
				}
			}

			echo json_encode($newfilename);	  		

		}

		public function importStdAcc(){

			if($_FILES['files']['name'] != '')	{

				echo '<pre>';
				print_r($_FILES['files']['name']);
				echo '</pre>';

			    $fileName = $_FILES["files"]["tmp_name"];
			    
			    if ($_FILES["files"]["size"] > 0) {
			        
			        $file = fopen($fileName, "r");
			        
			        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

			        	echo $column[0];
			        	echo $column[1];
			        	echo $column[2];
			        	echo $column[3];
			        	echo $column[4];

			            /*$sqlInsert = "INSERT into users (userId,userName,password,firstName,lastName)
			                   values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "')";
			            $result = mysqli_query($conn, $sqlInsert);
			            
			            if (! empty($result)) {
			                $type = "success";
			                $message = "CSV Data Imported into the Database";
			            } else {
			                $type = "error";
			                $message = "Problem in Importing CSV Data";
			            }*/

			        }
			    }


			}

		}		

		////////////////////////////////////////////////////////////////// 
		/////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////

		
		// message page functionality

		public function message(){
			$this->admin_model->message();
			redirect('admin/messages');
		}

		// notifications page functionality

		public function notification(){
			$this->admin_model->notification();
			redirect('admin/notifications');
		}	

		public function api(){

			//Api link for the app: https://vistrotestserver.000webhostapp.com/Admins/api

			$apiKey = $this->input->post('token');

			//check for api key validity

			$validApi = $this->admin_model->checkApiKeyValidity($apiKey);

			if($validApi){

				//prepare http post request
				                                                                   
				$str = http_build_query($_POST);                                                                                   
																																	 
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL ,"http://localhost/Vistro/api/api.php");                                                                      
				curl_setopt($ch, CURLOPT_POST, 1);                                                                     
				curl_setopt($ch, CURLOPT_POSTFIELDS, $str);                                                                  
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                                                                                                                                    
																																	 
				$result = curl_exec($ch);
				curl_close($ch);

				echo $result;				
	
			}
			else{
				echo 'You don\'t have permission to access this api.';
			}
		}		

		public function upPassword(){

			$response = $this->admin_model->updatePassword();

			if($response == 'changed'){
				$this->session->set_flashdata('upPass-success','User password was successfully updated!');
			}
			else
			if($response == 'mismatch'){
				$this->session->set_flashdata('upPass-mismatch','The passwords you entered don\'t match!');
			}
			else
			if($response == 'incorrect'){
				$this->session->set_flashdata('upPass-incorrect','The password you entered is incorrect!');
			}
			
			redirect('admin/change_password');
		}

		public function uploadImage(){

			if($_FILES['files']['name'] != '')	{

				$settings_id = $_POST['id'];
				$pic_name = '';
				$pic_path = '';

				$output = '';
				$config['upload_path'] = './custom/uploads/admin/images';
				$config['allowed_types'] = 'gif|jpeg|png|jpg';
				$config['max_size'] = '10240';

				$this->load->library('upload', $config);

				for ($count=0; $count < count($_FILES['files']['name']); $count++) { 

					//get the real name of the file before renaming it..
					$pic_name = $_FILES['files']['name'][$count];
					
					$path = $_FILES['files']['name'][$count];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					$newfilename = md5($_FILES['files']['name'][$count].$settings_id).'.'.$ext;

					$_FILES['file']['name'] = $newfilename;	
					$_FILES['file']['type'] = $_FILES['files']['type'][$count];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$count];
					$_FILES['file']['error'] = $_FILES['files']['error'][$count];
					$_FILES['file']['size'] = $_FILES['files']['size'][$count];				

					if($this->upload->do_upload('file')){
						
						$output .= $_FILES['file']['name'] .' was uploaded successfully';
						//$pic_path = 'custom/uploads/teachers/files/';

						//add assignment reccord to the database...
						$this->admin_model->updatePicName($newfilename,$settings_id);

					}
				}
			}

			echo $output;		
		}			

	}

?>