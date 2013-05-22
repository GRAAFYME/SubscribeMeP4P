<?php
class Faq extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('faq_model');		
	}

	public function index()
	{
		$this->load->library('menu');
		$menu = new Menu;

		$data['menu'] = $menu->show_menu();
		$data['faq'] = $this->faq_model->get_faq();
		$data['title'] = 'FAQ';

		$this->load->view('templates/frontend/header', $data);
		$this->load->view('faq/index', $data);
		$this->load->view('templates/frontend/footer');
	}

	public function view($slug)
	{
		$data['faq_item'] = $this->faq_model->get_faq($slug);

		if (empty($data['faq_item'])) // FAQ item DOESN'T exitst!
		{
			show_404();
		}
		else // FAQ item DOES exitst!
		{	
			$this->load->library('menu');
			$menu = new Menu;

			$data['menu'] = $menu->show_menu();
			$data['title'] = $data['faq_item']['question'];

			$this->load->view('templates/frontend/header', $data);
			$this->load->view('faq/view', $data);
			$this->load->view('templates/frontend/footer');
		}
	}

	public function create()
	{				
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->library('menu');
		$menu = new Menu;

		$data['menu'] = $menu->show_menu();
		$data['title'] = 'Create a FAQ item';
		
		$this->form_validation->set_rules('question', 'Question', 'required');
		$this->form_validation->set_rules('answer', 'Answer', 'required');
		
		if ($this->form_validation->run() === FALSE) // Something went wrong!
		{
			$this->load->view('templates/frontend/header', $data);	
			$this->load->view('admin/faq/create');
			$this->load->view('templates/frontend/footer');
			
		}
		else // New news item succesfully created!
		{			
			$return = $this->faq_model->set_faq();

			if ($return == "error")
			{
				$this->load->view('templates/frontend/header', $data);	
				$this->load->view('admin/faq/create');
				$this->load->view('admin/faq/error');
				$this->load->view('templates/frontend/footer');
				// + error, title / slug in use
			}
			else
			{			
				$this->load->view('templates/frontend/header', $data);	
				$this->load->view('admin/faq/create');
				$this->load->view('admin/faq/success');
				$this->load->view('templates/frontend/footer');
			}
		}
	}
}