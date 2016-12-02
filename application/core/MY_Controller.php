<?php
class MY_Controller extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->data['site_name'] = config_item('site_name');
        $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->model('user_m');
        $this->data['errors'] = array();

        //Login check
		$exception_uris = array(
			'login/login', 
			'login/logout',
			'login'
		);
		//register check
		$exception_uris_register = array(
			'register/registerNewClient',
			'register/registerNewClientSave',
			'register/registerNewUser',
			'register/registerNewUserSave',
			'admin/user/recoverPassword'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ($this->user_m->loggedin() == FALSE) {
				if (in_array(uri_string(), $exception_uris_register) == FALSE) {
					redirect('login');
				}
			}
		}

		$this->load->model('navBar_m');

        //fetch navigation
        $this->data['menu'] = $this->navBar_m->get_nested();

        //obteniendo todos los eventos
		$this->load->model('menu/event_m');
		$events = $this->event_m->get_by(array('idUsers'=>$this->session->userdata('idUsers')));
		$this->data['events'] = $events;
		//contador de eventos por usuario
		$eventsCount = 0;
		foreach ($events as $evento) {
			$eventsCount++;
		}
		$this->load->model('user_m');
		$this->data['users'] = $this->user_m->get();
		//load emailTmis model
		$this->load->model('menu/email/emailTmis_m');
		//get all email by user
		$emailsByUser = $this->emailTmis_m->get_by_Count(array('idUsers'=>$this->session->userdata('idUsers')));
		log_message('info', 'total de correos ' . $emailsByUser);
		//Load model Clientes
		$this->load->model("menu/client_m");
		//get all client by user
		$clientsByUser = $this->client_m->get_by_Count(array('idUsers'=>$this->session->userdata('idUsers')));
		//Load model cronograma
		$this->load->model("menu/schedule_m");
		//get all cronograma by user
		$scheduleByUser = $this->schedule_m->get_by_Count(array('idUsers'=>$this->session->userdata('idUsers')));
		$this->data['eventsCount'] = $eventsCount;
		$this->data['emailCount'] = $emailsByUser;
		$this->data['clientsByUser'] = $clientsByUser;
		$this->data['scheduleByUser'] = $scheduleByUser;
    }
}