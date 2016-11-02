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
			$this->load->helper('common_helper');
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
				$this->load->view('UnInitiatedProjectDashboard.php',$data);
			} 
			else
			{
				$this->load->view('InitiatedProjectDashboard.php',$data);
			}
			
		}
		public function addProject()
		{
			$data=array();
			$tbl='client';
			$data['ClientInfo']=$this->CommonModel->get_data_array($tbl,'','','','','','','');
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
				 $this->session->set_userdata('Client_Id',$this->input->post('Client_Id'));
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
				$data['Client_Id']=$this->session->userdata('Client_Id');
				$Non_Funname = $this->input->post('Project_NonFunctional_Name');
				$count_NonFun = count($Non_Funname);
				$Funname = $this->input->post('Project_Functional_Name');
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
			} else{
				redirect(base_url()."ProjectController/next");
			}
		}
        public function modifyCharter(){
            $data=array();
            $project_Id=$this->session->userdata('project_Id');
            $con=array('Project_Id'=>$project_Id);
            $tbl='client';
			$data['ClientInfo']=$this->CommonModel->get_data_array($tbl,'','','','','','','');
            $data['ProjectInfo']=$this->CommonModel->get_data_array('project',$con,'','','','','','');
            $data['header']=$this->load->view('include/header.php','',true);
			$this->load->view("modifyCharter.php",$data);
        }
        public function modifyCharterNext()
		{
			$data=array();
			if($this->input->post()){
				$this->session->set_userdata('Project_Name',$this->input->post('ProjectName'));
				 $this->session->set_userdata('Project_Start_Date',$this->input->post('TentativeStart'));
				 $this->session->set_userdata('Project_End_Date',$this->input->post('TentativeEnd'));
				 $this->session->set_userdata('Project_Budget',$this->input->post('SummaryBudget'));
				 $this->session->set_userdata('Client_Id',$this->input->post('Client_Id'));
			}
            $project_Id=$this->session->userdata('project_Id');
            $con=array('Project_Id'=>$project_Id);
			$data['projectToFunctionalInfo']=$this->CommonModel->get_data_array('project_to_functional',$con,'','','','','','');
			$data['projectToNonFunctionalInfo']=$this->CommonModel->get_data_array('project_to_nonfunctional',$con,'','','','','','');
            $data['ProjectInfo']=$this->CommonModel->get_data_array('project',$con,'','','','','','');
			$data['header']=$this->load->view('include/header.php','',true);
			$this->load->view("modifyCharterNext.php",$data);
		}
        public function modifyCharterSave()
		{
			$data=array();
            $project_Id=$this->session->userdata('project_Id');
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
				$data['Client_Id']=$this->session->userdata('Client_Id');
				$Funname = $this->input->post('Project_Functional_Name');
				$Non_Funname = $this->input->post('Project_NonFunctional_Name');
				$count_Fun = count($Funname);
                $count_NonFun = count($Non_Funname);
                $con=array('Project_Id'=>$project_Id);
				$this->CommonModel->tbl_update('project',$con,$data);
                $this->CommonModel->tbl_record_del('project_to_functional',$con);
                $this->CommonModel->tbl_record_del('project_to_nonfunctional',$con);
				for($i=0;$i<$count_Fun;$i++)
				{
					$fun=array(
								'Project_Functional_Name' => $Funname[$i],
								'Project_Id' => $project_Id
							);
					$this->CommonModel->tbl_insert('project_to_functional',$fun);
				}
				for($j=0;$j<$count_NonFun;$j++)
				{
					$non_fun=array(
								'Project_NonFunctional_Name' => $Non_Funname[$j],
								'Project_Id' => $project_Id
							);
					$this->CommonModel->tbl_insert('project_to_nonfunctional',$non_fun);
				}
                
			} else{
			}
            	redirect(base_url()."ProjectController/viewProject/".$project_Id);
		}
        
        
        /*developed by rajyasree*/
        
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
            $con=array('Project_Id'=>$project_Id);
            $this->CommonModel->tbl_record_del('project_to_baseline',$con);
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
			$this->load->view("ProjectMilestoneView.php",$data);
		}
		public function addedMilestones()
		{
			$data=array();
			$milestone=$this->input->post('milestone');
			$milestoneDescription=$this->input->post('milestoneDescription');
			$ctn=count($milestone);
			$project_Id=$this->session->userdata('project_Id');
            $con=array('Project_Id'=>$project_Id);
            $this->CommonModel->tbl_record_del('project_to_milestone',$con);
			for($i=0;$i<$ctn;$i++)
			{				                              $value=array('project_Id'=>$project_Id,'Project_Milestone_Name'=>$milestone[$i],'Project_Milestone_Description'=>$milestoneDescription[$i]);
				$this->CommonModel->tbl_insert('project_to_milestone',$value);
			}
            $con=array('Project_Id'=>$project_Id);
			$data['milestoneInfo']=$this->CommonModel->get_data_array('project_to_milestone',$con,'','','','','','');
			$data['header']=$this->load->view('include/header.php','',true);
			$this->load->view("ProjectStoryView.php",$data);
				
		}
		public function selectMilestone()
		{
			$addcnt=$this->input->post('addcnt');
            $project_Id=$this->session->userdata('project_Id');
            $con=array('Project_Id'=>$project_Id);
			$milestoneInfo=$this->CommonModel->get_data_array('project_to_milestone',$con,'','','','','','');
            echo '<div id="adddiv_'.$addcnt.'"><input type="text" placeholder="" name="Project_Stories_Name[]" id="Project_Stories_Name'.$addcnt.'" class="required">&nbsp;<input type="date" placeholder="" name="Project_to_Stories_Date[]" id="Project_to_Stories_Date'.$addcnt.'" class="required">&nbsp;<select name="Project_to_Milestone_Id[]" id="Project_to_Milestone_Id'.$addcnt.'"><option value="">-- Select --</option>';
		   foreach($milestoneInfo as $result){
            echo '<option value="'.$result['Project_to_Milestone_Id'].'">'.$result['Project_Milestone_Name'].'</option>';
           }
            echo '</select></div>';
		}
		public function addStories()
		{
			$data=array();
            $project_Id=$this->session->userdata('project_Id');
			$Project_Stories_Name=$this->input->post('Project_Stories_Name');
			$Project_to_Stories_Date=$this->input->post('Project_to_Stories_Date');
			$Project_to_Milestone_Id=$this->input->post('Project_to_Milestone_Id');
			$ctn=count($this->input->post('Project_Stories_Name'));
            for($i=0;$i<$ctn;$i++)
			{				                              $value=array('project_Id'=>$project_Id,'Project_Stories_Name'=>$Project_Stories_Name[$i],'Project_to_Stories_Date'=>$Project_to_Stories_Date[$i],'Project_to_Milestone_Id'=>$Project_to_Milestone_Id[$i]);
             $this->CommonModel->tbl_insert('project_to_stories',$value);
			}
            $con=array('Project_Id'=>$project_Id);
            $data=array('Project_Status'=>1);
            $this->CommonModel->tbl_update('project',$con,$data);
			redirect(base_url()."ProjectController/viewProject/".$project_Id);
		}
        
        /*Developped By Rajyasree */
        public function modifyBaseline()
		{
			$project_Id=$this->session->userdata('project_Id');
			$con=array('project_to_baseline.Project_Id'=>$project_Id);
			$data=array();
			$data['baseline']=$this->CommonModel->get_data_array('baseline','','','','','','','');
			$data['baselineInfo']=$this->CommonModel->get_data_array('project_to_baseline',$con,'','','','','','');
			$data['header']=$this->load->view('include/header.php','',true);
			$this->load->view("ModifyBaselineView.php",$data);
		}
		public function modifyBaselineSave()
		{	
			$data=array();
			$Baseline_Id=$this->input->post('Baseline_Id');
			$project_Id=$this->session->userdata('project_Id');
			$con=array('Project_Id'=>$project_Id,);
			$this->CommonModel->tbl_record_del('project_to_baseline',$con);
			$ctn=count($Baseline_Id);
			for($i=0;$i<$ctn;$i++)
			{
				$value=array('project_Id'=>$project_Id,'Baseline_Id'=>$Baseline_Id[$i]);
				$this->CommonModel->tbl_insert('project_to_baseline',$value);
			}
			$data['milestone']=$this->CommonModel->get_data_array('project_to_milestone',$con,'','','','','','');
			$data['header']=$this->load->view('include/header.php','',true);
			$this->load->view("ModifyMilestoneView.php",$data);
		}
		public function modifyMilestone()
		{
			$project_Id=$this->session->userdata('project_Id');
			$milestone=$this->input->post('milestone');
			$milestoneDescription=$this->input->post('milestoneDescription');
			$ctn=count($milestone);
			for($i=0;$i<$ctn;$i++)
			{
				$value=array('project_Id'=>$project_Id,'Project_Milestone_Name'=>$milestone[$i],'Project_Milestone_Description'=>$milestoneDescription[$i]);
				$this->CommonModel->tbl_insert('project_to_milestone',$value);
			}
            
            
            
			$Milestone_Id=$this->input->post('Milestone_Id');
			$Milestone_Name=$this->input->post('Milestone_Name');
			$MilestoneDescription_Name=$this->input->post('MilestoneDescription_Name');
			$con=array('Project_to_Milestone_Id'=>$Milestone_Id,);
			$ctn=count($MilestoneDescription_Name);
			for($j=0;$j<$ctn;$j++)
			{
				$data=array('Project_Milestone_Name'=>$Milestone_Name[$j],'Project_Milestone_Description'=>$MilestoneDescription_Name[$j]);	
				$con=array('Project_to_Milestone_Id'=>$Milestone_Id[$j],);
				$this->CommonModel->tbl_update('project_to_milestone',$con,$data);
			}
            redirect(base_url()."ProjectController/modifyProjectStoriesView");
			
		}
        public function modifyProjectStoriesView(){
            $data=array();
            $project_Id=$this->session->userdata('project_Id');
            $con=array('Project_Id'=>$project_Id,);
            $data['projectStoriesInfo']=$this->CommonModel->get_data_array('project_to_stories',$con,'','','','','','');
            $data['projectMilestoneInfo']=$this->CommonModel->get_data_array('project_to_milestone',$con,'','','','','','');
			$data['header']=$this->load->view('include/header.php','',true);
			$this->load->view("modifyProjectStoriesView.php",$data);
        }
        
        public function modifyProjectStoriesSave(){
            $data=array();
            $project_Id=$this->session->userdata('project_Id');
            $con=array('Project_Id'=>$project_Id,);
            $this->CommonModel->tbl_record_del('project_to_stories',$con);
            $Project_Stories_Name=$this->input->post('Project_Stories_Name');
            $Project_to_Stories_Date=$this->input->post('Project_to_Stories_Date');
            $Project_to_Milestone_Id=$this->input->post('Project_to_Milestone_Id');
			$ctn=count($Project_Stories_Name);
			for($i=0;$i<$ctn;$i++)
			{            $value=array('project_Id'=>$project_Id,'Project_to_Milestone_Id'=>$Project_to_Milestone_Id[$i],'Project_to_Stories_Date'=>$Project_to_Stories_Date[$i],'Project_Stories_Name'=>$Project_Stories_Name[$i]);
             $this->CommonModel->tbl_insert('project_to_stories',$value);
			}
            redirect(base_url()."ProjectController/viewProject/".$project_Id);
        }
        public function viewSpine()
        {
			$data=array();
			$project_Id=$this->session->userdata('project_Id');
            $con=array('Project_Id'=>$project_Id);
            $data['projectMilestoneInfo']=$this->CommonModel->get_data_array('project_to_milestone',$con,'','','','','','');
            $data['header']=$this->load->view('include/header.php','',true);
			$this->load->view("viewSpine.php",$data);
		}
		
		public function updateStoriesStatus()
		{
			$data=array();
			$Project_to_Stories_Id=$this->input->post('Project_to_Stories_Id');
			$Project_Stories_status=$this->input->post('Project_Stories_status');
			$Project_to_Milestone_Id=$this->input->post('Project_to_Milestone_Id');
			$con=array('Project_to_Stories_Id'=>$Project_to_Stories_Id);
			$con1=array('Project_to_Milestone_Id'=>$Project_to_Milestone_Id);
			$data=array('Project_Stories_status'=>$Project_Stories_status); 
			$this->CommonModel->tbl_update('project_to_stories',$con,$data);
			$flag=0;
			$milestone=$this->CommonModel->get_data_array('project_to_stories',$con1,'','','','','','');
			foreach($milestone as $Result)
			{
				if($Result['Project_Stories_status']!=2)
				{
					$flag=1;
				}
			}
			if($flag==0)
			{
				$data2=array('Project_Milestone_Status'=>1);
			} 
			else
			{
				$data2=array('Project_Milestone_Status'=>0);	
			}
			$con2=array('Project_to_Milestone_Id'=>$Project_to_Milestone_Id);
			$this->CommonModel->tbl_update('project_to_milestone',$con2,$data2);
			redirect(base_url()."ProjectController/viewSpine");
		}
	}
?>
