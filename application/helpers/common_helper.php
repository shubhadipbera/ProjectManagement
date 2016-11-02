<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function GetFunctional($Project_Id)
{
	$CI =& get_instance();
    $CI->db->select('*')->from('project_to_functional');
    $CI->db->where('Project_Id',$Project_Id);
    $res=$CI->db->get();
    return $res->result_array();
	
}

function GetNon_Functional($Project_Id)
{
	$CI =& get_instance();
    $CI->db->select('*')->from('project_to_nonfunctional');
    $CI->db->where('Project_Id',$Project_Id);
    $res=$CI->db->get();
    return $res->result_array();
	
}
function getStories($Project_to_Milestone_Id)
{
	$CI =& get_instance();
    $CI->db->select('*')->from('project_to_stories');
    $CI->db->where('Project_to_Milestone_Id',$Project_to_Milestone_Id);
    $res=$CI->db->get();
    return $res->result_array();
	
}

