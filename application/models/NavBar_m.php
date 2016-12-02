<?php
Class NavBar_m extends MY_Model
{
	protected $_table_name = 'navBars';
	protected $_order_by = 'idMenuSubMenu, order';

	public $rules = array(
		'url' => array(
			'field' => 'url', 
			'label' => 'Url', 
			'rules' => 'trim|max_length[150]'
		), 
		'nombreNavBar' => array(
			'field' => 'nombreNavBar', 
			'label' => 'Nombre', 
			'rules' => 'trim|required|max_length[50]'
		), 
		'idMenuSubMenu' => array(
			'field' => 'idMenuSubMenu', 
			'label' => 'idMenuSubMenu', 
			'rules' => 'trim|intval'
		), 
		'iconClass' => array(
			'field' => 'iconClass', 
			'label' => 'Clase', 
			'rules' => 'trim|max_length[150]'
		), 
		'dropdown' => array(
			'field' => 'dropdown', 
			'label' => 'dropdown', 
			'rules' => 'trim|required|intval|max_length[1]'
		), 
		'order' => array(
			'field' => 'order', 
			'label' => 'Orden', 
			'rules' => 'trim|intval'
		), 
		'status' => array(
			'field' => 'status', 
			'label' => 'status', 
			'rules' => 'trim|required|intval|max_length[1]'
		)
	);

	public function get_new ()
	{
		$navBar = new stdClass();
		$navBar->url = '';
		$navBar->nombreNavBar = '';
		$navBar->idMenuSubMenu = '';
		$navBar->iconClass = '';
		$navBar->dropdown = '';
		$navBar->order = '';
		$navBar->status = '';
		return $navBar;
	}

	function __construct(){
		parent::__construct();
	}

	public function get_nested ()
	{
		$this->db->select('navBars.*');
		$this->db->from('navBars');
		$this->db->join('navBars_Profiles', 'navBars_Profiles.idMenu = navBars.id', 'inner');
		$this->db->join('profiles p','p.idProfile = navBars_Profiles.idProfile', 'inner');
		$this->db->where('p.idProfile', $this->session->userdata('idProfile'));
		$this->db->where('navBars.status', 1);
		$this->db->order_by($this->_order_by);
		$navBars = $this->db->get()->result_array();
		$array = array();
		foreach ($navBars as $navBar) {
			if (! $navBar['idMenuSubMenu']) {
				// This page has no parent
				$array[$navBar['id']] = $navBar;
			}
			else {
				// This is a child page
				$array[$navBar['idMenuSubMenu']]['children'][] = $navBar;
			}
		}
		return $array;
	}

	public function get_with_parent ($id = NULL, $single = FALSE)
	{
		$this->db->select('navBars.*, n.idMenuSubMenu as parent_id, n.nombreNavBar as parent_name');
		$this->db->join('navBars as n', 'navBars.idMenuSubMenu=n.id', 'left');
		return parent::get($id, $single);
	}

	public function get_no_parents ()
	{
		// Fetch navBars without parents
		$this->db->select('id, nombreNavBar');
		$this->db->where('idMenuSubMenu', 0);
		$navBars = parent::get();
		
		// Return key => value pair array
		$array = array(
			0 => 'No parent'
		);
		if (count($navBars)) {
			foreach ($navBars as $navBar) {
				$array[$navBar->id] = $navBar->nombreNavBar;
			}
		}
		
		return $array;
	}

	public function get_navBar_by_profile($id)
	{
		$this->db->select('navBars.*');
		$this->db->from('navBars');
		$this->db->join('navBars_Profiles', 'navBars_Profiles.idMenu = navBars.id', 'inner');
		$this->db->join('profiles p','p.idProfile = navBars_Profiles.idProfile', 'inner');
		$this->db->where('p.idProfile', $id);
		$this->db->where('navBars.status', 1);
		$navBars = $this->db->get()->result_array();
		return $navBars;
	}

	public function get_AllnavBar()
	{
		$this->db->select('navBars.*');
		$this->db->from('navBars');
		$this->db->where('navBars.status', 1);
		$navBars = $this->db->get()->result_array();
		return $navBars;
	}
}