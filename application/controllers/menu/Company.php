<?php
	/**
	* Clientes (Get,Insert, update y delete)
	*/
	class Company extends MY_Controller{
		public function __construct(){
			parent::__construct();
			$this->data['meta_title'] = 'TMIS - Empresas';
			$this->data['active_navBar'] = 'active';
		}

		public function index ()
		{
			//Load breadcrums
			$this->breadcrumbs->push('Inicio', '/dashboard');
			$this->breadcrumbs->push('Empresas', 'menu/company');
			$this->data['breadcrumbs'] = $this->breadcrumbs->show();
			log_message('info', 'mostrando breadcrumbs');
			//Load model Clientes
			$this->load->model("menu/company_m");
			log_message('info', 'cargado modelo empresas');
			// Fetch all companys
			$this->data['companys'] = $this->company_m->get();
			
			// Load view
			$this->data['subview'] = 'menu/company/index';
			//$this->data['NameView'] = 'Usuarios';
			$this->load->view('main_layout', $this->data);
		}

		public function edit ($id = NULL)
		{
			//variable para saber si el cliente es nuevo
			$newCompany = TRUE;
			//load model company
			$this->load->model('menu/company_m');
			// Fetch a profile or set a new one
			if ($id) {
				$this->data['company'] = $this->company_m->get($id);
				$newCompany = FALSE;
				log_message('info', 'Empresa existe');
				count($this->data['companys']) || $this->data['errors'][] = 'turn could not be found';
			}
			else {
				$this->data['companys'] = $this->company_m->get_new();
				$newCompany = TRUE;
				log_message('info', 'Empresa nueva');
			}
			
			// Set up the form
			$rules = $this->company_m->rules;
			$id || $rules['companys']['rules'] .= '|required';
			$this->form_validation->set_rules($rules);
			
			// Process the form
			if ($this->form_validation->run() == TRUE) {
				if ($newCompany == TRUE) {
					//load usuario
					$this->load->model('user_m');
					$userName = substr(str_replace(' ', '', $this->input->post('companyName')),0, -10);
					$userName = $userName . rand(1,1000);
					$random = rand(1,1000000) . 'tmis';
					$userPassword = $this->user_m->hash($random);
					$userEmail = $this->input->post('email');
					$status = 1;
					$profile = 2;
					$dataUser = array(
					'userName' =>  $userName, 
					'email' => $userEmail, 
					'password' => $userPassword, 
					'idProfile' => $profile, 
					'status' => $status);
					$this->user_m->save($dataUser, $id);
					$idUsers = $this->db->insert_id();
					$data = array(
					'companyName' =>  $this->input->post('companyName'), 
					'typeDocument' => $this->input->post('typeDocument'), 
					'numberDocument' => $this->input->post('numberDocument'), 
					'class' => $this->input->post('class'), 
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email'),
					'direction' => $this->input->post('direction'),
					'status' => $this->input->post('status'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'idUsers' => $idUsers);
					$this->company_m->save($data, $id);
					$idCompany = $this->db->insert_id();
					$this->user_m->save(array('idCompany' => $idCompany), $idUsers);
					if (!file_exists('../public_html/files/'.$this->input->post('companyName'))) {
					    mkdir('../public_html/files/'.$this->input->post('companyName'), 0777, true);
					    //load folder
						$this->load->model('menu/folders/folders_m');
						$folderLocation = 'public_html/files/'.$this->input->post('companyName');
						$data = array(
							'idUsers' => $idUsers,
							'folderLocation' => $folderLocation);
						$this->folders_m->save($data,$id);
						mkdir('../public_html/files/'.$this->input->post('companyName').'/users', 0777, true);
					}
					$this->enviarCorreo($userEmail,$userName,$random);
				}
				else{
					$data = $this->company_m->array_from_post(array('companyName', 'typeDocument', 'numberDocument', 'class', 'phone', 'email', 'direction', 'status','country','state','city','idUsers'));
					$this->company_m->save($data, $id);
				}
			}
			//get pais
			$this->load->model('admin/country_m');
			$this->data['countrys'] = $this->country_m->get();

			//get estado
			$this->load->model('admin/state_m');
			$this->data['states'] = $this->state_m->get();

			//get ciudad
			$this->load->model('admin/city_m');
			$this->data['citys'] = $this->city_m->get();

			//get users
			$this->load->model('user_m');
			$this->data['users'] = $this->user_m->get();

			// Load the view
			$this->data['subview'] = 'menu/company/edit';
			$this->load->view('main_layout', $this->data);
		}

		public function delete ($id)
		{
			//load model client
			$this->load->model('menu/company_m');
			$this->company_m->delete($id);
			redirect('menu/company');
		}

		public function _unique_client ($str)
		{
			// Do NOT validate if email already exists
			// UNLESS it's the email for the current profile
			
			$id = $this->uri->segment(4);
			$this->db->where('numberDocument', $this->input->post('numberDocument'));
			!$id || $this->db->where('id !=', $id);
			$profile = $this->company_m->get();
			
			if (count($profile)) {
				$this->form_validation->set_message('_unique_client', '%s should be unique');
				return FALSE;
			}
			
			return TRUE;
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
	    	redirect('menu/company');
		}
		
		public function getRegion($id){
		//get estado
		$this->load->model('admin/state_m');
		$state = $this->state_m->get_by(array('idCountry'=>$id));
		$str ="";
		foreach ($state as $region) {
			$str .= "<option value='".$region->id."'> ".$region->state." </option>";
		}
		echo json_encode(array("access" => $str));
		}

		public function getComunas($id){
			//get estado
			$this->load->model('admin/city_m');
			$city = $this->city_m->get_by(array('idState'=>$id));
			$str ="";
			foreach ($city as $comunas) {
				$str .= "<option value='".$comunas->id."'> ".$comunas->city." </option>";
			}
			echo json_encode(array("access" => $str));
		}
	}