<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ViajeroModelo extends CI_Model {

	private $PERFIL_GUIA = 2;
	private $PERFIL_ADMIN = 1;
	private $PERFIL_VIAJERO = 3;

	public function __construct() {
		parent::__construct();
	}

	public function viajes ($idUsuario) {
		$this->db->select("via.*");
		$this->db->join("detalle_viajes det", "det.id_viaje = via.id");
		$this->db->where("det.id_viajero", $idUsuario);
		$viajes = $this->db->get("viajes via");
		$total = $viajes->num_rows();
		if ($total > 0) {
			$viajes = $viajes->result_array();
			$viajes['total'] = $total;
			return $viajes;
		}
		return false;
	}

	public function buscar ($usuario) {				
		$this->db->select("usuarios.*, perfiles.nombre as perfil");
		$this->db->where("usuario", $usuario);
		$this->db->join("perfiles", "perfiles.id = usuarios.id_perfil");		
		$usuario = $this->db->get("usuarios");		
		if ($usuario->num_rows() > 0) {
			$usuario = $usuario->row_array();
			$this->db->where("id_usuario", $usuario['id']);
			switch ($usuario['id_perfil']) {
				case $this->PERFIL_ADMIN:
				case $this->PERFIL_GUIA:
					$persona = $this->db->get("empleados");
					break;
				case $this->PERFIL_VIAJERO:
					$persona = $this->db->get("viajeros");
					break;
			}
			if ($persona->num_rows() > 0) {
				$persona = $persona->result_array();
				return array("usuario" => $usuario, "persona" => $persona);
			}
			return false;
		}
		return false;
	}	
}