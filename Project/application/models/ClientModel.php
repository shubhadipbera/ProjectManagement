<?php
	class ClientModel extends CI_Model
	{
		function __construct()
		{ 
			parent::__construct(); 
		}
		
		public function selectCountry()
		{
			$this->db->select('*');
			$this->db->from('country');
			$query = $this->db->get();
			$result= $query->result_array();
			return $result;
		}
		
	}
?>
