<?php
	class ClientController extends CI_Controller
	{
		function __construct()
		{ 
			parent::__construct(); 
			$this->load->helper('url'); 
			$this->load->database(); 
			$this->load->model('ClientModel');
			$this->load->library('session');
			$this->load->model('CommonModel');
			if(empty($this->session->userdata('user_id')))
			{
				redirect(base_url()."HomeController");
			}
		} 
		public function index()
		{
			$dataa=array();
			$data=array();
			$con=array();
			if($this->input->post('clientName')!='')
			{
				$con=array('client.Client_Name'=>$this->input->post('clientName'));
			}
			if($this->input->post('addDate'))
			{
				$con=array('client.Client_Added_Date'=>$this->input->post('addDate'));
			}
			$order_by='client.Client_Id';
			$joins1[0]=array('table'=>'country','condition'=>'country.Country_Id = client.Client_Country_Id','jointype'=>'left');	
			$data['records']=$this->CommonModel->get_data_array('client',$con,'',$order_by,$joins1,'','','');
			$data['header']=$this->load->view('include/header.php','',true);
			$this->load->view('ManageClientView.php',$data);
		}
		public function addClientView()
		{
			$data=array();
			$data['countryInfo']=$this->ClientModel->selectCountry();
			//print_r($data);die;
			$data['header']=$this->load->view('include/header.php','',true);
			$this->load->view('AddClientView.php',$data);
		}
		public function addClient()
		{
			$data = array( 
					'Client_Name' => $this->input->post('clientName'), 
					'Client_Email' => $this->input->post('clientEmail'), 
					'Client_Address' => $this->input->post('clientAddress'), 
					'Client_Country_Id' => $this->input->post('Client_Country_Id'),
					'Client_Added_Date' => date("Y-m-d"),
					'Client_Addedby' => $this->session->userdata('user_id')
				); 
			$tbl='client';
			$Client_Id=$this->CommonModel->tbl_insert($tbl,$data); 
			redirect(base_url()."ClientController");
		}
	}
?>
