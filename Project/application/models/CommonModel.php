<?php
class CommonModel extends CI_Model{
	function __construct()
		{ 
			parent::__construct(); 
			
		} 
	
	public function get_data_array($tbl,$con='',$select='*',$order_by='',$joins=array(),$limit='',$group_by=array(),$having=array()){
		//group by input example: $group_by=array('field 1','field 2');
        //having input example: $having=array('title ='=>'My Title','id <'=>$id);
        //limit input example: $limit='10,20';
        
        $this->db->select($select);
        $this->db->from($tbl);
        if(!empty($joins)){
            foreach($joins as $k=>$v){
                $this->db->join($v['table'],$v['condition'],$v['jointype']);
            }
        }
        if($con!=''){
            $this->db->where($con);
        }
        if(!empty($group_by)){
            $this->db->group_by($group_by);
        }
        if(!empty($having)){
            $this->db->having($having);
        }
        if($order_by!=''){
            $this->db->order_by($order_by,'DESC');
        }
        if(trim($limit)!=''){
            $lm=explode(',',trim($limit));
            $this->db->limit(trim($lm[1]),trim($lm[0]));
        }
        $res=$this->db->get();
		//echo $this->db->last_query(); die;
        return $res->result_array();
    }
	
	public function get_data_row($tbl,$con='',$select='*',$joins=array()){
        $this->db->select($select);
        $this->db->from($tbl);
        if(!empty($joins)){
            foreach($joins as $k=>$v){
                $this->db->join($v['table'],$v['condition'],$v['jointype']);
            }
        }
        if($con!=''){
            $this->db->where($con);
        }
        $res=$this->db->get();
        //echo $this->db->last_query(); die;
        return $res->row_array();
    }
	
	public function tbl_insert($tbl,$data){
        $res=$this->db->insert($tbl,$data);
        return $this->db->insert_id();
    }
	
	public function tbl_update($tbl,$con,$data){
        $this->db->where($con);
        $this->db->update($tbl,$data);
        //$this->db->last_query();exit;
        return $this->db->affected_rows();
    }
	
	public function tbl_record_del($tbl,$con){
        $this->db->where($con);
        $this->db->delete($tbl);
        return $this->db->affected_rows();
    }
	
	
}
?>
