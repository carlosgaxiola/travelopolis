<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	
	private $nombre = "inicio";
	private $modulo;
		
	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
		$this->load->model("InicioModelo");
		$this->load->model("Modelo");
		$this->modulo = $this->Modelo->buscar("modulos", $this->nombre, "nombre");
	}

	public function index () {
		if ($this->session->userdata("login") == null) {
			$sessionData = array('id_perfil' => 5);
			$this->session->set_userdata($sessionData);
		}
		else {
			$this->session->set_userdata("admin_active", false);
		}
		$data = array('viajes' => $this->Modelo->listar("listar_viajes", null, 1));
		$this->load->view("index", $data);
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
					$descripcion = isset($persona['informacion'])? $persona['informacion']: '';	
					$data = array(
						'id_persona' => $persona['id'],						
						'usuario' => $usuario["usuario"],
						'id_usuario' => $usuario["id"],
						'id_perfil' => $usuario['id_perfil'],
						'perfil' => $usuario['perfil'],
						'usu_f_registro' => $usuario['f_registro'],
						'usu_status' => $usuario['status'],						
						'nombre' => $persona['nombre'],
						'a_paterno' => $persona['a_paterno'],
						'a_materno' => $persona['a_materno'],
						'completo' => $persona['nombre']." ".$persona['a_paterno']." ".$persona['a_materno'],
						'correo' => $persona['correo'],
						'per_f_registro' => $persona['f_registro'],
						'per_status' => $persona['status'],
						'telefono' => $persona['telefono'],						
						'admin_active' => false,
						'informacion' => $descripcion,
						'login' => true
					);
					if ($usuario['id_perfil'] != 3) {
						$data['rfc'] = $persona['rfc'];
						$data['nss'] = $persona['nss'];						
					}
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
		$data = array( 'titulo' => 'Login' );
		$this->load->view("inicio/login_vista", $data);
	}

	public function logout () {
		$this->session->sess_destroy();
		header("Location: ".base_url());
	}

	public function registro () {
		$data = array(
			'contenidos' => array("id" => "formulario", 'url' => 'inicio/registro'),
			'titulo' => "Registrarse",
			'scripts' => array('app/formulario'),
			'actual' => $this->modulo
		);
		$this->load->view("inicio/registro_vista", $data);
	}

	public function crear () {
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules("txtNombre", "Nombre", "required");
			$this->form_validation->set_rules("txtUsuario", "Usuario", "required|is_unique[usuarios.usuario]");
			$this->form_validation->set_rules("txtCorreo", "Correo", "required|valid_email|is_unique[viajeros.correo]");
			$this->form_validation->set_rules("txtAPaterno", "Apellido Paterno", "required");
			$this->form_validation->set_rules("txtAMaterno", "Apellido Materno", "required");
			$this->form_validation->set_rules("txtTelefono", "Teléfono", "required|numeric");
			$this->form_validation->set_rules("txtContra", "Contraseña", "required");
			$this->form_validation->set_rules("txtConfirmar", "Confirmar Contraseña", "required|matches[txtContra]");
			if ($this->form_validation->run()) {
				$fecha = DateTime::createFromFormat("d/m/Y", $this->input->post("fecha"));;
				$usuarioData = array(
					'usuario' => $this->input->post("txtUsuario"),
					'contraseña' => sha1($this->input->post("txtContra")),
					'id_perfil' => 3, //Perfil de viajero
					'f_registro' => $fecha->format("Y-m-d"),
					'status' => 1 
				);
				$idUsuario = $this->Modelo->insertar("usuarios", $usuarioData);
				if ($idUsuario != false) {
					$viajeroData = array(
						'nombre' => $this->input->post("txtNombre"),
						'a_paterno' => $this->input->post("txtAPaterno"),
						'a_materno' => $this->input->post("txtAMaterno"),
						'telefono' => $this->input->post("txtTelefono"),
						'correo' => $this->input->post("txtCorreo"),
						'id_usuario' => $idUsuario,
						'f_registro' => $fecha->format("Y-m-d"),
						'status' => 1
					);
					$idViajero = $this->Modelo->insertar("viajeros", $viajeroData);
					if ($idViajero != false) {
						echo $idViajero;
					}
					else {
						$this->session->set_flashdata("error_crear", "No se pudo crear el usuario");
						redirect(base_url());
					}
				}
				else {
					$this->session->set_flashdata("error_crear", "No se pudo crear el usuario");
					redirect(base_url());
				}
			}
			else
				echo validation_errors("<li>", "</li>");
		}
		else
			show_404();		
	}
}
