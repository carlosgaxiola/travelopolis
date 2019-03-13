<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	private $titulo = "Inicio";

	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
		$this->load->model("InicioModelo");
		$this->load->model("Modelo");
	}

	public function index () {
		if ($this->session->userdata("login") == null) {
			$sessionData = array('id_perfil' => 5);
			$this->session->set_userdata($sessionData);
		}		
		$this->load->view("index", array('titulo' => $this->titulo));
	}

	public function login () {
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules("txtUsuario", "Usuario", "required|trim");
			$this->form_validation->set_rules("txtContra", "Contraseña", "required");
			$this->form_validation->set_message("required", "El campo %s es obligatoro");
			if ($this->form_validation->run()) {
				$usuario = $this->InicioModelo->login($this->input->post("txtUsuario"), $this->input->post("txtContra"));
				if ($usuario) {
					if ($usuario['id_perfil'] != 3)
						$persona = $this->Modelo->buscar("empleados", $usuario["id"], "id_usuario");
					else
						$persona = $this->Modelo->buscar("viajeros", $usuario['id'], 'id_usuario');			
					$data = array(						
						'usuario' => $usuario["usuario"],
						'id_usuario' => $usuario["id"],
						'id_perfil' => $usuario['id_perfil'],
						'perfil' => $usuario['perfil'],
						'f_registro' => $usuario['f_registro'],
						'status' => $usuario['status'],
						'login' => true
					);
					$this->session->set_userdata($data);
					echo "true";
				}
				else
					echo "false";
			}
			else
				echo "false";
		}
		else
			show_404();	
	}
	
	public function ingresar () {
		$data = array(
			'contenidos' => array('id' => 'formulario', 'url' => 'inicio/login'),
			'titulo' => 'Login',
			'scripts' => array('app/login', 'app/formulario')
		);
		$this->load->view("index", $data);
	}

	public function logout () {
		$this->session->sess_destroy();
		header("Location: ".base_url());
	}
}