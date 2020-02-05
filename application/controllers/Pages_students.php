<?php 
	class Pages_students extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('Student_model');
		}

		public function page($page='login'){

			if(!file_exists(APPPATH.'views/student/'.$page.'.php')){   
				show_404();
			}

			if($this->session->userdata('student_id')){

				$student_id = $this->session->userdata('student_id');  
 
				switch($page){
					case 'dashboard':

		        			$this->session->unset_userdata('stdProfile');
		        			$stdProfile = $this->Student_model->getProfile($student_id);
		        			$this->session->set_userdata($stdProfile);

		        			//getting class id for student...
		        			$class_id = $stdProfile['stdProfile'][0]['class_id'];

		        			$this->session->unset_userdata('myEvents');
		        			$myEvents = $this->Student_model->getMyEvents($student_id);
		        			$this->session->set_userdata($myEvents);

		        			$this->session->unset_userdata('myAssignments');
		        			$myAssignments = $this->Student_model->getMyAssignments($class_id);
		        			$this->session->set_userdata($myAssignments);

		        			$this->session->unset_userdata('myFiles');
		        			$myFiles = $this->Student_model->getFiles();
		        			$this->session->set_userdata($myFiles);

		        			$this->session->unset_userdata('myClass');
		        			$myClass = $this->Student_model->getClassById($class_id);
		        			$this->session->set_userdata($myClass); 

		        			//$this->session->unset_userdata('myUploadedFiles');
		        			//$myUploadedFiles = $this->Student_model->getMyUploadedFiles($student_id);
		        			//$this->session->set_userdata($myUploadedFiles);		        			


					case 'profile':

		        			$this->session->unset_userdata('stdProfile');
		        			$stdProfile = $this->Student_model->getProfile($student_id);
		        			$this->session->set_userdata($stdProfile);

		        			//getting class id for student...
		        			$class_id = $stdProfile['stdProfile'][0]['class_id'];

		        			$this->session->unset_userdata('myClass');
		        			$myClass = $this->Student_model->getClassById($class_id);
		        			$this->session->set_userdata($myClass);

					case 'grades': 

		        			$this->session->unset_userdata('stdProfile');
		        			$stdProfile = $this->Student_model->getProfile($student_id);
		        			$this->session->set_userdata($stdProfile);

		        			//getting class id for student...
		        			$class_id = $stdProfile['stdProfile'][0]['class_id'];

		        			$this->session->unset_userdata('myClass');
		        			$myClass = $this->Student_model->getClassById($class_id);
		        			$this->session->set_userdata($myClass);

		        			$this->session->unset_userdata('schooling');
		        			$schooling = $this->Student_model->getClassById($class_id);
		        			$this->session->set_userdata($schooling);

		        			$this->session->unset_userdata('grading');
		        			$grading = $this->Student_model->getClassById($class_id);
		        			$this->session->set_userdata($grading);

		        			$this->session->unset_userdata('allCourses');
		        			$allCourses = $this->Student_model->getAllCourses();
		        			$this->session->set_userdata($allCourses);		        			

		        			$this->session->unset_userdata('courseList');
		        			$courseList = $this->Student_model->getmyCoursesByClassId($class_id);
		        			$this->session->set_userdata($courseList);

		        			$tempGrades = array();
		        			$myGrades = array();

		        			$class_dep = 0;

		        			if(count($courseList)>0){

		        				$courses = $courseList['courseList'];

			        			if(count($courses)>0){

				        			for ($i=0; $i < count($courses); $i++) { 

				        				$course_id = $courses[$i]['course_id'];
				        				
				        				$grade = $this->Student_model->getGradesByStudentId($student_id, $class_id, $course_id);

				        				if(!empty($grade)){
				        					array_push($tempGrades, $grade);
				        				}
				        			}
			        			}

			        			foreach ($tempGrades as $key => $value) {

			        				$myGrades += $value;

			        			}
			        		}

						    $data['myGrades'] = $myGrades;		        			

					break;
					case 'change_password':

		        			$this->session->unset_userdata('stdProfile');
		        			$stdProfile = $this->Student_model->getProfile($student_id);
		        			$this->session->set_userdata($stdProfile);

					break;
					case 'attendance':

		        			$this->session->unset_userdata('stdProfile');
		        			$stdProfile = $this->Student_model->getProfile($student_id);
		        			$this->session->set_userdata($stdProfile);

		        			$class_id = $stdProfile['stdProfile'][0]['class_id'];

		        			$this->session->unset_userdata('myClass');
		        			$myClass = $this->Student_model->getClassById($class_id);
		        			$this->session->set_userdata($myClass);

		        			$this->session->unset_userdata('schooling');
		        			$schooling = $this->Student_model->getClassById($class_id);
		        			$this->session->set_userdata($schooling);

		        			$this->session->unset_userdata('grading');
		        			$grading = $this->Student_model->getClassById($class_id);
		        			$this->session->set_userdata($grading);

		        			$this->session->unset_userdata('allCourses');
		        			$allCourses = $this->Student_model->getAllCourses();
		        			$this->session->set_userdata($allCourses);		        			

		        			$this->session->unset_userdata('courseList');
		        			$courseList = $this->Student_model->getmyCoursesByClassId($class_id);
		        			$this->session->set_userdata($courseList); 

		        			$tempAttendance = array();
		        			$myAttendance = array();


		        			if(count($courseList)>0){

		        				$courses = $courseList['courseList'];

			        			if(count($courses)>0){

				        			for ($i=0; $i < count($courses); $i++) { 

				        				$course_id = $courses[$i]['course_id']; 
				        				
				        				$attendance = $this->Student_model->getAttendanceByStudentId($student_id, $class_id, $course_id);

				        				if(!empty($attendance)){
				        					array_push($tempAttendance, $attendance); 
				        				}
				        			}
			        			}

			        			foreach ($tempAttendance as $key => $value) { 

			        				$myAttendance += $value;

			        			}

		        			}

						    $data['myAttendance'] = $myAttendance;	

					break;
					case 'graphs':

		        			$this->session->unset_userdata('stdProfile');
		        			$stdProfile = $this->Student_model->getProfile($student_id);
		        			$this->session->set_userdata($stdProfile);

		        			$class_id = $stdProfile['stdProfile'][0]['class_id'];

		        			$this->session->unset_userdata('myClass');
		        			$myClass = $this->Student_model->getClassById($class_id);
		        			$this->session->set_userdata($myClass);	  	        			


					break;
					case 'notifications':

		        			$this->session->unset_userdata('stdProfile');
		        			$stdProfile = $this->Student_model->getProfile($student_id);
		        			$this->session->set_userdata($stdProfile);

		        			//$this->session->unset_userdata('notifications');
		        			//$notifications = $this->Student_model->getAllNotifications($student_id);
		        			//$this->session->set_userdata($notifications);	 	        			

					break;
					default:{

					}
				}
			}

			$data['title'] = ucfirst($page);
			$this->load->view('student/'.$page,$data);

		}

		/*public function table($t_num = 0){

			$this->load->view('student/table.php');

		}*/
	}