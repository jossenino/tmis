<?php 
	class Company_M extends MY_Model{
		protected $_table_name = 'companys';
		protected $_primary_key = 'id';
		protected $_order_by = 'id';
		public $rules = array(
			'companyName' => array(
				'field' => 'companyName', 
				'label' => 'Nombre Empresa', 
				'rules' => 'trim|required'
			), 
			'typeDocument' => array(
				'field' => 'typeDocument', 
				'label' => 'Tipo documento', 
				'rules' => 'trim|required'
			),
			'numberDocument' => array(
				'field' => 'numberDocument', 
				'label' => 'Número documento', 
				'rules' => 'trim|required'
			),
			'class' => array(
				'field' => 'class', 
				'label' => 'Tipo cliente', 
				'rules' => 'trim|required'
			),
			'phone' => array(
				'field' => 'phone', 
				'label' => 'Teléfono', 
				'rules' => 'trim|required'
			),
			'email' => array(
				'field' => 'email', 
				'label' => 'Correo electrónico', 
				'rules' => 'trim|required'
			),
			'direction' => array(
				'field' => 'direction', 
				'label' => 'Dirección', 
				'rules' => 'trim|required'
			),
			'status' => array(
				'field' => 'status', 
				'label' => 'Estado', 
				'rules' => 'trim|required'
			),
			'country' => array(
				'field' => 'country', 
				'label' => 'Pais', 
				'rules' => 'trim|required'
			),
			'state' => array(
				'field' => 'state', 
				'label' => 'Estado', 
				'rules' => 'trim|required'
			),
			'city' => array(
				'field' => 'city', 
				'label' => 'Ciudad', 
				'rules' => 'trim|required'
			)
		);

		function __construct()
		{
			parent::__construct();
		}

		public function get_new(){
			$company = new stdClass();
			$company->companyName = '';
			$company->typeDocument = '';
			$company->numberDocument = '';
			$company->class = '';
			$company->phone = '';
			$company->email = '';
			$company->direction = '';
			$company->status = '';
			return $company;
		}

		public function getCompanyId($idCompany){
			$this->db->select('companyName');
			$this->db->from('companys');
			$this->db->where('id', $idCompany);
			$companyID = $this->db->get()->result_array();
			return $companyID;
		}

		/*public function getProfiles_id()
		{
			$profile_id = get_by(array('email' => $this->input->post('email'), 'password' => $this->hash($this->input->post('password'))), TRUE);
			return $profile_id;
		}*/
	}