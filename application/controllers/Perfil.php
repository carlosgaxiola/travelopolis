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
				'usuario' => $usuario,
				'estados' => $this->Modelo->listar("estados", null, 1)
			);
			$this->load->view("perfil/perfil_vista", $perfil);
		}
	}

	public function editar_empleado () {
		if ($this->input->is_ajax_request()) {
			$nombreUsuario = $this->input->post("usuario");
			$datos = $this->ViajeroModelo->buscar($nombreUsuario);
			if ($datos) {
				$uCorreo = "";
				$uUsuario = "";
				$correo = $this->input->post("correo");				
				if (strcmp($datos['persona'][0]['correo'], $correo) != 0) {
					$uCorreo = "|is_unique[empleados.correo]";						
				}
				if (strcmp($datos['usuario']['usuario'], $nombreUsuario) != 0)
					$uUsuario = "|is_unique[usuarios.usuario]";				
				$this->form_validation->set_rules("nombre", "Nombre", "trim|required");
				$this->form_validation->set_rules("paterno", "Apellido Paterno", "trim|required");
				$this->form_validation->set_rules("materno", "Apellido Materno", "trim|required");
				$this->form_validation->set_rules("nss", "NSS", "trim|alpha");
				$this->form_validation->set_rules("rfc", "RFC", "trim|alpha");
				$this->form_validation->set_rules("tel", "Teléfono", "trim|numeric");
				$this->form_validation->set_rules("correo", "Correo", "trim|required".$uCorreo);
				$this->form_validation->set_rules("usuario", "Usuario", "trim|required".$uUsuario);
				$this->form_validation->set_rules("descripcion", "Descripción", "trim");
				if ($this->form_validation->run()) {
					$user_data = array("usuario" => $nombreUsuario);
					$userAct = $this->Modelo->actualizar("usuarios", $datos['usuario']['id'], $user_data);					
					$persona_data = array(
						'nombre' => $this->input->post("nombre"),
						'a_paterno'	=> $this->input->post("paterno"),
						'a_materno' => $this->input->post("materno"),
						'correo' => $this->input->post("correo"),
						'nss' => $this->input->post("nss"),
						'rfc' => $this->input->post("rfc"),
						'telefono' => $this->input->post("telefono"),
						'informacion' => $this->input->post("descripcion")
					);
					$perAct = $this->Modelo->actualizar("empleados", $datos['persona'][0]['id'], $persona_data);						
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

	public function editar_viajero () {
		if ($this->input->is_ajax_request()) {
			$nombreUsuario = $this->input->post("usuario");
			$datos = $this->ViajeroModelo->buscar($nombreUsuario);
			if ($datos) {
				$uCorreo = "";
				$uUsuario = "";
				$correo = $this->input->post("correo");				
				if (strcmp($datos['persona'][0]['correo'], $correo) != 0) {					
					$uCorreo = "|is_unique[viajeros.correo]";
				}
				if (strcmp($datos['usuario']['usuario'], $nombreUsuario) != 0)
					$uUsuario = "|is_unique[usuarios.usuario]";				
				$this->form_validation->set_rules("nombre", "Nombre", "trim|required");
				$this->form_validation->set_rules("paterno", "Apellido Paterno", "trim|required");
				$this->form_validation->set_rules("materno", "Apellido Materno", "trim|required");
				$this->form_validation->set_rules("estado", "Estado", "trim|alpha");
				$this->form_validation->set_rules("sexo", "Sexo", "trim|alpha");
				$this->form_validation->set_rules("tel", "Teléfono", "trim|numeric");
				$this->form_validation->set_rules("correo", "Correo", "trim|required".$uCorreo);
				$this->form_validation->set_rules("usuario", "Usuario", "trim|required".$uUsuario);
				$this->form_validation->set_rules("descripcion", "Descripción", "trim");
				if ($this->form_validation->run()) {
					$user_data = array("usuario" => $nombreUsuario);
					$userAct = $this->Modelo->actualizar("usuarios", $datos['usuario']['id'], $user_data);					
					$persona_data = array(
						'nombre' => $this->input->post("nombre"),
						'a_paterno'	=> $this->input->post("paterno"),
						'a_materno' => $this->input->post("materno"),
						'correo' => $this->input->post("correo"),
						'estado' => $this->input->post("estado"),
						'sexo' => $this->input->post("sexo"),
						'telefono' => $this->input->post("telefono"),
						'informacion' => $this->input->post("descripcion")
					);
					$perAct = $this->Modelo->actualizar("viajeros", $datos['persona'][0]['id'], $persona_data);						
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