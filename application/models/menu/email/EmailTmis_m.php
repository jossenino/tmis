<?php

class EmailTmis_M extends MY_Model{
	protected $_table_name = 'emailTmis';
	protected $_primary_key = 'id';
	protected $_order_by = 'id';
	public $rules = array(
		'email' => array(
			'field' => 'email', 
			'label' => 'Correo usuario', 
			'rules' => 'trim|required'
		), 
		'title' => array(
			'field' => 'description', 
			'label' => 'Descripción', 
			'rules' => 'trim|required'
		), 
		'body' => array(
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
}