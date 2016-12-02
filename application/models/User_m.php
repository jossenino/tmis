<?php

class User_M extends MY_Model{
	protected $_table_name = 'users';
	protected $_primary_key = 'idUsers';
	protected $_order_by = 'userName';
	public $rules = array(
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|required|valid_email'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required'
		)
	);

	public $rules_admin = array(
		'userName' => array(
			'field' => 'userName', 
			'label' => 'User name', 
			'rules' => 'alpha|required'
		), 
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|required|valid_email|callback__unique_email'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|matches[password_confirm]'
		),
		'password_confirm' => array(
			'field' => 'password_confirm', 
			'label' => 'Confirm password', 
			'rules' => 'trim|matches[password]'
		),
		'status' => array(
			'field' => 'status', 
			'label' => 'Estado', 
			'rules' => 'trim|required'
		),
		'profile' => array(
			'field' => 'profile', 
			'label' => 'Perfil', 
			'rules' => 'trim|required'
		),
		'company' => array(
			'field' => 'company', 
			'label' => 'Compañia', 
			'rules' => 'trim|required'
		)
	);

	public $rules_registration = array(
		'userName' => array(
			'field' => 'userName', 
			'label' => 'User name', 
			'rules' => 'alpha|required'
		), 
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|required|valid_email'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|matches[password_confirm]'
		),
		'password_confirm' => array(
			'field' => 'password_confirm', 
			'label' => 'Confirm password', 
			'rules' => 'trim|matches[password]'
		),
		'company' => array(
			'field' => 'company', 
			'label' => 'Compañia', 
			'rules' => 'trim|required'
		)
	);

	function __construct(){
		parent::__construct();
	}

	public function login ()
	{
		$user = $this->get_by(array(
			'email' => $this->input->post('email'),
			'password' => $this->hash($this->input->post('password')),
		), TRUE);
		
		if (count($user)) {
			// Log in user
			$data = array(
				'userName' => $user->userName,
				'email' => $user->email,
				'idUsers' => $user->idUsers,
				'loggedin' => TRUE,
				'idProfile' => $user->idProfile,
				'idCompany' => $user->idCompany
			);
			$this->session->set_userdata($data);
		}
	}

	public function logout ()
	{
		$this->session->sess_destroy();
	}

	public function loggedin ()
	{
		return (bool) $this->session->userdata('loggedin');
	}
	
	public function get_new(){
		$user = new stdClass();
		$user->name = '';
		$user->email = '';
		$user->password = '';
		$user->status = '';
		$user->idCompany = '';
		return $user;
	}

	public function hash ($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}

	/*public function getProfiles_id($email, $password)
	{
		//$profile_id = get_by(array('email' => $this->input->post('email'), 'password' => $this->hash($this->input->post('password'))), TRUE);
		$profile_id = $this->get_by(array('email' => $email, 'password' => $this->hash($password)), TRUE);
		return $profile_id;
	}*/

	public function getProfiles_id()
	{
		$profile_id = get_by(array('email' => $this->input->post('email'), 'password' => $this->hash($this->input->post('password'))), TRUE);
		return $profile_id;
	}

	public function getLawyer($lawyer){
		$this->db->select('userName');
		$this->db->from('users');
		$this->db->where('idUsers', $lawyer);
		$companyID = $this->db->get()->result_array();
		return $companyID;
	}

	public function getCompanyId($lawyer){
		$this->db->select('idCompany');
		$this->db->from('users');
		$this->db->where('idUsers', $lawyer);
		$companyID = $this->db->get()->result_array();
		return $companyID;
	}
}