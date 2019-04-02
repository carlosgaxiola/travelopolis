<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Viajes extends CI_Controller {
	
	private $nombre = "Viajes";
	private $tbl_viajes = "viajes";
	private $modulo;
	private $tbl_tipos_viaje = "tipos_viaje";
	private $tbl_dias_viaje = "dias_viajes";
	private $listar_detalle_viaje = "listar_detalle_viaje";

	private $ABRIR_REGITRO = 1;
	private $CERRAR_REGISTRO = 2;
	private $INACTIVO = 0;
	private $EN_CURSO = 4;
	private $REALIZADO = 3;

	public function __construct () {
		parent::__construct();
		$this->load->model("Modelo");
		$this->load->helper("global_functions_helper");
		$this->load->model("ViajesModelo");
		$this->modulo = $this->Modelo->buscar("modulos", $this->tbl_viajes, "nombre");
	}

	public function index () {
		if ($this->session->userdata("admin_active") && hasAccess($this->session->userdata("id_perfil"), $this->modulo['id'])) {
			$tiposViaje = $this->Modelo->listar($this->tbl_tipos_viaje);
			$data = array(
				'allowAdd' => true,
				'modulo' => $this->modulo,
				'registros' => $this->ViajesModelo->viajes(),
				'styles' => array("daterangepicker"),
				'scripts' => array("moment", "daterangepicker"),
				'extras' => array('tiposViaje' => $tiposViaje)
			);
			$this->load->view("administrar/main_vista", $data);
		}
		else
			show_404();
	}

	public function add () {
		if ($this->input->is_ajax_request()) {
			if ($this->validar()) {
				$fecha = DateTime::createFromFormat('d/m/Y', $this->input->post("fecha"));
				$fechaInicio = DateTime::createFromFormat("d/m/Y", $this->input->post("txtFechaInicio"));
				$fechaFin = DateTime::createFromFormat("d/m/Y", $this->input->post("txtFechaFin"));
				$viaje = array(
					'nombre' => $this->input->post("txtNombre"),
					'descripcion' => $this->input->post("txtDescripcion"),
					'maximo' => $this->input->post("txtMaximo"),
					'minimo' => $this->input->post("txtMinimo"),
					'dias_duracion' => $this->input->post("txtDias"),
					'noches_duracion' => $this->input->post("txtNoches"),
					'dias_espera_devolucion' => $this->input->post("txtDiasDevolucion"),
					'precio' => $this->input->post("txtPrecio"),
					'f_inicio' => $fechaInicio->format("Y-m-d"),
					'f_fin' => $fechaFin->format("Y-m-d"),
					'id_tipo_viaje' => $this->input->post("cmbTipoViaje"),
					'f_registro' => $fecha->format("Y-m-d"),
					'status' => 0 //Estado inactivo
				);				
				$idViaje = $this->Modelo->insertar($this->tbl_viajes, $viaje);
				if ($idViaje) {
					foreach ($this->input->post("dias") as $index => $dia) {
						$f_dia = DateTime::createFromFormat('d/m/Y', $dia['fecha']);;
						$dia_data = array(
							'nombre' => $dia['nombre'],
							'f_dia' => $f_dia->format("Y-m-d"),
							'descripcion' => $dia['descripcion'],
							'id_viaje' => $idViaje,
							'f_registro' => $fecha->format("Y-m-d"),
							'indice' => "dia".$index."viaje".$idViaje
						);
						$this->Modelo->insertar($this->tbl_dias_viaje, $dia_data);
					}
					echo $idViaje;
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
			$idViaje = $this->input->post("idViaje");
			$fecha = DateTime::createFromFormat("d/m/Y", $this->input->post("fecha"));
			$fechaInicio = DateTime::createFromFormat('d/m/Y', $this->input->post("txtFechaInicio"));
			$fechaFin = DateTime::createFromFormat('d/m/Y', $this->input->post("txtFechaFin"));
			if ($this->validar($idViaje)) {
				$viaje = array(
					'nombre' => $this->input->post("txtNombre"),
					'descripcion' => $this->input->post("txtDescripcion"),
					'maximo' => $this->input->post("txtMaximo"),
					'minimo' => $this->input->post("txtMinimo"),
					'dias_duracion' => $this->input->post("txtDias"),
					'noches_duracion' => $this->input->post("txtNoches"),
					'dias_espera_devolucion' => $this->input->post("txtDiasDevolucion"),
					'precio' => $this->input->post("txtPrecio"),
					'f_inicio' => $fechaInicio->format("Y-m-d"),
					'f_fin' => $fechaFin->format("Y-m-d"),
					'id_tipo_viaje' => $this->input->post("cmbTipoViaje")					
				);
				$dias = $this->input->post("dias");
				if (is_array($dias) and !empty($dias)) {
					$this->Modelo->actualizar($this->tbl_viajes, $idViaje, $viaje);
					$this->Modelo->borrar($this->tbl_dias_viaje, "id_viaje", $idViaje);
					foreach ($dias as $index => $dia) {
						$fechaDia = DateTime::createFromFormat('d/m/Y', $dia['fecha']);
						$dataDia = array(
							'id_viaje' => $idViaje,
							'nombre' => $dia['nombre'],
							'descripcion' => $dia['descripcion'],
							'f_dia' => $fechaDia->format("Y-m-d"),
							'indice' => 'dia'.($index + 1).'viaje'.$idViaje
						);
						$this->Modelo->insertar($this->tbl_dias_viaje, $dataDia);
					}
					echo $idViaje;					
				}
				else
					echo "Los días no pueden estar vacios";
			}
			else				
				echo validation_errors("<li>", "</li>");		
		}
		else
			show_404();
	}

	public function diasViaje () {
		if ($this->input->is_ajax_request()) {
			$idViaje = $this->input->post("idViaje");
			if ($idViaje == null or empty($idViaje))
				echo "false";
			else
				echo json_encode($this->ViajesModelo->listarDias($idViaje));
		}
		else
			show_404();
	}

	public function validar ($idViaje = 0) {
		$uNombre = "|is_unique[".$this->tbl_viajes.".nombre]";
		if ($idViaje != 0) {
			$viaje = $this->Modelo->buscar($this->tbl_viajes, $idViaje);
			if ($this->input->post("txtNombre") == $viaje['nombre']) {
				$uNombre = "";
			}
		}
		$this->form_validation->set_rules("txtNombre", "Nombre", "trim|required".$uNombre);
		$this->form_validation->set_rules("txtMinimo", "Mínimo", "trim|required|numeric");		
		$this->form_validation->set_rules("txtMaximo", "Máximo", "trim|required|numeric");
		$this->form_validation->set_rules("txtPrecio", "Precio", "trim|required");
		$this->form_validation->set_rules("txtDias", "Días", "trim|required|numeric");
		$this->form_validation->set_rules("txtNoches", "Noches", "trim|required|numeric");
		$this->form_validation->set_rules("txtDiasDevolucion", "Días para devolucion de pago", "trim|required|numeric");
		$this->form_validation->set_rules("txtDescripcion", "Descripción", "trim|required");		
		$this->form_validation->set_rules("txtFechaInicio", "Fecha Inicio", "trim|required");
		$this->form_validation->set_rules("txtFechaFin", "Fecha Inicio", "trim|required");
		$this->form_validation->set_rules("cmbTipoViaje", "Tipo de viaje", "required|is_natural_no_zero");

		$this->form_validation->set_message("is_natural_no_zero", "Seleccione un %s");
		$this->form_validation->set_message("less_than", "El campo %s debe ser menor a 100");		
		$this->form_validation->set_message("required", "El campo %s es obligatorio");
		$this->form_validation->set_message("is_unique", "El campo %s ya existe");
		$this->form_validation->set_message("numeric", "El campo %s debe ser numerico");
		return $this->form_validation->run();
	}

	public function editDias () {
		if ($this->input->is_ajax_request()) {
			$dias = $this->input->post("dias");
			$idViaje = $this->input->post("idViaje");
			if (is_array($dias) and !empty($dias)) {
				$this->Modelo->borrar($this->tbl_dias_viaje, "id_viaje", $idViaje);
				$diasActualizados = true;
				foreach ($dias as $index => $dia) {
					$dataDia = array(
						'id_viaje' => $idViaje,
						'nombre' => $dia['nombre'],
						'descripcion' => $dia['descripcion'],
						'f_dia' => $dia['fecha'],
						'indice' => 'dia'.($index + 1).'viaje'.$idViaje
					);
					$diasActualizados &= $this->Modelo->insertar($this->tbl_dias_viaje, $data);
				}
				echo $diasActualizados;
			}
			else
				echo "Los días no pueden estar vacios";
		}
		else
			show_404();
	}

	public function data () {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Modelo->listar($this->tbl_viajes));
		}
		else
			show_404();
	}

	public function dias () {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->ViajesModelo->listarDias());
		}
		else
			show_404();
	}

	public function abrir ($idViaje) {
		if ($this->input->is_ajax_request()) {			
			$data = array("status" => $this->ABRIR_REGITRO);
			echo $this->Modelo->actualizar($this->tbl_viajes, $idViaje, $data);
		}
		else
			show_404();
	}

	public function cerrar ($idViaje) {
		if ($this->input->is_ajax_request()) {
			$data = array("status" => $this->CERRAR_REGISTRO);
			echo $this->Modelo->actualizar($this->tbl_viajes, $idViaje, $data);
		}
		else
			show_404();
	}

	public function empezar ($idViaje) {
		if ($this->input->is_ajax_request()) {
			$data = array("status" => $this->EN_CURSO);
			echo $this->Modelo->actualizar($this->tbl_viajes, $idViaje, $data);
		}
		else
			show_404();
	}

	public function terminar ($idViaje) {
		if ($this->input->is_ajax_request()) {
			$data = array("status" => $this->REALIZADO);
			echo $this->Modelo->actualizar($this->tbl_viajes, $idViaje, $data);
		}
		else
			show_404();
	}

	public function ver () {
		$nombre_viaje = $this->input->get("viaje");
		if ($nombre_viaje && !empty($nombre_viaje)) {
			$viaje = $this->Modelo->buscar($this->tbl_viajes, $nombre_viaje, "nombre");
			$detalles = $this->Modelo->buscar($this->listar_detalle_viaje, $nombre_viaje, "viaje");			
			$this->modulo['nombre'] = "Detalle";
			$this->modulo['nombre_personalizado'] = $nombre_viaje;
			$this->modulo['listado_personalizado'] = "Viajeros en ".$nombre_viaje;
			$this->modulo['descripcion'] = "Vizualizar los vijeros dentro del viaje";
			$data = array(
				'registros' => $detalles,
				'viaje' => $viaje,
				'modulo' => $this->modulo
			);
			$this->load->view("administrar/main_vista", $data);
		}
		else
			show_404();
	}
}