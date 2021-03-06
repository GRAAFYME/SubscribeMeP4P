<?php 
class Getsignup_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	// Gets and returns all courses
	public function getcourses()
	{
		$query = $this->db->get('courses');
		return $query-> result_array();
	}

	// Gets and returns all singups for a specific course
	public function course_information($id)
	{
		$query = $this->db->get_where('signups', array('course_name' => $id));
		return $query->result_array();
	}

	// Gets and returns all signups for a specific year and period
	public function get_year_period($year,$period)
	{		
		$this->db->select('*');
		$this->db->from('signups');
		$this->db->where(array('year' => $year));
		$this->db->where(array('period' => $period));
		$query = $this->db->get();
		return $query->result_array();
	}

	// Gets and returns all signups for a specific course in a specific year and period
	public function signups($id,$year,$period)
	{
		$query = $this->db->get_where('signups', array('course_name' => $id, 'year' => $year, 'period' => $period));
		return $query->result_array();
	}
}