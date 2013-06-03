<?php
class Profile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('dmenu');
		$this->load->library('amenu');	
	}

	public function index()
	{
			$dmenu = new Dmenu;

			$data['menu'] = $dmenu->show_menu();
			$data['title'] = "profiel";

			$this->load->view('templates/frontend/header', $data);
			$this->load->view('profile/index');
			$this->load->view('templates/frontend/footer');
	}
}