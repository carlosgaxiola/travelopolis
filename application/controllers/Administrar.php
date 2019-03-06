<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require "Crud.php";
class Administrar extends Crud {
		
	public function __construct() {
		parent::__construct();		
	}	

	public function empleados () {
		$this->tabla = "empleados";
		$this->unicos = array('telefono', 'rfc', 'nss');
		$this->titulo = "Empleados";
	}
}
