<?php

class User extends Admin_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['meta_title'] = 'TMIS - Usuarios';
	}

	public function index ()
	{
		//Load breadcrums
		$this->breadcrumbs->push('Inicio', '/dashboard');
		$this->breadcrumbs->push('Usuarios', 'menu/user');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		// Fetch all users
		$this->data['users'] = $this->user_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/user/index';
		//$this->data['NameView'] = 'Usuarios';
		$this->load->view('main_layout', $this->data);
	}

	public function edit ($id = NULL)
	{
		//variable para saber si el cliente es nuevo
		$newUser = TRUE;
		// Fetch a user or set a new one
		if ($id) {
			$this->data['user'] = $this->user_m->get($id);
			$newUser = FALSE;
			log_message('info', 'Usuario existe');
			count($this->data['user']) || $this->data['errors'][] = 'User could not be found';
		}
		else {
			$this->data['user'] = $this->user_m->get_new();
			$newUser = TRUE;
			log_message('info', 'Usuario nuevo');
		}
		
		// Set up the form
		$rules = $this->user_m->rules_admin;
		$id || $rules['password']['rules'] .= '|required';
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			if ($newUser == TRUE) {
				$data = array(
				'userName' =>  $this->input->post('userName'), 
				'email' => $this->input->post('email'), 
				'password' => $this->user_m->hash($this->input->post('password')), 
				'idProfile' => $this->input->post('profile'), 
				'status' => $this->input->post('status'),
				'idCompany' => $this->input->post('company'));
				$this->user_m->save($data, $id);
				$idUsers = $this->db->insert_id();
				$userName = $this->input->post('userName');
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
			}
			else{
				$data = array(
				'userName' =>  $this->input->post('userName'), 
				'email' => $this->input->post('email'), 
				'password' => $this->user_m->hash($this->input->post('password')), 
				'idProfile' => $this->input->post('profile'), 
				'status' => $this->input->post('status'),
				'idCompany' => $this->input->post('company'));
				$this->user_m->save($data, $id);
			}
			redirect('admin/user');
		}
		
		//get profiles
		$this->load->model('profile_m');
		$this->data['profiles'] = $this->profile_m->get();

		//get profiles
		$this->load->model('menu/company_m');
		$this->data['companys'] = $this->company_m->get();

		// Load the view
		$this->data['subview'] = 'admin/user/edit';
		$this->load->view('main_layout', $this->data);
	}

	public function delete ($id)
	{
		$this->user_m->delete($id);
		redirect('admin/user');
	}

	public function login(){
		// Redirect a user if he's already logged in
		$dashboard = 'admin/dashboard';
		if ($this->user_m->loggedin() != FALSE) {
			if ($this->session->userdata('idProfile') == 1) {
					redirect($dashboard);
				}
				else{
					redirect("Home");
				}
		}
		// Set form
		$rules = $this->user_m->rules;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == TRUE) {
			//we can login
			if ($this->user_m->login() == TRUE) {
				redirect($dashboard);
			}
			else {
				$this->session->set_flashdata('error', 'That email/password combination does not exist');
				redirect('admin/user/login', 'refresh');
			}
		}
		$this->data['subview'] = 'admin/user/login';
		$this->load->view('admin/layout_modal', $this->data);
	}

	public function logout ()
	{
		$this->user_m->logout();
		redirect('admin/user/login');
	}

	public function _unique_email ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current user
		
		$id = $this->uri->segment(4);
		$this->db->where('email', $this->input->post('email'));
		!$id || $this->db->where('idUsers !=', $id);
		$user = $this->user_m->get();
		
		if (count($user)) {
			$this->form_validation->set_message('_unique_email', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}

	public function profiles_popup($id)
	{
		$str = '';
		$this->load->model('navBar_m');
		$menu = $this->navBar_m->get_navBar_by_profile();
		$str .= '<table class="table table-striped"> <tr> <th> Opcion </th> <th> Acceso </th> </tr>';
		foreach ($menu as $navBar) {
			$str .= '<tr> <td> '.$navBar['nombreNavBar'].' </td>'. '<td> '.$navBar['status'] .' </td> </tr>';
		}
		$str .= '</table>';
		//$table = $this->data['users'][0]->userName;
		echo json_encode(array("access" => $str));
	}

	public function recoverPassword($email){
		log_message('info', 'recuperando contraseña de ' . $this->input->post('email'));
		$random = rand(1,1000000) . 'tmis';
		$data = array(
			'password' => $this->user_m->hash($random)); 
		$this->user_m->save($data, array('email' => $this->input->post('email')));
		$this->enviarCorreo( $this->input->post('email'),$random);
		echo "<script type='text/javascript'> 
		alert('Estimado usuario, se ha mandado al correo indicado la nueva contraseña para que pueda ingresar en el sistema'); setTimeout('".redirect('login')."',5000); </script>";

	}

	public function enviarCorreo($userEmail,$userPassword){
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
	        "<div style='width: 700px;height: auto; padding: 10px; background-color: #ecf0f5; border-radius: 10px; font-size: 18px;  color: black;clear: both;margin:auto; margin-top: 10px; text-align: center;'> Estimado usuario, su nueva contraseña para ingresar en el sistema es la siguiente: " .
	        "<table border='1'><tr> <th> Contraseña </th> </tr> <tr><td>".$userPassword."</td></tr></table>".
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
		}
}