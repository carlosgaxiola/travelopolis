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
		$viaje = $this->Modelo->buscar($this->modulo, $this->input->get("buscar"), "nombre");
		$data['titulo'] = ucfirst($this->modulo);
		if ($viaje) {
			$data['viaje'] = $this->Modelo->buscar($this->modulo, $this->input->get("buscar"), "nombre");
			$dias = $this->Modelo->buscar($this->secundario, $data['viaje']['id'], 'id_viaje');
			if (is_array($dias))
				$data['dias'] = $dias;
			$this->load->view("Viajes/viaje_vista", $data);
		}
		else 
			$this->load->view("Viajes/viaje_no_encontrado", $data);
	}

}