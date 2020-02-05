<?php 
	class Pages_admin extends CI_Controller{

		public function page($page='login'){

			if(!file_exists(APPPATH.'views/admin/'.$page.'.php')){

				//echo 'Page not exist!';
				show_404();  
			}

			$data['title'] = ucfirst($page); 

		    if($this->session->userdata('admin_id')){

		    	$this->session->unset_userdata('settings');
		        $settings = $this->admin_model->getSettings($this->session->userdata('admin_id'));
		        $this->session->set_userdata($settings);

		        if(count($settings)>0){

		        	$lev_type = $settings['settings'][0]['schooling'];
		        	//$year = $settings['settings'][0]['start'].'-'.$settings['settings'][0]['end'];
		        }
		        else{
		        	$lev_type = 'none';  
		        }
		        
		        switch ($page) {
		        	case 'dashboard':

		        			$this->session->unset_userdata('students');
		        			$students = $this->admin_model->getStudents();		        			
		        			$this->session->set_userdata($students);

		        			$this->session->unset_userdata('teachers');
		        			$teachers = $this->admin_model->getTeachers();		        			
		        			$this->session->set_userdata($teachers);

		        			$this->session->unset_userdata('classes');
		        			$classes = $this->admin_model->getClasses();
		        			$this->session->set_userdata($classes);

		        			$this->session->unset_userdata('courses');
		        			$courses = $this->admin_model->getCourses();
		        			$this->session->set_userdata($courses);

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->admin_model->getProfile($this->session->userdata('admin_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->admin_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->admin_model->getNotifications();
		        			$this->session->set_userdata($notifications);

		        			$this->session->unset_userdata('d_events');
		        			$d_events = $this->admin_model->getDEvents($this->session->userdata('admin_id'),'admin_log');
		        			$this->session->set_userdata($d_events);

		        			$this->session->unset_userdata('myEvents');
		        			$myEvents = $this->admin_model->getMyEvents($this->session->userdata('admin_id'),'admin_log');
		        			$this->session->set_userdata($myEvents);		

		        			$this->session->unset_userdata('sharedEvents');
		        			$sharedEvents = $this->admin_model->getsharedEvents($this->session->userdata('admin_id'),'2');
		        			$this->session->set_userdata($sharedEvents);        			

		        		
		        		break;
		        	case 'profile':
		        			$this->session->unset_userdata('profile');
		        			$profile = $this->admin_model->getProfile($this->session->userdata('admin_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->admin_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->admin_model->getNotifications();
		        			$this->session->set_userdata($notifications);

		        		break;
		        	case 'settings':
		        			
		        			$this->session->unset_userdata('profile');
		        			$profile = $this->admin_model->getProfile($this->session->userdata('admin_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('settings');
		        			$settings = $this->admin_model->getSettings($this->session->userdata('admin_id'));
		        			$this->session->set_userdata($settings);

		        			$this->session->unset_userdata('schooling');
		        			$schooling = $this->admin_model->getSchooling();
		        			$this->session->set_userdata($schooling);

		        			$this->session->unset_userdata('grading');
		        			$grading = $this->admin_model->getGrading();
		        			$this->session->set_userdata($grading);

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->admin_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->admin_model->getNotifications();
		        			$this->session->set_userdata($notifications);

		        		break;
		        	case 'administrators':

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->admin_model->getProfile($this->session->userdata('admin_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('administrators');
		        			$administrators = $this->admin_model->getAdministrators($this->session->userdata('admin_id'));
		        			$this->session->set_userdata($administrators);

		        			$this->session->unset_userdata('admin_type');
		        			$admin_type = $this->admin_model->getAdminTypes();
		        			$this->session->set_userdata($admin_type);

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->admin_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->admin_model->getNotifications();
		        			$this->session->set_userdata($notifications);

		        		break;
		        	case 'teachers':
		        			
		        			$this->session->unset_userdata('profile');
		        			$profile = $this->admin_model->getProfile($this->session->userdata('admin_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('teachers');
		        			$teachers = $this->admin_model->getTeachers();		        			
		        			$this->session->set_userdata($teachers);

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->admin_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->admin_model->getNotifications();
		        			$this->session->set_userdata($notifications);		        			

		        		break;	
					case 'students':

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->admin_model->getProfile($this->session->userdata('admin_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('students');
		        			$students = $this->admin_model->getStudents();		        			
		        			$this->session->set_userdata($students);

		        			$this->session->unset_userdata('classes');
		        			$classes = $this->admin_model->getClasses();		        			
		        			$this->session->set_userdata($classes);

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->admin_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->admin_model->getNotifications();
		        			$this->session->set_userdata($notifications);					
						break;	

					case 'classes':

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->admin_model->getProfile($this->session->userdata('admin_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('classes');
		        			$classes = $this->admin_model->getClasses();		        			
		        			$this->session->set_userdata($classes);

		        			$this->session->unset_userdata('levels');
		        			$levels = $this->admin_model->getLevels($lev_type);		        			
		        			$this->session->set_userdata($levels);

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->admin_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->admin_model->getNotifications();
		        			$this->session->set_userdata($notifications);	

						break;  
					case 'courses':

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->admin_model->getProfile($this->session->userdata('admin_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('courses');
		        			$courses = $this->admin_model->getCourses();		        			
		        			$this->session->set_userdata($courses);

		        			$this->session->unset_userdata('levels');
		        			$levels = $this->admin_model->getLevels($lev_type);		        			
		        			$this->session->set_userdata($levels);

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->admin_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->admin_model->getNotifications();
		        			$this->session->set_userdata($notifications);	

						break;  
					case 'attendance':

		        			$this->session->unset_userdata('profile');
		        			$profile = $this->admin_model->getProfile($this->session->userdata('admin_id'));
		        			$this->session->set_userdata($profile);

		        			$this->session->unset_userdata('classes');
		        			$classes = $this->admin_model->getClasses();		        			
		        			$this->session->set_userdata($classes);		        			

		        			$this->session->unset_userdata('messages');
		        			$messages = $this->admin_model->getMessages();
		        			$this->session->set_userdata($messages);

		        			$this->session->unset_userdata('notifications');
		        			$notifications = $this->admin_model->getNotifications();
		        			$this->session->set_userdata($notifications);		        			

						break;     	
		        	default:
		        		# code...
		        		break;
		        }
		    }

			$this->load->view('admin/'.$page,$data);
		}

		public function student($id = '0'){

			//page data here...

			  $this->session->unset_userdata('profile');
		      $profile = $this->admin_model->getProfile($this->session->userdata('admin_id'));
		      $this->session->set_userdata($profile);

		      $this->session->unset_userdata('teachers');
		      $teachers = $this->admin_model->getTeachers();		        			
		      $this->session->set_userdata($teachers);

		      $this->session->unset_userdata('small_settings');
		      $small_settings = $this->admin_model->getSmallSettings($this->session->userdata('admin_id'));	       			
		      $this->session->set_userdata($small_settings);

		      $this->session->unset_userdata('classes');
		      $classes = $this->admin_model->getClasses();		        			
		      $this->session->set_userdata($classes);		      			      		      

			//get all student data here...

			  /////// student profile

		      $this->session->unset_userdata('stdProfile');
		      $stdProfile = $this->admin_model->getStudentProfileById($id);
		      $this->session->set_userdata($stdProfile);

		      $student_id = $stdProfile['stdProfile'][0]['id'];
		      $class_id = $stdProfile['stdProfile'][0]['class_id'];

		      $this->session->unset_userdata('ind_class');
		      $ind_class = $this->admin_model->getClassById($class_id);
		      $this->session->set_userdata($ind_class);			      

		      /////// student demerits

		      $this->session->unset_userdata('demerits');
		      $demerits = $this->admin_model->getStudentDemeritsById($student_id); 
		      $this->session->set_userdata($demerits);	

		      /////// student Jugs

		      $this->session->unset_userdata('jugs');
		      $jugs = $this->admin_model->getStudentJugsById($student_id); 
		      $this->session->set_userdata($jugs);

		      /////// student Suspensions

		      $this->session->unset_userdata('suspensions');
		      $suspensions = $this->admin_model->getStudentSuspensionsById($student_id); 
		      $this->session->set_userdata($suspensions);

		      /////// student Expulsions

		      $this->session->unset_userdata('expulsions');
		      $expulsions = $this->admin_model->getStudentExpulsionsById($student_id); 
		      $this->session->set_userdata($expulsions);		      		      		            

			  /////// student grades

			  //**get all courses for the student**//

			  //$this->session->unset_userdata('stdProfile');  
		      //$stdProfile = $this->admin_model->getStudentProfileById($id);
		      //$this->session->set_userdata($stdProfile);			  

		      $this->session->unset_userdata('stdProfile');  
		      $stdProfile = $this->admin_model->getStudentProfileById($id);
		      $this->session->set_userdata($stdProfile);	


		      if(count($demerits)>0){
		      	$demerits = $demerits['demerits'];
		      }
		      else{
		      	$demerits = array();
		      }

		      if(count($jugs)>0){
		      	$jugs = $jugs['jugs'];
		      }
		      else{
		      	$jugs = array();
		      }	

		      if(count($suspensions)>0){
		      	$suspensions = $suspensions['suspensions'];
		      }
		      else{
		      	$suspensions = array();
		      }	

		      if(count($expulsions)>0){
		      	$expulsions = $expulsions['expulsions'];
		      }
		      else{
		      	$expulsions = array();
		      }			      		      	      

		      $studentProfile = array(
		      	'std_profile' => $stdProfile,
		      	'grades'  	 => array(),
		      	'attendance' => array(),
		      	'behaviour'	 => array(
		      							'demerits'=>$demerits,
		      							'jugs'=>$jugs, 
		      							'suspensions'=>$suspensions, 
		      							'expulsions'=>$expulsions
		      					), 
		      	'fees'		 => array(),
		      	'consellor'	 => array()
		      );

			  $this->load->view('admin/student',$studentProfile);

		}

		public function class($id= '0'){

			$this->session->unset_userdata('ind_class');
		    $ind_class = $this->admin_model->getClassById($id);
		    $this->session->set_userdata($ind_class);

			//get department to determine the courses to show...

		    $department = $ind_class['ind_class'][0]['department'];

		    $this->session->unset_userdata('coursesByDept');
		    $coursesByDept = $this->admin_model->getCoursesByDepartment($department);		         			
		    $this->session->set_userdata($coursesByDept);

		    $this->session->unset_userdata('courses');
		    $courses = $this->admin_model->getCourses();		         			
		    $this->session->set_userdata($courses);		    

		    $this->session->unset_userdata('teachers');
		    $teachers = $this->admin_model->getTeachers();		        			
		    $this->session->set_userdata($teachers);

		    $this->session->unset_userdata('course_to_class');
		    $course_to_class = $this->admin_model->getCourse_to_class($id);		        			
		    $this->session->set_userdata($course_to_class);

			$this->load->view('admin/class');

		}

		/*public function messages($note = 'all'){

			$data['title'] = $note;
			$this->load->view('admins/pages/messages',$data);
		}*/
	}