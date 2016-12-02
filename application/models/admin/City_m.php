<?php

class City_M extends MY_Model{
	protected $_table_name = 'city';
	protected $_primary_key = 'id';
	protected $_order_by = 'city';
	public $rules = array(
		'city' => array(
			'field' => 'city', 
			'label' => 'Ciudad', 
			'rules' => 'trim|required'
		),
		'idState' => array(
			'field' => 'idState', 
			'label' => 'Id Estado', 
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