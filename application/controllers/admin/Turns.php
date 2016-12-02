<?php

class turns extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['meta_title'] = 'TMIS - Turnos';
	}

	public function index ()
	{
		//Load breadcrums
		$this->breadcrumbs->push('Inicio', '/dashboard');
		$this->breadcrumbs->push('Turnos', 'menu/turnos');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		//Load model turn
		$this->load->model('turn_m');
		// Fetch all profile
		$this->data['turns'] = $this->turn_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/turns/index';
		//$this->data['NameView'] = 'Usuarios';
		$this->load->view('main_layout', $this->data);
	}

	public function edit ($id = NULL)
	{
		//load model events
		$this->load->model('turn_m');
		// Fetch a profile or set a new one
		if ($id) {
			$this->data['turns'] = $this->turn_m->get($id);
			count($this->data['turns']) || $this->data['errors'][] = 'turn could not be found';
		}
		else {
			$this->data['turns'] = $this->turn_m->get_new();
		}
		
		// Set up the form
		$rules = $this->turn_m->rules;
		$id || $rules['turns']['rules'] .= '|required';
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->turn_m->array_from_post(array('turn', 'typeTurn'));
			$this->turn_m->save($data, $id);
			redirect('admin/turn');
		}
		
		// Load the view
		$this->data['subview'] = 'admin/turns/edit';
		$this->load->view('main_layout', $this->data);
	}

	public function delete ($id)
	{
		$this->turn_m->delete($id);
		redirect('admin/turns');
	}

	public function _unique_turn ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current profile
		
		$id = $this->uri->segment(4);
		$this->db->where('turn', $this->input->post('turn'));
		!$id || $this->db->where('idTurn !=', $id);
		$profile = $this->turn_m->get();
		
		if (count($profile)) {
			$this->form_validation->set_message('_unique_turn', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
}