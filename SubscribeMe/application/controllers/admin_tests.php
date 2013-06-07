<?php
class Admin_tests extends AD_Controller {

	// Number of entries per page
	private $limit = 10;

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('url', 'form'); // Load helper(s)

		$this->load->library(array('table', 'amenu', 'form_validation')); // Load library(s)

		$this->load->model('admin_tests_model'); // Load model(s)
	}

	public function index($offset = 0)
	{
		// Set offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);

		// Load data from model
		$entries = $this->admin_tests_model->get_paged_list($this->limit, $offset)->result();

		// Generate pagination
		$this->load->library('pagination');
		$config['base_url']    = site_url('admin/faq');
        $config['total_rows']  = $this->admin_tests_model->count_all();
        $config['per_page']    = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination']    = $this->pagination->create_links();

        // Generate table data
        $this->table->set_heading('id', 'course_name', 'year', 'period', 'tests', '');
        foreach ($entries as $entry)
        {
        	$this->table->add_row($entry->id, substr($entry->course_name, 0, 40), substr($entry->year, 0, 40),substr($entry->period, 0, 40),substr($entry->tests, 0, 40),
        		anchor('admin/tests/read/'.$entry->id,'view', array('class'=>'view')).' '.
        		anchor('admin/tests/update/'.$entry->id, 'update', array('class'=>'update')).' '.
        		anchor('admin/tests/delete/'.$entry->id, 'delete', array('class'=>'delete', 'onclick'=>"return confirm('Are you sure you want to delete this entry?')"))
        	);
        }        
        $data['table'] = $this->table->generate();
        $data['add_data'] = 'admin/tests/create';
        $data['show_add_button'] = TRUE;

        // Load view
    	$amenu = new Amenu;

		$data['menu'] = $amenu->show_menu();
		$data['title'] = 'CRUD -> FAQ';

		$this->load->view('templates/backend/header', $data);
		$this->load->view('admin/entryList', $data);
		$this->load->view('templates/backend/footer');  
	}
/*
	function create()
	{
		// Prefill form values
		$this->form_validation->question = $this->input->post('question');
		$this->form_validation->answer = $this->input->post('answer');

		// Set common properties
		$data['title'] = 'Create a new test';
		$data['message'] = '';
		$data['action'] = site_url('admin/tests/create');
		$data['link_back'] = anchor('admin/tests', 'Back to list of entries', array('class'=>'back'));
		$data['title_fieldname'] = 'question';
		$data['content_fieldname'] = 'answer';

		// Load view
		$amenu = new Amenu;

		$data['menu'] = $amenu->show_menu();

		// Set question and answer field as required	
		$this->form_validation->set_rules('question', 'Question', 'required');
		$this->form_validation->set_rules('answer', 'Answer', 'required');

		if ($this->form_validation->run() === FALSE) // Display error (question and/or answer field is empty)
		{
			$this->load->view('templates/backend/header', $data);
			$this->load->view('admin/entryEdit', $data);
			$this->load->view('templates/backend/footer');
		}
		else // Try insert new item into DB
		{
			$bool = $this->admin_faq_model->save(); // Save function will return true or false in $bool

			if ($bool == false) // Display error (title (and slug) are in use)
			{
				$data['message'] = 'Title already in use';

				$this->load->view('templates/backend/header', $data);
				$this->load->view('admin/entryEdit', $data);
				$this->load->view('templates/backend/footer');
			}
			else // New item successfully created
			{			
				redirect('admin/faq'); // Redirect back to overview
			}
		}
	}
*/
	function read() 
	{
		// Set common properties
		$data['title'] = 'Entry details';
		$data['link_back'] = anchor('admin/tests', 'Back to list of entries',array('class'=>'back'));

		// Get $id from url
		$id = $this->uri->segment(4);

		// Get entry details
		$data['entry'] = $this->admin_tests_model->get_by_id($id)->row();

		// Load view
		$amenu = new Amenu;

		$data['menu'] = $amenu->show_menu();

		$this->load->view('templates/backend/header', $data);
		$this->load->view('admin/tests/entryView_tests', $data);
		$this->load->view('templates/backend/footer');
	}

	function update() 
	{
		// Get $id from url
		$id = $this->uri->segment(4);

		$entry = $this->admin_tests_model->get_by_id($id)->row();

		// Prefill form values
		if ($this->input->post('course_name') == '')		{	$this->form_validation->question = $entry->course_name;				}
		else 											{	$this->form_validation->question = $this->input->post('course_name');	}

		if ($this->input->post('year') == '')			{	$this->form_validation->answer = $entry->year;					}
		else 											{	$this->form_validation->answer = $this->input->post('year');		}
		if ($this->input->post('period') == '')		{	$this->form_validation->question = $entry->period;				}
		else 											{	$this->form_validation->question = $this->input->post('period');	}

		if ($this->input->post('test') == '')			{	$this->form_validation->answer = $entry->test;					}
		else 											{	$this->form_validation->answer = $this->input->post('test');		}
		
		// Set common properties
		$data['title'] = 'Update entry';
		$data['message'] = '';
		$data['action'] = site_url('admin/tests/update/'.$id);
		$data['link_back'] = anchor('admin/tests','Back to list of entries', array('class'=>'back'));
		$data['course_name_fieldname'] = 'course_name';
		$data['year_fieldname'] = 'year';
		$data['period_fieldname'] = 'period';
		$data['tests_fieldname'] = 'test';

		// Load view
		$amenu = new Amenu;

		$data['menu'] = $amenu->show_menu();

		// Set question and answer field as required
		$this->form_validation->set_rules('course_name', 'Course_name', 'required');
		$this->form_validation->set_rules('year', 'Year', 'required');
		$this->form_validation->set_rules('period', 'Period', 'required');
		$this->form_validation->set_rules('test', 'Tests', 'required');

		if ($this->form_validation->run() === FALSE) // Display error (question and/or answer field is empty)
		{
			$this->load->view('templates/backend/header', $data);
			$this->load->view('admin/entryEdit_tests', $data);
			$this->load->view('templates/backend/footer');
		}
		else // Try update item into DB
		{
			$bool = $this->admin_tests_model->update($id, $entry->course_name); // Update function will return true or false in $bool

			if ($bool == false) // Display error (title (and slug) are in use)
			{
				$data['message'] = 'This course name doesnt exists';

				$this->load->view('templates/backend/header', $data);
				$this->load->view('admin/entryEdit', $data);
				$this->load->view('templates/backend/footer');
			}
			else // Current item successfully updated
			{			
				redirect('admin/tests'); // Redirect back to overview
			}
		}
	}

	function delete()
	{		
		$id = $this->uri->segment(4); // Get $id from url
		
		$this->admin_tests_model->delete($id); // Delete this record

		redirect('admin/faq'); // Redirect back to overview
	}
}