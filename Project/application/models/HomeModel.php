<?php
	class HomeModel extends CI_Model
	{
		function __construct()
		{ 
			parent::__construct(); 
			$this->load->helper('url'); 
			$this->load->database(); 
			$this->load->library('session');
		}
		public function select($data)
		{
			$this->db->select('User_Id,User_Name,User_Password');
			$this->db->from('user');
			$this->db->where('User_Name',$data['username']);
			$this->db->where('User_Password',md5($data['password']));
			$query=$this->db->get();
			return $query->row_array();
		} 
	}
?>
