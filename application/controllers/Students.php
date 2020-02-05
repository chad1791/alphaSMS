<?php 

	class Students extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('Student_model'); 
		}

		public function register(){

			//$enc_pass = md5($this->input->post('password'));

			$this->Student_model->register();
			$this->session->set_flashdata('user_created','Your account was successfully created! Please proceed to login');
			redirect('login');
		}

		public function login(){

			$email 	  = $this->input->post('email');
			$password = $this->input->post('password');
			
			$student_id = $this->Student_model->login($email, $password); 
			//$className = $this->Student_model->getClassName(); 

			if($student_id){
				//create session
				$student_data = array(
					'student_id' => $student_id,
					'email' => $email,
					'logged_in' => true
				);

				$this->session->set_userdata($student_data);

				//redirect to dashboard

				redirect('students/dashboard');
			}
			else {
				redirect('students/login');
			}
		}

		public function forgot_pass(){
			$student_id = $this->User_model->forgot_password();
			$this->session->set_flashdata('forgot_pwd','Vistro admins have been notified, we\'ll get back to you soon!');
			redirect('forgot_password');
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect('students/login');
		}

		//dashboard page functionality 

		public function updateStudentBio(){  //
			header('Content-Type: application/json');
			$result = $this->Student_model->updateStudentBioAjax();
			echo json_encode($result); 
		}

		public function getAllCourses(){  //
			header('Content-Type: application/json');
			$result = $this->Student_model->getAllCourses(); 
			echo json_encode($result); 
		}


		public function getStudentCoursesById(){  //////
			$id = $this->input->post('id');
			header('Content-Type: application/json');
			$result = $this->Student_model->getmyCoursesByClassId($id);
			echo json_encode($result); 
		}

		public function getStdCoursesNGrades(){  //////
			$id = $this->input->post('id');
			$student_id = $this->input->post('student_id');
			header('Content-Type: application/json');
			$result = $this->Student_model->getStdCoursesNGrades($id,$student_id);
			echo json_encode($result); 
		}	

		public function getGradesByStudentId(){  //////  
			
			$student_id = $this->input->post('student_id');
			$class_id = $this->input->post('class_id');
			$course_id = $this->input->post('course_id');

			header('Content-Type: application/json');
			$result = $this->Student_model->getGradesByStudentId($student_id, $class_id, $course_id);
			echo json_encode($result); 
		}		

		public function getAttendanceByStudentId(){  ////// ////////
			
			$student_id = $this->input->post('student_id');
			$class_id = $this->input->post('class_id');
			$course_id = $this->input->post('course_id');

			header('Content-Type: application/json');
			$result = $this->Student_model->getAttendanceByStudentId($student_id, $class_id, $course_id);
			echo json_encode($result); 
		}							

		public function getStudentPassById(){
			header('Content-Type: application/json');
			$result = $this->Student_model->getStudentPassByIdAjax(); 
			echo json_encode($result); 
		}

		public function getMyUploadedFiles(){
			header('Content-Type: application/json');
			$result = $this->Student_model->getMyUploadedFiles($this->session->userdata('student_id'));  
			echo json_encode($result); 
		}		

		public function updatePassword(){
			header('Content-Type: application/json');
			$result = $this->Student_model->updatePasswordAjax();   
			echo json_encode($result);
		} 

		public function delFileById(){ //
			header('Content-Type: application/json');
			$result = $this->Student_model->delFileByIdAjax(); 
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

		public function downloadFile(){

			$this->load->helper('download');

			//$data = file_get_contents("./custom/uploads/teachers/files/".$_POST['file']); // Read the file's contents
			
			//or perhpas $data = fopen(......);
			//$name = $_GET['file'];

			//force_download($name, $data); 
			//force_download('./custom/uploads/teachers/files/'.$name, NULL);

			$name = $_GET['file'];
			$data = file_get_contents("./custom/uploads/teachers/files/".$name);
			force_download($name, $data);			

		}

		public function uploadFiles(){

			if($_FILES['files']['name'] != '')	{

				$student_id = $this->session->userdata('student_id');
				$assignment_id = $_POST['id'];
				$pic_name = '';
				$pic_path = '';

				$assDbId = '';

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
						$assDbId = $this->Student_model->addAssFileRecord($assignment_id, $pic_name, $pic_path,$newfilename,$student_id);

					}
				}
			}

			echo json_encode(array('id'=>$assDbId, 'file'=>$pic_name));			
		}	

		public function getNewNotifications() { //

			$result = $this->Student_model->getNewNotificationsAjax(); 			

			if(count($result)>0){

				$result = $result['notification'];

				$stringNote = '<li style="height:25px; padding-left:5px; color:#afb2b8; border-top: 1px solid #e8e8e8; border-bottom: 1px solid #e8e8e8; background-color:#f5f6f7; line-height:1.6;">NEW</li>';

				foreach ($result as $key => $value) {

					$shortText = $value['notification_text'];

					if(strlen($shortText) > 20){

						$shortText = substr($shortText, 0 , 20) . '...';

					}

					$details = $this->Student_model->getUserDetails($value['from_id'], $value['from_dep']);

					$username = '';	
					$pic_path = '';				

					if(count($details)>0){

						$details = $details['info'];

						$gender = $details[0]['gender'];						

						if($gender == 'Male'){
							$gender = 'male';
							$username = 'Mr. ';
						}
						else
						if($gender == 'Female'){
							$gender = 'female';
							$username = 'Ms. ';
						}

						$username .= $details[0]['last'];												

						if($details[0]['image'] == ''){

							$pic_path = base_url().'custom/uploads/default/images/'.$gender.'.jpg';
						}
						else{

							if($value['from_dep'] == 'teachers_log'){

								$pic_path = base_url().'custom/uploads/teachers/images/'.$details[0]['image'];
							}
							else
							if($value['from_dep'] == 'admin_profile'){

								$pic_path = base_url().'custom/uploads/admin/images/'.$details[0]['image'];
							}
							else
							if($value['from_dep'] == 'students'){

								$pic_path = base_url().'custom/uploads/students/images/'.$details[0]['image'];
							}							

						}

					}

					$stringNote .= "<li style=\"background-color:#f9f9f9;\" data-newNote=\"newNote\" data-noteId=\"".$value['id']."\">";
					$stringNote .= "<a href=\"" . $value['type'] . "\">";
					$stringNote .= "<img src=\"";
					$stringNote .= $pic_path;
					$stringNote .= "\" style=\"height:25px; width:25px; margin-left:7px;\" class=\"img-circle\" /><b>&nbsp;&nbsp;";
					$stringNote .= $username;
					$stringNote .= "</b> ". $shortText;
					$stringNote .= "</a>";
					$stringNote .= "</li>";
				}

				echo $stringNote;

			}

		}

		public function getOldNotifications() { //

			$result = $this->Student_model->getOldNotificationsAjax(); 

			if(count($result)>0){

				$result = $result['notification'];

				$stringNote = '<li style="height:25px; padding-left:5px; color:#afb2b8; border-top: 1px solid #e8e8e8; border-bottom: 1px solid #e8e8e8; background-color:#f5f6f7; line-height:1.6;">EARLIER</li>';

				foreach ($result as $key => $value) {

					$shortText = $value['notification_text'];

					if(strlen($shortText) > 20){

						$shortText = substr($shortText, 0 , 20) . '...';

					}

					$details = $this->Student_model->getUserDetails($value['from_id'], $value['from_dep']);

					$username = '';	
					$pic_path = '';				

					if(count($details)>0){

						$details = $details['info'];

						$gender = $details[0]['gender'];						

						if($gender == 'Male'){
							$gender = 'male';
							$username = 'Mr. ';
						}
						else
						if($gender == 'Female'){
							$gender = 'female';
							$username = 'Ms. ';
						}

						$username .= $details[0]['last'];												

						if($details[0]['image'] == ''){

							$pic_path = base_url().'custom/uploads/default/images/'.$gender.'.jpg';
						}
						else{

							if($value['from_dep'] == 'teachers_log'){

								$pic_path = base_url().'custom/uploads/teachers/images/'.$details[0]['image'];
							}
							else
							if($value['from_dep'] == 'admin_profile'){

								$pic_path = base_url().'custom/uploads/admin/images/'.$details[0]['image'];
							}
							else
							if($value['from_dep'] == 'students'){

								$pic_path = base_url().'custom/uploads/students/images/'.$details[0]['image'];
							}							

						}

					}

					$stringNote .= "<li>";
					$stringNote .= "<a href=\"" . $value['type'] . "\">";
					$stringNote .= "<img src=\"";
					$stringNote .= $pic_path;
					$stringNote .= "\" style=\"height:25px; width:25px; margin-left:7px;\" class=\"img-circle\" /><b>&nbsp;&nbsp;";
					$stringNote .= $username;
					$stringNote .= "</b> ". $shortText;
					$stringNote .= "</a>";
					$stringNote .= "</li>";
				}

				echo $stringNote;

			}

		}		

		public function getNoteCount() { 

			header('Content-Type: application/json');

			$result = $this->Student_model->getNewNotificationsAjax();
			$result = count($result['notification']);			

			echo json_encode($result);

		}	

		public function updateViewNotification(){ //
			header('Content-Type: application/json');
			$result = $this->Student_model->updateViewNotificationjax(); 
			echo json_encode($result);
		}

		public function getAllNotifications(){ //

			$result = $this->Student_model->getAllNotificationsAjax(); 

			$domString = '';

			if(count($result)>0){

				$result = $result['notifications'];			

				if(count($result)>0){

					foreach ($result as $key => $value) {

						$viewed = '';

						if($value['is_viewed'] == 0){
							$viewed = 'background-color: #f9f9f9;';
						}

						$domString .= '<tr style="line-height: 2; ';
						$domString .= $viewed;
						$domString .= '">';
						
						//get the name and image...

						$details = $this->Student_model->getUserDetails($value['from_id'], $value['from_dep']);

						$username = '';	
						$pic_path = '';				

						if(count($details)>0){

							$details = $details['info'];

							$gender = $details[0]['gender'];						

							if($gender == 'Male'){
								$gender = 'male';
								$username = 'Mr. ';
							}
							else
							if($gender == 'Female'){
								$gender = 'female';
								$username = 'Ms. ';
							}

							if(isset($details[0]['first'])){
								$username .= $details[0]['first'];
							}
							else{
								$username .= $details[0]['name'];
							}

							$username .= ' ';
							$username .= $details[0]['last'];												

							if($details[0]['image'] == ''){

								$pic_path = base_url().'custom/uploads/default/images/'.$gender.'.jpg';
							}
							else{

								if($value['from_dep'] == 'teachers_log'){

									$pic_path = base_url().'custom/uploads/teachers/images/'.$details[0]['image'];
								}
								else
								if($value['from_dep'] == 'admin_profile'){

									$pic_path = base_url().'custom/uploads/admin/images/'.$details[0]['image'];
								}
								else
								if($value['from_dep'] == 'students'){

									$pic_path = base_url().'custom/uploads/students/images/'.$details[0]['image'];
								}							

							}

							$domString .= '<td><img style="height: 25px; width: 25px;" src="';
							$domString .= $pic_path;
							$domString .= '" class="img-circle" alt="profile pic" />&nbsp;&nbsp; <span><b>';
							$domString .= $username;
							$domString .= '</b>&nbsp;';
							$domString .= $value['notification_text'];
			                $domString .= '</span></td>';

						}

						//get the date in Oct 5, 2019 format...

						$formattedDateTime = $value['creation_date_time'];	

						//append row to the DOM string...

						$domString .= '<td>';
			            $domString .= $formattedDateTime;
			            $domString .= '</td>'; 
						$domString .= '</tr>';
					}			
				}
			}

			echo $domString;

		}



	}

?>