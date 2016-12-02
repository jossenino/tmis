<?php
	/**
	* Clientes (Get,Insert, update y delete)
	*/
	class Inbox extends MY_Controller{
		public function __construct(){
			parent::__construct();
			$this->data['meta_title'] = 'TMIS - Inbox';
			$this->data['active_navBar'] = 'active';
		}

		public function index ()
		{
			//Load breadcrums
			$this->breadcrumbs->push('Inicio', '/dashboard');
			$this->breadcrumbs->push('Inbox', 'menu/inbox');
			$this->data['breadcrumbs'] = $this->breadcrumbs->show();
			//load emailTmis model
			$this->load->model('menu/email/emailTmis_m');
			// Fetch all emails
			$this->data['emails'] = $this->emailTmis_m->get();
			// Load view
			$this->data['subview'] = 'menu/inbox/index';
			//$this->data['NameView'] = 'Usuarios';
			$this->load->view('main_layout', $this->data);
		}

		public function edit ($id = NULL)
		{
			//load model client
			$this->load->model('menu/schedule_m');
			// Fetch a profile or set a new one
			if ($id) {
				$this->data['schedules'] = $this->schedule_m->get($id);
				count($this->data['schedules']) || $this->data['errors'][] = 'turn could not be found';
			}
			else {
				$this->data['schedules'] = $this->schedule_m->get_new();
			}
			
			// Set up the form
			$rules = $this->schedule_m->rules;
			$id || $rules['schedule']['rules'] .= '|required';
			$this->form_validation->set_rules($rules);
			$total = $this->input->post('pay') * $this->input->post('hourValue');
			// Process the form
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'idUsers' =>  $this->input->post('idUsers'), 
					'idClient' => $this->input->post('idClient'), 
					'day' => $this->input->post('day'), 
					'startDate' => $this->input->post('startDate'), 
					'endDate' => $this->input->post('endDate'),
					'hourValue' => $this->input->post('hourValue'),
					'pay' => $this->input->post('pay'),
					'documento' => $this->input->post('documento'),
					'total' => $total);
				$this->schedule_m->save($data, $id);
				redirect('menu/clientSchedule/index');
			}
			//get users
			$this->load->model('user_m');
			$this->data['users'] = $this->user_m->get();
			//get clients
			$this->load->model('menu/client_m');
			$this->data['clients'] = $this->client_m->get_by(array('idUsers'=>$this->session->userdata('idUsers')));
			// Load the view
			$this->data['subview'] = 'menu/schedule/edit';
			$this->load->view('main_layout', $this->data);
		}

		public function delete ($id)
		{
			//load model client
			$this->load->model('menu/schedule_m');
			$this->schedule_m->delete($id);
			redirect('menu/clientSchedule');
		}
	}