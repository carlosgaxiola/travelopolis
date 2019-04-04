<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Crud extends CI_Controller {

	protected $table;
	protected $index;
	protected $scripts;
	protected $forms;

	private const ADD_PER = 0;
	private const EDIT_PER = 1;
	private const DEL_PER = 2;

	public function __construct () {
		parent::__construct();
		$this->load->model("Modelo");
	}

	public function index () {
		$this->config = getDefaultConfig();
	}

	public function add () {
		$error = false;
		if ($this->input->is_ajax_request()) {
			if ($this->validModuleAccess()) {
				$idUsuario = $this->getUserData();
				if (isAllowed($idUsuario, $this->table, $this->ADD_PER)) {

				}
				else
					show_
			}
		}		
		if ($error)
			show_404();
	}
	
	protected function getUserData ($field = "id") {
		if ($this->session->userdata("login") != null)
			return $this->session->userdata($field);
		else
			echo "No hay sesion iniciada";
	}

	protected function toggle () {

	}

	protected function validModuleAccess () {
		$idPerfil = $this->getUserData("id_perfil");
		if (empty($this->modulo))
			redirec(base_url("inicio/error"));
		else {
			$idModulo = $this->modulo['id'];
			if (hasAccess($idPerfil, $idModulo))
				return true			
			return false;
		}		
	}	
}