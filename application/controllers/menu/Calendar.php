<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends MY_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->data['meta_title'] = 'TMIS - Calendario';
		$this->load->model('menu/event_m');
	}

	public function index()
	{
		//Load breadcrums
		$this->breadcrumbs->push('Inicio', '/dashboard');
		$this->breadcrumbs->push('Calendar', 'menu/calendar');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->data['subview'] = 'menu/events/calendar';
		//obteniendo todos los eventos
		$this->load->model('menu/event_m');
		$events = $this->event_m->get_by(array('idUsers'=>$this->session->userdata('idUsers')));
		$this->data['events'] = $events;
		//contador de eventos por usuario
		$eventsCount = 0;
		foreach ($events as $evento) {
			$eventsCount++;
		}
		//load user model
		$this->load->model('user_m');
		//get all user
		$this->data['users'] = $this->user_m->get();
		//load emailTmis model
		$this->load->model('menu/email/emailTmis_m');
		//get all email by user
		$emailsByUser = $this->emailTmis_m->get_by_Count(array('idUsers'=>$this->session->userdata('idUsers')));
		log_message('info', 'total de correos ' . $emailsByUser);
		$this->data['eventsCount'] = $eventsCount;
		$this->data['emailCount'] = $emailsByUser;
		$this->data['totalNotifications'] = $eventsCount + $emailsByUser;
		$this->load->view('menu/events/event', $this->data);
	}

	/*Get all Events */

	Public function getEvents()
	{
		$events = array();
		$result=$this->event_m->get_by(array('idUsers'=>$this->session->userdata('idUsers')));
		foreach ($result as $event) {
			$e = array();
		    $e['id'] = $event->id;
		    $e['title'] = $event->title;
		    $e['start'] = $event->date;
		    $e['end'] = $event->endDate;
		    $e['description'] = $event->description;
		    $e['color'] = $event->color;
		    array_push($events, $e);
		}
		echo json_encode($events);
	}
	/*Add new event */
	Public function addEvent($id = NULL)
	{
		// Set up the form
		$rules = $this->event_m->rules;
		$this->form_validation->set_rules($rules);
			$data = array(
			'title' => $this->input->post('title') ,
			'description' => $this->input->post('description') ,
			'url' => $this->input->post('url') ,
			'color' => $this->input->post('color') ,
			'date' => $this->input->post('date') ,
			'endDate' => $this->input->post('endDate') ,
			'typeEvent' => $this->input->post('typeEvent') ,
			'status' => $this->input->post('status') ,
			'idUsers' => $this->session->userdata('idUsers'));
		$this->event_m->save($data, $id);
		$this->enviarCorreo($this->input->post('title'),$this->input->post('date'),$this->input->post('endDate'),$this->input->post('typeEvent'),$this->input->post('description'));
	}
	/*Add new event */
	Public function save($id = NULL)
	{
		// Set up the form
		$rules = $this->event_m->rules;
		$this->form_validation->set_rules($rules);
		$data = array(
			'title' => $this->input->post('title') ,
			'description' => $this->input->post('description') ,
			'url' => $this->input->post('url') ,
			'color' => $this->input->post('color2') ,
			'date' => $this->input->post('startDate') ,
			'endDate' => $this->input->post('finalDate') ,
			'typeEvent' => $this->input->post('typeEvent') ,
			'status' => 1 ,
			'idUsers' => $this->session->userdata('idUsers'));
		$this->event_m->save($data, $id);
		redirect('menu/calendar');
	}
	/*Update Event */
	Public function updateEvent()
	{
		$id = $_POST['id'];
		$data = $this->event_m->array_from_post(array('title', 'description','url','color','date','endDate','typeEvent','status'));
		$this->event_m->save($data, $id);
		redirect('menu/calendar');
	}
	/*Delete Event*/
	Public function deleteEvent()
	{
		$result=$this->event_m->deleteEvent();
		echo $result;
	}
	Public function dragUpdateEvent()
	{	

		$result=$this->event_m->dragUpdateEvent();
		echo $result;
	}

	public function enviarCorreo($title,$date,$endDate,$typeEvent,$description){
	//configuracion para gmail
	$configGmail = config_item('configGmail');
	//cargamos la libreria para enviar correo
    $this->email->initialize($configGmail);
    $this->email->set_newline("\r\n");
	//datos del correo
	$this->email->from('jossenino@gmail.com','Josse Niño');
	$this->email->to($this->session->userdata('email'));
	$this->email->subject('Notificación de evento');
	$this->email->message('<h2>Usted ha creado el evento ' . $title .' para el día ' . $date . ' que dura hasta ' . $endDate . '</h2><hr><br> Bienvenido al blog');
		//con esto podemos ver el resultado
		if ($this->email->send()) 
	    {
	        $this->data['mensaje'] =  "Your Email has been sent successfully... !!";
	    }
	    else
	    {
	        log_message('error', 'pasando por addevent');
	    }
    redirect('menu/calendar');
	}
}

/* End of file calendar.php */
/* Location: ./application/controllers/calendar.php */