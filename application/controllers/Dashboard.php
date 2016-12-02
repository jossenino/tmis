<?php
class Dashboard extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['meta_title'] = 'TMIS - Inicio';
	}

	public function index(){
		$this->breadcrumbs->push('Inicio', '/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->data['subview'] = 'menu/index';
		$this->load->view('main_layout', $this->data);
	}

	public function viewModelEvent($id){
		$this->data['subview'] = 'menu/index';
		// Fetch a profile or set a new one
		if ($id) {
			$this->load->model('menu/event_m');
			$idUsers = $this->session->userdata('idUsers');
			$this->data['modelEvents'] = $this->event_m->get_by_dashb($id,$idUsers);
			count($this->data['modelEvents']) || $this->data['errors'] = 'no se puedo encontrar el evento';
		}
		// Load the view
		$this->load->view('main_layout',$this->data);
	}
}