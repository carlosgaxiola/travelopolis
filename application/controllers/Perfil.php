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
	}	

	public function index () {
		$usuario = $this->input->get("usuario");		
		if (empty($usuario))
			show_404();
		else {
			$usuario = $this->Modelo->buscar($this->tbl_usuarios, $usuario, "usuario");
			if ($usuario['id_perfil'] == 1 || $usuario['id_perfil']) { //Administrador o guia
				$persona = $this->Modelo->buscar($this->tbl_empleados, $usuario['id'], "id_usuario");
			} else if ($usuario['id_perfil'] == 3)  { //Viajero
				$persona = $this->Modelo->buscar($this->tbl_viajeros, $usuario['id'], "id_usuario");
			}
			$perfil = array(
				'titulo' => 'Perfil',
				'usuario' => $usuario,
				'persona' => $persona
			);
			$this->load->view("perfil/perfil_vista", $perfil);
		}
	}

}