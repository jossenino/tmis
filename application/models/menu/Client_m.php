<?php 
	class Client_M extends MY_Model{
		protected $_table_name = 'clients';
		protected $_primary_key = 'id';
		protected $_order_by = 'id';
		public $rules = array(
			'clientName' => array(
				'field' => 'clientName', 
				'label' => 'Nombre cliente', 
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

		public $rules_registration = array(
			'clientName' => array(
				'field' => 'clientName', 
				'label' => 'Nombre cliente', 
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
			$client = new stdClass();
			$client->clientName = '';
			$client->typeDocument = '';
			$client->numberDocument = '';
			$client->class = '';
			$client->phone = '';
			$client->email = '';
			$client->direction = '';
			$client->status = '';
			return $client;
		}

		public function get_clients()
		{
			$this->db->select('clients.*,`p`.state as estado, `c`.city as ciudad, `country`.`country` as pais');
			$this->db->from('clients');
			$this->db->join('country', 'country.id = clients.country', 'inner');
			$this->db->join('state p','p.id = clients.state', 'inner');
			$this->db->join('city c','c.id = clients.city', 'inner');
			$this->db->where('clients.idUsers', $this->session->userdata('idUsers'));
			$this->db->where('clients.status', 1);
			$clients = $this->db->get()->result();
			return $clients;
		}
	}