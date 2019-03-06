<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion extends CI_Controller {

	private $titulo;

	public function __construct () {
		parent::__construct();
	}

	public function index()	{
		$this->titulo;
		$data = array(
			'titulo' => $titulo,
			'modulos' => modulos();
		);
	}
}
