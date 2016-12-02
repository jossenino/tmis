<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->data['meta_title'] = 'TMIS - Eventos';
	}

	public function index()
	{
		//Load breadcrums
		$this->breadcrumbs->push('Inicio', '/dashboard');
		$this->breadcrumbs->push('Calendar', 'menu/events');
		$this->data['subview'] = 'menu/events/add_event';
		$this->load->view('main_layout', $this->data);
	}

	public function save()
	{
		$this->form_validation->set_rules('from', 'Desde', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to', 'Hasta', 'trim|required|xss_clean');
        $this->form_validation->set_rules('title', 'Título', 'trim|required|xss_clean');
        $this->form_validation->set_rules('event', 'Evento', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Tipo de evento', 'trim|required|xss_clean');

        $this->form_validation->set_message('required', 'El  %s es requerido');

        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
        	$this->load->model("menu/event_m");
        	$this->event_m->add();
        	redirect("menu/calendar");
        }
	}

	public function getAll()
	{
		if($this->input->is_ajax_request())
		{
			log_message('info', 'metodo getAll');
			$this->load->model('menu/event_m');
			$events = $this->event_m->getAll();
			echo json_encode(
				array(
					"success" => 1,
					"result" => $events
				)
			);
		}
	}

	public function render($id = 0)
	{
		if($id != 0)
		{
			echo $id;
		}
	}

	public function getEvent($id)
	{
		// Fetch a profile or set a new one
		if ($id) {
			$this->load->model('menu/event_m');
			$this->data['events'] = $this->event_m->get_by($id);
			count($this->data['events']) || $this->data['errors'][] = 'turn could not be found';
		}
		// Load the view
		$this->load->view('menu/events/view',$this->data);
	}
}


/* End of file events.php */
/* Location: ./application/controllers/events.php */
