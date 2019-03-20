<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "ControladorAdministrar.php";
class Perfiles extends ControladorAdministrar {	

	public function __construct () {
		$this->modulo = "perfiles";
		$this->indices = array(
			0 => array(
				'name' => '#',
				'db' => 'id',
				'frm' => 'idModulo',
				'data' => 'id',
				'ignore' => true
			),
			1 => array(
				'name' => 'Nombre',
				'db' => 'nombre',
				'frm' => 'txtNombre',
				'data' => 'nombre',
				'validation' => array(					
					'required' => true,
					'unique' => true
				)
			),
			2 => array(
				'name' => 'Descripcion',
				'db' => 'descripcion',
				'frm' => 'txtDescripcion',
				'validation' => array(					
					'required' => true
				)
			)
		);		
		$this->extras = array("modulos" => "modulos");
		parent::__construct();
		$this->load->model("PerfilesModulosModelo");
	}

	// public function index () {
	// 	if (hasAccess($this->session->userdata("id_perfil"), $this->id)) {
	// 		$data = array(
	// 			'titulo' => ucfirst($this->modulo),
	// 			'registros' => $this->Modelo->listar($this->modulo),				
	// 			'indices' => array(							
					
	// 			),
	// 			'actual' => $this->actual,
	// 			'modulos' => $this->Modelo->listar("modulos"),
	// 			'script' => "app/".$this->modulo,
	// 			'formulario' => "administrar/".$this->modulo."_vista"
	// 		);
	// 		$this->load->view("administrar/listar_vista", $data);
	// 	}
	// 	else
	// 		show_404();
	// }	

	public function add () {
		if ($this->input->is_ajax_request()) {
			$modulos = array();
			foreach ($this->input->post() as $index => $post)
				if (is_int(strpos($index, "cbx")))
					$modulos[] = $post;
			if ($this->validacion()) {
				$fecha = new datetime($this->input->post("fecha"));
				$data = array(
					'nombre' => $this->input->post("txtNombre"),
					'descripcion' => $this->input->post("txtDescripcion"),					
					'f_registro' => $fecha->format("Y-d-m"),					
					'status' => 1
				);
				$idPerfil = $this->Modelo->insertar($this->modulo, $data);				
				if ($idPerfil && !empty($modulos))
					foreach ($modulos as &$idModulo)
						$idModulo = ($this->PerfilesModulosModelo->add($idPerfil, $idModulo))? true: $idModulo;
				echo $idPerfil;
			}	
			else
				echo validation_errors("<li>", "</li>");
		}
		else
			show_404();
	}

	public function edit () {
		if ($this->input->is_ajax_request()) {
			$modulos = array();
			foreach ($this->input->post() as $index => $post)
				if (is_int(strpos($index, "cbx")))
					$modulos[] = $post;
			$idPerfil = $this->input->post("idPerfil");			
			if ($this->validacion($idPerfil)) {
				$data = array(
					'nombre' => $this->input->post("txtNombre"),
					'descripcion' => $this->input->post("txtDescripcion")
				);
				$perfil = $this->Modelo->actualizar($this->modulo, $idPerfil, $data);
				$modulo = false;
				$this->PerfilesModulosModelo->del($idPerfil);
				if (!empty($modulos))
					foreach ($modulos as $idModulo)
						$modulo |= $this->PerfilesModulosModelo->add($idPerfil, $idModulo);
				if ($perfil || $modulo)
					echo $idPerfil;
				else
					echo "0";
			}
			else
				echo validation_errors("<li>", "</li>");
		}	
		else 
		 show_404();
	}

	private function validacion ($idPerfil = 0) {
		$uNombre = "|is_unique[".$this->modulo.".nombre]";		
		if ($idPerfil != 0) {					
			$modulo = $this->Modelo->buscar($this->modulo, $idPerfil);			
			if ($modulo['nombre'] == $this->input->post("txtNombre"))
				$uNombre = "";			
		}
		$this->form_validation->set_rules("txtNombre", "Nombre", "trim|required".$uNombre);		
		$this->form_validation->set_rules("txtDescripcion", "Descripcion", "trim|required");
		$this->form_validation->set_message("required", "El campo %s es obligatorio");
		$this->form_validation->set_message("is_unique", "El campo %s ya existe");
		return $this->form_validation->run();
	}

	

	public function modulos () {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->PerfilesModulosModelo->modulosPerfil($this->input->post("idPerfil")));
		}
		else
			show_404();
	}
}