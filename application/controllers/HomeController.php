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
			if(!empty($this->session->userdata('user_id')))
			{
				redirect(base_url()."HomeController/dashboard");
			} 
			else
			{
				$this->load->view('LoginView');
			}
		}
		public function login()
		{
			$newdata = array(
                   'username'  =>  $this->input->post('userName'), 
                   'password'  => $this->input->post('password'),
         
               );
			$query=$this->HomeModel->select($newdata);
			if(!empty($query))
			{
				$this->session->set_userdata('user_id',$query['User_Id']);
				redirect(base_url()."HomeController/dashboard");
			}
			else
			{
				redirect(base_url()."HomeController");
				echo "NOt a valid username or password";
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
			$data['message_display'] = 'Successfully Logout';
			redirect(base_url());
		}
	}
?>

