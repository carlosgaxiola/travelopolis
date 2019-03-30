<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {
	
	private $nombre = "Mi Perfil";
	private $tbl_usuarios = "usuarios";	
	private $tbl_empleados = "empleados";
	private $tbl_viajeros = "viajeros";	
	
	public function  __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
		$this->load->model("Modelo");
		$this->load->model("ViajeroModelo");
	}	

	public function index () {
		$usuario = $this->input->get("usuario");		
		if (empty($usuario))
			show_404();
		else {			
			$usuario = $this->ViajeroModelo->buscar($usuario);
			$viajes = $this->ViajeroModelo->viajes($this->session->userdata("id_usuario"));
			$perfil = array(
				'titulo' => 'Perfil',
				'viajes' => $viajes,
				'usuario' => $usuario
			);
			$this->load->view("perfil/perfil_vista", $perfil);
		}
	}

}