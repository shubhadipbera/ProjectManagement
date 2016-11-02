<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		
		  $data = [];
		// $this->load->model('ProjectModel');
		$this->load->model('CommonModel');
		$project_id=$this->session->userdata('project_Id');
		$tbl="project";
		$order_by='project.Project_Id';
			$joins1[0]=array('table'=>'project_to_functional','condition'=>'project_to_functional.Project_Id = project.Project_Id','jointype'=>'left');
			$joins1[1]=array('table'=>' project_to_nonfunctional','condition'=>'project_to_nonfunctional.Project_Id = project.Project_Id','jointype'=>'left');			
			$data['records']=$this->CommonModel->get_data_array('project',$con=array('project.Project_Id'=>$project_id),'',$order_by,$joins1,'','','');
		$this->CommonModel->get_data_array($tbl,$con='','',$order_by='project.Project_Id',$joins1,$limit='',$group_by=array(),$having=array());
        //load the view and saved it into $html variable
        $html=$this->load->view('welcome_message', $data, true);
		
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "output_pdf_name.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D");        
    }
    
    public function downloadBaseline()
	{
		
		  $data = [];
		// $this->load->model('ProjectModel');
		$this->load->model('CommonModel');
		$project_id=$this->session->userdata('project_Id');
		//$tbl="project_to_baseline";
		$joins1[0]=array('table'=>'baseline','condition'=>'baseline.Baseline_Id = project_to_baseline.Baseline_Id','jointype'=>'left');		
		$data['records']=$this->CommonModel->get_data_array('project_to_baseline','','','',$joins1,'','','');
        $html=$this->load->view('baselineDownload', $data, true);
		
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "output_pdf_name.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D");        
    }
}
	
