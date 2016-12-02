<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->library('migration');

        echo "<pre>"; echo $this->db->last_query(); echo "</pre>";

        echo "<pre>"; echo $this->migration->current(); echo "</pre>";

        if ( ! $this->migration->current())
        {
        	show_error($this->migration->error_string());
        }
        else{
            echo "<pre>"; echo $this->db->last_query(); echo "</pre>";
            echo 'migration works';
        }
            
    }
}