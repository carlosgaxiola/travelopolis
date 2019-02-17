<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion extends CI_Controller {

	public function index()	{
		$data = array(
			'titulo' => "Travelopolis"
		);
		$this->load->view("Inicio/inicio_vista", $data);
	}
}
