<?php
	class ProjectController extends CI_Controller
	{
		function __construct()
		{ 
			parent::__construct(); 
			$this->load->model('ProjectModel');
			$this->load->model('CommonModel');
			$this->load->helper('url'); 
			$this->load->database(); 
			$this->load->library('session');
			if(empty($this->session->userdata('user_id')))
			{
				redirect(base_url()."HomeController");
			}
		} 
		
		public function index()
		{
			$data=array();
			$data['header']=$this->load->view('include/header.php','',true);
			$order_by='project.project_Id';
			$data['ProjectInfo']=$this->CommonModel->get_data_array('project','','',$order_by,'','','','');
			$this->load->view('ManageProjectView.php',$data);
		}
		public function viewProject($project_Id=null)
		{
			$data=array();
			$project_Id=$project_Id;
			$con=array('project_Id'=>$project_Id);
			$data['ProjectInfo']=$this->CommonModel->get_data_array('project',$con,'','','','','','');
			$Project_Status=$data['ProjectInfo'][0]['Project_Status'];
			$this->session->set_userdata('project_Id',$project_Id);
			$data['header']=$this->load->view('include/header.php','',true);
			if($Project_Status==0)
			{
				$this->load->view('ProjectViewUnInitiated.php',$data);
			} 
			else
			{
				$this->load->view('ProjectViewInitiated.php',$data);
			}
			
		}
		public function addProject()
		{
			$data=array();
			$data['header']=$this->load->view('include/header.php','',true);
			$this->load->view('AddProjectView.php',$data);
			
		}

		public function next()
		{
			$data=array();
			if($this->input->post()){
				$this->session->set_userdata('Project_Name',$this->input->post('ProjectName'));
				 $this->session->set_userdata('Project_Start_Date',$this->input->post('TentativeStart'));
				 $this->session->set_userdata('Project_End_Date',$this->input->post('TentativeEnd'));
				 $this->session->set_userdata('Project_Budget',$this->input->post('SummaryBudget'));
			}
			
			$data['header']=$this->load->view('include/header.php','',true);
			$this->load->view("AddProjectNextView.php",$data);
		}
		public function save()
		{
			$data=array();
			if($this->input->post()){
				$data = array( 
					'Project_Introduction' => $this->input->post('Introduction'), 
					'Project_Needs' => $this->input->post('Buisenessneeds'),
					'Project_Financer' => $this->input->post('ProjectFinancer'),
					'Project_AddedBy' => $this->session->userdata('user_id')
				);
				$data['Project_Name']=$this->session->userdata('Project_Name');	
				$data['Project_Start_Date']=$this->session->userdata('Project_Start_Date');	
				$data['Project_End_Date']=$this->session->userdata('Project_End_Date');	
				$data['Project_Budget']=$this->session->userdata('Project_Budget');
				$Non_Funname = $this->input->post('abc');
				$count_NonFun = count($Non_Funname);
				$Funname = $this->input->post('def');
				$count_Fun = count($Funname);
				$last_id=$this->CommonModel->tbl_insert('project',$data);
				for($i=0;$i<$count_Fun;$i++)
				{
					$fun=array(
								'Project_Functional_Name' => $Non_Funname[$i],
								'Project_Id' => $last_id
							);
					$this->CommonModel->tbl_insert('project_to_functional',$fun);
				}
				for($i=0;$i<$count_NonFun;$i++)
				{
					$non_fun=array(
								'Project_NonFunctional_Name' => $Funname[$i],
								'Project_Id' => $last_id
							);
					$this->CommonModel->tbl_insert('project_to_nonfunctional',$non_fun);
				}
				redirect(base_url()."ProjectController");
			} 
			else
			{
				redirect(base_url()."ProjectController/next");
			}
		}
		public function initiateProject()
		{
			$data=array();
			$data['header']=$this->load->view('include/header.php','',true);
			$this->load->view('ProjectInitiateView.php',$data);
		}
		public function viewBaseline()
		{
			$data=array();
			$project_Id=$this->session->userdata('project_Id');
			$data = array( 
					'Project_Initiate_StartDate' => $this->input->post('tentativeStartDate'), 
					'Project_Initiate_EndDate' => $this->input->post('tentativeEndDate'),
					'Project_Initiate_Amount' => $this->input->post('tentativeAmount')
				);
			$con=array('Project_Id'=>$project_Id);
			$this->CommonModel->tbl_update('project',$con,$data);
			$data['header']=$this->load->view('include/header.php','',true);
			
			$data['baseline']=$this->CommonModel->get_data_array('baseline','','','','','','','');
			$this->load->view("ProjectBaselineView.php",$data);
		}
		public function addBaseline()
		{
			$project_Id=$this->session->userdata('project_Id');
			if($this->input->post())
			{
				//print_r($this->input->post()); die;
				$Baseline_Id=$this->input->post('Baseline_Id');
				$ctn=count($this->input->post('Baseline_Id'));
				for($i=0;$i<$ctn;$i++)
				{
					$value=array('project_Id'=>$project_Id,'Baseline_Id'=>$Baseline_Id[$i]);
					$this->CommonModel->tbl_insert('project_to_baseline',$value);
				}
			}
			$data=array();
			$data['header']=$this->load->view('include/header.php','',true);
			$this->load->view("ProjectStoryView.php",$data);
		}
		public function addStories()
		{
			$data=array();
			$storiesName=$this->input->post('abd');
			print_r($storiesName);
			$storiesDate=$this->input->post('date');
			print_r($storiesDate);
			
		}
	}
?>
