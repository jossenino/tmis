<?php

class Profile_M extends MY_Model{
	protected $_table_name = 'profiles';
	protected $_primary_key = 'idProfile';
	protected $_order_by = 'profile';
	public $rules = array(
		'profile' => array(
			'field' => 'profile', 
			'label' => 'Perfil', 
			'rules' => 'trim|required'
		), 
		'description' => array(
			'field' => 'description', 
			'label' => 'Descripción', 
			'rules' => 'trim|required'
		)
	);

	function __construct(){
		parent::__construct();
	}
	
	public function get_new(){
		$profile = new stdClass();
		$profile->profile = '';
		$profile->description = '';
		return $profile;
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
}