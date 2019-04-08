<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpleadosModelo extends CI_Model {

	private $perfil_guia = "Guia";
	private $perfil_admin = "Administrador";	

	public function __construct () {
		parent::__construct();
	}

	public function listarGuias () {
		$this->db->select("emps.*, usus.usuario");
		$this->db->join("usuarios usus", "usus.id = emps.id_usuario");
		$this->db->join("perfiles pers", "pers.id = usus.id_perfil");
		$this->db->where("pers.nombre", $this->perfil_guia);
		$guias = $this->db->get("empleados emps");
		if ($guias->num_rows() > 0)
			return $guias->result_array();
		return false;
	}
}