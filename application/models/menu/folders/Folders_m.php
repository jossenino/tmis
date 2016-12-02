<?php 
	class Folders_M extends MY_Model{
		protected $_table_name = 'folders';
		protected $_primary_key = 'id';
		protected $_order_by = 'id';
		public $rules = array(
			'idUsers' => array(
				'field' => 'idUsers', 
				'label' => 'Nombre usuario', 
				'rules' => 'trim|required'
			), 
			'folderLocation' => array(
				'field' => 'folderLocation', 
				'label' => 'Directorio de la carpeta', 
				'rules' => 'trim|required'
			)
		);

		function __construct()
		{
			parent::__construct();
		}

		public function get_new(){
			$folders = new stdClass();
			$folders->idUsers = '';
			$folders->folderLocation = '';
			return $folders;
		}
	}