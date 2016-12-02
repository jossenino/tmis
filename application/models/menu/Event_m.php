<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_m extends MY_Model 
{
	protected $_table_name = 'events';
	protected $_primary_key = 'id';
	public $rules = array(
		'title' => array(
			'field' => 'title', 
			'label' => 'Títul', 
			'rules' => 'trim|required'
		), 
		'description' => array(
			'field' => 'description', 
			'label' => 'Descripción', 
			'rules' => 'trim|required'
		),
		'color' => array(
			'field' => 'color', 
			'label' => 'Color', 
			'rules' => 'required'
		),
		'time' => array(
			'field' => 'time', 
			'label' => 'Tiempo', 
			'rules' => 'required'
		),
		'endDate' => array(
			'field' => 'endDate', 
			'label' => 'Fecha Término', 
			'rules' => 'required'
		)
	);

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Europe/Madrid"); 
	}

	/**
	* @desc - añade un nuevo evento
	* @access public
	* @author Iparra
	* @return bool
	*/
	public function add()
	{
		$this->db->set("start", $this->_formatDate($this->input->post("from")));
		$this->db->set("end", $this->_formatDate($this->input->post("to")));
		$this->db->set("url", $this->input->post("url"));
		$this->db->set("title", $this->input->post("title"));
		$this->db->set("body", $this->input->post("event"));
		$this->db->set("class", $this->input->post("class"));
		$this->db->set("startDay", $this->input->post("from"));
		$this->db->set("endDay", $this->input->post("to"));
		$this->db->set("status", '1');
		$this->db->set("idUsers", $this->session->userdata('idUsers'));
		if($this->db->insert("events"))
		{
			$insert_id = $this->db->insert_id();
			$urlEvent = base_url().'index.php/menu/events/getEvent/'.$insert_id;
			$dataUpdateto = array(
					'url' => $urlEvent
				);
			$this->db->where('id', $insert_id);
			$this->db->update('events', $dataUpdateto); 
			return TRUE;
		}
		return FALSE;
	}

	/**
	* @desc - obtiene todos los registros de events
	* @access public
	* @author Iparra
	* @return object
	*/
	public function get_new(){
		$events = new stdClass();
		$events->title = '';
		$events->body = '';
		$events->url = '';
		$events->class = '';
		$events->star = '';
		$events->starDay = '';
		$events->end = '';
		$events->endDay = '';
		return $events;
	}

	public function getAll()
	{
		$query = $this->db->get('events');
		if($query->num_rows() > 0)
		{
			 log_message('info', $query->result());
			return $query->result();
		}
		log_message('error','Consulta vacia');
		return 'vacio';
	}

	public function get_by_dashb($id = NULL, $idUsers = NULL)
	{
		$this->db->where('id', $id);
		$this->db->where('idUsers', $idUsers);
		$query = $this->db->get('events');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return object();
	}
	/**
	* @desc - formatea una fecha a microtime para añadir al evento tipo 1401517498985
	* @access private
	* @author Iparra
	* @return strtotime
	*/
	private function _formatDate($date)
	{
		return strtotime(substr($date, 6, 4)."-".substr($date, 3, 2)."-".substr($date, 0, 2)." " .substr($date, 10, 6)) * 1000;
	}

	/*Read the data from DB */
	Public function getEvents()
	{
		$query = $this->db->get()->result_array();
		if($query->num_rows() > 0)
		{
			$events = array();
			foreach ($query as $event) {
				$e = array();
			    $e['id'] = $event['id'];
			    $e['title'] = $event['title'];
			    $e['start'] = $event['date'];
			    $e['end'] = $event['endDate'];
			    log_message('info', print_r($query,TRUE));
			    array_push($events, $e);
			}
			log_message('info', $query->result());
			return $query->result();
		}

	}

/*Create new events */

	Public function addEvent()
	{

	$sql = "INSERT INTO events (title,events.date, description, color) VALUES (?,?,?,?)";
	$this->db->query($sql, array($_POST['title'], $_POST['date'], $_POST['description'], $_POST['color']));
		return ($this->db->affected_rows()!=1)?false:true;
	}

	/*Update  event */

	Public function updateEvent()
	{

	$sql = "UPDATE events SET title = ?, events.date = ?, description = ?, color = ? WHERE id = ?";
	$this->db->query($sql, array($_POST['title'], $_POST['date'], $_POST['description'], $_POST['color'], $_POST['id']));
		return ($this->db->affected_rows()!=1)?false:true;
	}


	/*Delete event */

	Public function deleteEvent()
	{

	$sql = "DELETE FROM events WHERE id = ?";
	$this->db->query($sql, array($_GET['id']));
		return ($this->db->affected_rows()!=1)?false:true;
	}

	/*Update  event */

	Public function dragUpdateEvent()
	{
			$date=date('Y-m-d h:i:s',strtotime($_POST['date']));

			$sql = "UPDATE events SET  events.date = ? WHERE id = ?";
			$this->db->query($sql, array($date, $_POST['id']));
		return ($this->db->affected_rows()!=1)?false:true;


	}
}
/* End of file events_model.php */
/* Location: ./application/models/events_model.php */