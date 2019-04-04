<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpleadosModelo extends CI_Model {

	private $tbl_emps = "empleados";
	private $tbl_usus = "usuarios";
	private $tbl_pers = "perfiles";

	private $perfil_guia = "Guia";
	private $perfil_admin = "Administrador";


	private $tbl_usus_abv = "usus";
	private $tbl_emps_abv = "emps";
	private $tbl_emps_id = "id";
	private $tbl_emps_id_usu = "id_usuario";
	private $tbl_usus_id = "id";
	private $tbl_usus_id_perfil = "id_perfil";
	private $tbl_pers_abv = "pers";
	private $tbl_pers_id = "id";
	private $tbl_pers_nombre = "nombre";
	private $tbl_usus_nombre = "usuario";

	private $emps_join_usus;
	private $usus_join_pers;

	public function __construct () {
		$this->emps_join_usus = $this->tbl_usus_abv.".".$this->tbl_usus_id." = ".$this->tbl_emps_abv.".".$this->tbl_emps_id_usu;
		$this->usus_join_pers = $this->tbl_pers_abv.".".$this->tbl_pers_id." = ".$this->tbl_usus_abv.".".$this->tbl_usus_id_perfil;
		parent::__construct();
	}

	public function listarGuias () {
		$this->db->select($this->tbl_emps_abv.".*,".$this->tbl_usus_abv.".".$this->tbl_usus_nombre);
		$this->db->join($this->tbl_usus." ".$this->tbl_usus_abv, $this->emps_join_usus);
		$this->db->join($this->tbl_pers." ".$this->tbl_pers_abv, $this->usus_join_pers);
		$this->db->where($this->tbl_pers_abv.".".$this->tbl_pers_nombre, $this->perfil_guia);
		$guias = $this->db->get($this->tbl_emps." ".$this->tbl_emps_abv);
		if ($guias->num_rows() > 0)
			return $guias->result_array();
		return false;
	}

	public function listarAdmins () {
		$this->db->select($this->tbl_emps_abv.".*,".$this->tbl_usus_abv.".".$this->tbl_usus_nombre);
		$this->db->join($this->tbl_usus." ".$this->tbl_usus_abv, $this->emps_join_usus);
		$this->db->join($this->tbl_pers." ".$this->tbl_pers_abv, $this->usus_join_pers);
		$this->db->where($this->tbl_pers_abv.".".$this->tbl_pers_nombre, $this->perfil_admin);
		$guias = $this->db->get($this->tbl_emps." ".$this->tbl_emps_abv);
		if ($guias->num_rows() > 0)
			return $guias->result_array();
		return false;
	}

}