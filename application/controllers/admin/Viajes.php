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
		$this->load->model("ViajesModelo");
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

	public function add () {
		if ($this->input->is_ajax_request()) {
			var_dump($this->input->post());
			$imagen = $_FILES['txtImagen'];
			echo "<br>".$imagen['name'];
		}
		else
			show_404();
	}

	public function edit () {

	}

	public function diasViaje () {
		if ($this->input->is_ajax_request()) {
			$idViaje = $this->input->post("idViaje");
			if ($idViaje == null or empty($idViaje))
				echo "false";
			else
				echo json_encode($this->ViajesModelo->listarDias($idViaje));
		}
		else
			show_404();
	}
}