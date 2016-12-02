<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function initialize_elfinder($value=''){
	$CI =& get_instance();
    $CI->load->helper('path');
    $opts = array(
        //'debug' => true, 
        'roots' => array(
          array( 
            'driver' => 'LocalFileSystem', 
            'path'   => '../'. $value .'', 
            'URL'    => site_url($value).'/',
            'alias'      => 'Home',
            'mimeDetect' => 'internal',
            'imgLib'     => 'gd',
            'tmbPath'    => 'thumbnails',
            'tmbCrop'    => false,
            'tmbBgColor' => 'transparent',
            'attributes' => array(
                array( // hide readmes
                    'pattern' => '/README/',
                    'read' => false,
                    'write' => false,
                    'hidden' => true,
                    'locked' => false
                ),
                array( // hide readmes
                    'pattern' => '/thumbnails/',
                    'read' => false,
                    'write' => false,
                    'hidden' => true,
                    'locked' => false
                ),
                array( // hide readmes
                    'pattern' => '/tmb/',
                    'read' => false,
                    'write' => false,
                    'hidden' => true,
                    'locked' => false
                ),
                array( // hide readmes
                    'pattern' => '/quarantine/',
                    'read' => false,
                    'write' => false,
                    'hidden' => true,
                    'locked' => false
                ),
                array( // restrict access to png files
                    'pattern' => '/\.png$/',
                    'write' => false,
                    'locked' => true
                )
            ),
        ),
        array( // another root
            'driver' => 'MySQL',
            'host'   => 'localhost',
            'user'   => 'eluser',
            'pass'   => 'elpass',
            'db'     => 'elfinder',
            'path'   => 1,
        )
    )
);

	return $opts;
}
?>