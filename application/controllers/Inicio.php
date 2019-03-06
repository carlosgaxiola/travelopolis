<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	private $titulo = "Inicio";

	public function __construct () {
		parent::__construct();
		$this->load->helper("global_functions_helper");
	}

	public function index () {
		if ($this->session->userdata("login") == null) {
			$data = array(
				"id_perfil" => 5
			);
			$this->session->set_userdata($data);
		}
		$data = array(
			'modulos' => modulos(),
			'titulo' => $this->titulo
		);		
		$this->load->view("Inicio/inicio_vista", $data);		
	}

	public function ingresar () {
		$data = array(
			'modulos' => modulos(),
			'titulo' => $this->titulo
		);
		$this->load->view("Inicio/login_vista", $data);
	}

	public function load () {
		if ($this->input->is_ajax_request()) {
			$pagina = $this->input->post("pagina");
			$this->load->view("Inicio/".$pagina."_vista");
		}
		else
			show_404();
	}
}