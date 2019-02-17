<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists("iniciar")) {
	function iniciar ($titulo) {
		$that =& get_instance();		
		$data = array( 
			'titulo' => $titulo,
			'hola' => "Hola Mundo!"
		);
	}
}