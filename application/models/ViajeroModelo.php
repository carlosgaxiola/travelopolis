<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ViajeroModelo extends CI_Model {

	const PERFIL_GUIA = 2;
	const PERFIL_ADMIN = 1;
	const PERFIL_VIAJERO = 3;

	public function __construct() {
		parent::__construct();
	}

	public function viajes ($idUsuario) {
		$this->db->select("vias.*");
		$this->db->join("detalle_viajes det", "det.id_viaje = vias.id");
		$this->db->where("det.id_viajero", $idUsuario);
		$viajes = $this->db->get("viajes vias");
		$total = $viajes->num_rows();
		if ($total > 0) {
			$viajes = $viajes->result_array();
			$viajes['total'] = $total;
			return $viajes;
		}
		return false;
	}

	public function buscar ($usuario) {				
		$this->db->where("usuario", $usuario);		
		$usuario = $this->db->get("usuarios");
		if ($usuario->num_rows() > 0) {
			$usuario = $usuario->result_array();
			$this->db->where("id_usuario", $usuario['id']);
			switch ($usuario['id_perfil']) {
				case PERFIL_ADMIN:
				case PERFIL_GUIA:
					$persona = $this->db->get("empleados");
					break;
				case PERFIL_VIAJERO:
					$persona = $this->db->get("viajeros");
					break;
			}
			if ($persona->num_rows() > 0) {
				$persona = $persona->result_array();
				return array_merge($persona, $usuario);
			}
			return false;
		}
		return false;
	}	
}