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

	public function cambiar () {
		if ($this->input->is_ajax_request()) {
			$nombreUsuario = $this->input->post("usuario");
			$datos = $this->ViajeroModelo->buscar($nombreUsuario);
			if ($datos) {
				$uCorreo = "";
				$uUsuario = "";
				$correo = $this->input->post("correo");				
				if (strcmp($datos['persona'][0]['correo'], $correo) != 0) {
					if ($datos['usuario']['id_perfil'] == 3) // Perfil de viajero
						$uCorreo = "|is_unique[viajeros.correo]";
					else
						$uCorreo = "|is_unique[empleados.correo]";
				}
				if (strcmp($datos['usuario']['usuario'], $nombreUsuario) != 0)
					$uUsuario = "|is_unique[usuarios.usuario]";				
				$this->form_validation->set_rules("nombre", "Nombre", "trim|required");
				$this->form_validation->set_rules("paterno", "Apellido Paterno", "trim|required");
				$this->form_validation->set_rules("materno", "Apellido Materno", "trim|required");
				$this->form_validation->set_rules("correo", "Correo", "trim|required".$uCorreo);
				$this->form_validation->set_rules("usuario", "Usuario", "trim|required".$uUsuario);
				$this->form_validation->set_rules("descripcion", "Descripción", "trim");
				if ($this->form_validation->run()) {
					$user_data = array("usuario" => $nombreUsuario);
					$userAct = $this->Modelo->actualizar("usuarios", $datos['usuario']['id'], $user_data);
					if ($datos['usuario']['id_perfil'] == 3) // Perfil de viajero
						$tabla = "viajeros";
					else
						$tabla = "empleados";
					$persona_data = array(
						'nombre' => $this->input->post("nombre"),
						'a_paterno'	=> $this->input->post("paterno"),
						'a_materno' => $this->input->post("materno"),
						'correo' => $this->input->post("correo"),
						'informacion' => $this->input->post("descripcion")
					);
					$perAct = $this->Modelo->actualizar($tabla, $datos['persona'][0]['id'], $persona_data);						
					echo $datos['usuario']['id'];
				}
				else {
					echo validation_errors("<li>", "</li>");
				}
			}	
			else
				show_404();
		}
		else
			show_404();
	}	

	public function cambiar_contra () {
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules("contra", "Contraseña", "trim|required");
			$this->form_validation->set_rules("confirmar", "Confirmar Contraseña", "trim|required|matches[contra]");
			$this->form_validation->set_rules("nueva", "Nueva Contraseña", "trim|required");
			if ($this->form_validation->run()) {
				$data = array("contraseña" => sha1($this->input->post("nueva")));
				echo $this->Modelo->actualizar("usuarios", $this->input->post("id"), $data);
			}
			else {
				echo validation_errors("<li>", "</li>");
			}			
		}
		else
			show_404();
	}
}