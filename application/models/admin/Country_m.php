<?php

class Country_M extends MY_Model{
	protected $_table_name = 'country';
	protected $_primary_key = 'id';
	protected $_order_by = 'country';
	public $rules = array(
		'country' => array(
			'field' => 'country', 
			'label' => 'País', 
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