<?php

class profile extends Frontend_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['meta_title'] = 'TMIS - Perfiles';
	}

	public function index ()
	{
		//Load breadcrums
		$this->breadcrumbs->push('Inicio', '/dashboard');
		$this->breadcrumbs->push('Perfiles', 'menu/profile');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		// Fetch all profile
		$this->data['profile'] = $this->profile_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/profile/index';
		//$this->data['NameView'] = 'Usuarios';
		$this->load->view('main_layout', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a profile or set a new one
		if ($id) {
			$this->data['profile'] = $this->profile_m->get($id);
			count($this->data['profile']) || $this->data['errors'][] = 'profile could not be found';
		}
		else {
			$this->data['profile'] = $this->profile_m->get_new();
		}
		
		// Set up the form
		$rules = $this->profile_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->profile_m->array_from_post(array('profile', 'description'));
			$this->profile_m->save($data, $id);
			redirect('admin/profile');
		}
		
		// Load the view
		$this->data['subview'] = 'admin/profile/edit';
		$this->load->view('main_layout', $this->data);
	}

	public function delete ($id)
	{
		$this->profile_m->delete($id);
		redirect('admin/profile');
	}

	public function _unique_profile ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current profile
		
		$id = $this->uri->segment(4);
		$this->db->where('profile', $this->input->post('profile'));
		!$id || $this->db->where('idProfile !=', $id);
		$profile = $this->profile_m->get();
		
		if (count($profile)) {
			$this->form_validation->set_message('_unique_profile', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}

	public function profiles_popup($id)
	{
		$str = '';
		$validate = '';
		$this->load->model('navBar_m');
		$menu = $this->navBar_m->get_navBar_by_profile($id);
		$allAccess = $this->navBar_m->get_AllnavBar();
		$str .= '<table class="table table-striped" id="ProfilesUsers"> <tr> <th>Selección</th> <th> Opcion </th> <th> Activo </th> </tr>';
		foreach ($allAccess as $allnavBar) {
			foreach ($menu as $navBar) {
				if ($allnavBar['id'] == $navBar['id']) {
					$str .= '<tr> <td><input type="checkbox" name="profilesPermissions" checked="" value="'.$navBar['id'].'"></td> <td> '.$navBar['nombreNavBar'].' </td>'. '<td> '.$navBar['status'] .' </td> </tr>';
					$validate = TRUE;
				}
			}
			if (!$validate) {
				$str .= '<tr> <td><input type="checkbox" name="profilesPermissions"  value="'.$allnavBar['id'].'"></td> <td> '.$allnavBar['nombreNavBar'].' </td>'. '<td> '.$allnavBar['status'] .' </td> </tr>';
			}
			$validate = FALSE;
		}
		$str .= '</table>';
		//$table = $this->data['users'][0]->userName;
		echo json_encode(array("access" => $str));
	}

	public function permissionsSave($idProfiles){
		$valore=split("-",$this->input->post('perfiles'));
		// Delete a navBarProfiles
		$this->db->delete('navbars_profiles', array('idProfile' => $idProfiles));
		for ($i=0; $i < count($valore) ; $i++) { 
			//insertando en navBarProfiles
			$this->db->set('idProfile', $idProfiles);
			$this->db->set('idMenu', $valore[$i]);
			$this->db->insert('navBars_Profiles');
		}
		echo json_encode(array("access" => TRUE));
	}
}