<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioModelo extends CI_Model {

	private $tabla = "usuarios";
	private $segTabla = "perfiles";

	public function __construct () {
		parent::__construct();
	}

	public function login ($usuario, $contra) {
		$this->db->select("usu.*, per.nombre AS perfil");
		$this->db->where("usu.usuario", $usuario);
		$this->db->where("usu.contraseña", sha1($contra));
		$this->db->where("usu.status", 1);
		$this->db->join($this->segTabla." per", "per.id = usu.id_perfil");
		$usuario = $this->db->get($this->tabla." usu");
		if ($usuario->num_rows() > 0)
			return $usuario->row_array();
		return false;
	}
}