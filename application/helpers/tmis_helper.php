<?php

function add_meta_title ($string)
{
	$CI =& get_instance();
	$CI->data['meta_title'] = e($string) . ' - ' . $CI->data['meta_title'];
}

function btn_edit ($uri)
{
	return anchor($uri, '<button class="btn btn-primary glyphicon glyphicon-pencil"></button>');
}

function btn_delete ($uri)
{
	return anchor($uri, '<button class="btn btn-danger glyphicon glyphicon-trash"></button>', array(
		'onclick' => "return confirm('Esta a punto de elminar este registro. No se podrá deshacer. Esta seguro?');"
	));
}

function btn_popup ($uri,$value,$onclickFunction)
{
	return '<button class="btn btn-warning glyphicon glyphicon-ok" onclick='.$onclickFunction.'>'.$value.'</button>';
}

function btn_js ($class,$text,$onclickFunction)
{
	return '<button class="'.$class.'" onclick='.$onclickFunction.'>'.$text.'</button>';
}

function get_excerpt($article, $numwords = 50){
	$string = '';
	$url = article_link($article);
	$string .= '<h2>' . anchor($url, e($article->title)) .  '</h2>';
	$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
	$string .= '<p>' . e(limit_to_numwords(strip_tags($article->body), $numwords)) . '</p>';
	$string .= '<p>' . anchor($url, 'Read more ›', array('title' => e($article->title))) . '</p>';
	return $string;
}

function limit_to_numwords($string, $numwords){
	$excerpt = explode(' ', $string, $numwords + 1);
	if (count($excerpt) >= $numwords) {
		array_pop($excerpt);
	}
	$excerpt = implode(' ', $excerpt);
	return $excerpt;
}

function e($string){
	return htmlentities($string);
}

function get_menu ($array, $child = FALSE)
{
	$CI =& get_instance();
	$str = '';
	$contador = 0;
	if (count($array)) {
		$str .= $child == FALSE ? '<ul class="nav navbar-nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;
		
		foreach ($array as $item) {
			
			$active = $CI->uri->segment(1) == $item['url'] ? TRUE : FALSE;
			if (isset($item['children']) && count($item['children'])) {
				if(!$item['iconClass']){
					$str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
					$str .= '<a  class="dropdown-toggle '.e($item['iconClass']).'" data-toggle="dropdown" href="' . site_url(e($item['url'])) . '">' . e($item['nombreNavBar']);
					$str .= '<b class="caret"></b></a>' . PHP_EOL;
					$str .= get_menu($item['children'], TRUE);
				}
			}
			else {
				if(!$item['iconClass']){
					$str .= $active ? '<li class="active">' : '<li>';
					$str .= '<a href="' . site_url($item['url']) . '">' . e($item['nombreNavBar']) . '</a>';
				}
			}
			$str .= '</li>' . PHP_EOL;
		}
		
		$str .= '</ul>' . PHP_EOL;
		$str .= '<ul class="nav navbar-nav navbar-right">';
		foreach ($array as $item) {
			
			$active = $CI->uri->segment(1) == $item['url'] ? TRUE : FALSE;
			if (isset($item['children']) && count($item['children'])) {
				if($item['iconClass']){
					if ($contador == 0) {
						$str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
						$str .= '<a  class="dropdown-toggle '.e($item['iconClass']).'" data-toggle="dropdown" href="' . site_url(e($item['url'])) . '">';
						$str .= '<b class="caret"></b></a>' . PHP_EOL;
						$str .= get_menu($item['children'], TRUE);
						$contador = 1;
					}
					else{
						$str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
						$str .= '<a  class="dropdown-toggle '.e($item['iconClass']).'" data-toggle="dropdown" href="' . site_url(e($item['url'])) . '">' . e($item['nombreNavBar']);
						$str .= '<b class="caret"></b></a>' . PHP_EOL;
						$str .= get_menu($item['children'], TRUE);
					}
				}
			}
			else {
				if($item['iconClass']){
					$str .= $active ? '<li class="active">' : '<li>';
					$str .= '<a class="'.e($item['iconClass']).'" href="' . site_url($item['url']) . '"></a>';
				}
			}
			$str .= '</li>' . PHP_EOL;
		}
		$str .= '</ul>' . PHP_EOL;
	}
	
	return $str;
}

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}