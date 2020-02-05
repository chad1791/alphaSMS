<?php

    class User_model extends CI_Model {

		public function __construct(){
			$this->load->database();
    }
        
		// for register page

		public function register(){

			$data = array(
				'email' 	=> $this->input->post('email'),
				'password'  => $this->input->post('password'),
				'status'	=> 'inactive' 
			);

			return $this->db->insert('users_data', $data);
    }
        
    public function login($email,$password){

			$this->db->where('email',$email);
			$this->db->where('pass_md5',md5($password)); 

			$result = $this->db->get('teachers_log');
			
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

		public function forgot_password(){ 
			$data = array(
				'email' => $this->input->post('email'),
			);

			return $this->db->insert('forgot_password', $data);
		}
		
		/**
		 * Dashboard page functions
		 */

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

			public function getCoursesByClassIdAjax(){ 

				$class_id 	= $this->input->post('class_id');
				$teacher_id = $this->input->post('teacher_id');

				$coursesByClassId = array();

				//$result = $this->db->get_where('students',array('id'=>$id));
				$this->db->order_by('id', 'ASC');  
				//$this->db->like('share_group', $group);
				$result = $this->db->get_where('course_to_class',array('class_id'=>$class_id,'teacher_id'=>$teacher_id));

				if($result->num_rows() >= 1){
					$coursesByClassId['coursesByClassId'] = $result->result_array();
				}

				return $coursesByClassId;

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

			public function updateGradeAjax(){  

				$timezone = new \DateTimeZone('America/Belize');
		        $date = new \DateTime('@' . time(), $timezone);
		        $date->setTimezone($timezone);
		        $today = $date->format('Y-m-d H:i:s');

				$data = array(
					'id'		=> $this->input->post('id'),
					'mark' 		=> $this->input->post('mark'), 
					'edited_on'	=> $today
				);
				
				$updt_str = '';
			    foreach ($data as $k => $v) {
			        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
			    }

			    $updt_str = substr_replace($updt_str,";", -1);

			    $this->db->query($this->db->insert_string('grades', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
			}

			public function updateAttendanceAjax(){

				$timezone = new \DateTimeZone('America/Belize');
		        $date = new \DateTime('@' . time(), $timezone);
		        $date->setTimezone($timezone);
		        $today = $date->format('Y-m-d H:i:s');

				$data = array(
					'id'			=> $this->input->post('id'),
					'attendance' 	=> $this->input->post('attendance'), 
					'remarks' 		=> $this->input->post('remarks'),
					'edited_on'		=> $today
				);
				
				$updt_str = '';
			    foreach ($data as $k => $v) {
			        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
			    }

			    $updt_str = substr_replace($updt_str,";", -1);

			    $this->db->query($this->db->insert_string('attendance', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
			}

			public function updateRemarksAjax(){

				$timezone = new \DateTimeZone('America/Belize');
		        $date = new \DateTime('@' . time(), $timezone);
		        $date->setTimezone($timezone);
		        $today = $date->format('Y-m-d H:i:s');

				$data = array(
					'id'			=> $this->input->post('id'),
					'remarks' 		=> $this->input->post('remarks'),
					'edited_on'		=> $today
				);
				
				$updt_str = '';
			    foreach ($data as $k => $v) {
			        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
			    }

			    $updt_str = substr_replace($updt_str,";", -1);

			    $this->db->query($this->db->insert_string('attendance', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
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

			public function delFileByIdAjax(){ //
				
				$id = $this->input->post('id');

				/*$data = array(
					'deleted' => '1'
				);*/
					
				$this->db->where('id', $id);
				$deleted = $this->db->delete('ass_files');		

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

			public function delAssignmentById(){
				
				$id = $this->input->post('id');

				$data = array(
					'deleted' => '1'
				);
					
				$this->db->where('id', $id);
				$deleted = $this->db->update('assignments', $data);		

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

			public function getMyEventByIdAjax(){ //

				$id = $this->input->post('id');

				$myEvents = array();

				//$result = $this->db->get_where('students',array('id'=>$id));
				$result = $this->db->get_where('my_events',array('id'=>$id,'deleted'=>'0')); 

				if($result->num_rows() >= 1){
					$myEvents['event'] = $result->result_array();
				}

				return $myEvents;

			}

			public function getAssignmentByIdAjax(){

				$id = $this->input->post('id');

				$singleAssignment = array();

				//$result = $this->db->get_where('students',array('id'=>$id));
				$result = $this->db->get_where('assignments',array('id'=>$id,'deleted'=>'0')); 

				if($result->num_rows() >= 1){
					$singleAssignment['assignment'] = $result->result_array();
				}

				return $singleAssignment;

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

			public function addAssignmentAjax(){ //

				$timezone = new \DateTimeZone('America/Belize');
		        $date = new \DateTime('@' . time(), $timezone);
		        $date->setTimezone($timezone);
		        $today = $date->format('Y-m-d H:i:s');

				$data = array(
					'teacher_id' 	=> $this->input->post('teacher_id'),
					'class_id'		=> $this->input->post('class_id'),
					'course_id' 	=> $this->input->post('course_id'),
					'title'			=> $this->input->post('title'),
					'des'			=> $this->input->post('des'),
					'expiry_date'	=> $this->input->post('expiry_date'),
					'time'			=> $this->input->post('time'),
					'allow_upload'	=> $this->input->post('allow_upload'),
					'ex_disable'	=> $this->input->post('ex_disable'),
					'attachments'	=> $this->input->post('attachments'),
					'status'		=> '1',
					'deleted'		=> '0',
					'edited_on'   	=> $today
				);

				$this->db->insert('assignments', $data);
				//$this->session->set_flashdata('AssignmentAdded_success','Assignment was successfully added to the system!');
				return $this->db->insert_id();
			}

			public function updateAssignmentAjax(){ 

				$timezone = new \DateTimeZone('America/Belize');
		        $date = new \DateTime('@' . time(), $timezone);
		        $date->setTimezone($timezone);
		        $today = $date->format('Y-m-d H:i:s');

				$data = array(
					'id' 			=> $this->input->post('ass_id'),
					'teacher_id' 	=> $this->input->post('teacher_id'),
					'class_id'		=> $this->input->post('class_id'),
					'course_id' 	=> $this->input->post('course_id'),
					'title'			=> $this->input->post('title'),
					'des'			=> $this->input->post('des'),
					'expiry_date'	=> $this->input->post('expiry_date'),
					'time'			=> $this->input->post('time'),
					'allow_upload'	=> $this->input->post('allow_upload'),
					'ex_disable'	=> $this->input->post('ex_disable'),
					'status'		=> '1',
					'deleted'		=> '0',
					'edited_on'   	=> $today
				);

				$updt_str = '';
			    foreach ($data as $k => $v) {
			        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
			    }

			    $updt_str = substr_replace($updt_str,";", -1);

			    $result = $this->db->query($this->db->insert_string('assignments', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
			    return $result;
			
			}			

			public function addAssFileRecord($ass_id, $name, $path, $new_pic_name){ 

				$timezone = new \DateTimeZone('America/Belize');
		        $date = new \DateTime('@' . time(), $timezone);
		        $date->setTimezone($timezone);
		        $today = $date->format('Y-m-d H:i:s');

				$data = array(
					'assignment_id' => $ass_id,
					'new_name'		=> $new_pic_name,
					'name'			=> $name,
					'path' 			=> $path,
					'edited_on'   	=> $today
				);

				$this->db->insert('ass_files', $data);

				return $this->db->insert_id();
			}

		//for assignmentss page

		public function getUploadedFilesByAssIdAjax(){ //

			$id = $this->input->post('id');

			$upFiles = array();

			$this->db->select('id, name, new_name');
			$this->db->where(array('assignment_id'=>$id));
			$result = $this->db->get('ass_files');

			if($result->num_rows() >= 1){
				$upFiles['files'] = $result->result_array();
			}

			//print_r($auth);

			return $upFiles;

		}

		public function getStudentsAssUploadsAjax(){

			$id = $this->input->post('id');
			$stdAssUploads = array();

			$this->db->order_by('id', 'ASC');  
			$result = $this->db->get_where('ass_student_files',array('assignment_id'=>$id));

			if($result->num_rows() >= 1){
				$stdAssUploads['stdAssUploads'] = $result->result_array();
			}

			return $stdAssUploads;
		}	

		//** end of assignments page **//			

			public function addGradeAjax(){ //

				$data = array(
					'course_id'		=> $this->input->post('course_id'),
					'class_id'		=> $this->input->post('class_id'),
					'student_id' 	=> $this->input->post('student_id'),
					'module'		=> $this->input->post('module'),
					'mark'			=> $this->input->post('mark'),
					'school_year'	=> $this->input->post('year'),
				);

				$this->db->insert('grades', $data);

				return $this->db->insert_id();
				//$this->session->set_flashdata('adminAdded_success','Administrator was successfully added to the system!');
			}	

			public function addAttendanceAjax(){

				$data = array(
					'class_id'		=> $this->input->post('class_id'),
					'course_id'		=> $this->input->post('course_id'),		
					'student_id' 	=> $this->input->post('student_id'),
					'date'			=> $this->input->post('date'),
					'attendance'	=> $this->input->post('attendance'),
					'remarks'		=> '',
					'school_year'	=> $this->input->post('year'),
				);

				$this->db->insert('attendance', $data);

				return $this->db->insert_id();
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

			public function getMyAddedAssignments($teacher_id){

				$myAddedAssignments = array();

				$this->db->order_by('id', 'DESC');  
				$result = $this->db->get_where('assignments',array('teacher_id'=>$teacher_id, 'deleted'=>'0'));

				if($result->num_rows() >= 1){
					$myAddedAssignments['myAddedAssignments'] = $result->result_array();
				}

				return $myAddedAssignments;
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

			public function getstudentsByClassId($class_id){

				$studentsByClassId = array();

				$this->db->order_by('id', 'ASC');  
				$result = $this->db->get_where('students',array('class_id'=>$class_id,'deleted'=>'0'));

				if($result->num_rows() >= 1){
					$studentsByClassId['studentsByClassId'] = $result->result_array();
				}

				return $studentsByClassId;
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

			public function getClasses($id){

				$classes = array();

				$this->db->distinct();

				$this->db->select('class_id');

				//$this->db->where(array()); 

				$result = $this->db->get_where('course_to_class',array('teacher_id'=>$id,'deleted'=>'0'));

				if($result->num_rows() >= 1){
					$classes['classes'] = $result->result_array();
				}

				return $classes;
			}

			public function getClassNameById($id){ 

				$classNameById = array();

				$this->db->distinct();

				$this->db->select('name,level');

				//$this->db->where(array()); 

				$result = $this->db->get_where('classes',array('id'=>$id,'deleted'=>'0'));

				if($result->num_rows() >= 1){
					$classNameById['classNameById'] = $result->result_array();
				}

				return $classNameById;
			}

			public function getCourseNameById($id){

				$courseNameById = array();

				$this->db->distinct();

				$this->db->select('short,name');

				//$this->db->where(array()); 

				$result = $this->db->get_where('courses',array('id'=>$id,'deleted'=>'0'));

				if($result->num_rows() >= 1){
					$courseNameById['courseNameById'] = $result->result_array();
				}

				return $courseNameById;
			}

			public function getCourseNameByIdAjax(){

				$id = $this->input->post('course_id');

				$courseDetails = array();
				$this->db->select('short,name');

				$result = $this->db->get_where('courses',array('id'=>$id,'deleted'=>'0'));

				if($result->num_rows() >= 1){
					$courseDetails['courseDetails'] = $result->result_array();
				}

				return $courseDetails;
			}

			public function getmarksCourseAndClass($course_id, $class_id){ 

				$marksCourseAndClass = array();

				//$this->db->order_by('id', 'ASC');
				$this->db->order_by("student_id ASC, module ASC");  
				$result = $this->db->get_where('grades',array('class_id'=>$class_id,'course_id'=>$course_id));

				if($result->num_rows() >= 1){
					$marksCourseAndClass['marksCourseAndClass'] = $result->result_array();
				}

				return $marksCourseAndClass;
			}

			public function getAttendanceCourseAndClass($course_id, $class_id,$today){

				$attendanceCourseAndClass = array();

				//$this->db->order_by('id', 'ASC');
				$this->db->order_by("student_id ASC");  
				$result = $this->db->get_where('attendance',array('class_id'=>$class_id,'course_id'=>$course_id,'date'=>$today));

				if($result->num_rows() >= 1){
					$attendanceCourseAndClass['attendanceCourseAndClass'] = $result->result_array();
				}

				return $attendanceCourseAndClass;
			}

			public function getMyClassesList($id){ 

				$myClassesList = array();

				$this->db->distinct();

				$this->db->select('*');

				//$this->db->where(array()); 

				$result = $this->db->get_where('course_to_class',array('teacher_id'=>$id,'deleted'=>'0'));

				if($result->num_rows() >= 1){
					$myClassesList['myClassesList'] = $result->result_array();
				}

				return $myClassesList;
			}

			public function getMyClassesListSingle($id){ 

				$myClassesListSingle = array();

				$this->db->select('DISTINCT(class_id)');
				$result = $query = $this->db->get_where('course_to_class',array('teacher_id'=>$id,'deleted'=>'0'));

				if($result->num_rows() >= 1){
					$myClassesListSingle['myClassesListSingle'] = $result->result_array();
				}

				return $myClassesListSingle;
			}

			public function getclassList(){

				$classList = array();

				$this->db->order_by('id', 'ASC');  
				$result = $this->db->get_where('classes',array('deleted'=>'0'));

				if($result->num_rows() >= 1){
					$classList['classList'] = $result->result_array();
				}

				return $classList;
			}

			public function getCourses($id){ 

				$courses = array();

				$this->db->order_by('id', 'ASC');  
				$result = $this->db->get_where('course_to_class',array('teacher_id'=>$id,'deleted'=>'0'));

				if($result->num_rows() >= 1){
					$courses['courses'] = $result->result_array();
				}

				return $courses;
			}

			public function getCourseToClassById($id){ 

				$courseToClassById = array();

				$this->db->order_by('id', 'ASC');  
				$result = $this->db->get_where('course_to_class',array('id'=>$id,'deleted'=>'0'));

				if($result->num_rows() >= 1){
					$courseToClassById['courseToClassById'] = $result->result_array();
				}

				return $courseToClassById;
			}

			public function getCourseList(){ 

				$courseList = array();

				$this->db->order_by('id', 'ASC');  
				$result = $this->db->get_where('courses',array('deleted'=>'0'));

				if($result->num_rows() >= 1){
					$courseList['courseList'] = $result->result_array();
				}

				return $courseList;
			}

			public function getProfile($id){

				$profile = array();

				$result = $this->db->get_where('teachers_log',array('id'=>$id));
				
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

			public function updateProfilePic($student_id, $newfilename){ 

				$data = array(
					'id'		=> $student_id,
					'image' 	=> $newfilename
				);
				
				$updt_str = '';
			    foreach ($data as $k => $v) {
			        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
			    }

			    $updt_str = substr_replace($updt_str,";", -1);

			    $this->db->query($this->db->insert_string('teachers_log', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
			}

			public function updateProfile(){ 

				$timezone = new \DateTimeZone('America/Belize');
		        $date = new \DateTime('@' . time(), $timezone);
		        $date->setTimezone($timezone);
		        $today = $date->format('Y-m-d H:i:s');

				$data = array(
					'id'		=> $this->input->post('teacher_id'),
					'first'		=> $this->input->post('first'),
					'middle'	=> $this->input->post('middle'),
					'last'		=> $this->input->post('last'),
					'email'		=> $this->input->post('email'),
					'phone'		=> $this->input->post('cell'),
					'address'	=> $this->input->post('address'),
					'subjects'	=> $this->input->post('post'),
					'education'	=> $this->input->post('education'),
					'des'		=> $this->input->post('des'),
					'edited_on'   	=> $today
				);
				
				$updt_str = '';
			    foreach ($data as $k => $v) {
			        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
			    }

			    $updt_str = substr_replace($updt_str,";", -1);

			    $result = $this->db->query($this->db->insert_string('teachers_log', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);

			    if($result){
			    	$this->session->set_flashdata('teacherProUpdated_success','Congratulations, your profile was successfully updated!'); 
			    }
			    else{
			    	$this->session->set_flashdata('teacherProUpdated_error','Error, your profile could not be updated! Try again later.'); 
			    }
			}

		//for change password page

		public function getUserPassByIdAjax(){

			$id = $this->input->post('id');
			$current = $this->input->post('current');

			$auth = array();

			$this->db->select('id, pass_md5');
			$this->db->where(array('id'=>$id));
			$result = $this->db->get('teachers_log');

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
			$updated = $this->db->update('teachers_log', $data); 

			//echo 'Updated: ' . $updated;

			return $updated;
						
		}

		//** end of change password page **// 	

		//for lesson plan page 

		public function addLessonPlanAjax(){

			$data = array(
				'teacher_id'	=> $this->input->post('teacher_id'),
				'name'			=> $this->input->post('name'),
				'course'		=> $this->input->post('course'),		
				'school_year' 	=> $this->input->post('schoolYear'),
				'des'			=> $this->input->post('des'),
				'uploaded_on'	=> $this->input->post('uploadedOn'),
				'deleted'		=> '0'
			);

			$this->db->insert('lesson_plans', $data);

			return $this->db->insert_id();
				//$this->session->set_flashdata('adminAdded_success','Administrator was successfully added to the system!');
		}	

		public function updateLessonPlanRecord($id, $newfilename){

			$data = array(
				'file_name' => $newfilename
			);			
						
			$this->db->where('id', $id);
			$updated = $this->db->update('lesson_plans', $data); 

				//echo 'Updated: ' . $updated;

			return $updated;

		}	

		public function getLessonPlanByTeacherId($teacher_id){

			$lessonPlans = array();

			$result = $this->db->get_where('lesson_plans', array('teacher_id'=>$teacher_id,'deleted'=>'0'));

			if($result->num_rows() >= 1){
				$lessonPlans['lessonPlans'] = $result->result_array();
			}

			return $lessonPlans;

		}
	
		public function delLessonPlanByIdAjax(){

			$id = $this->input->post('id');

			$data = array(
				'deleted' => '1'
			);			
						
			$this->db->where('id', $id);
			$updated = $this->db->update('lesson_plans', $data); 

				//echo 'Updated: ' . $updated;

			return $updated;

		}

		public function getLessonPlanByIdAjax(){ 

			$id = $this->input->post('id');

			$lessonPlan = array();

			$result = $this->db->get_where('lesson_plans', array('id'=>$id,'deleted'=>'0'));

			if($result->num_rows() >= 1){
				$lessonPlan['lessonPlan'] = $result->result_array();
			}

			return $lessonPlan;

		} 	

		public function updateLessonPlanAjax(){

			$replaceFile = $this->input->post('replaceFile');
			$fileName 	 = $this->input->post('file_name');

			$data = array(
				'id'			=> $this->input->post('id'),
				'teacher_id'	=> $this->input->post('teacher_id'),
				'name'			=> $this->input->post('name'),
				'course'		=> $this->input->post('course'),		
				'school_year' 	=> $this->input->post('schoolYear'),
				'des'			=> $this->input->post('des'),
				'uploaded_on'	=> $this->input->post('uploadedOn'),
				'deleted'		=> '0'
			);

			//$this->db->insert('lesson_plans', $data);

			if($replaceFile){
				unlink('./custom/uploads/teachers/files/'.$fileName);
			}

			$updt_str = '';

			foreach ($data as $k => $v) {
			    $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
			}

			$updt_str = substr_replace($updt_str,";", -1);	
			$this->db->query($this->db->insert_string('lesson_plans', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);		

			return $this->input->post('id');
				
		}				  

    }

?>