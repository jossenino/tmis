<?php

class State_M extends MY_Model{
	protected $_table_name = 'state';
	protected $_primary_key = 'id';
	protected $_order_by = 'state';
	public $rules = array(
		'state' => array(
			'field' => 'state', 
			'label' => 'Estado', 
			'rules' => 'trim|required'
		),
		'idCountry' => array(
			'field' => 'idCountry', 
			'label' => 'Id Pais', 
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
}