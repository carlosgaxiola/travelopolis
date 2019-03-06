<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	protected $tabla;
	protected $unicos = array();	
	protected $titulo;
	protected $vista;

	public function __construct () {
		parent::__construct();
		$this->load->model("Modelo");
	}

	public function index () {
		$this->load->view("Global/header");
		$this->load->view("Global/navbar");
		$this->load->view($vista, $data);
		$this->load->view("Global/footer");
	}	
}