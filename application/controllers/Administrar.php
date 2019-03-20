<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrar extends CI_Controller {
	
	private $nombre = "administrar";	
	private $currenConfig = '';
	private $modulo;

	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");		
		$this->load->model("Modelo");		
		$this->modulo = $this->Modelo->buscar("modulos", $this->nombre, "nombre");
	}

	public function index ($moduloActual = '') {
		$idPerfil = $this->session->userdata("id_perfil");
		if (hasAccess($idPerfil, $this->modulo['id'])) {
			if (empty($moduloActual)) {
				$moduloActual = $this->Modelo->buscar("modulos", "perfiles", "nombre");
				if (hasAccess($idPerfil, $moduloActual['id'])) {
					$this->currenConfig = getPerfilesConfig();
					$this->currenConfig['modulo'] = $moduloActual;
					$this->load->view("administrar_vista", $this->currenConfig);
				}
				else {
					show_404();
				}	
			}
			else {	
				$moduloActual = $this->Modelo->buscar("modulos", $moduloActual, "nombre");
				if (hasAccess($idPerfil, $moduloActual['id'])) {
					$this->session->set_userdata("admin_active", true);
					$configFunction = "get".ucfirst($moduloActual['nombre'])."Config";
					$this->currenConfig = getPerfilesConfig();
					$this->currenConfig['modulo'] = $moduloActual;
					$this->load->view("administrar_vista", $this->currenConfig);
				}
				else {
					show_404();
				}			
			}
		}
		else
			show_404();			
	}

	private function getPerfilesConfig () {
		$config = array(
			'formulario' => 'administrar/perfiles',
			'script' => 'app/perfiles',
			'editar' => true,
			'registros' => $this->Modelo->listar("perfiles"),
			'indices' => array(
				'id' => array(
					'frm' => 'idPerfil',
					'tbl' => '#'					
				),
				'nombre' => array(
					'frm' => 'txtNombre',
					'tbl' => 'Nombre',					
					'validations' => array('required', 'unique')
				),
				'descripcion' => array(
					'frm' => 'txtDescripcion',
					'tbl' => 'Descripción',
					'validations' => array('required')
				)
			)
		);	
		return $config;	
	}

	private function getViajesConfig () {
		$config = array(
			'formulario' => 'administrar/viajes',
			'script' => 'app/viajes',
			'editar' => true,
			'status' => true,
			'registros' => $this->Modelo->listar("viajes"),
			'indices' => array(
				'id' => array(
					'frm' => 'idViaje',
					'tbl' => '#'
				),
				'nombre' => array(
					'frm' => 'txtNombre',
					'tbl' => 'Nombre',					
					'validations' => array('required', 'unique')
				),
				'descripcion' => array(
					'frm' => 'txtDescripcion',
					'tbl' => 'Descripción',
					'validations' => array('required')
				),
				'minimo' => array(
					'frm' => 'txtMinimo',
					'tbl' => 'MIN',
					'validations' => array('required', 'numeric')
				),
				'maximo' => array(
					'frm' => 'txtMaximo',
					'tbl' => 'Maximo',
					'validations' => array('required', 'numeric')
				),
				'precio' => array(
					'frm' => 'txtPrecio',
					'tbl' => 'Precio',
					'validations' => array('required', 'decimal', 'numeric')
				),
				'dias_duracion' => array(
					'frm' => 'txtDiasDuracion',
					'tbl' => 'Dias Duración',
					'validations' => array('required', 'numeric')
				)
			)
		);
	}