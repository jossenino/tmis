<?php

Class EventsEmail_m extends MY_Model
{

	protected $_table_name = 'events';
	protected $_primary_key = 'id';

	public function getEvents()
	{
		$this->db->select('events.date,TIME(events.date),events.title, users.idUsers,users.email');
		$this->db->from('events');
		$this->db->join('users', 'users.idUsers = events.idUsers', 'inner');
		$this->db->where('YEAR(events.date)', date("Y"));
		$this->db->where('MONTH(events.date)', date("n"));
		$this->db->where('DAY(events.date)', date("d"));
		$this->db->where('TIME(events.date) BETWEEN  TIME(NOW()) and TIME(NOW()+ INTERVAL 5  MINUTE)');
		$eventos = $this->db->get()->result_array();
		log_message('info', $this->db->last_query());
		$array = array();
		foreach ($eventos as $evento) {
			log_message('info','leyendo eventos');
			$array[$evento['idUsers']] = $evento;
		}
		return $array;
	}

	public function enviarCorreoMasivoThirtyMin()
	{
		$this->db->select('events.date,TIME(events.date),events.title, users.idUsers,users.email');
		$this->db->from('events');
		$this->db->join('users', 'users.idUsers = events.idUsers', 'inner');
		$this->db->where('YEAR(events.date)', date("Y"));
		$this->db->where('MONTH(events.date)', date("n"));
		$this->db->where('DAY(events.date)', date("d"));
		$this->db->where('TIME(events.date) BETWEEN  TIME(NOW()) and TIME(NOW()+ INTERVAL 30  MINUTE)');
		$eventos = $this->db->get()->result_array();
		//log_message('info', $this->db->last_query());
		$array = array();
		foreach ($eventos as $evento) {
			log_message('info','leyendo eventos');
			$array[$evento['idUsers']] = $evento;
		}
		return $array;
	}

	public function enviarCorreoMasivoFortyFiveMin()
	{
		$this->db->select('events.date,TIME(events.date),events.title, users.idUsers,users.email');
		$this->db->from('events');
		$this->db->join('users', 'users.idUsers = events.idUsers', 'inner');
		$this->db->where('YEAR(events.date)', date("Y"));
		$this->db->where('MONTH(events.date)', date("n"));
		$this->db->where('DAY(events.date)', date("d"));
		$this->db->where('TIME(events.date) BETWEEN  TIME(NOW()) and TIME(NOW()+ INTERVAL 45  MINUTE)');
		$eventos = $this->db->get()->result_array();
		//log_message('info', $this->db->last_query());
		$array = array();
		foreach ($eventos as $evento) {
			log_message('info','leyendo eventos');
			$array[$evento['idUsers']] = $evento;
		}
		return $array;
	}
}