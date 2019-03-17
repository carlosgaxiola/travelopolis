<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viajes extends CI_Controller {	

	private $modulo = "viajes";
	private $secundario = 'dias_viajes';

	public function __construct () {
		parent::__construct();
		$this->load->model("Modelo");
	}

	public function index () {
		$data = array(
			'titulo' => ucfirst($this->modulo),
			'viaje' => $this->Modelo->buscar($this->modulo, $this->input->get("buscar"), "nombre"),			
		);
		$dias = $this->Modelo->buscar($this->secundario, $data['viaje']['id'], 'id_viaje');
		if (is_array($dias))
			$data['dias'] = $dias;
		$this->load->view("Viajes/viaje_vista", $data);
	}

	// public function _remap ($method, $params = array()) {    
	//     if(!method_exists($this, $method)) {
	//        $this->index($method, $params);
	//     }
	//     else{
	//       return call_user_func_array(array($this, $method), $params);
	//     }
 //  	}

}