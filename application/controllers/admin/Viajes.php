<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Viajes extends CI_Controller {
	
	private $nombre = "Viajes";
	private $tbl_viajes = "viajes";
	private $modulo;
	
	public function __construct () {
		parent::__construct();
		$this->load->model("Modelo");
		$this->load->helper("global_functions_helper");
		$this->modulo = $this->Modelo->buscar("modulos", $this->tbl_viajes, "nombre");
	}

	public function index () {
		if (hasAccess($this->session->userdata("id_perfil"), $this->modulo['id'])) {
			$data = array(
				'allowAdd' => true,
				'modulo' => $this->modulo,
				'registros' => $this->Modelo->listar($this->tbl_viajes),
				'styles' => array("daterangepicker"),
				'scripts' => array("moment", "daterangepicker"),
			);
			$this->load->view("administrar/main_vista", $data);
		}
		else
			show_404();
	}
}