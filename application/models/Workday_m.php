<?php

class Workday_M extends MY_Model{
	protected $_table_name = 'workday';
	protected $_primary_key = 'idWorkday';
	protected $_order_by = 'idWorkday';
	public $rules = array(
		'workday' => array(
			'field' => 'workday', 
			'label' => 'Jornada', 
			'rules' => 'trim|required'
		), 
		'typeWorkday' => array(
			'field' => 'typeWorkday', 
			'label' => 'Tipo jornada', 
			'rules' => 'trim|required'
		),
		'status' => array(
			'field' => 'status', 
			'label' => 'Estado', 
			'rules' => 'trim|required'
		),
		'idTurn' => array(
			'field' => 'idTurn', 
			'label' => 'id Turno', 
			'rules' => 'trim|required'
		)
	);

	function __construct(){
		parent::__construct();
	}
	
	public function get_new(){
		$workday  = new stdClass();
		$workday ->workday  = '';
		$workday ->typeWorkday = '';
		$workday ->status = '';
		$workday ->idTurn = '';
		return $workday;
	}

	/*public function getProfiles_id($email, $password)
	{
		//$profile_id = get_by(array('email' => $this->input->post('email'), 'password' => $this->hash($this->input->post('password'))), TRUE);
		$profile_id = $this->get_by(array('email' => $email, 'password' => $this->hash($password)), TRUE);
		return $profile_id;
	}*/

	/*public function getProfiles_id()
	{
		$profile_id = get_by(array('email' => $this->input->post('email'), 'password' => $this->hash($this->input->post('password'))), TRUE);
		return $profile_id;
	}*/
}