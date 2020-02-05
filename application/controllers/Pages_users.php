<?php 
	class Pages_users extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('User_model');
		}

		public function page($page='login'){

			if(!file_exists(APPPATH.'views/user/'.$page.'.php')){
				show_404();
			}

			if($this->session->userdata('teacher_id')){

				$rest_id = $this->session->userdata('teacher_id');

				switch($page){
					case 'dashboard':

		        			$this->session->unset_userdata('students');
		        			$students = $this->User_model->getStudents();	 	        			
		        			$this->session->set_userdata($students);

		        			$this->session->unset_userdata('teachers');
		        			$teachers = $this->User_model->getTeachers();		        			
		        			$this->session->set_userdata($teachers);

		        			$this->session->unset_userdata('classes');
		        			$classes = $this->User_model->getClasses($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($classes);

		        			$this->session->unset_userdata('courses');
		        			$courses = $this->User_model->getCourses($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($courses);

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->User_model->getProfile($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->User_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->User_model->getNotifications();
		        			$this->session->set_userdata($notifications);

		        			$this->session->unset_userdata('d_events');
		        			$d_events = $this->User_model->getDEvents($this->session->userdata('teacher_id'),'teachers_log');
		        			$this->session->set_userdata($d_events);

		        			$this->session->unset_userdata('myEvents');
		        			$myEvents = $this->User_model->getMyEvents($this->session->userdata('teacher_id'),'teachers_log');
		        			$this->session->set_userdata($myEvents);		

		        			$this->session->unset_userdata('sharedEvents');
		        			$sharedEvents = $this->User_model->getsharedEvents($this->session->userdata('teacher_id'),'4');
		        			$this->session->set_userdata($sharedEvents); 

		        			$this->session->unset_userdata('myAddedAssignments');
		        			$myAddedAssignments = $this->User_model->getMyAddedAssignments($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($myAddedAssignments);

					break;
					case 'students':

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->User_model->getProfile($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('students');
		        			$students = $this->User_model->getStudents();		        			
		        			$this->session->set_userdata($students);

		        			$this->session->unset_userdata('classes');
		        			$classes = $this->User_model->getClasses($this->session->userdata('teacher_id'));      			
		        			$this->session->set_userdata($classes);

		        			$this->session->unset_userdata('classList');
		        			$classList = $this->User_model->getclassList();		        			
		        			$this->session->set_userdata($classList);

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->User_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->User_model->getNotifications();
		        			$this->session->set_userdata($notifications);

					break;
					case 'classes':

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->User_model->getProfile($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('myClassesList');
		        			$myClassesList = $this->User_model->getMyClassesList($this->session->userdata('teacher_id'));	
		        			$this->session->set_userdata($myClassesList);

		        			$this->session->unset_userdata('classList');
		        			$classList = $this->User_model->getclassList();		        			
		        			$this->session->set_userdata($classList);

		        			$this->session->unset_userdata('courseList');
		        			$courseList = $this->User_model->getCourseList();
		        			$this->session->set_userdata($courseList);

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->User_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->User_model->getNotifications();
		        			$this->session->set_userdata($notifications);


					break;
					case 'assignments':

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->User_model->getProfile($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('myClassesListSingle');
		        			$myClassesListSingle = $this->User_model->getMyClassesListSingle($this->session->userdata('teacher_id'));	
		        			$this->session->set_userdata($myClassesListSingle);

		        			$this->session->unset_userdata('classList');
		        			$classList = $this->User_model->getclassList();		        			
		        			$this->session->set_userdata($classList);

		        			$this->session->unset_userdata('courseList');
		        			$courseList = $this->User_model->getCourseList();
		        			$this->session->set_userdata($courseList);

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->User_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->User_model->getNotifications();
		        			$this->session->set_userdata($notifications);

		        			$this->session->unset_userdata('myAddedAssignments');
		        			$myAddedAssignments = $this->User_model->getMyAddedAssignments($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($myAddedAssignments);

					break;
					case 'profile':

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->User_model->getProfile($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($profile);	

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->User_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->User_model->getNotifications();
		        			$this->session->set_userdata($notifications);		        									

					break;
					case 'events':

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->User_model->getProfile($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($profile);	

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->User_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->User_model->getNotifications();
		        			$this->session->set_userdata($notifications);

		        			$this->session->unset_userdata('myEvents');
		        			$myEvents = $this->User_model->getMyEvents($this->session->userdata('teacher_id'),'teachers_log');
		        			$this->session->set_userdata($myEvents);		

		        			$this->session->unset_userdata('sharedEvents');
		        			$sharedEvents = $this->User_model->getsharedEvents($this->session->userdata('teacher_id'),'4');
		        			$this->session->set_userdata($sharedEvents); 		        			

					break;
					case 'change_password':

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->User_model->getProfile($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($profile);	

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->User_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->User_model->getNotifications();
		        			$this->session->set_userdata($notifications);	 	        			

					break;
					case 'lesson-plans':

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->User_model->getProfile($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($profile);	

		        			$this->session->unset_userdata('lessonPlans');
		        			$lessonPlans = $this->User_model->getLessonPlanByTeacherId($this->session->userdata('teacher_id'));
		        			$this->session->set_userdata($lessonPlans);	
		        			
		        			$this->session->unset_userdata('messages');
		        			$messages = $this->User_model->getMessages(); 
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->User_model->getNotifications();
		        			$this->session->set_userdata($notifications);

		        			/*$this->session->unset_userdata('courseList');
		        			$courseList = $this->User_model->getCourseList();
		        			$this->session->set_userdata($courseList);*/			        			        			

					break;
					default:{

					}
				}
			}

			$data['title'] = ucfirst($page);
			$this->load->view('user/'.$page,$data);

		}

		public function grades($courseToClassId = 0){

			//setup table for student grades...

			$this->session->unset_userdata('courseToClassById');
		    $courseToClassById = $this->User_model->getCourseToClassById($courseToClassId);	
		    $this->session->set_userdata($courseToClassById);

		    //getting class Id:
		    $class_id = $courseToClassById['courseToClassById'][0]['class_id'];

		    //getting course Id:
		    $course_id = $courseToClassById['courseToClassById'][0]['course_id'];

			$this->session->unset_userdata('classNameById');
		    $classNameById = $this->User_model->getClassNameById($class_id);	
		    $this->session->set_userdata($classNameById);

			$this->session->unset_userdata('courseNameById');
		    $courseNameById = $this->User_model->getCourseNameById($course_id);	
		    $this->session->set_userdata($courseNameById);

			$this->session->unset_userdata('marksCourseAndClass');
		    $marksCourseAndClass = $this->User_model->getmarksCourseAndClass($course_id,$class_id);	
		    $this->session->set_userdata($marksCourseAndClass);

			$this->session->unset_userdata('studentsByClassId');
		    $studentsByClassId = $this->User_model->getstudentsByClassId($class_id);	
		    $this->session->set_userdata($studentsByClassId);

		    $this->session->unset_userdata('profile');
		    $profile = $this->User_model->getProfile($this->session->userdata('teacher_id'));
		    $this->session->set_userdata($profile);

		    $this->session->unset_userdata('messages');
		    $messages = $this->User_model->getMessages();
		    $this->session->set_userdata($messages);

		    $this->session->unset_userdata('notifications');
		    $notifications = $this->User_model->getNotifications();
		    $this->session->set_userdata($notifications);

			$this->load->view('user/grades.php');

		}

		public function attendance($courseToClassId = 0){

	        $timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d');

			//setup table for student grades...

			$this->session->unset_userdata('courseToClassById');
		    $courseToClassById = $this->User_model->getCourseToClassById($courseToClassId);	
		    $this->session->set_userdata($courseToClassById);

		    //getting class Id:
		    $class_id = $courseToClassById['courseToClassById'][0]['class_id'];

		    //getting course Id:
		    $course_id = $courseToClassById['courseToClassById'][0]['course_id'];

			$this->session->unset_userdata('classNameById');
		    $classNameById = $this->User_model->getClassNameById($class_id);	
		    $this->session->set_userdata($classNameById);

			$this->session->unset_userdata('courseNameById');
		    $courseNameById = $this->User_model->getCourseNameById($course_id);	
		    $this->session->set_userdata($courseNameById);

			$this->session->unset_userdata('attendanceCourseAndClass');
		    $attendanceCourseAndClass = $this->User_model->getAttendanceCourseAndClass($course_id,$class_id,$today);	
		    $this->session->set_userdata($attendanceCourseAndClass);

			$this->session->unset_userdata('studentsByClassId');
		    $studentsByClassId = $this->User_model->getstudentsByClassId($class_id);	
		    $this->session->set_userdata($studentsByClassId);

		    $this->session->unset_userdata('profile');
		    $profile = $this->User_model->getProfile($this->session->userdata('teacher_id'));
		    $this->session->set_userdata($profile);

		    $this->session->unset_userdata('messages');
		    $messages = $this->User_model->getMessages();
		    $this->session->set_userdata($messages);

		    $this->session->unset_userdata('notifications');
		    $notifications = $this->User_model->getNotifications();
		    $this->session->set_userdata($notifications);

			$this->load->view('user/attendance.php');

		}		
	}