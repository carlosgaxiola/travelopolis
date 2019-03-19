<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrar extends CI_Controller {
	
	private $nombre = "administrar";
	private $modulo;
	
	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");		
		$this->load->model("Modelo");
		$this->modulo = $this->Modelo->buscar("modulos", $this->nombre, "nombre");
	}

	public function index ($modulo = '') {
		$this->session->set_userdata("admin_active", true);
		if (!empty($modulo))
			$modulo = $this->Modelo->buscar("modulos", $modulo, "nombre");
		else
			$modulo = $this->modulo;
		$data = array(
			"modulo" => $modulo,
			"formulario" => 'administrar/perfiles',
			'indices' => array(
				'id' => array(
					'form' => 'idPerfil',
					'hidden' => true,
					'db' => 'id'					
				),
				'nombre' => array(
					'form' => "txtNombre",
					'db' => 'nombre',
					'validaciones' => array(
						'required',
						'unique'
					)
				),
				'descripcion' => array(
					'form' => "txtDescripcion",
					'db' => 'descripcion',
					'validaciones' => array(
						'required'
					)
				)
			)
		);
		$this->load->view("administrar_vista", $data);
	}
}