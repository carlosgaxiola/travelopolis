<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PerfilesModulosModelo extends CI_Model {

	private $union = "perfiles_modulos";	
	private $modulos = "modulos";	
	private $perfiles = "perfiles";	

	public function __construct () {
		parent::__construct();		
	}

	public function modulosPerfil ($idPerfil) {
		$this->db->select("mods.*");
		$this->db->where("pm.id_perfil", $idPerfil);
		$this->db->join($this->union." pm", "pm.id_modulo = mods.id");
		$this->db->order_by("mods.nombre");
		$modulos = $this->db->get($this->modulos." mods");
		if ($modulos->num_rows() > 0)
			return $modulos->result_array();
		return false;
	}

	public function add ($idPerfil, $idModulo) {		
		$this->db->set("id_modulo", $idModulo);
		$this->db->set("id_perfil", $idPerfil);
		$this->db->insert($this->union);		
		if ($this->db->affected_rows() > 0)
			return $this->db->insert_id();
		return false;
	}

	public function del ($idPerfil) {
		$this->db->where("id_perfil", $idPerfil);
		$this->db->delete($this->union);		
		return ($this->db->affected_rows() > 0);
	}

	public function moduloHijos ($idModulo)  {
		$this->db->where("status", 1);
		$this->db->where("id_padre", $idModulo);
		$modulos = $this->db->get($this->modulos);
		if ($modulos->num_rows() > 0)
			return $modulos->result_array();
		return false;
	}

	public function get ($idPerfil, $idModulo) {
		$this->db->where("id_perfil", $idPerfil);
		$this->db->where("id_modulo", $idModulo);
		$reg = $this->db->get($this->union);
		if ($reg->num_rows() > 0)
			return  $reg->row_array();
		return false;
	}
}
