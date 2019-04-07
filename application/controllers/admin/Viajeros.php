<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viajeros extends CI_Controller {	

	private $nombre = "Viajes";
	private $tbl_viajeros = "viajeros";
	private $modulo;
	private $lst_viajeros = "listar_viajeros";
	private $tbl_usuarios = "usuarios";

	public function __construct () {
		parent::__construct();
		$this->load->model("Modelo");
		$this->load->helper("global_functions_helper");		
		$this->modulo = $this->Modelo->buscar("modulos", $this->tbl_viajeros, "nombre");
	}

	public function index () {
		if ($this->session->userdata("admin_active") && hasAccess($this->session->userdata("id_perfil"), $this->modulo['id'])) {			
			$data = array(
				'allowAdd' => true,
				'modulo' => $this->modulo,
				'registros' => $this->Modelo->listar($this->lst_viajeros),
				'scripts' => array("moment", "sha1"),
				'estados' => $this->Modelo->listar("estados")
			);
			$this->load->view("admin/main_vista", $data);
		}
		else
			show_404();
	}

	public function data () {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Modelo->listar($this->lst_viajeros));
		}
		else
			show_404();
	}

	public function add () {
		if ($this->input->is_ajax_request()) {
			if ($this->validar()) {
				$fecha = DateTime::createFromFormat('d/m/Y', $this->input->post("fecha"));
				$data_usuario = array(
					'usuario' => $this->input->post("usuario"),
					'contraseña' => $this->input->post("contra"),
					'f_registro' => $fecha->format("Y-m-d"),
					'status' => 1
				);
				$idUsuario = $this->Modelo->insertar($this->tbl_usuarios, $data_usuario);
				if ($idUsuario) {
					$data_viajero = array(
						'nombre' => $this->input->post("nombre"),
						'a_paterno' => $this->input->post("paterno"),
						'a_materno' => $this->input->post("materno"),
						'edad' => $this->input->post("edad"),
						'sexo' => $this->input->post("sexo"),
						'correo' => $this->input->post("correo"),
						'telefono' => $this->input->post("telefono"),
						'estado' => $this->input->post("estado"),
						'informacion' => $this->input->post("informacion"),
						'f_registro' => $fecha->format("Y-m-d"),
						'id_usuario' => $idUsuario,
						'status' => 1
					);
					if ($idViajero = $this->Modelo->insertar($this->tbl_viajeros, $data_viajero))
						echo $idViajero;
					else
						echo "-1";
				}
				else
					echo "0";
			}
			else
				echo validation_errors("<li>", "</li>");
		}
		else
			show_404();
	}

	public function edit () {
		if ($this->input->is_ajax_request()) {
			$idViajero = $this->input->post("id");
			if ($this->validar($idViajero)) {
				$data_usuario = array(
					'usuario' => $this->input->post("usuario"),
					'contraseña' => $this->input->post("contra")
				);				
				$data_viajero = array(
					'nombre' => $this->input->post("nombre"),
					'a_paterno' => $this->input->post("paterno"),
					'a_materno' => $this->input->post("materno"),
					'edad' => $this->input->post("edad"),
					'sexo' => $this->input->post("sexo"),
					'correo' => $this->input->post("correo"),
					'telefono' => $this->input->post("telefono"),
					'estado' => $this->input->post("estado"),
					'informacion' => $this->input->post("informacion")
				);
				$this->Modelo->actualizar($this->tbl_usuarios, $idViajero, $data_usuario);
				$this->Modelo->actualizar($this->tbl_viajeros, $idViajero, $data_viajero);
				echo $idViajero;
			}
			else
				echo validation_errors("<li>", "</li>");			
		}
		else
			show_404();
	}

	private function validar ($idViajero = 0) {
		$uCorreo = "|is_unique[".$this->lst_viajeros.".correo]";
		$uUsuario = "|is_unique[".$this->lst_viajeros.".usuario]";
		if ($idViajero != 0) {
			$vijero = $this->Modelo->buscar($this->lst_viajeros, $idViajero);
			if ($vijero['correo'] == $this->input->post("correo"))
				$uCorreo = "";
			if ($vijero['usuario'] == $this->input->post("usuario"))
				$uUsuario = "";			
		}

		$this->form_validation->set_rules("nombre", "Nombre", "trim|required");
		$this->form_validation->set_rules("paterno", "Apellido Paterno", "trim|required");
		$this->form_validation->set_rules("materno", "Apellido Materno", "trim|required");
		$this->form_validation->set_rules("edad", "Edad", "trim|numeric");
		$this->form_validation->set_rules("sexo", "Sexo", "trim|alpha");
		$this->form_validation->set_rules("correo", "Correo", "trim|required|valid_email".$uCorreo);
		$this->form_validation->set_rules("telefono", "Teléfono", "trim|numeric|max_length[10]");
		$this->form_validation->set_rules("estado", "Estado de residencia", "trim|required");
		$this->form_validation->set_rules("usuario", "Usuario", "trim|required".$uUsuario);
		$this->form_validation->set_rules("contra", "Contraseña", "trim|required");
		$this->form_validation->set_rules("confirmar", "Confirmar Contraseña", "trim|required");
		$this->form_validation->set_message("is_natural_no_zero", "Seleccione un {field}");
		return $this->form_validation->run();
	}

	public function toggle () {
		if ($this->input->is_ajax_request()) {
			$idViajero = $this->input->post("idViajero");			
			$status = $this->input->post("status");
			echo $this->Modelo->alternar($this->tbl_viajeros, $idViajero, $status);
		}	
		else
			show_404();
	}
}