<?php
class Xmlparser_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
		$this->load->library('parser');
	}

	public function insert()
	{

	$xml = simplexml_load_file("uploads/curiclium2012-2013.xml");
	foreach($xml as $course)
		{
			
		$data = array(
		'name' => (string)$course->name,
		'description' => (string)$course->description,
		'datee' => (string)$course->datee
		);
		
		$this->db->insert('xml', $data);	
		}
		
	}

	public function getxml()
	{
		$query =$this->db->get('xml');
		return $query->result_array();
	}
}