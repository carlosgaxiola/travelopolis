<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ViajesModelo extends CI_Model {

	public function __construct () {
		parent::__construct();
	}

	public function listarDias ($idViaje = 0) {
		if ($idViaje != 0) {
			$this->db->where("id_viaje");
			$dias = $this->db->get("dias_viajes");
			if ($dias->num_rows() > 0)
				return $dias->result_array();
			return false;
		}
		else {
			$viajes = $this->db->select("id")->get("viajes");
			if ($viajes->num_rows() == 0)
				return false;
			else
				$viajes = $viajes->result_array();
			foreach ($viajes as &$viaje) {
				$viaje['dias'] = $this->db->
					select("nombre, descripcion, f_dia as fecha, id")->
					where("id_viaje", $viaje['id'])->
					get("dias_viajes")->
					result_array();
			}
			return $viajes;
		}
	}

	public function viajes ($status = -1) {
		if ($status != -1)
			$this->db->where("status", $status);
		$this->db->select("viajes.*, tipo.nombre as tipo");
		$this->db->join("tipos_viaje tipo", "tipo.id = viajes.id_tipo_viaje");
		$viajes = $this->db->get("viajes");
		if ($viajes->num_rows() > 0)
			return $viajes->result_array();
		return false;
	}

	public function abonar ($cantidad, $idViaje, $idViajero) {
		$this->db->where("id_viaje", $idViaje);
		$this->db->where("id_viajero", $idViajero);
		$this->db->set("resto", "resto - ".$cantidad, false);
		$this->db->update("detalle_viajes");
		return $this->db->affected_rows() > 0;
	}
}