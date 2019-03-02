<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	protected $tabla;
	protected $camposUnicos = array();
	protected $titulo;

	public function __construct () {
		parent::__construct();
		$this->load->model("CrudModel");
	}

	public function index () {
		$data = array(
			'titulo' => $this->titulo,
			'modulos' => getModulos(),
			'datos' => $this->CrudModel->list($this->tabla);
		);
	}
}