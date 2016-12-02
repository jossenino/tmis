<?php
class Frontend_Controller extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        //load pages
        $this->load->helper('form');
		$this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('profile_m');

        //fetch navigation
        //$this->data['menu'] = $this->page_m->get_nested();
    }
}