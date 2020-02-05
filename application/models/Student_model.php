<?php

    class Student_model extends CI_Model {

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

			$result = $this->db->get('students');
			
			if($result->num_rows() == 1){
				if($result->row(0)->status == '1' && $result->row(0)->can_login == '1'){
					return $result->row(0)->id;
				}
				else{

					$this->session->set_flashdata('acc_inactive','Your account is inactive, please contact your School Administration for account activation!'); 
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

			public function getProfile($id){

				$stdProfile = array();

				$result = $this->db->get_where('students',array('id'=>$id));
				
				if($result->num_rows() >= 1){
					$stdProfile['stdProfile'] = $result->result_array();
				}

				return $stdProfile;
			}

			public function getMyEvents($id){

				$myEvents = array();

				//$query = $this->db->query("SELECT * FROM `my_events` WHERE owner_id = '".$id."' AND deleted != 1 OR share_group LIKE '%".$id."%' GROUP BY created_on ASC;");

				$where = "owner_id='". $id ."' AND deleted='0' AND owner_type='students' OR share_group LIKE '%5%' ORDER BY start ASC";
				$this->db->where($where);
				
				//$this->db->where('owner_id',$id);
				//$this->db->where('deleted!=',$id);
				//$this->db->or_where('share_group LIKE',$id);
				$result = $this->db->get('my_events');
				
				if($result->num_rows() >= 1){
					$myEvents['myEvents'] = $result->result_array();
				}

				//echo $id; 

				return $myEvents;
			}

			public function getMyAssignments($id){  

				$myAssignments = array();

				$this->db->order_by('id', 'DESC'); 
				$result = $this->db->get_where('assignments',array('class_id'=>$id));
				
				if($result->num_rows() >= 1){
					$myAssignments['myAssignments'] = $result->result_array();
				}

				return $myAssignments;
			}

			public function getFiles(){

				$myFiles = array();

				$result = $this->db->get('ass_files');
				
				if($result->num_rows() >= 1){
					$myFiles['myFiles'] = $result->result_array();
				}

				return $myFiles;
			}

			public function getClassById($id){ 

				$myClass = array();

				$result = $this->db->get_where('classes',array('id'=>$id));
				
				if($result->num_rows() >= 1){
					$myClass['myClass'] = $result->result_array();
				}

				return $myClass;
			}

			public function getStudentPassByIdAjax(){

				$id = $this->input->post('id');
				$current = $this->input->post('current');

				$auth = array();

				$this->db->select('id, pass_md5');
				$this->db->where(array('id'=>$id));
				$result = $this->db->get('students');

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
				$updated = $this->db->update('students', $data); 

				//echo 'Updated: ' . $updated;

				return $updated;
							
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

			public function getGradesByStudentId($student_id, $class_id, $course_id){ //

				$grade = array();

				//$query = $this->db->query("SELECT short FROM courses WHERE id='".$course_id."'");
				//$row = $query->row(0);				
				//$courseShort = $row->short;

				$this->db->select('id, module, mark, school_year');
				$this->db->where(array('student_id'=>$student_id, 'class_id'=>$class_id, 'course_id'=>$course_id, 'school_year'=>'2018-2019'));
				$this->db->order_by('module', 'ASC');
				$result = $this->db->get('grades');				

				if($result->num_rows() >= 1){
					$grade[$course_id] = $result->result_array();
				}

				return $grade;		

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

			public function getMyUploadedFiles($id){ 

				$myUploadedFiles = array();

				$result = $this->db->get_where('ass_student_files', array('student_id'=>$id));
				
				if($result->num_rows() >= 1){
					$myUploadedFiles['myUploadedFiles'] = $result->result_array();
				}

				return $myUploadedFiles;
			} 

			public function updateStudentBioAjax(){ 

				$timezone = new \DateTimeZone('America/Belize');
		        $date = new \DateTime('@' . time(), $timezone);
		        $date->setTimezone($timezone);
		        $today = $date->format('Y-m-d H:i:s');

		        //echo 'Hi from student model: '.$this->input->post('id');

				$data = array(
					'id'		=> $this->input->post('id'),
					'bio' 		=> $this->input->post('myBio'), 
					'edited_on'	=> $today
				);
				
				$updt_str = '';
			    foreach ($data as $k => $v) {
			        $updt_str = $updt_str.' '.$k.' = "'.$v.'",';
			    }

			    $updt_str = substr_replace($updt_str,";", -1); 
			    $this->db->query($this->db->insert_string('students', $data).' ON DUPLICATE KEY UPDATE '.$updt_str);
			}

			public function addAssFileRecord($ass_id, $name, $path, $new_pic_name, $student_id){ 

				$timezone = new \DateTimeZone('America/Belize');
		        $date = new \DateTime('@' . time(), $timezone);
		        $date->setTimezone($timezone);
		        $today = $date->format('Y-m-d H:i:s');

				$data = array(
					'assignment_id' => $ass_id,
					'student_id'	=> $student_id,					
					'name'			=> $name,
					'new_name'		=> $new_pic_name,
					'path' 			=> $path,
					'edited_on'   	=> $today
				);

				$this->db->insert('ass_student_files', $data);

				return $this->db->insert_id();
			}

			public function delFileByIdAjax(){ //
				
				$id = $this->input->post('id');

				/*$data = array(
					'deleted' => '1'
				);*/
					
				$this->db->where('id', $id);
				$deleted = $this->db->delete('ass_student_files');		

				return $deleted;

			}

			public function getNewNotificationsAjax(){ 

				$id = $this->input->post('id');
				$notifications = array();

				$this->db->order_by("id", "asc");
				$result = $this->db->get_where('notifications', array('department'=>'student','user_id'=>$id,'is_viewed'=>'0'));
				
				if($result->num_rows() >= 1){
					$notifications['notification'] = $result->result_array();
				}

				return $notifications;	

			}

			public function getOldNotificationsAjax(){ //

				$id = $this->input->post('id');
				$notifications = array();

				$this->db->order_by("id", "asc");
				$this->db->limit(5);
				$result = $this->db->get_where('notifications', array('department'=>'student','user_id'=>$id,'is_viewed'=>'1'));
				
				if($result->num_rows() >= 1){
					$notifications['notification'] = $result->result_array();
				}

				return $notifications;	

			}			

			public function getAllNotificationsAjax(){ 

				$id = $this->input->post('id');
				$notifications = array();

				$result = $this->db->get_where('notifications', array('department'=>'student','user_id'=>$id));
				
				if($result->num_rows() >= 1){
					$notifications['notifications'] = $result->result_array();
				}

				return $notifications;	

			}

			public function updateViewNotificationjax(){ //

				$id = $this->input->post('id');						

				$data = array(
					'is_viewed' => '1'
				);			
						
				$this->db->where('id', $id);
				$updated = $this->db->update('notifications', $data); 

				return $updated;
							
			}	

			public function getUserDetails($from_id, $from_dept){

				$details = array();

				if($from_dept == 'teachers_log'){

					$this->db->select('first, last, image, gender');
					$this->db->where(array('id'=>$from_id));

					$result = $this->db->get($from_dept);

					if($result->num_rows() >= 1){
						$details['info'] = $result->result_array();
					}
				}
				else
				if($from_dept == 'admin_profile'){

					$this->db->select('name, last, image, gender');
					$this->db->where(array('id'=>$from_id));
					
					$result = $this->db->get($from_dept);

					if($result->num_rows() >= 1){
						$details['info'] = $result->result_array();
					}					
				}
				else
				if($from_dept == 'students'){

					$this->db->select('first, last, image, gender');
					$this->db->where(array('id'=>$from_id));
					
					$result = $this->db->get($from_dept);

					if($result->num_rows() >= 1){
						$details['info'] = $result->result_array();
					}					
				}							

				return $details;	

			}											 

    }

?>