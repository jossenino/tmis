<?php
	class Login extends Login_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index ()
	{
		$this->login();
	}

	public function login(){
		// Redirect a user if he's already logged in
		$dashboard = 'dashboard';
		if ($this->user_m->loggedin() != FALSE) {
			if ($this->session->userdata('idProfile') == 1) {
					redirect($dashboard);
				}
				else{
					redirect("dashboard");
				}
		}
		// Set form
		$rules = $this->user_m->rules;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == TRUE) {
			//we can login
			if ($this->user_m->login() == TRUE) {
				redirect($dashboard);
			}
			else {
				$this->session->set_flashdata('error', ' Usuario no exisite, correo o contraseña invalidos');
				redirect('login', 'refresh');
			}
		}
		$this->load->view('login');
	}

	public function logout ()
	{
		$this->user_m->logout();
		redirect('login');
	}
}