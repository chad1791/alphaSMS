<?php 

	class Login extends CI_Controller{

		public function logme(){
			//$account = 'admin';
			$this->Login_model->getAuth('admin');
		}
	}
?>