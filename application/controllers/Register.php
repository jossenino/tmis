<?php
	class Register extends Login_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function registerNewClient(){
		//load user model
		$this->load->model('user_m');
		// Fetch all users
		$this->data['users'] = $this->user_m->get();
		
		//get pais
		$this->load->model('admin/country_m');
		$this->data['countrys'] = $this->country_m->get();

		//get estado
		$this->load->model('admin/state_m');
		$this->data['states'] = $this->state_m->get();

		//get ciudad
		$this->load->model('admin/city_m');
		$this->data['citys'] = $this->city_m->get();

		// Load view
		$this->data['subview'] = 'register/newClient';
		$this->load->view('register', $this->data);
	}

	public function registerNewClientSave(){
		//load model client
		$this->load->model('menu/client_m');
		log_message('info', 'cargando modelo cliente');
		$this->data['clients'] = $this->client_m->get_new();
		// Set up the form
		$rules = $this->client_m->rules_registration;
		$id || $rules['clients']['rules'] .= '|required';
		$this->form_validation->set_rules($rules);

		// Process the form
		if ($this->form_validation->run() == TRUE) {
			//load usuario
			$this->load->model('user_m');
			log_message('info', 'cargando modelo usuario');
			$userName = substr(str_replace(' ', '', $this->input->post('clientName')),0, -10);
			$userName = $userName . rand(1,1000);
			$random = rand(1,1000000) . 'tmis';
			$userPassword = $this->user_m->hash($random);
			$userEmail = $this->input->post('email');
			$status = 1;
			$profile = 1;
			$dataUser = array(
			'userName' =>  $userName, 
			'email' => $userEmail, 
			'password' => $userPassword, 
			'idProfile' => $profile, 
			'status' => $status);
			$this->user_m->save($dataUser, $id);
			$idUsers = $this->db->insert_id();
			$data = array(
			'clientName' =>  $this->input->post('clientName'), 
			'typeDocument' => $this->input->post('typeDocument'), 
			'numberDocument' => $this->input->post('numberDocument'), 
			'class' => $this->input->post('class'), 
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'direction' => $this->input->post('direction'),
			'status' => 1,
			'country' => $this->input->post('country'),
			'state' => $this->input->post('state'),
			'city' => $this->input->post('city'),
			'idUsers' => $idUsers,
			'lawyer' => $this->input->post('lawyer'));
			$this->client_m->save($data, $id);
			//load company_m
			$this->load->model('menu/company_m');
			//se obtiene el nombre de la empresa
			$idCompany = $this->user_m->getCompanyId($this->input->post('lawyer'));
			$company = $this->company_m->getCompanyId($idCompany[0]['idCompany']);
			log_message('info', 'Empresa '. $company[0]['companyName']);
			//obtener nombre del abogado
			//se obtiene el nombre de la empresa
			$lawyerName = $this->user_m->getLawyer($this->input->post('lawyer'));
			log_message('info', 'Empresa '. $company[0]['companyName']);
			if (!file_exists('../public_html/files/'.$company[0]['companyName']. '/users/'. $lawyerName[0]['userName'].'/clients/'.$this->input->post('clientName'))) {
			    mkdir('../public_html/files/'.$company[0]['companyName']. '/users/'. $lawyerName[0]['userName'].'/clients/'.$this->input->post('clientName'), 0777, true);
			    //load folder
				$this->load->model('menu/folders/folders_m');
				$folderLocation = 'public_html/files/'.$company[0]['companyName']. '/users/'. $lawyerName[0]['userName'].'/clients/'.$this->input->post('clientName');
				$data = array(
					'idUsers' => $idUsers,
					'folderLocation' => $folderLocation);
				$this->folders_m->save($data,$id);
			}
			//se actualiza usuario
			$this->user_m->save(array('idCompany' => $idCompany[0]['idCompany']), $idUsers);
			$this->enviarCorreo($userEmail,$userName,$random);
		}
		// Load view
		$this->data['subview'] = 'register/newClient';
		$this->load->view('register', $this->data);
	}

	public function registerNewUser(){
		//get profiles
		$this->load->model('menu/company_m');
		$this->data['companys'] = $this->company_m->get();

		// Load view
		$this->data['subview'] = 'register/newUser';
		$this->load->view('register', $this->data);
	}

	public function registerNewUserSave(){
		//load model user
		$this->load->model('user_m');
		$this->data['user'] = $this->user_m->get_new();
		log_message('info', 'cargado model user');
		// Set up the form
		$rules = $this->user_m->rules_registration;
		$id || $rules['password']['rules'] .= '|required';
		$this->form_validation->set_rules($rules);

		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$str = $this->_unique_email_registration();
			if($str == TRUE) {
				$data = array(
				'userName' =>  $this->input->post('userName'), 
				'email' => $this->input->post('email'), 
				'password' => $this->user_m->hash($this->input->post('password')), 
				'idProfile' => 1, 
				'status' => 1,
				'idCompany' => $this->input->post('company'));
				$this->user_m->save($data, $id);
				$idUsers = $this->db->insert_id();
				$userName = $this->input->post('userName');
				$random = $this->input->post('password');
				$email = $this->input->post('email');
				//load company_m
				$this->load->model('menu/company_m');
				//se obtiene el nombre de la empresa
				$company = $this->company_m->getCompanyId($this->input->post('company'));
				log_message('info', 'Empresa '. $company[0]['companyName']);
				if (!file_exists('../public_html/files/'.$company[0]['companyName']. '/users/' .$userName)) {
				    mkdir('../public_html/files/'.$company[0]['companyName']. '/users/' .$userName, 0777, true);
				    //load folder
					$this->load->model('menu/folders/folders_m');
					$folderLocation = 'public_html/files/'.$company[0]['companyName']. '/users/' .$userName;
					$data = array(
						'idUsers' => $idUsers,
						'folderLocation' => $folderLocation);
					$this->folders_m->save($data,$id);
					mkdir('../public_html/files/'.$company[0]['companyName']. '/users/' .$userName.'/clients', 0777, true);
				}
				$this->enviarCorreo($userEmail,$userName,$random);
			}
			else{
				$this->form_validation->set_message('_unique_email_registration', '%s should be unique');
			}
		}
		// Load view
		$this->data['subview'] = 'register/newUser';
		$this->load->view('register', $this->data);
	}

	public function enviarCorreo($userEmail,$userName,$userPassword){
	    //configuracion para gmail
		$configGmail = config_item('configGmail');
		//cargamos la libreria para enviar correo
	    $this->email->initialize($configGmail);
	    $this->email->set_newline("\r\n");
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
	    "<div style='width: 700px;height: auto; padding: 10px; background-color: #ecf0f5; border-radius: 10px; font-size: 18px;  color: black;clear: both;margin:auto; margin-top: 10px; text-align: center;'> Muchas gracias por crear una cuenta con nosotros, le indicamos los datos para poder ingresar: " .
	    "<table border='1'><tr><th> Nombre usuario </th> <th> Contraseña </th> </tr> <tr><td>".$userName."</td><td>".$userPassword."</td></tr></table>".
	    "<div style='width: 680px;height: auto; overflow: hidden; padding: 10px;  color: white;  border-radius: 10px;  background-color: #3c8dbc; ;color: white;clear: both;margin:auto; margin-top:10px; text-align: center;'> T-MIS C.A. Telefono: 0212-2377200.</div> " .
	    "</body> " .
	    "</html>";
		log_message('info', 'enviando correo de notificacion');
		$this->email->from('jossenino@gmail.com','Josse Niño');
		$this->email->to($userEmail);
		$this->email->subject('Notificación para usuarios nuevos');
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
	    redirect('login');
	}

	public function _unique_email_registration ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current user
		log_message('info', 'correo post '. $this->input->post('email'));
		$this->db->where('email', $this->input->post('email'));
		$user = $this->user_m->get();
		
		if (count($user)) {
			$this->form_validation->set_message('_unique_email_registration', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
}