<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ViajesModelo extends CI_Model {

	public function __construct () {
		parent::__construct();
	}

	public function listarDias ($idViaje) {
		$this->db->where("id_viaje");
		$dias = $this->db->get("dias_viajes");
		if ($dias->num_rows() > 0)
			return $dias->result_array();
		return false;
	}

}