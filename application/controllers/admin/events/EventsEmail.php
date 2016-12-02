<?php 
class EventsEmail extends CI_Controller
{
	 function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        //var message
		$this->data['mensaje'] = "";

    }
	public function enviarCorreoMasivo(){
		$this->load->model('eventsEmail_m');
		$eventos = $this->eventsEmail_m->getEvents();
	    //configuracion para gmail
		$configGmail = config_item('configGmail');
		//cargamos la libreria para enviar correo
	    $this->email->initialize($configGmail);
	    $this->email->set_newline("\r\n");
		//datos del correo
		foreach ($eventos as $evento) {
			$CodigoHtml =
	        "<!DOCTYPE html> " .
	        "<html> " .
	        "<head> " .
	        "<title>TODO supply a title</title> " .
	        "<meta charset='UTF-8'>  " .
	        "<meta name='viewport' content='width=device-width, initial-scale=1.0'> " .
	        "</head> " .
	        "<body> " .
	        "<div style='width: 720px;height: 184px; overflow: hidden; border-radius: 10px;  background: no-repeat center center url(http://localhost/TMIS/public_html/img/tmis_logo_correo.jpg) #3c8dbc; color: white;clear: both;margin:auto;text-align: center;'></div> " .
	        "<div style='width: 700px;height: auto; padding: 10px; background-color: #ecf0f5; border-radius: 10px; font-size: 18px;  color: black;clear: both;margin:auto; margin-top: 10px; text-align: center;'> " .
	            'Le recordamos que dentro los próximos 5 minutos usted tiene programado un evento de ' . $evento['date']. ' Muchas gracias' .
	        "<div style='width: 680px;height: auto; overflow: hidden; padding: 10px;  color: white;  border-radius: 10px;  background-color: #3c8dbc; ;color: white;clear: both;margin:auto; margin-top:10px; text-align: center;'> T-MIS C.A. Telefono: 0212-2377200.</div> " .
	        "</body> " .
	        "</html>";
			log_message('info', 'enviando correo de notificacion');
			$this->email->from('informacion@tmis.com.ve','Demo');
			$this->email->to($evento['email']);
			$this->email->subject('Notificación de evento');
			$this->email->message($CodigoHtml);
			//con esto podemos ver el resultado
			if ($this->email->send()) 
		    {
		        $this->data['mensaje'] =  "Your Email has been sent successfully... !!";
		    }
		    else
		    {
		        log_message('error', 'pasando por addevent');
		    }
		}
	    redirect('menu/calendar');
	}

	public function enviarCorreoMasivoThirtyMin(){
		$this->load->model('eventsEmail_m');
		$eventos = $this->eventsEmail_m->getEventsThirtyMin();
	    //configuracion para gmail
		$configGmail = config_item('configGmail');
		//cargamos la libreria para enviar correo
	    $this->email->initialize($configGmail);
	    $this->email->set_newline("\r\n");
		//datos del correo
		foreach ($eventos as $evento) {
			$CodigoHtml =
	        "<!DOCTYPE html> " .
	        "<html> " .
	        "<head> " .
	        "<title>TODO supply a title</title> " .
	        "<meta charset='UTF-8'>  " .
	        "<meta name='viewport' content='width=device-width, initial-scale=1.0'> " .
	        "</head> " .
	        "<body> " .
	        "<div style='width: 720px;height: 184px; overflow: hidden; border-radius: 10px;  background: no-repeat center center url(http://localhost/TMIS/public_html/img/tmis_logo_correo.jpg) #3c8dbc; color: white;clear: both;margin:auto;text-align: center;'></div> " .
	        "<div style='width: 700px;height: auto; padding: 10px; background-color: #ecf0f5; border-radius: 10px; font-size: 18px;  color: black;clear: both;margin:auto; margin-top: 10px; text-align: center;'> " .
	            'Le recordamos que dentro los próximos 30 minutos usted tiene programado un evento de ' . $evento['date']. ' Muchas gracias' .
	        "<div style='width: 680px;height: auto; overflow: hidden; padding: 10px;  color: white;  border-radius: 10px;  background-color: #3c8dbc; ;color: white;clear: both;margin:auto; margin-top:10px; text-align: center;'> T-MIS C.A. Telefono: 0212-2377200.</div> " .
	        "</body> " .
	        "</html>";
			log_message('info', 'enviando correo de notificacion');
			$this->email->from('informacion@tmis.com.ve','Demo');
			$this->email->to($evento['email']);
			$this->email->subject('Notificación de evento');
			$this->email->message($CodigoHtml);
			//con esto podemos ver el resultado
			if ($this->email->send()) 
		    {
		        $this->data['mensaje'] =  "Your Email has been sent successfully... !!";
		    }
		    else
		    {
		        log_message('error', 'pasando por addevent');
		    }
		}
	    redirect('menu/calendar');
	}

	public function enviarCorreoMasivoFortyFiveMin(){
		$this->load->model('eventsEmail_m');
		$eventos = $this->eventsEmail_m->getEventsFortyFiveMin();
	    //configuracion para gmail
		$configGmail = config_item('configGmail');
		//cargamos la libreria para enviar correo
	    $this->email->initialize($configGmail);
	    $this->email->set_newline("\r\n");
		//datos del correo
		foreach ($eventos as $evento) {
			$CodigoHtml =
	        "<!DOCTYPE html> " .
	        "<html> " .
	        "<head> " .
	        "<title>TODO supply a title</title> " .
	        "<meta charset='UTF-8'>  " .
	        "<meta name='viewport' content='width=device-width, initial-scale=1.0'> " .
	        "</head> " .
	        "<body> " .
	        "<div style='width: 720px;height: 184px; overflow: hidden; border-radius: 10px;  background: no-repeat center center url(http://localhost/TMIS/public_html/img/tmis_logo_correo.jpg) #3c8dbc; color: white;clear: both;margin:auto;text-align: center;'></div> " .
	        "<div style='width: 700px;height: auto; padding: 10px; background-color: #ecf0f5; border-radius: 10px; font-size: 18px;  color: black;clear: both;margin:auto; margin-top: 10px; text-align: center;'> " .
	            'Le recordamos que dentro los próximos 45 minutos usted tiene programado un evento de ' . $evento['date']. ' Muchas gracias' .
	        "<div style='width: 680px;height: auto; overflow: hidden; padding: 10px;  color: white;  border-radius: 10px;  background-color: #3c8dbc; ;color: white;clear: both;margin:auto; margin-top:10px; text-align: center;'> T-MIS C.A. Telefono: 0212-2377200.</div> " .
	        "</body> " .
	        "</html>";
			log_message('info', 'enviando correo de notificacion');
			$this->email->from('informacion@tmis.com.ve','Demo');
			$this->email->to($evento['email']);
			$this->email->subject('Notificación de evento');
			$this->email->message($CodigoHtml);
			//con esto podemos ver el resultado
			if ($this->email->send()) 
		    {
		        $this->data['mensaje'] =  "Your Email has been sent successfully... !!";
		    }
		    else
		    {
		        log_message('error', 'pasando por addevent');
		    }
		}
	    redirect('menu/calendar');
	}

	public function sendEmailNormaly(){
		$this->load->library('session');
		log_message('info', 'ENTRANDO AL METODO sendEmailNormaly');
		//load emailTmis model
		$this->load->model('menu/email/emailTmis_m');
		$fecha = date('d-m-Y');
		$data = array(
			'title' => $this->input->post('emailTitle'),
			'body' => $this->input->post('emailText'),
			'email' => $this->input->post('emailUser'),
			'status' => 1 ,
			'dateSend' => "10-11-2016",
			'dateRead' => "10-11-2016",
			'idUsers' => $this->session->userdata('idUsers'));
		log_message('info', 'INSERTANTO CORREO ' . $data);
		$this->emailTmis_m->save($data, $id);
		//configuracion para gmail
		$configGmail = config_item('configGmail');
		//cargamos la libreria para enviar correo
	    $this->email->initialize($configGmail);
	    $this->email->set_newline("\r\n");
	    log_message('info', 'PREPARANDO CORREO PARA ENVIAR');
		//datos del correo
		$CodigoHtml =
        "<!DOCTYPE html> " .
        "<html> " .
        "<head> " .
        "<title>TODO supply a title</title> " .
        "<meta charset='UTF-8'>  " .
        "<meta name='viewport' content='width=device-width, initial-scale=1.0'> " .
        "</head> " .
        "<body> " .
        "<div style='width: 720px;height: 184px; overflow: hidden; border-radius: 10px;  background: no-repeat center center url(http://localhost/TMIS/public_html/img/tmis_logo_correo.jpg) #3c8dbc; color: white;clear: both;margin:auto;text-align: center;'></div> " .
        "<div style='width: 700px;height: auto; padding: 10px; background-color: #ecf0f5; border-radius: 10px; font-size: 18px;  color: black;clear: both;margin:auto; margin-top: 10px; text-align: center;'> " . $this->input->post('emailText'). ' Muchas gracias' .
        "<div style='width: 680px;height: auto; overflow: hidden; padding: 10px;  color: white;  border-radius: 10px;  background-color: #3c8dbc; ;color: white;clear: both;margin:auto; margin-top:10px; text-align: center;'> T-MIS C.A. Telefono: 0212-2377200.</div> " .
        "</body> " .
        "</html>";
		log_message('info', 'ENVIANDO CORREO DE NOTIFICACIÓN');
		$this->email->from('informacion@tmis.com.ve','Demo');
		$this->email->to($this->input->post('emailUser'));
		$this->email->subject($this->input->post('emailTitle'));
		$this->email->message($CodigoHtml);
		//con esto podemos ver el resultado
		if ($this->email->send()) 
	    {
	        $this->data['mensaje'] =  "Your Email has been sent successfully... !!";
	        log_message('info', 'El correo electrónico fue enviado satisfactoriamente');
	        echo json_encode(array("access" => TRUE));
	    }
	    else
	    {
	        log_message('error', 'pasando por addevent');
	        $this->data['mensaje'] = "Error al enviar el correo electrónico";
	    }
	    // Load view
	}
}