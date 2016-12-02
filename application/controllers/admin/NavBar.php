<?php

class NavBar extends Admin_Controller{
	public function __construct (){
		parent::__construct();
		$this->data['meta_title'] = 'TMIS - Páginas';
		$this->load->model('navBar_m');
	}

	public function index ()
	{
		// Fetch all pages
		$this->data['navBars'] = $this->navBar_m->get_with_parent();
		//Load breadcrums
		$this->breadcrumbs->push('Inicio', '/dashboard');
		$this->breadcrumbs->push('Páginas', 'admin/navBar');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		// Load view
		$this->data['subview'] = 'admin/navBar/index';
		$this->data['NameView'] = 'Paginas';
		$this->load->view('main_layout', $this->data);
	}

	public function edit ($id = NULL)
	{
		//Load breadcrums
		$this->breadcrumbs->push('Inicio', '/dashboard');
		$this->breadcrumbs->push('Páginas', 'admin/navBar');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		// Fetch a page or set a new one
		if ($id) {
			$this->data['navBar'] = $this->navBar_m->get($id);
			count($this->data['navBar']) || $this->data['errors'][] = 'navBars could not be found';
		}
		else {
			$this->data['navBar'] = $this->navBar_m->get_new();
		}
		
		// Pages for dropdown
		$this->data['pages_no_parents'] = $this->navBar_m->get_no_parents();
		
		// Set up the form
		$rules = $this->navBar_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->navBar_m->array_from_post(array('url','nombreNavBar','idMenuSubMenu','iconClass','dropdown','order','status'));
			$this->navBar_m->save($data, $id);
			redirect('admin/navBar');
		}
		
		// Load the view
		$this->data['subview'] = 'admin/navBar/edit';
		$this->load->view('main_layout', $this->data);
	}

	public function delete ($id)
	{
		$this->navBar_m->delete($id);
		redirect('admin/navBar');
	}

	public function _unique_slug ($str)
	{
		// Do NOT validate if slug already exists
		// UNLESS it's the slug for the current page
		

		$id = $this->uri->segment(4);
		$this->db->where('nombreNavBar', $this->input->post('nombreNavBar'));
		! $id || $this->db->where('id !=', $id);
		$page = $this->navBar_m->get();
		
		if (count($page)) {
			$this->form_validation->set_message('_unique_slug', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
}