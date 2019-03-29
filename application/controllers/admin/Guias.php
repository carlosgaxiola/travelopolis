<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guias extends CI_Controller {	

	private $nombre = "guias";
	private $tabla = "empleados";
	private $modulo;
	private $idPerfilGuia;
	private $guia_nss = "nss";
	private $guia_rfc = "rfc";
	private $guia_correo = "correo";
	private $guia_telefono = "telefono";
	private $usu_nombre = "usuario";
	private $sndTable = "usuarios";

	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
		$this->load->model("Modelo");
		$this->load->model("EmpleadosModelo");
		$this->modulo = $this->Modelo->buscar("modulos", $this->nombre, "nombre");
		$this->idPerfilGuia = $this->Modelo->buscar("perfiles", "Guia", "nombre")['id'];
	}

	public function index () {
		if (hasAccess($this->session->userdata("id_perfil"), $this->modulo['id'])) {
			$data = array(
				'allowAdd' => true,
				'modulo' => $this->modulo,
				'registros' => $this->EmpleadosModelo->listarGuias()
			);
			$this->load->view("administrar/main_vista", $data);
		}
		else
			show_404();
	}	

	public function add () {
		if ($this->input->is_ajax_request()) {
			if ($this->validacion()) {
				$fecha = DateTime::createFromFormat('d/m/Y', $this->input->post("fecha"));
				$usuario = array(
					'usuario' => $this->input->post("txtUsuario"),
					'contraseña' => sha1($this->input->post("txtContra")),
					'id_perfil' => $this->idPerfilGuia,
					'f_registro' => $fecha->format("Y-m-d"),
					'status' => 1
				);
				$idUsuario = $this->Modelo->insertar($this->sndTable, $usuario);
				if ($idUsuario) {
					$guia = array(
						'nombre' => $this->input->post("txtNombre"),
						'a_paterno' => $this->input->post("txtAPaterno"),
						'a_materno' => $this->input->post("txtAMaterno"),
						'telefono' => $this->input->post("txtTelefono"),
						'rfc' => $this->input->post("txtRFC"),
						'nss' => $this->input->post("txtNSS"),
						'correo' => $this->input->post("txtCorreo"),
						'id_usuario' => $idUsuario,
						'f_registro' => $fecha->format("Y-m-d"),
						'status' => 1
					);
					echo $this->Modelo->insertar($this->tabla, $guia);					
				}

			}
			else
				echo validation_errors("<li>", "</li>");
		}
		else
			show_404();
	}

	public function edit () {
		if ($this->input->is_ajax_request()) {			
			$idGuia = $this->input->post("idGuia");
			$idUsaurio = $this->input->post("idUsuario");
			if ($this->validacion($idGuia, $idUsuario)) {
				$usuario = array(
					'usuario' => $this->input->post("txtUsuario"),
					'contraseña' => $this->input->post("txtContra")
				);
				$guia = array(
					'nombre' => $this->input->post("txtNombre"),
					'a_materno' => $this->input->post("txtAMaterno"),
					'a_paterno' => $this->input->post("txtAPaterno"),
					'rfc' => $this->input->post("txtRFC"),
					'nss' => $this->input->post("txtNSS"),
					'correo' => $this->input->post("txtCorreo"),
					'telefono' => $this->input->post("txtTelefono")
				);
				$usuarioActualizado = $this->Modelo->actualizar($this->sndTable, $idUsaurio, $usuario);
				$guiaActualizado = $this->Modelo->actualizar($this->tabla, $idGuia, $guia);			
				echo ($usuarioActualizado || $guiaActualizado);
			}
			else
				echo validation_errors("<li>", "</li>");
		}	
		else 
		 show_404();
	}

	private function validacion ($idGuia = 0, $idUsuario = 0) {
		$uTelefono = "|is_unique[".$this->tabla.".".$this->guia_telefono."]";
		$uRFC = "|is_unique[".$this->tabla.".".$this->guia_rfc."]";
		$uNSS = "|is_unique[".$this->tabla.".".$this->guia_nss."]";
		$uCorreo = "|is_unique[".$this->tabla.".".$this->guia_correo."]";
		$uNombre = "|is_unique[".$this->sndTable.".".$this->usu_nombre."]";

		if ($idGuia != 0) {					
			$guia = $this->Modelo->buscar($this->tabla, $idGuia);
			if ($guia[$this->guia_telefono] == $this->input->post("txtTelefono"))
				$uTelefono = "";
			if ($guia[$this->guia_rfc] == $this->input->post("txtRFC"))
				$uRFC = "";
			if ($guia[$this->guia_nss] == $this->input->pots("txtNSS"))
				$uNSS = "";
			if ($guia[$this->guia_correo] == $this->input->post("txtCorreo"))
				$uCorreo = "";
		}

		if ($idUsuario != 0) {
			$usuario = $this->Modelo->buscar($this->sndTable, $idUsuario);
			if ($usuario[$this->usu_nombre] == $this->post("txtUsuario"))
				$uNombre = "";
		}
		
		//Validaciones de usuario
		$this->form_validation->set_rules("txtUsuario", "Usuario", "trim|required".$uNombre);
		$this->form_validation->set_rules("txtContra", "Contraseña", "trim|required");
		$this->form_validation->set_rules("txtConfirmar", "Confirmar Contraseña", "trim|required|matches[txtContra]");
		
		//Validaciones de empleado guia
		$this->form_validation->set_rules("txtNombre", "Nombre", "trim|required");
		$this->form_validation->set_rules("txtAMaterno", "Apellido Materno", "trim|required");
		$this->form_validation->set_rules("txtAPaterno", "Apellido Paterno", "trim|required");
		$this->form_validation->set_rules("txtTelefono", "Télefono", "trim|numeric|required".$uTelefono);
		$this->form_validation->set_rules("txtRFC", "RFC", "trim|required|alpha_numeric".$uRFC);
		$this->form_validation->set_rules("txtNSS", "NSS", "trim|required|numeric".$uNSS);
		$this->form_validation->set_rules("txtCorreo", "Correo", "trim|valid_email|required".$uCorreo);

		return $this->form_validation->run();
	}

	public function toggle () {
		if ($this->input->is_ajax_request()) {
			$idGuia = $this->input->post("idGuia");
			$idUsuario = $this->input->post("idUsuario");
			$status = $this->input->post("status");
			$guiaConmutado = $this->Modelo->alternar($this->tabla, $idGuia, $status);
			$usuarioConmutado = $this->Modelo->alternar($this->tabla, $idUsuario, $status);
			echo ($guiaConmutado || $usuarioConmutado);
		}	
		else
			show_404();
	}

}