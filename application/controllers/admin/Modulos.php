<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulos extends CI_Controller {	

	private $nombre = "modulos";
	private $modulo;

	public function __construct () {
		parent::__construct();
		$this->load->model("Modelo");
		$this->load->helper("global_functions_helper");
		$this->modulo = $this->Modelo->buscar("modulos", $this->nombre, "nombre");
	}

	public function index () {
		if (hasAccess($this->session->userdata("id_perfil"), $this->modulo['id'])) {
			$data = array(				
				'modulo' => $this->modulo,
				'registros' => $this->Modelo->listar($this->nombre)				
			);
			$this->load->view("admin/main_vista", $data);
		}
		else
			show_404();	
	}

	public function edit () {
		if ($this->input->is_ajax_request()) {
			$idModulo = $this->input->post("idModulo");
			if ($this->validacion($idModulo)) {				
				$data = array(
					'nombre' => $this->input->post("txtNombre"),
					'descripcion' => $this->input->post("txtDescripcion"),
					'ruta' => $this->input->post("txtRuta"),
					'fa_icon' => $this->input->post("cmbIcono")					
				);
				if ($this->Modelo->actualizar($this->nombre, $idModulo, $data))
					echo $idModulo;
				else
					echo "0";
			}
			else
				echo validation_errors("<li>", "</li>");
		}	
		else 
		 show_404();
	}

	private function validacion ($idModulo = 0) {
		$uNombre = "|is_unique[$this->nombre.nombre]";
		$uRuta = "|is_unique[$this->nombre.ruta]";		
		if ($idModulo != 0) {			
			$modulo = $this->Modelo->buscar($this->nombre, $idModulo);			
			if ($modulo['nombre'] == $this->input->post("txtNombre"))
				$uNombre = "";
			if ($modulo['ruta'] == $this->input->post("txtRuta"))
				$uRuta = "";
		}		
		$this->form_validation->set_rules("txtNombre", "Nombre", "trim|required".$uNombre);
		$this->form_validation->set_rules("txtRuta", "Ruta", "trim|required".$uRuta);		
		$this->form_validation->set_rules("txtDescripcion", "Descripcion", "trim|required");
		$this->form_validation->set_message("less_than", "El campo %s debe ser menor a 100");		
		$this->form_validation->set_message("required", "El campo %s es obligatorio");
		$this->form_validation->set_message("is_unique", "El campo %s ya existe");
		return $this->form_validation->run();
	}
}