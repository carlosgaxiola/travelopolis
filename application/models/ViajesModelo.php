<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ViajesModelo extends CI_Model {

	private $LIQUIDADO = 3;
	private $ANTICIPADO = 2;

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
		$detalle = $this->db->get("detalle_viajes");
		if ($detalle->num_rows() > 0) {
			$detalle = $detalle->row_array();
			$respuesta = "abono";
			if ($this->esLiquidacion($cantidad, $detalle)) {
				$this->db->set("status", $this->LIQUIDADO);
				$respuesta = "liquidado";
			}
			else if ($this->esAnticipo($cantidad, $detalle)) {
				$this->db->set("status", $this->ANTICIPADO);
				$respuesta = "anticipo";
			}
			$this->db->where("id_viaje", $idViaje);
			$this->db->where("id_viajero", $idViajero);
			$this->db->set("resto", "resto - ".$cantidad, false);
			$this->db->update("detalle_viajes");
			if ($this->db->affected_rows() > 0)
				return $respuesta;
		}
		return "error";
	}

	private function esAnticipo ($cantidad, $detalle) {
		return ($detalle['resto'] - $cantidad) <= $detalle['precio'] * 0.8;
	}

	private function esLiquidacion ($cantidad, $detalle) {
		return ($detalle['resto'] - $cantidad) == 0;
	}

	public function cambiarStatus ($idViaje, $idViajero, $status) {
		$this->db->where("id_viaje", $idViaje);
		$this->db->where("id_viajero", $idViajero);
		$this->db->set("status", $status);
		$this->db->update("detalle_viajes");
		return $this->db->affected_rows() > 0;
	}
}