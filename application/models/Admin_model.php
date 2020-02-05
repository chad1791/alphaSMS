<?php 

	class Admin_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		// for register page

		public function register($password){ 

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'email' 	=> $this->input->post('email'),
				'pass_md5'  => $password,
				'pass_txt' 	=> $this->input->post('password'),
				'status'	=> '1',
				'type'		=> '1',
				'deleted'	=> '0',
				'edited_on' => $today
			);

			return $this->db->insert('admin_log', $data);   
		}

		//** end of registration page **// 

		// for login page

		public function login($email, $password){

			//echo $email;
			//echo $password;

			$this->db->where('email',$email);
			$this->db->where('pass_md5',$password);

			$result = $this->db->get('admin_log');
			
			if($result->num_rows() == 1){
				if($result->row(0)->status == '1'){
					return $result->row(0)->id;
				}
				else{

					$this->session->set_flashdata('acc_inactive','Your account is inactive, please contact your Web Master for account activation!');
					return 0;
				}
			}
			else{
				$this->session->set_flashdata('unk_account','Incorrect username or password, please try to login again!');
				return 0;
			}
		}

		//** end of login page **// 

		// for messages page

		public function message(){

		}

		//** end of messages page **// 

		// for notifications page

		public function notification(){

		}

		//** end of notifications page **// 

		// for search page

		public function search($param){

			$first = '';
			$middle = '';
			$last = '';
			$search_result = array();

			//split student name into first name and last name.

			$str_name = explode (" ", $param); 

			if(count($str_name) == 3){

				$first = $str_name[0];
				$middle = $str_name[1];
				$last = $str_name[2];

				$result = $this->db->select('id, student_id, first, middle, last, cell, email, address')
						   ->from('students')
						   ->like('first',$first,'after')
						   ->like('middle',$middle,'both')
						   ->like('last',$last,'both')
						   ->get();	

				if($result->num_rows() >= 1){
					$search_result['studentSearchResult'] = $result->result_array();
				}
			}
			else
			if(count($str_name) == 2){

				$first = $str_name[0];
				$last = $str_name[1];

				if($last == '-sur'){

					$result = $this->db->select('id, student_id, first, middle, last, cell, email, address')
							   ->from('students')
							   ->like('last',$first,'both')
							   ->get();	

					if($result->num_rows() >= 1){
						$search_result['studentSearchResult'] = $result->result_array();
					}
				}
				else
				if($last == '-mid'){

					$result = $this->db->select('id, student_id, first, middle, last, cell, email, address')
							   ->from('students')
							   ->like('middle',$first,'after')
							   ->get();	

					if($result->num_rows() >= 1){
						$search_result['studentSearchResult'] = $result->result_array();
					}
				}
				else{

					$result = $this->db->select('id, student_id, first, middle, last, cell, email, address')
							   ->from('students')
							   ->like('first',$first,'after')
							   ->like('last',$last,'after')
							   ->get();	

					if($result->num_rows() >= 1){
						$search_result['studentSearchResult'] = $result->result_array();
					}
				}
			}
			else
			if(count($str_name) == 1){

				$first = $str_name[0];

				$result = $this->db->select('id, student_id, first, middle, last, cell, email, address')
						   ->from('students')
						   ->like('first',$first,'after')
						   ->get();	

				if($result->num_rows() >= 1){
					$search_result['studentSearchResult'] = $result->result_array();
				}
			}

			
			//echo 'Search Result from Admin_model: ';

			/*echo '<pre>';
			print_r($search_result);
			echo '</pre>';*/
			
			return $search_result;
		}

		//** end of search page **//  

		// for dashboard page

		public function getsharedEvents($id,$group){

			//$id = $this->input->post('owner_id');

			$sharedEvents = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$this->db->order_by('id', 'DESC');  
			$this->db->like('share_group', $group);
			$result = $this->db->get_where('my_events',array('owner_id!='=>$id,'deleted'=>'0'));

			if($result->num_rows() >= 1){
				$sharedEvents['sharedEvents'] = $result->result_array();
			}

			return $sharedEvents;

		}

		public function getAllSharedEventsAjax(){ 

			$id = $this->input->post('owner_id');
			$group = $this->input->post('group');

			$sharedEvents = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$this->db->order_by('id', 'DESC');  
			$this->db->like('share_group', $group);
			$result = $this->db->get_where('my_events',array('owner_id!='=>$id,'deleted'=>'0'));

			if($result->num_rows() >= 1){
				$sharedEvents['sharedEvents'] = $result->result_array();
			}

			return $sharedEvents;

		}

		public function updateMyEventUrlSharesAjax(){

			$id = $this->input->post('id');
			$myEvents = array();

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'id'			=> $id,
				'url' 			=> $this->input->post('url'), 
				'des' 			=> $this->input->post('des'), 
				'share_group' 	=> $this->input->post('shareGroup'),
				'edited_on'		=> $today
			);
			
			$updt_str = '';
		    foreach ($data as $k => $v) {
		        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
		    }

		    $updt_str = substr_replace($updt_str,";", -1);

		    $result = $this->db->query($this->db->insert_string('my_events', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);

		    //get and return data from last updated event

		    if($result){

				$result2 = $this->db->get_where('my_events',array('id'=>$id,'deleted'=>'0')); 

				if($result2->num_rows() >= 1){
					$myEvents['event'] = $result2->result_array();
				}
		    }

		    return $myEvents;
		}		   

		public function updateMyEvent(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'id'		=> $this->input->post('id'),
				'start' 	=> $this->input->post('start'), 
				'end' 		=> $this->input->post('end'),
				'allDay'	=> $this->input->post('allDay'),
				'edited_on'	=> $today
			);
			
			$updt_str = '';
		    foreach ($data as $k => $v) {
		        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
		    }

		    $updt_str = substr_replace($updt_str,";", -1);

		    $this->db->query($this->db->insert_string('my_events', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
		}

		public function addMyEventAjax(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');			

			$data = array(
				'owner_id' 	  	=> $this->input->post('owner_id'),
				'd_event_id'  	=> $this->input->post('d_event_id'),
				'owner_type'	=> $this->input->post('owner_type'),
				'title' 		=> $this->input->post('title'),
				'start' 		=> $this->input->post('start'),
				'end'	 		=> $this->input->post('end'),
				'url' 			=> '',
				'allDay'		=> '1',
				'share_group'	=> '1',
				'color'			=> $this->input->post('color'),
				'background'	=> $this->input->post('background'),
				'border'		=> $this->input->post('border'),
				'deleted'   	=> '0',
				'created_on'   	=> $today
			);

			$this->db->insert('my_events', $data);

			return $this->db->insert_id(); //get the id of the last inserted event from the database...
			//$this->session->set_flashdata('adminAdded_success','Administrator was successfully added to the system!'); 
		}		   

		public function delDEventByIdAjax(){
			
			$id = $this->input->post('id');

			$data = array(
				'deleted' => '1'
			);
				
			$this->db->where('id', $id);
			$deleted = $this->db->update('d_events', $data);		

			return $deleted;

		}

		public function delMyEventByIdAjax(){
			
			$id = $this->input->post('id');

			$data = array(
				'deleted' => '1'
			);
				
			$this->db->where('id', $id);
			$deleted = $this->db->update('my_events', $data);		

			return $deleted;

		}

		public function getAllMyEventsAjax(){

			$id = $this->input->post('owner_id');

			$myEvents = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('my_events',array('owner_id'=>$id,'deleted'=>'0')); 

			if($result->num_rows() >= 1){
				$myEvents['event'] = $result->result_array();
			}

			return $myEvents;

		}

		public function getMyEventByIdAjax(){

			$id = $this->input->post('id');

			$myEvents = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('my_events',array('id'=>$id,'deleted'=>'0')); 

			if($result->num_rows() >= 1){
				$myEvents['event'] = $result->result_array();
			}

			return $myEvents;

		}

		public function getMyEvents($owner_id,$table_name){

			$id = $this->input->post('owner_id');

			$myEvents = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$this->db->order_by('id', 'DESC');  
			$result = $this->db->get_where('my_events',array('owner_id'=>$owner_id, 'owner_type'=>$table_name, 'deleted'=>'0'));

			if($result->num_rows() >= 1){
				$myEvents['myEvents'] = $result->result_array();
			}

			return $myEvents;

		}

		public function getAllDefaultEventsAjax(){

			$id = $this->input->post('owner_id');

			$myEvents = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('d_events',array('owner_id'=>$id,'deleted'=>'0')); 

			if($result->num_rows() >= 1){
				$myEvents['d_event'] = $result->result_array();
			}

			return $myEvents;

		}		

		public function addDefaultEvent(){

			$data = array(
				'owner_id' 	  	=> $this->input->post('owner_id'),
				'table_name'	=> $this->input->post('table_name'),
				'title' 		=> $this->input->post('title'),
				'color'			=> $this->input->post('color'),
				'bground'		=> $this->input->post('bground'),
				'border'		=> $this->input->post('border'),
				'deleted'   	=> '0'
			);

			$this->db->insert('d_events', $data);
			//$this->session->set_flashdata('adminAdded_success','Administrator was successfully added to the system!');
		}		

		public function getDEvents($owner_id,$table_name){

			$d_events = array();

			$this->db->order_by('id', 'DESC');  
			$result = $this->db->get_where('d_events',array('owner_id'=>$owner_id, 'table_name'=>$table_name, 'deleted'=>'0'));

			if($result->num_rows() >= 1){
				$d_events['d_events'] = $result->result_array();
			}

			return $d_events;
		}		

		public function getStudents(){

			$students = array();

			$this->db->order_by('id', 'ASC');  
			$result = $this->db->get_where('students',array('deleted'=>'0'));

			if($result->num_rows() >= 1){
				$students['students'] = $result->result_array();
			}

			return $students;
		}

		public function getTeachers(){

			$teachers = array();

			$this->db->order_by('id', 'ASC');  
			$result = $this->db->get_where('teachers_log',array('deleted'=>'0'));

			if($result->num_rows() >= 1){
				$teachers['teachers'] = $result->result_array();
			}

			return $teachers;
		}

		public function getClasses(){

			$classes = array();

			$this->db->order_by('id', 'ASC');  
			$result = $this->db->get_where('classes',array('deleted'=>'0'));

			if($result->num_rows() >= 1){
				$classes['classes'] = $result->result_array();
			}

			return $classes;
		}

		public function getCourses(){ //

			$courses = array();

			$this->db->order_by('id', 'ASC');  
			$result = $this->db->get_where('courses',array('deleted'=>'0'));

			if($result->num_rows() >= 1){
				$courses['courses'] = $result->result_array();
			}

			return $courses;
		}

		public function getCoursesByDepartment($department){

			$coursesByDept = array();

			$this->db->order_by('id', 'ASC');  
			$result = $this->db->get_where('courses',array('deleted'=>'0', 'type'=>$department));

			if($result->num_rows() >= 1){
				$coursesByDept['coursesByDept'] = $result->result_array();
			}

			return $coursesByDept;
		}		

		public function getProfile($id){

			$profile = array();

			$result = $this->db->get_where('admin_profile',array('id'=>$id));
			
			if($result->num_rows() >= 1){
				$profile['profile'] = $result->result_array();
			}

			return $profile;
		}

		public function getMessages(){

			$messages = array();

			$this->db->order_by('id', 'ASC');  
			$result = $this->db->get('messages');

			if($result->num_rows() >= 1){
				$messages['messages'] = $result->result_array();
			}

			return $messages;
		}

		public function getNotifications(){

			$notifications = array();

			$this->db->order_by('id', 'ASC');  
			$result = $this->db->get('notifications');

			if($result->num_rows() >= 1){
				$notifications['notifications'] = $result->result_array();
			}

			return $notifications;
		}

		//** end of dashboard page **//

		//for profile page

		public function updateProfile($id){

			$data = array(
				'id'	=> $id,
				'name' => $this->input->post('first'), 
				'middle' => $this->input->post('middle'),
				'last' => $this->input->post('last'),
				'email' => $this->input->post('email'),
				'cell' => $this->input->post('cell'),
				'address' => $this->input->post('address'),
				'position' => $this->input->post('post'),
				'education' => $this->input->post('education'),
				'description' => $this->input->post('des')
			);

			//$this->db->where('id', $id);
			$this->db->replace('admin_profile', $data);

			$this->session->set_flashdata('upProfile_success','Profile was successfully updated!');

		}

		public function updateAdminProPic($admin_id, $pic_name, $pic_path,$newfilename){ 

			$data = array(
				'id'		=> $admin_id,
				'image' 	=> $newfilename
			);
			
			$updt_str = '';
		    foreach ($data as $k => $v) {
		        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
		    }

		    $updt_str = substr_replace($updt_str,";", -1);

		    $this->db->query($this->db->insert_string('admin_profile', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
		}

		//** end of profile page **//

		//for settings page

		public function addSettingsAjax($id){ 

			$data = array(
				'id'		=> $id,
				'name' 		=> $this->input->post('name'), 
				'address' 	=> $this->input->post('address'),
				'phone' 	=> $this->input->post('phone'),
				'cell' 		=> $this->input->post('cell'),
				'email' 	=> $this->input->post('email'),
				'schooling' => $this->input->post('schooling'),
				'grading' 	=> $this->input->post('grading'),
				'terms' 	=> $this->input->post('terms'),
				'start' 	=> $this->input->post('start'),
				'end'		=> $this->input->post('end'),
				'short'		=> $this->input->post('short')
				//'image' 	=> '$this->input->post(image)'
			);

			//$this->db->where('id', $id);
			$this->db->insert('settings', $data);
			return $id;
			//return $this->db->insert_id();
			//$this->session->set_flashdata('upProfile_success','School Settings were successfully updated!');

		}

		public function updatePicName($pic_name, $settings_id){ //

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'id'		=> $settings_id,
				'image'   	=> $pic_name,
				'edited_on' => $today
			);
			
			$updt_str = '';
		    foreach ($data as $k => $v) {
		        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
		    }

		    $updt_str = substr_replace($updt_str,";", -1);
		    $this->db->query($this->db->insert_string('settings', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);

		}				

		public function updateSettingsAjax(){

			$data = array(
				'id'		=> $this->input->post('setting_id'),
				'name' 		=> $this->input->post('name'), 
				'address' 	=> $this->input->post('address'),
				'phone' 	=> $this->input->post('phone'),
				'cell' 		=> $this->input->post('cell'),
				'email' 	=> $this->input->post('email'),
				'schooling' => $this->input->post('schooling'),
				'grading' 	=> $this->input->post('grading'),
				'terms' 	=> $this->input->post('terms'),
				'start' 	=> $this->input->post('start'),
				'end'		=> $this->input->post('end'),
				'short'		=> $this->input->post('short')
			);

			$updt_str = '';
		    foreach ($data as $k => $v) {
		        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
		    }

		    $updt_str = substr_replace($updt_str,";", -1);
		    $this->db->query($this->db->insert_string('settings', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);

		    //delete image from server upload folder....

		    $prevImage = $this->input->post('prevImage');
		    $willDelImage = $this->input->post('willUpdateImage');

		    if($willDelImage == 1){
		    	$fileName = './custom/uploads/admin/images/'.$prevImage;
				unlink($fileName);		    	
		    }

		    return $this->input->post('setting_id');
		}

		public function getSettings($id){

			$settings = array();

			$result = $this->db->get_where('settings',array('id'=>$id));
			
			if($result->num_rows() >= 1){
				$settings['settings'] = $result->result_array();
			}

			return $settings;
		}

		public function getSchooling(){

			$schooling = array();

			$result = $this->db->get('schooling');

			if($result->num_rows() >= 1){
				$schooling['schooling'] = $result->result_array();
			}

			return $schooling;
		}

		public function getGrading(){

			$grading = array();

			$result = $this->db->get('grading');

			if($result->num_rows() >= 1){
				$grading['grading'] = $result->result_array();
			}

			return $grading;
		}

		//** end of settings page **// 

		//for administrators page

		public function getAdministrators($id){

			$administrators = array();

			$this->db->select('id, email, status, type');
			$this->db->order_by("id", "asc");
			//$result = $this->db->get_where('admin_log',array('id!='=>$id));
			$result = $this->db->get_where('admin_log',array('deleted'=>'0'));

			if($result->num_rows() >= 1){
				$administrators['administrators'] = $result->result_array();
			}

			return $administrators;
		}

		public function getAdminTypes(){

			$admin_type = array();

			$result = $this->db->get_where('account_types',array('id!='=>'1'));

			if($result->num_rows() >= 1){
				$admin_type['admin_type'] = $result->result_array();
			}

			return $admin_type;
		}

		public function addAdmin(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'email' 	=> $this->input->post('email'),
				'pass_md5'  => md5('password'),
				'pass_txt' 	=> 'password',
				'status'	=> $this->input->post('status'),
				'type'		=> $this->input->post('type'),
				'deleted'   => '0',
				'edited_on' => $today
			);

			$this->db->insert('admin_log', $data);
			$this->session->set_flashdata('adminAdded_success','Administrator was successfully added to the system!');
		}

		public function getAdminByIdAjax(){

			$id = $this->input->post('id');

			$Admin_info = array();

			$this->db->select('id, email, status, type');
			$this->db->order_by("id", "asc");
			$this->db->where(array('id'=>$id));
			$result = $this->db->get('admin_log');

			if($result->num_rows() >= 1){
				$Admin_info['admin'] = $result->result_array();
			}

			return $Admin_info;

		}

		public function delAdminById(){ //
			
			$id = $this->input->post('id');

			$data = array(
				'deleted' => '1'
			);
				
			$this->db->where('id', $id);
			$deleted = $this->db->update('admin_log', $data);		

			return $deleted;

		}

		public function updateAdmin(){ 

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');			

			$data = array(
				'id'		=> $this->input->post('admin_id'),
				'email' 	=> $this->input->post('upEmail'), 
				'status' 	=> $this->input->post('upStatus'),
				'type' 	=> $this->input->post('upAccType'),
				'edited_on'	=> $today
			);

			$updt_str = '';
		    foreach ($data as $k => $v) {
		        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
		    }

		    $updt_str = substr_replace($updt_str,";", -1);
		    $this->db->query($this->db->insert_string('admin_log', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);

		    $this->session->set_flashdata('upAccount_success','Account was successfully updated!');

		}

		//** end of administrators page **// 

		//for teachers page

		public function addTeacher(){ 

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'email' 	=> $this->input->post('email'),
				'pass_md5'  => md5('password'),
				'pass_txt' 	=> 'password',
				'first'		=> $this->input->post('first'),
				'last'		=> $this->input->post('last'),
				'phone'		=> '000-0000',
				'address'	=> 'Your Address',
				'status'	=> $this->input->post('status'),
				'subjects'	=> 'Your Subjects',
				'homeroom'	=> 'Your Homeroom',
				'des'		=> 'Write your description here',
				'deleted'   => '0',
				'edited_on' => $today
			);

			$result = $this->db->insert('teachers_log', $data);

			return $result;
			//$this->session->set_flashdata('teacherAdded_success','Teacher was successfully added to the system!');
		}

		public function getTeacherByIdAjax(){

			$id = $this->input->post('id');

			$Teacher_info = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('teachers_log',array('id'=>$id)); 

			if($result->num_rows() >= 1){
				$Teacher_info['teacher'] = $result->result_array();
			}

			return $Teacher_info;
		}

		public function updateTeacherEmail(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'id'		=> $this->input->post('teacherDbId'),
				'email' 	=> $this->input->post('upEmail'),
				'status'	=> $this->input->post('upStatus'),
				'deleted'   => '0',
				'edited_on' => $today
			);
			
			$updt_str = '';
		    foreach ($data as $k => $v) {
		        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
		    }

		    $updt_str = substr_replace($updt_str,";", -1);

		    $this->db->query($this->db->insert_string('teachers_log', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
			$this->session->set_flashdata('upTeacher_success','Teacher profile was successfully updated!');

		}

		public function delTeacherByIdAjax(){ 
			
			$id = $this->input->post('id');

			$data = array(
				'deleted' => '1'
			);
				
			$this->db->where('id', $id);
			$deleted = $this->db->update('teachers_log', $data);

			if($deleted){
				$this->session->set_flashdata('delTeacher_success','Teacher profile was successfully deleted!');
			}
			else{
				$this->session->set_flashdata('delStudent_error','Teacher profile could not be deleted! Please contact your system Admin.');
			}			

			return $deleted;

		}

		//** end of teachers page **//

		//for students page

		public function addStudent(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'ss'		=> $this->input->post('ss'),
				'student_id'=> $this->input->post('student_id'),
				'first'		=> $this->input->post('first'),
				'middle'	=> $this->input->post('middle'),
				'last'		=> $this->input->post('last'),
				'cell'		=> $this->input->post('cell'),
				'email' 	=> $this->input->post('email'),
				'address'	=> $this->input->post('address'),
				'gender'	=> $this->input->post('gender'),
				'class_id'	=> $this->input->post('class_id'),
				'father'	=> $this->input->post('father'),
				'mother'	=> $this->input->post('mother'),
				'emergency'	=> $this->input->post('emergency'),
				'pass_md5'  => md5('password'),
				'pass_txt' 	=> 'password',
				'status'	=> $this->input->post('status'),
				'deleted'   => '0',
				'edited_on' => $today
			);

			$this->db->insert('students', $data);
			$this->session->set_flashdata('studentAdded_success','Student was successfully added to the system!');

			return $this->db->insert_id();
		}

		public function getStudentByIdAjax(){

			$id = $this->input->post('id');

			$Student_info = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('students',array('id'=>$id)); 

			if($result->num_rows() >= 1){
				$Student_info['student'] = $result->result_array();
			}

			return $Student_info;
		}

		public function getStudentProfileById($id){

			$stdProfile = array();

			$result = $this->db->get_where('students',array('student_id'=>$id));

			//echo $id;
			
			if($result->num_rows() >= 1){
				$stdProfile['stdProfile'] = $result->result_array();
			}

			return $stdProfile;
		}

		public function updateStudent(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'id'		=> $this->input->post('studentDbId'),
				'ss'		=> $this->input->post('upSS'),
				'student_id'=> $this->input->post('upStudentId'),
				'first'		=> $this->input->post('upFirst'),
				'middle'	=> $this->input->post('upMiddle'),
				'last'		=> $this->input->post('upLast'),
				'cell'		=> $this->input->post('upCell'),
				'email' 	=> $this->input->post('upEmail'),
				'address'	=> $this->input->post('upAddress'),
				'gender'	=> $this->input->post('upGender'),
				'class_id'	=> $this->input->post('upClassId'),
				'father'	=> $this->input->post('upFather'),
				'mother'	=> $this->input->post('upMother'),
				'emergency'	=> $this->input->post('upEmergency'),
				'status'	=> $this->input->post('upStatus'),
				'deleted'   => '0',
				'edited_on' => $today
			);
			
			$updt_str = '';
		    foreach ($data as $k => $v) {
		        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
		    }

		    $updt_str = substr_replace($updt_str,";", -1);

		    $this->db->query($this->db->insert_string('students', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
			$this->session->set_flashdata('upStudent_success','Student profile was successfully updated!');

		}

		public function delStudentByIdAjax(){
			
			$id = $this->input->post('id');

			$data = array(
				'deleted' => '1'
			);
				
			$this->db->where('id', $id);
			$deleted = $this->db->update('students', $data);

			/*if($deleted){
				$this->session->set_flashdata('delStudent_success','Student profile was successfully deleted!');
			}
			else{
				$this->session->set_flashdata('delStudent_error','Student profile could not be deleted! Please contact your system Admin.');
			}*/			

			return $deleted;

		}

		public function updateStudentProPic($student_id, $pic_name, $pic_path,$newfilename){ //

			$data = array(
				'id'		=> $student_id,
				'image' 	=> $newfilename
			);
			
			$updt_str = '';
		    foreach ($data as $k => $v) {
		        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
		    }

		    $updt_str = substr_replace($updt_str,";", -1);

		    $this->db->query($this->db->insert_string('students', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
		}		

		//** end of students page **//

		//for classes page

		public function addClass(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'name'  		=> $this->input->post('class'),
				'department'    => $this->input->post('dept'),
				'level' 		=> $this->input->post('level'),
				'description'   => $this->input->post('des'),
				'deleted'   	=> '0',
				'edited_on' 	=> $today
			);

			$result = $this->db->insert('classes', $data);
			return $result;
			//$this->session->set_flashdata('studentAdded_success','Teacher was successfully added to the system!');
		}

		public function getLevels($lev_type){

			$levels = array();

			if($lev_type != 'none'){

				$result = $this->db->get('account_types');
				$result = $this->db->get_where('schooling',array('id'=>$lev_type));

				if($result->num_rows() >= 1){
					$levels['levels'] = $result->result_array();
				}

				return $levels;

			}
			else{
				return $levels;
			}

		}

		public function getClassByIdAjax(){

			$id = $this->input->post('id');

			$classes = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('classes',array('id'=>$id));

			if($result->num_rows() >= 1){
				$classes['class'] = $result->result_array();
			}

			return $classes;

		}

		public function updateClass(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'id'			=> $this->input->post('classDbId'),
				'name' 			=> $this->input->post('upClassName'),
				'level' 		=> $this->input->post('upLevel'),
				'description' 	=> $this->input->post('upDesc'),
				'deleted'   	=> '0',
				'edited_on' 	=> $today
			);
			
			$updt_str = '';
		    foreach ($data as $k => $v) {
		        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
		    }

		    $updt_str = substr_replace($updt_str,";", -1);

		    $this->db->query($this->db->insert_string('classes', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
			$this->session->set_flashdata('upClass_success','Class profile was successfully updated!');

		}

		public function delClassByIdAjax(){
			
			$id = $this->input->post('id');

			$data = array(
				'deleted' => '1'
			);
				
			$this->db->where('id', $id);
			$deleted = $this->db->update('classes', $data);

			if($deleted){
				$this->session->set_flashdata('delClass_success','Class profile was successfully deleted!');
			}
			else{
				$this->session->set_flashdata('delClass_error','Class profile could not be deleted! Please contact your system Admin.');
			}			

			return $deleted;

		}

		//** end of classes page **// 

		//for courses page

		public function addCourse(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'short'  		=> $this->input->post('short_name'),
				'name' 			=> $this->input->post('course'),
				'type'			=> $this->input->post('type'),
				'description'   => $this->input->post('des'),
				'status'   		=> '1',
				'deleted'   	=> '0',
				'edited_on' 	=> $today
			);

			$result = $this->db->insert('courses', $data);
			return $result;
			//$this->session->set_flashdata('courseAdded_success','Course was successfully added to the system!');
		}

		public function getCourseByIdAjax(){

			$id = $this->input->post('id');

			$courses = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('courses',array('id'=>$id));

			if($result->num_rows() >= 1){
				$courses['course'] = $result->result_array();
			}

			return $courses;

		}

		public function updateCourse(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'id'			=> $this->input->post('courseDbId'),
				'short' 		=> $this->input->post('upShortName'),
				'name' 			=> $this->input->post('upCourseName'),
				'type'			=> $this->input->post('upType'),
				'status' 		=> $this->input->post('upStatus'),
				'description' 	=> $this->input->post('upDesc'),
				'deleted'   	=> '0',
				'edited_on' 	=> $today
			);
			
			$updt_str = '';
		    foreach ($data as $k => $v) {
		        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
		    }

		    $updt_str = substr_replace($updt_str,";", -1);

		    $this->db->query($this->db->insert_string('courses', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
			$this->session->set_flashdata('upCourse_success','Course was successfully updated!');

		}

		public function delCourseByIdAjax(){
			
			$id = $this->input->post('id');

			$data = array(
				'deleted' => '1'
			);
				
			$this->db->where('id', $id);
			$deleted = $this->db->update('courses', $data);

			if($deleted){
				$this->session->set_flashdata('delCourse_success','Course was successfully deleted!');
			}
			else{
				$this->session->set_flashdata('delCourse_error','Course could not be deleted! Please contact your system Admin.');
			}			

			return $deleted;

		}

		//** end of courses page **//

		//for class page {individual class} 

		public function addCourseToClass(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'class_id'  	=> $this->input->post('class'),
				'course_id' 	=> $this->input->post('course'),
				'teacher_id'    => $this->input->post('teacher'),
				'modules'   	=> $this->input->post('module'),
				'status'   		=> '1',
				'deleted'   	=> '0',
				'edited_on' 	=> $today
			);

			$result = $this->db->insert('course_to_class', $data);
			return $result;
			//$this->session->set_flashdata('courseAdded_success','Course was successfully added to class!');
		}

		public function getClassById($id){

			//$id = $this->input->post('id');

			$ind_class = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('classes',array('id'=>$id));

			if($result->num_rows() >= 1){
				$ind_class['ind_class'] = $result->result_array();
			}

			return $ind_class;

		}

		public function getCourse_to_class($id){

			$course_to_class = array();

			$this->db->order_by('id', 'ASC');  
			$result = $this->db->get_where('course_to_class',array('deleted'=>'0','class_id'=>$id));

			if($result->num_rows() >= 1){
				$course_to_class['course_to_class'] = $result->result_array();
			}

			return $course_to_class;
		}

		public function getCourseToClassByIdAjax(){ 

			$id = $this->input->post('id');

			$cTC = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('course_to_class',array('id'=>$id));

			if($result->num_rows() >= 1){
				$cTC['cTC'] = $result->result_array();
			}

			return $cTC;

		}

		public function updateCourseToClass(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'id'			=> $this->input->post('courseToClassDbId'),
				'class_id' 		=> $this->input->post('classId'),
				'course_id' 	=> $this->input->post('upCourseName'),
				'teacher_id' 	=> $this->input->post('upTeacherName'),
				'modules'   	=> $this->input->post('upNumOfModules'),
				'status' 		=> $this->input->post('upStatus'),
				'deleted'   	=> '0',
				'edited_on' 	=> $today  
			);
			
			$updt_str = '';
		    foreach ($data as $k => $v) {
		        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
		    }

		    $updt_str = substr_replace($updt_str,";", -1);

		    $this->db->query($this->db->insert_string('course_to_class', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
			$this->session->set_flashdata('upCourse_to_class_success','Course was successfully updated!');

		}		

		public function delCourseToClassByIdAjax(){ 
			
			$id = $this->input->post('id');

			$data = array(
				'deleted' => '1'
			);
				
			$this->db->where('id', $id);
			$deleted = $this->db->update('course_to_class', $data);

			/*if($deleted){
				$this->session->set_flashdata('delCourseToClass_success','Course was successfully deleted!');
			}
			else{
				$this->session->set_flashdata('delCourseToClass_error','Course could not be deleted! Please contact your system Admin.');
			}*/			

			return $deleted;

		}

		//** end of class page **// 

		//for change password page

		public function getUserPassByIdAjax(){

			$id = $this->input->post('id');
			$current = $this->input->post('current');

			$auth = array();

			$this->db->select('id, pass_md5');
			$this->db->where(array('id'=>$id));
			$result = $this->db->get('admin_log');

			if($result->num_rows() >= 1){
				$auth['auth'] = $result->result_array();
			}

			//print_r($auth);

			if(md5($current) == $auth['auth'][0]['pass_md5']){
				return '1';
			}
			else{
				return '0';
			}

		}

		public function updatePasswordAjax(){ 

			$id = $this->input->post('id');			
			$newPass = $this->input->post('new');				
			
			//update old password with new one.

			$data = array(
				'pass_md5' => md5($newPass),
				'pass_txt' => $newPass
			);			
					
			$this->db->where('id', $id);
			$updated = $this->db->update('admin_log', $data); 

			//echo 'Updated: ' . $updated;

			return $updated;
						
		}

		//** end of change password page **// 
		//for advance student page

		public function toggleAccStatusAjax(){ //
			
			$id 	= $this->input->post('id');
			$status = $this->input->post('status');

			$data = array(
				'status' => $status
			);
				
			$this->db->where('id', $id);
			$updated = $this->db->update('students', $data);		

			return $updated;

		}		

		public function toggleCanLoginAjax(){
			
			$id 	= $this->input->post('id');
			$status = $this->input->post('status');

			$data = array(
				'can_login' => $status
			);
				
			$this->db->where('id', $id);
			$updated = $this->db->update('students', $data);		

			return $updated;

		}	

		public function toggleCanViewGradesAjax(){ //
			
			$id 	= $this->input->post('id');
			$status = $this->input->post('status');

			$data = array(
				'can_view_grades' => $status
			);
				
			$this->db->where('id', $id);
			$updated = $this->db->update('students', $data);		

			return $updated;

		}	

		public function toggleCanViewAttendanceAjax(){ //
			
			$id 	= $this->input->post('id');
			$status = $this->input->post('status');

			$data = array(
				'can_view_attendance' => $status
			);
				
			$this->db->where('id', $id);
			$updated = $this->db->update('students', $data); 		

			return $updated;

		}

		public function getStudentDemeritsById($id){ 

			//$id = $this->input->post('id');

			$demerits = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('demerits',array('student_id'=>$id, 'deleted'=>'0'));

			if($result->num_rows() >= 1){
				$demerits['demerits'] = $result->result_array();
			}

			return $demerits;

		}	

		public function assignHomeRoomAjax(){ 
			
			$id = $this->input->post('id');
			$teacher_id = $this->input->post('teacher_id');

			$data = array(
				'homeroom' => $teacher_id
			);
				
			$this->db->where('id', $id);
			$updated = $this->db->update('classes', $data);			

			return $updated;

		}

		public function addDemeritAjax(){

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'student_id'  => $this->input->post('student_id'),
				'teacher_id'  => $this->input->post('teacher_id'),
				'date'  	  => $this->input->post('date1'),
				'des'		  => $this->input->post('desc'),
				'deleted'     => '0',
				'school_year' => '2019-2020',				
				'edited_on'   => $today
			);

			$result = $this->db->insert('demerits', $data);

			return $result;
		}

		public function addLastTabAjax(){ //

			$data = array(
				'owner_type'  => $this->input->post('owner_type'),
				'owner_id'    => $this->input->post('owner_id'),
				'page'  	  => $this->input->post('page'),
				'name'		  => $this->input->post('name'),
				'value'       => $this->input->post('value')
			);

			$result = $this->db->insert('small_settings', $data);

			return array('result'=>$result, 'db_id'=>$this->db->insert_id());
		}				

		public function updateLastTabAjax(){ 

			$db_id = $this->input->post('db_id');
			$page  = $this->input->post('page');
			$name  = $this->input->post('name');

			$data = array(
				'value' => $this->input->post('value')
			);
				
			$this->db->where(array('id'=>$db_id, 'page'=>$page, 'name'=>$name));
			$updated = $this->db->update('small_settings', $data);			

			return $updated;

		}

		public function getSmallSettings($id){ //

			$small_settings = array();

			$result = $this->db->get_where('small_settings',array('owner_id'=>$id));

			if($result->num_rows() >= 1){
				$small_settings['small_settings'] = $result->result_array();
			}

			return $small_settings;
		}

		public function getDemeritByIdAjax(){ //

			$id = $this->input->post('id');

			$myDemerits = array();

			$result = $this->db->get_where('demerits',array('id'=>$id));   

			if($result->num_rows() >= 1){
				$myDemerits['demerit'] = $result->result_array();
			}

			return $myDemerits;
		}	

		public function updateDemeritRecordAjax(){ //

			$db_id = $this->input->post('id');

			$data = array(
				'teacher_id' => $this->input->post('teacher_id'),
				'date'       => $this->input->post('date2'),
				'des' 		 => $this->input->post('desc')
			);
				
			$this->db->where(array('id'=>$db_id));
			$updated = $this->db->update('demerits', $data);			

			return $updated;
		}

		public function delDemeritByIdAjax(){ //
			
			$id = $this->input->post('id');

			$data = array(
				'deleted' => 1
			);
				
			$this->db->where('id', $id);
			$deleted = $this->db->update('demerits', $data);			

			return $deleted;

		}	

		public function getStudentJugsById($id){

			//$id = $this->input->post('id');

			$jugs = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('jugs',array('student_id'=>$id, 'deleted'=>'0'));

			if($result->num_rows() >= 1){
				$jugs['jugs'] = $result->result_array();
			}

			return $jugs;

		}

		public function addJugAjax(){ //

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'student_id'  => $this->input->post('student_id'),
				'date'  	  => $this->input->post('date3'),
				'status'  	  => '0',
				'des'		  => $this->input->post('desc'),
				'deleted'     => '0',
				'school_year' => '2019-2020',				
				'edited_on'   => $today
			);

			$result = $this->db->insert('jugs', $data);

			return $result;
		}

		public function getJugByIdAjax(){ //

			$id = $this->input->post('id');

			$myJugs = array();

			$result = $this->db->get_where('jugs',array('id'=>$id));   

			if($result->num_rows() >= 1){
				$myJugs['jug'] = $result->result_array();
			}

			return $myJugs;
		}

		public function updateJugRecordAjax(){ //

			$db_id = $this->input->post('id');

			$data = array(
				'status' 	 => $this->input->post('status'),
				'date'       => $this->input->post('date4'),
				'des' 		 => $this->input->post('desc')
			);
				
			$this->db->where(array('id'=>$db_id));
			$updated = $this->db->update('jugs', $data);			

			return $updated;
		}

		public function delJugByIdAjax(){ //
			
			$id = $this->input->post('id');

			$data = array(
				'deleted' => 1
			);
				
			$this->db->where('id', $id);
			$deleted = $this->db->update('jugs', $data);			

			return $deleted;

		}

		public function getStudentSuspensionsById($id){ //

			//$id = $this->input->post('id');

			$suspensions = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('suspensions',array('student_id'=>$id, 'deleted'=>'0'));

			if($result->num_rows() >= 1){
				$suspensions['suspensions'] = $result->result_array();
			}

			return $suspensions;

		}

		public function addSuspensionAjax(){ //

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'student_id'  => $this->input->post('student_id'),
				'start'  	  => $this->input->post('from'),
				'end'  	 	  => $this->input->post('to'),
				'des'		  => $this->input->post('desc'),
				'deleted'     => '0',
				'school_year' => '2019-2020',				
				'edited_on'   => $today
			);

			$result = $this->db->insert('suspensions', $data);

			return $result;
		}

		public function getSuspensionByIdAjax(){ //

			$id = $this->input->post('id');

			$mySuspensions = array();

			$result = $this->db->get_where('suspensions',array('id'=>$id));   

			if($result->num_rows() >= 1){
				$mySuspensions['suspension'] = $result->result_array();
			}

			return $mySuspensions;
		}

		public function updateSuspensionRecordAjax(){ //

			$db_id = $this->input->post('id');

			$data = array(
				'start' 	 => $this->input->post('from'),
				'end'        => $this->input->post('to'),
				'des' 		 => $this->input->post('desc')
			);
				
			$this->db->where(array('id'=>$db_id));
			$updated = $this->db->update('suspensions', $data);			

			return $updated;
		}

		public function delSuspensionByIdAjax(){ //
			
			$id = $this->input->post('id');

			$data = array(
				'deleted' => 1
			);
				
			$this->db->where('id', $id);
			$deleted = $this->db->update('suspensions', $data);			

			return $deleted;

		}

		public function getStudentExpulsionsById($id){ //

			//$id = $this->input->post('id');

			$expulsions = array();

			//$result = $this->db->get_where('students',array('id'=>$id));
			$result = $this->db->get_where('expulsions',array('student_id'=>$id, 'deleted'=>'0'));

			if($result->num_rows() >= 1){
				$expulsions['expulsions'] = $result->result_array();
			}

			return $expulsions;

		}

		public function addExpulsionAjax(){ //

			$timezone = new \DateTimeZone('America/Belize');
	        $date = new \DateTime('@' . time(), $timezone);
	        $date->setTimezone($timezone);
	        $today = $date->format('Y-m-d H:i:s');

			$data = array(
				'student_id'  => $this->input->post('student_id'),
				'date'  	  => $this->input->post('date'),
				'des'		  => $this->input->post('desc'),
				'deleted'     => '0',
				'school_year' => '2019-2020',				
				'edited_on'   => $today
			);

			$result = $this->db->insert('expulsions', $data);

			return $result;
		}

		public function getExpulsionByIdAjax(){ //

			$id = $this->input->post('id');

			$myExpulsions = array();

			$result = $this->db->get_where('expulsions',array('id'=>$id));   

			if($result->num_rows() >= 1){
				$myExpulsions['expulsion'] = $result->result_array();
			}

			return $myExpulsions;
		}

		public function getAllStdsByClassIdAjax(){ //

			$class_id = $this->input->post('class_id');

			$allStudents = array();

			$this->db->select('id, ss, student_id, first, middle, last');
			$this->db->where(array('class_id'=>$class_id, 'deleted'=>'0'));
			$result = $this->db->get('students'); 

			if($result->num_rows() >= 1){
				$allStudents['allStudents'] = $result->result_array();
			}

			return $allStudents;
		}		

		public function getAllCoursesByClassIdAjax(){  /////working here.....

			$class_id = $this->input->post('class_id');

			$allCourses = array();

			$this->db->select('cTc.id, cTc.class_id, cTc.course_id, cTc.teacher_id, cTc.modules, cr.short, cr.name');
			$this->db->from('course_to_class as cTc');
			$this->db->join('courses as cr', 'cr.id=cTc.course_id', 'left');
			$this->db->where('cTc.class_id', $class_id);
			//$this->db->where('gr.student_id', $student_id);	
			$result = $this->db->get();				

			//$this->db->select('id, class_id, course_id, teacher_id, department, modules');
			//$this->db->where(array('class_id'=>$class_id, 'deleted'=>'0'));
			//$result = $this->db->get('course_to_class'); 

			if($result->num_rows() >= 1){
				$allCourses['allCourses'] = $result->result_array();
			}

			return $allCourses;
		}

		public function updateExpulsionRecordAjax(){ //

			$db_id = $this->input->post('id');

			$data = array(
				'date'       => $this->input->post('date'),
				'des' 		 => $this->input->post('desc')
			);
				
			$this->db->where(array('id'=>$db_id));
			$updated = $this->db->update('expulsions', $data);			

			return $updated;
		}

		public function delExpulsionByIdAjax(){ //
			
			$id = $this->input->post('id');

			$data = array(
				'deleted' => 1
			);
				
			$this->db->where('id', $id);
			$deleted = $this->db->update('expulsions', $data);			

			return $deleted;

		}

		public function getmyCoursesByClassId($class_id){

			$courseList = array();

			$this->db->select('id, class_id, course_id, teacher_id, modules');
			$this->db->where(array('class_id'=>$class_id, 'deleted'=>'0'));
			$result = $this->db->get('course_to_class');				

			if($result->num_rows() >= 1){
				$courseList['courseList'] = $result->result_array();
			}

			return $courseList;

		}

		public function getAttendanceByStudentId($student_id, $class_id, $course_id){ 

			$attendance = array();

			$this->db->select('id, class_id, course_id, student_id, date, attendance, remarks');
			$this->db->where(array('student_id'=>$student_id, 'class_id'=>$class_id, 'course_id'=>$course_id, 'school_year'=>'2018-2019'));
			$this->db->order_by('date', 'ASC');
			$result = $this->db->get('attendance');				

			if($result->num_rows() >= 1){
				$attendance[$course_id] = $result->result_array();
			}

			return $attendance;		

		}	

		public function getAllCourses(){ 

			$allCourses = array();

			$this->db->select('id, short, name');
			$this->db->where(array('deleted'=>'0'));
			$result = $this->db->get('courses');				

			if($result->num_rows() >= 1){
				$allCourses['allCourses'] = $result->result_array();
			}

			return $allCourses;

		}

		public function getAllClassesAjax(){ //

			$allClasses = array();

			$this->db->select('id, name, department, level, homeroom');
			$this->db->where(array('deleted'=>'0'));
			$result = $this->db->get('classes');				

			if($result->num_rows() >= 1){
				$allClasses['allClasses'] = $result->result_array();
			}

			return $allClasses;

		}		

		public function getGradesByStudentId($student_id, $class_id, $course_id){ //

			$grade = array();

			$this->db->select('id, module, mark, school_year');
			$this->db->where(array('student_id'=>$student_id, 'class_id'=>$class_id, 'course_id'=>$course_id, 'school_year'=>'2018-2019'));
			$this->db->order_by('module', 'ASC');
			$result = $this->db->get('grades');				

			if($result->num_rows() >= 1){
				$grade[$course_id] = $result->result_array();
			}

			return $grade;		

		}

			public function getStdCoursesNGrades($class_id,$student_id){ ///working here...

				$courseListNGrades = array();

				/*$this->db->select('id, class_id, course_id, teacher_id, modules');
				$this->db->where(array('class_id'=>$class_id, 'deleted'=>'0'));
				$result = $this->db->get('course_to_class');*/	
				
				$this->db->select('cTc.id, cTc.class_id, cTc.course_id, cTc.teacher_id, cTc.modules, gr.mark');
				$this->db->from('course_to_class as cTc');
				$this->db->join('grades as gr', 'gr.class_id=cTc.class_id and gr.course_id=cTc.course_id', 'left');
				$this->db->where('cTc.class_id', $class_id);
				$this->db->where('gr.student_id', $student_id);	
				$result = $this->db->get();			

				if($result->num_rows() >= 1){
					$courseListNGrades['courseListNGrade'] = $result->result_array();
				}

				return $courseListNGrades;

			}		

		/*public function getClassById($id){ 

			$myClass = array();

			$result = $this->db->get_where('classes',array('id'=>$id));
				
			if($result->num_rows() >= 1){
				$myClass['myClass'] = $result->result_array();
			}

			return $myClass;
		}*/																																																										

		//** end of advanced student page **// 				

		//////////////////////////////////////////////////////////////////////// 
		///////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////


		public function getDeliveryItemsByInvoiceIdAjax(){

			$invoice_id = $this->input->post('invoice_id');

			//echo $status;

			$items = array();

			//$result = $this->db->get_where('remote_delivery_items',array('invoice_id'=>$invoice_id));

			$this->db->select('restaurant_data.name,restaurant_data.cell_phone,restaurant_data.message_no,menu.cat_name,menu.plate_name,menu.price,remote_delivery_items.quantity,remote_delivery_items.description,remote_delivery_items.invoice_id'); //invoice no. username, foodname, qty, total, date, time
			$this->db->from('remote_delivery_items');
			$this->db->join('restaurant_data','remote_delivery_items.restaurant_id = restaurant_data.id');
			$this->db->join('menu','remote_delivery_items.foodId = menu.id');
			$this->db->where(array('remote_delivery_items.invoice_id'=>$invoice_id));

			//Restaurant	Category	Food Name	Qty	Price	Special Inst.

			$result = $this->db->get();

			if($result->num_rows() >= 1){
				$items['items'] = $result->result_array();
			}

			return $items;
		}

		public function orderItemsAjax(){

			$orders = array();
			$invoice_id = $this->input->post('invoice_id');

			$this->db->select('remote_delivery_items.id,restaurant_data.name,menu.cat_name,menu.plate_name,menu.price,remote_delivery_items.quantity,remote_delivery_items.total,remote_delivery_items.description'); //invoice no. username, foodname, qty, total, date, time
			$this->db->from('remote_delivery_items');
			$this->db->join('restaurant_data','remote_delivery_items.restaurant_id = restaurant_data.id');
			$this->db->join('menu','remote_delivery_items.foodId = menu.id');
			$this->db->where(array('remote_delivery_items.invoice_id'=>$invoice_id));

			$result = $this->db->get();

			if($result->num_rows() >= 1){
				$orders['order'] = $result->result_array();
			}

			return $orders;

		}

		public function sendMessageOneSignal(){

			$player_id = $this->input->post('player_id');
			$msg = $this->input->post('msgBody');
			$username = $this->input->post('username');

			$ids = array($player_id);

			$app_id		= '9bd8af51-a07d-44b2-87dc-99bcdaa234f0';
			$auth 		= 'ZTNiMGE4MzktZDM0Zi00YzlhLTg3YTktZDMzNDhiY2Q4NGU0';
			$title 		= 'Hey ' .$username. ',';
			//$body 		= 'There\'s a delivery. Tap here to check order details!';

			$content = array(
				"en" => $msg
			);
			$heading = array(
				"en" => $title 
			);
				
			$fields = array(
				'app_id' => $app_id,
				//'include_player_ids' => array("6392d91a-b206-4b7b-a620-cd68e32c3a76","76ece62b-bcfe-468c-8a78-839aeaa8c5fa","8e0f21fa-9a5a-4ae7-a9a6-ca1f24294b86"),
				'include_player_ids' => $ids,
				//'data' => array($title => $body),
				'contents' => $content,
				'headings' => $heading
			);
				
			$fields = json_encode($fields);
				
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic '.$auth));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			curl_close($ch);

			return $response;
		}

		//** end of incomming orders list page **// 

		/*	
		**
		** Api controller functions for the app
		**
		*/

		public function checkApiKeyValidity($apiKey){

			$valid = 0;
			$result = $this->db->get_where('api_users',array('api_key'=>$apiKey));

			if($result->num_rows() >= 1){
				$valid = 1;
			}

			return $valid;	

		}

		/*	
		**
		** Graphs for the dashboard
		**
		*/

		  public function allOrdersListAjax(){

			//$start = $this->input->get('start');
			//$end = $this->input->get('end');
			//$location = $this->input->get('location');

			$allOrders = array();
			$counter = 0;

			$SQL = "SELECT DISTINCT(`dateToday`) as today, COUNT(`dateToday`) as count FROM `remote_delivery_details` GROUP BY `dateToday` HAVING count > 0";
			$result = $this->db->query($SQL);

			if($result->num_rows() >= 1){

				while($counter<$result->num_rows()){
					if(!empty($result->row($counter)->today)){

						$date = $result->row($counter)->today;	

						if(!empty($date)){
				
							$formattedDate = DateTime::createFromFormat('m-d-y',$date);
							$newDate = $formattedDate->format('Y-m-d');
				
							$row = array('date'=>$newDate,'value'=>$result->row($counter)->count);
				
							array_push($allOrders,$row);
						}

					}
					$counter++;
				}				
			}

			return $allOrders;			

		  }

		  public function mostOrdersListAjax(){

			$colors = array('#3498DB','#E67E22','#9B59B6','#CCD1D1','#ABEBC6','#E74C3C','#1D8348','#196F3D','#1ABC9C','#76448A','#212F3C','#A04000','#16A085','#7DCEA0','#F5CBA7','#5499C7','#48C9B0','#FAD7A0','#E74C3C','#45B39D','#7DCEA0','#21618C','#B9770E','#616A6B','#A569BD','#F0B27A','#AEB6BF','#0E6655','#A04000','#979A9A','#1ABC9C','#F5CBA7','#D98880','#154360','#3498DB','#E67E22','#9B59B6','#CCD1D1','#ABEBC6','#E74C3C','#1D8348','#196F3D','#1ABC9C','#76448A','#212F3C','#A04000','#16A085','#7DCEA0','#F5CBA7','#5499C7','#48C9B0','#FAD7A0','#E74C3C','#45B39D','#7DCEA0','#21618C','#B9770E','#616A6B','#A569BD','#F0B27A','#AEB6BF','#0E6655','#A04000','#979A9A','#1ABC9C','#F5CBA7','#D98880','#154360');

			$start = $this->input->get('start');
			$end = $this->input->get('end');
			//$location = $this->input->get('location');
			$location = 'Orange Walk';

			$mostOrders = array();
			$counter = 0;

			$SQL = "SELECT `restaurant_data`.`id`, `restaurant_data`.`name` FROM `restaurant_data` WHERE location='".$location."'";
			$result = $this->db->query($SQL);

			if($result->num_rows() >= 1){

				while($counter<$result->num_rows()){

					$rest_id = $result->row($counter)->id;

					if($start != 'All'){
						//$sql = "SELECT COUNT(*) AS total FROM `remote_delivery_items` `rd` LEFT JOIN `remote_delivery_details` `rdd` ON `rd`.`invoice_id` = `rdd`.`invoice_id` WHERE `rdd`.`dateToday`>='".$start."' AND `rdd`.`dateToday`<='".$end."' AND restaurant_id='".$rest_id."'";
						//$sql = "SELECT `rdi`.`invoice_id`,`rdd`.`dateToday` FROM `remote_delivery_items` `rdi` LEFT JOIN `remote_delivery_details` `rdd` ON `rdi`.`invoice_id`=`rdd`.`invoice_id` WHERE `rdi`.`restaurant_id`='" .$rest_id. "'";
						$this->db->select('COUNT(*) AS total', 'remote_delivery_details.dateToday'); //invoice no. username, foodname, qty, total, date, time
						$this->db->from('remote_delivery_items');
						$this->db->join('remote_delivery_details','remote_delivery_items.invoice_id = remote_delivery_details.invoice_id');
						$this->db->where(array('remote_delivery_items.restaurant_id'=>$rest_id));
					}
					else{
						//$sql = "SELECT COUNT(*) AS total FROM `remote_delivery_items` WHERE restaurant_id='".$rest_id."'";
						$this->db->select('COUNT(*) AS total', 'remote_delivery_details.dateToday'); //invoice no. username, foodname, qty, total, date, time
						$this->db->from('remote_delivery_items');
						$this->db->join('remote_delivery_details','remote_delivery_items.invoice_id = remote_delivery_details.invoice_id');
						$this->db->where(array('remote_delivery_items.restaurant_id'=>$rest_id));
					}

					//echo 'This is the query: '.$sql . '<br/>';

					//$result2 = $this->db->query($sql);
					$result2 = $this->db->get();

					if($result2->num_rows() >= 1){

						$rowCount = $result2->row(0)->total;
						$restName = $result->row($counter)->name;

						$shortName = mb_strimwidth($restName, 0, 9, '...');

						if($rowCount > 0){
		
							$row = array('country'=>$shortName,'visits'=>$rowCount,'color'=>$colors[$counter],'completeName'=>$restName);
							array_push($mostOrders,$row);
						}

					}
					
					$counter++;
				}				
			}

			return $mostOrders;			

		  }

		  public function mostCashListAjax(){

			$colors = array('#3498DB','#E67E22','#9B59B6','#CCD1D1','#ABEBC6','#E74C3C','#1D8348','#196F3D','#1ABC9C','#76448A','#212F3C','#A04000','#16A085','#7DCEA0','#F5CBA7','#5499C7','#48C9B0','#FAD7A0','#E74C3C','#45B39D','#7DCEA0','#21618C','#B9770E','#616A6B','#A569BD','#F0B27A','#AEB6BF','#0E6655','#A04000','#979A9A','#1ABC9C','#F5CBA7','#D98880','#154360','#3498DB','#E67E22','#9B59B6','#CCD1D1','#ABEBC6','#E74C3C','#1D8348','#196F3D','#1ABC9C','#76448A','#212F3C','#A04000','#16A085','#7DCEA0','#F5CBA7','#5499C7','#48C9B0','#FAD7A0','#E74C3C','#45B39D','#7DCEA0','#21618C','#B9770E','#616A6B','#A569BD','#F0B27A','#AEB6BF','#0E6655','#A04000','#979A9A','#1ABC9C','#F5CBA7','#D98880','#154360');

			$start = $this->input->get('start');
			$end = $this->input->get('end');
			//$location = $this->input->get('location');
			$location = 'Orange Walk';

			$mostCash = array();			
			$counter = 0;

			$sql = "SELECT `id`, `name` FROM `restaurant_data` WHERE location='".$location."'";
			$res = $this->db->query($sql);

			while($counter < $res->num_rows()){

				$rest_id = $res->row($counter)->id;

				//$SQL = "SELECT SUM(total) AS total,`rdd`.`dateToday` FROM `remote_delivery_items` `rdi` LEFT JOIN `remote_delivery_details` `rdd` ON `rdi`.`invoice_id`=`rdd`.`invoice_id` WHERE `rdi`.`restaurant_id`='" .$rest_id. "'";
				$this->db->select('SUM(total) AS total', 'remote_delivery_details.dateToday'); //invoice no. username, foodname, qty, total, date, time
				$this->db->from('remote_delivery_items');
				$this->db->join('remote_delivery_details','remote_delivery_items.invoice_id = remote_delivery_details.invoice_id');
				$this->db->where(array('remote_delivery_items.restaurant_id'=>$rest_id));
	
				$result = $this->db->get();

				//$result = $this->db->query($SQL);

				if($result->num_rows() >= 1){
					$rowsCount = $result->row(0)->total;
					$restName = $res->row($counter)->name;
					//$date = $result->row($counter)->dateToday;

					$decimal = number_format((float)$rowsCount, 1, '.', '');				
					$shortName = mb_strimwidth($restName, 0, 9, '...');
			
					if($rowsCount > 0){
			
						$row = array('country'=>$shortName,'visits'=>$decimal,'color'=>$colors[$counter],'completeName'=>$restName);			
						array_push($mostCash,$row);
					}
				}

				$counter++;
			}

			return $mostCash;
		  }

		//** end Graphs for the dashboard **// 

	}

?>