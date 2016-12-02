<?php

class workday extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['meta_title'] = 'TMIS - workdays';
	}

	public function index ()
	{
		//Load breadcrums
		$this->breadcrumbs->push('Inicio', '/dashboard');
		$this->breadcrumbs->push('Jornadas', 'menu/workday');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		//Load model workday
		$this->load->model('workday_m');
		// Fetch all profile
		$this->data['workdays'] = $this->workday_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/workday/index';
		//$this->data['NameView'] = 'Usuarios';
		$this->load->view('main_layout', $this->data);
	}

	public function edit ($id = NULL)
	{
		//load model workday
		$this->load->model('workday_m');
		// Fetch a profile or set a new one
		if ($id) {
			$this->data['workdays'] = $this->workday_m->get($id);
			//log_message('info', $this->db->last_query());
			count($this->data['workday']) || $this->data['errors'][] = 'workday could not be found';
		}
		else {
			$this->data['workday'] = $this->workday_m->get_new();
		}
		
		// Set up the form
		$rules = $this->workday_m->rules;
		$id || $rules['workday']['rules'] .= '|required';
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->workday_m->array_from_post(array('workday', 'typeWorkday', 'idTurn', 'status'));
			$this->workday_m->save($data, $id);
			redirect('admin/workday');
		}

		//get turnos
		$this->load->model('turn_m');
		$this->data['turns'] = $this->turn_m->get();
		
		// Load the view
		$this->data['subview'] = 'admin/workday/edit';
		$this->load->view('main_layout', $this->data);
	}

	public function delete ($id)
	{
		$this->workday_m->delete($id);
		redirect('admin/workday');
	}

	public function _unique_workday ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current profile
		
		$id = $this->uri->segment(4);
		$this->db->where('workday', $this->input->post('workday'));
		!$id || $this->db->where('idworkday !=', $id);
		$workday = $this->workday_m->get();
		
		if (count($workday)) {
			$this->form_validation->set_message('_unique_workday', '%s debe ser único');
			return FALSE;
		}
		
		return TRUE;
	}
}