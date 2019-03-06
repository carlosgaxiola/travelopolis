<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require "Modelo.php";
class ModulosModelo extends Modelo {

	private $tabla = "modulos";
	private $id = "id";	

	public function __construct () {
		parent::__construct();
	}

	public function modulosPerfil ($idPerfil) {
		$this->db->where("id_perfil", $idPerfil);
		$this->db->join("modulos_perfiles mp", "mp.id_modulo = ".$this->tabla.".id");
		parent::listar($this->tabla, 1);
	}
}