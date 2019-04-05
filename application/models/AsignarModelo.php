<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AsignarModelo extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function cambiar ($idViaje, $idGuia) {		
		$this->db->where("id_viaje", $idViaje);
		$this->db->set("id_guia", $idGuia);
		$this->db->update("guias_viajes");
		if ($this->db->affected_rows() > 0)
			return array("result" => "asigando");
		return array("result" => "no cambiado");
	}

	public function guiaDisponible ($idGuia, $idViaje) {
		$viaje = $this->viaje($idViaje);
		$this->db->where("id_guia", $idGuia);
		$this->db->where("f_inicio", $viaje['f_inicio']);
		$this->db->where("f_fin", $viaje['f_fin']);
		$res = $this->db->get("listar_viajes_guias");
		return $res->num_rows() == 0 || $res->num_rows() == 1;
	}

	public function asignar ($idViaje, $idGuia) {
		$this->db->set("id_viaje", $idViaje);
		$this->db->set("id_guia", $idGuia);
		$this->db->insert("guias_viajes");
		return $this->db->affected_rows() > 0;
	}

	private function viaje ($idViaje) {
		$this->db->where("id", $idViaje);
		$viaje = $this->db->get("viajes");
		if ($viaje->num_rows() > 0)
			return $viaje->row_array();
		return false;
	}
}