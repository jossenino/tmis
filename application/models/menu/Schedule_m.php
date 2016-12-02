<?php 
	class Schedule_M extends MY_Model{
		protected $_table_name = 'schedule';
		protected $_primary_key = 'id';
		protected $_order_by = 'id';
		public $rules = array(
			'day' => array(
				'field' => 'day', 
				'label' => 'Día de pago', 
				'rules' => 'trim|required'
			),
			'startDate' => array(
				'field' => 'startDate', 
				'label' => 'Fecha inicio', 
				'rules' => 'trim|required'
			),
			'endDate' => array(
				'field' => 'endDate', 
				'label' => 'Fecha culminación', 
				'rules' => 'trim|required'
			),
			'hourValue' => array(
				'field' => 'hourValue', 
				'label' => 'Valor de la hora', 
				'rules' => 'trim|required'
			),
			'pay' => array(
				'field' => 'pay', 
				'label' => 'Pago', 
				'rules' => 'trim|required'
			),
			'documento' => array(
				'field' => 'documento', 
				'label' => 'Documento', 
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