<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// Load view
		$this->data['subview'] = 'menu/client/fmgr_view';
		//$this->data['NameView'] = 'Usuarios';
		$this->load->view('main_layout', $this->data);
	}

	function elfinder_init()
	{
		$this->load->helper('general_helper');
		$opts = initialize_elfinder();
	  	$this->load->library('elfinder_lib', $opts);
	}
}
