<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrar extends CI_Controller {	

	private $nombre = "inicio administrador";
	private $modulo;

	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
		$this->load->model("Modelo");
		$this->modulo = $this->Modelo->buscar("modulos", $this->nombre, "nombre");
	}

	public function index () {		
		if (hasAccess($this->session->userdata("id_perfil"), $this->modulo['id'])) {
			$this->session->set_userdata("admin_active", true);
			$data = array(
				'modulo' => $this->modulo
			);
			$this->load->view("administrar/main_vista", $data);
		}
		else
			show_404();		
	}

	public function salir () {
		$this->session->set_userdata("admin_active", false);
		redirect(base_url());
	}
}