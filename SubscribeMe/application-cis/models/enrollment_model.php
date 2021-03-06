<?php
class Enrollment_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	// Gets all the signups for a specific user
	public function enrollments($username)
	{
		$query = $this->db->get_where('signups', array('username' => $username));
		return $query->result_array();
	}

	// Unrolls a specific user from a specific test
	public function unroll($id)
	{
		$this->db->delete('signups', array('id'=>$id));		
	}
}