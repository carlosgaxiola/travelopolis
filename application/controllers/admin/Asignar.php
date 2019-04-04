<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignar extends CI_Controller {

	private $nombre = "asignar guias";
	private $tabla = "guias_viajes";
	private $modulo;

	function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
		$this->load->model("Modelo");		
		$this->modulo = $this->Modelo->buscar("modulos", $this->nombre, "nombre");
	}

	function index () {
		if ($this->session->userdata("admin_active") && hasAccess($this->session->userdata("id_perfil"), $this->modulo['id'])) {
			$this->modulo['nombre'] = "asignar";
			$this->modulo['nombre_personalizado'] = "Asiganar Guias";			
			$this->modulo['descripcion'] = "Asigna un guia un viaje";
			$data = array(
				'modulo' => $this->modulo,
				'registros' => $this->Modelo->listar("listar_viajes_guias"),
				'scripts' => array("moment")
			);
			$this->load->view("administrar/main_vista", $data);
		}
		else
			show_404();
	}
}