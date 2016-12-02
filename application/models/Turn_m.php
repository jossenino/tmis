<?php

class Turn_M extends MY_Model{
	protected $_table_name = 'turns';
	protected $_primary_key = 'idTurn';
	protected $_order_by = 'idTurn';
	public $rules = array(
		'turn' => array(
			'field' => 'turn', 
			'label' => 'Turno', 
			'rules' => 'trim|required'
		), 
		'typeTurn' => array(
			'field' => 'typeTurn', 
			'label' => 'Tipo turno', 
			'rules' => 'trim|required'
		),
		'status' => array(
			'field' => 'status', 
			'label' => 'Estado', 
			'rules' => 'trim|required'
			)
	);

	function __construct(){
		parent::__construct();
	}
	
	public function get_new(){
		$turn = new stdClass();
		$turn->turn = '';
		$turn->typeTurn = '';
		$turn->status = '';
		return $turn;
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