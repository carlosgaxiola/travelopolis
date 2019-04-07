<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignar extends CI_Controller {

	private $nombre = "asignar guias";
	private $tabla = "guias_viajes";
	private $modulo;

	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
		$this->load->model("Modelo");	
		$this->load->model("AsignarModelo");
		$this->modulo = $this->Modelo->buscar("modulos", $this->nombre, "nombre");
	}

	public function index () {
		if ($this->session->userdata("admin_active") && hasAccess($this->session->userdata("id_perfil"), $this->modulo['id'])) {
			$this->modulo['nombre'] = "asignar";
			$this->modulo['nombre_personalizado'] = "Asignar Guias";			
			$this->modulo['descripcion'] = "Asigna un guia un viaje";
			$data = array(
				'modulo' => $this->modulo,
				'registros' => $this->Modelo->listar("listar_viajes_guias"),
				'scripts' => array("moment"),
				'guias' => $this->Modelo->listar("listar_guias")
			);
			$this->load->view("admin/main_vista", $data);
		}
		else
			show_404();
	}

	public function cambiar_guia () {
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("admin_active") && hasAccess($this->session->userdata("id_perfil"), $this->modulo['id'])) {
				$this->form_validation->set_rules("idGuia", "Guia", "trim|required|numeric|is_natural_no_zero");
				$this->form_validation->set_rules("idViaje", "Viaje", "trim|required|numeric|is_natural_no_zero");
				$this->form_validation->set_message("is_natural_no_zero", "Seleccione un {field}");
				if ($this->form_validation->run()) {
					$data = $this->input->post();
					if ($this->AsignarModelo->guiaDisponible($data['idGuia'], $data['idViaje'])) {
						if ($this->AsignarModelo->cambiar($data['idViaje'], $data['idGuia'])) {
							echo json_encode(array("result" => "cambiado"));
						}
						else
							echo json_encode(array("result" => "error"));
					}
					else
						echo json_encode(array("result" => "no disponible", "message" => "El guia no esta disponible para este viaje"));
				}
				else
					echo validation_errors("<li>", "</li>");
			}
			else
				echo json_encode(array("result" => "error", "message" => "no tiene permiso"));
		}
		else
			show_404();
	}

	public function asignar_guia () {
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("admin_active") && hasAccess($this->session->userdata("id_perfil"), $this->modulo['id'])) {
				$this->form_validation->set_rules("idGuia", "Guia", "trim|required|numeric|is_natural_no_zero");
				$this->form_validation->set_rules("idViaje", "Viaje", "trim|required|numeric|is_natural_no_zero");
				$this->form_validation->set_message("is_natural_no_zero", "Seleccione un {field}");
				if ($this->form_validation->run()) {
					$data = $this->input->post();
					if ($this->AsignarModelo->guiaDisponible($data['idGuia'], $data['idViaje'])) {
						if ($this->AsignarModelo->asignar($data['idViaje'], $data['idGuia'])) {
							echo json_encode(array("result" => "asignado"));
						}
						else
							echo json_encode(array("result" => "error"));
					}
					else
						echo json_encode(array("result" => "no disponible", "message" => "El guia no esta disponible para este viaje"));
				}
				else
					echo validation_errors("<li>", "</li>");
			}
			else
				echo json_encode(array("result" => "error", "message" => "no tiene permiso"));
		}
		else
			show_404();
	}

	public function guia ($idGuia) {
		if ($this->input->is_ajax_request())
			echo json_encode($this->Modelo->buscar("listar_guias", $idGuia));
		else
			show_404();
	}
}