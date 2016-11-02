<?php
	class HomeController extends CI_Controller
	{
		function __construct()
		{ 
			parent::__construct(); 
			$this->load->helper('url'); 
			$this->load->database(); 
			$this->load->library('session');
			$this->load->model('HomeModel');
			$this->load->model('CommonModel');
		} 
		public function index()
		{
			if(!empty($this->session->userdata('user_id'))){
				redirect(base_url()."HomeController/dashboard");
			} else{
				$this->load->view('LoginView');
			}
		}
		public function login()
		{
			$newdata = array(
                   'username'  =>  $this->input->post('userName'), 
                   'password'  => $this->input->post('password')
               );
			$userInfo=$this->HomeModel->select($newdata);
			if(!empty($userInfo))
			{
				$this->session->set_userdata('user_id',$userInfo['User_Id']);
				redirect(base_url()."HomeController/dashboard");
			}
			else
			{
                $this->session->set_userdata('error_message','Wrong Credential...');
				redirect(base_url()."HomeController");
			}
		}
		public function dashboard()
		{
			if(!empty($this->session->userdata('user_id'))){
				$this->load->view('DashboardView');
			} else{
				redirect(base_url()."HomeController");
			}
			
		}
		public function logout()
		{
			$this->session->unset_userdata('user_id');	
			$this->session->set_userdata('error_message','Successfully Log Out...');
			redirect(base_url());
		}
	}
?>

