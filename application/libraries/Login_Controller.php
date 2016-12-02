<?php
class Login_Controller extends CI_Controller{
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
    }
}