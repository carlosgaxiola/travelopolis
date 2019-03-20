<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorAdministrar extends CI_Controller {
	
	protected $modulo = "";
	protected $actual = "";
	protected $formularios = "";
	protected $indices = "";
	protected $registros = "";
	protected $extras = "";

	public function __construct () {
		parent::__construct();
		$this->load->model("Modelo");
		$this->load->helper("global_functions_helper");
		$this->registros = $this->Modelo->listar($this->modulo);
		$this->actual = $this->Modelo->buscar("modulos", $this->modulo, "nombre");
		if (is_array($this->extras))
			foreach ($this->extras as &$extra)
				$extra = $this->Modelo->listar($extra);	
		if (!is_array($this->formularios))
			$this->formularios = $this->modulo;
	}	

	public function index () {
		if (!empty($this->modulo) && hasAccess($this->session->userdata("id_perfil"), $this->actual['id'])) {
			$data = array(
				'titulo' => ucfirst($this->modulo),
				'indices' => $this->indices,
				'actual' => $this->actual,				
				'script' => "app/".$this->modulo,
				'registros' => $this->registros,
				'extras' => $this->extras,
				'formularios' => $this->formularios
			);
			$this->load->view("administrar/listar_vista", $data);
		}
		else
			show_404();
	}

	public function toggle () {
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post("id");
			$status = $this->input->post("status");
			echo $this->Modelo->alternar($this->modulo, $idModulo, $status);
		}	
		else
			show_404();
	}

	public function edit () {
		if ($this->input->is_ajax_request()) {			
			$idLog = $this->input->post("idLog");
			if ($this->validacion($idLog)) {
				$data = array(
					'nombre' => $this->input->post("txtNombre"),
					'descripcion' => $this->input->post("txtDescripcion")
				);
				$perfil = $this->Modelo->actualizar($this->modulo, $idPerfil, $data);
				$modulo = false;
				$this->PerfilesModulosModelo->del($idPerfil);
				if (!empty($modulos))
					foreach ($modulos as $idModulo)
						$modulo |= $this->PerfilesModulosModelo->add($idPerfil, $idModulo);
				if ($perfil || $modulo)
					echo $idPerfil;
				else
					echo "0";
			}
			else
				echo validation_errors("<li>", "</li>");
		}	
		else 
		 show_404();
	}

}