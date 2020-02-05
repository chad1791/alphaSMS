<?php 

	class Users extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('User_model');
		}

		public function register(){

			//$enc_pass = md5($this->input->post('password'));
			
			$this->User_model->register();
			$this->session->set_flashdata('user_created','Your account was successfully created! Please proceed to login');
			redirect('login');
		}

		public function login(){

			$email 	  = $this->input->post('email');
			$password = $this->input->post('password');
			
			$teacher_id = $this->User_model->login($email, $password); 

			if($teacher_id){
				//create session
				$teacher_data = array(
					'teacher_id' => $teacher_id,
					'email' => $email,
					'logged_in' => true
				);

				$this->session->set_userdata($teacher_data);

				//redirect to dashboard

				redirect('teachers/dashboard');
			}
			else {
				redirect('teachers/login');
			}
		}

		public function forgot_pass(){
			$teacher_id = $this->User_model->forgot_password();
			$this->session->set_flashdata('forgot_pwd','Vistro admins have been notified, we\'ll get back to you soon!');
			redirect('forgot_password');
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect('teachers/login');
		}

		//dashboard page functionality 

		public function updateMyEvent(){ //
			//header('Content-Type: application/json');
			$this->User_model->updateMyEvent();
			//redirect('profile');
		}

		public function updateProfile(){ //
			//header('Content-Type: application/json');
			$this->User_model->updateProfile();
			redirect('teachers/profile');
		}		

		public function addMyEvent(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->addMyEventAjax();
			echo json_encode($result); 
		}

		public function addLessonPlan(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->addLessonPlanAjax();
			echo json_encode($result); 
		}

		public function updateLessonPlan(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->updateLessonPlanAjax();
			echo json_encode($result); 
		}		

		public function updateMyEventUrlShares(){
			header('Content-Type: application/json');
			$result = $this->User_model->updateMyEventUrlSharesAjax();
			echo json_encode($result); 
		}

		public function updateGrade(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->updateGradeAjax();
			echo json_encode($result); 
		}

		public function updateAttendance(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->updateAttendanceAjax();
			echo json_encode($result); 
		}

		public function updateRemarks(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->updateRemarksAjax();
			echo json_encode($result); 
		}

		public function delDEventById(){
			header('Content-Type: application/json');
			$result = $this->User_model->delDEventByIdAjax(); 
			echo json_encode($result);
		}

		public function delMyEventById(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->delMyEventByIdAjax();
			echo json_encode($result);
		}

		public function delAssignmentById(){ //
			//header('Content-Type: application/json');
			$result = $this->User_model->delAssignmentById();
			//echo json_encode($result);
		}

		public function addDefaultEvent(){
			//header('Content-Type: application/json');
			$result = $this->User_model->addDefaultEvent();
			//echo json_encode($result); 
			//redirect('dashboard');
		}

		public function addGrade(){ //
			//header('Content-Type: application/json');
			$result = $this->User_model->addGradeAjax();
			echo json_encode($result); 
			//redirect('dashboard');
		}

		public function addAttendance(){ //
			//header('Content-Type: application/json');
			$result = $this->User_model->addAttendanceAjax();
			echo json_encode($result); 
			//redirect('dashboard');
		}

		public function addAssignment(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->addAssignmentAjax(); 
			echo json_encode($result); 
			//redirect('dashboard');
		}	

		public function updateAssignment(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->updateAssignmentAjax(); 
			echo json_encode($result); 
			//redirect('dashboard');
		}		

		public function delLessonPlanById(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->delLessonPlanByIdAjax();  
			echo json_encode($result); 
		}

		public function delFileById(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->delFileByIdAjax(); 
			echo json_encode($result);
		}		

		public function getLessonPlanById(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->getLessonPlanByIdAjax();
			echo json_encode($result); 
		}

		public function getAllMyEvents(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->getAllMyEventsAjax();
			echo json_encode($result); 
		}

		public function getStudentsAssUploads(){ 
			header('Content-Type: application/json');
			$result = $this->User_model->getStudentsAssUploadsAjax(); 
			echo json_encode($result); 
		}

		public function getCoursesByClassId(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->getCoursesByClassIdAjax();
			echo json_encode($result); 
		}

		public function getAssignmentById(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->getAssignmentByIdAjax();
			echo json_encode($result); 
		}

		public function getCourseNameById(){
			header('Content-Type: application/json');
			$result = $this->User_model->getCourseNameByIdAjax();
			echo json_encode($result); 
		}


		public function getAllSharedEvents(){
			header('Content-Type: application/json');
			$result = $this->User_model->getAllSharedEventsAjax();
			echo json_encode($result); 
		}

		public function getMyEventById(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->getMyEventByIdAjax();
			echo json_encode($result); 
		}

		public function getUploadedFilesByAssId(){ //
			header('Content-Type: application/json');
			$result = $this->User_model->getUploadedFilesByAssIdAjax(); 
			echo json_encode($result); 
		}

		public function getAllDefaultEvents(){
			header('Content-Type: application/json');
			$result = $this->User_model->getAllDefaultEventsAjax();
			echo json_encode($result); 
		}

		//change password page

		public function getUserPassById(){
			header('Content-Type: application/json');
			$result = $this->User_model->getUserPassByIdAjax(); 
			echo json_encode($result); 
		}

		public function updatePassword(){
			header('Content-Type: application/json');
			$result = $this->User_model->updatePasswordAjax(); 
			echo json_encode($result);
		} 		

		public function upPic(){

			$config['upload_path'] = './assets/user/pics';
			$config['allowed_types'] = 'gif|jpeg|png|jpg';
			$config['overwrite'] = TRUE;
			$config['max_height'] = '1000';
			$config['max_width'] = '2048';
			$config['max_size'] = '4096';

			//upload image here...
			$this->load->library('upload', $config);
			$this->upload->do_upload('file_name');
			$file_name=$this->upload->data();
			$data=array('image'=>$file_name['file_name']);

			$this->User_model->updatePicture($data);

			$this->session->set_flashdata('Success-ImgChange','Image was successfully updated!');
			redirect('view_menu');
		}

		/*public function downloadFile(){

			$this->load->helper('download'); 

			//$data = file_get_contents("./custom/uploads/teachers/files/".$_POST['file']); // Read the file's contents
			
			//or perhpas $data = fopen(......);
			//$name = $_GET['file'];

			//force_download($name, $data); 
			//force_download('./custom/uploads/teachers/files/'.$name, NULL);

			$name = $_GET['file'];
			$data = file_get_contents("./custom/uploads/teachers/files/".$name);
			force_download($name, $data);			

		}*/		

		public function uploadLessonPlan(){

			/*echo '<pre>';
			print_r($_FILES);
			echo '</pre>';*/

			if($_FILES['files']['name'] != '')	{

				$lesson_plan_id = $_POST['id'];
				$pic_name = '';
				$pic_path = '';

				$output = '';
				$config['upload_path'] = './custom/uploads/teachers/files';
				$config['allowed_types'] = 'gif|jpeg|png|jpg';
				$config['max_size'] = '10240';

				$this->load->library('upload', $config);

				for ($count=0; $count < count($_FILES['files']['name']); $count++) { 

					//get the real name of the file before renaming it..
					$pic_name = $_FILES['files']['name'][$count];
					
					$path = $_FILES['files']['name'][$count];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					$newfilename = md5($_FILES['files']['name'][$count].$lesson_plan_id).'.'.$ext; 

					$_FILES['file']['name'] = $newfilename;	
					$_FILES['file']['type'] = $_FILES['files']['type'][$count];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$count];
					$_FILES['file']['error'] = $_FILES['files']['error'][$count];
					$_FILES['file']['size'] = $_FILES['files']['size'][$count];				

					if($this->upload->do_upload('file')){
						
						$output .= $_FILES['file']['name'] .' was uploaded successfully';
						$pic_path = 'custom/uploads/teachers/files/';

						//add assignment reccord to the database...
						$this->User_model->updateLessonPlanRecord($lesson_plan_id, $newfilename);

					}
				}
			}

			echo $output;		
		}		

		public function uploadFiles(){

			if($_FILES['files']['name'] != '')	{

				$assignment_id = $_POST['id'];
				$pic_name = '';
				$pic_path = '';

				$ass_dbId = 0;

				$output = '';
				$config['upload_path'] = './custom/uploads/teachers/files';
				$config['allowed_types'] = 'gif|jpeg|png|jpg';
				$config['max_size'] = '10240';

				$this->load->library('upload', $config);

				for ($count=0; $count < count($_FILES['files']['name']); $count++) { 

					//get the real name of the file before renaming it..
					$pic_name = $_FILES['files']['name'][$count];
					
					$path = $_FILES['files']['name'][$count];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					$newfilename = md5($_FILES['files']['name'][$count].$assignment_id).'.'.$ext; 

					$_FILES['file']['name'] = $newfilename;	
					$_FILES['file']['type'] = $_FILES['files']['type'][$count];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$count];
					$_FILES['file']['error'] = $_FILES['files']['error'][$count];
					$_FILES['file']['size'] = $_FILES['files']['size'][$count];				

					if($this->upload->do_upload('file')){
						
						$output .= $_FILES['file']['name'] .' was uploaded successfully';
						$pic_path = 'custom/uploads/teachers/files/';

						//add assignment reccord to the database...
						$ass_dbId = $this->User_model->addAssFileRecord($assignment_id, $pic_name, $pic_path,$newfilename);

					}
				}
			}

			//echo $ass_dbId.' '.$newfilename;

			echo json_encode(array('id'=>$ass_dbId, 'file'=>$newfilename));		
		}

		public function uploadImage(){

			if($_FILES['files']['name'] != '')	{

				$teacher_id = $this->session->userdata('teacher_id');
				$pic_name = '';
				$pic_path = '';

				$output = '';
				$config['upload_path'] = './custom/uploads/teachers/images';
				$config['allowed_types'] = 'gif|jpeg|png|jpg';
				$config['max_size'] = '10240';

				$this->load->library('upload', $config);

				for ($count=0; $count < count($_FILES['files']['name']); $count++) { 

					//get the real name of the file before renaming it..
					$pic_name = $_FILES['files']['name'][$count];
					
					$path = $_FILES['files']['name'][$count];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					$newfilename = md5($_FILES['files']['name'][$count].$teacher_id).'.'.$ext;

					$_FILES['file']['name'] = $newfilename;	
					$_FILES['file']['type'] = $_FILES['files']['type'][$count];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$count];
					$_FILES['file']['error'] = $_FILES['files']['error'][$count];
					$_FILES['file']['size'] = $_FILES['files']['size'][$count];				

					if($this->upload->do_upload('file')){
						
						$output .= $_FILES['file']['name'] .' was uploaded successfully';
						$pic_path = 'custom/uploads/teachers/images/';

						//add assignment reccord to the database...
						$this->User_model->updateProfilePic($teacher_id, $newfilename); 

					}
				}
			}

			echo $output;		
		}

		public function downloadFile(){

			$this->load->helper('download');

			$name = $_GET['file'];;
			$data = file_get_contents("./custom/uploads/teachers/files/".$name);
			force_download($name, $data);			

		}					

	}

?>