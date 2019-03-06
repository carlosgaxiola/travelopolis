<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function listar ($tabla, $status = -1) {
		if ($status != -1)
			$this->db->where($tabla.".status", $status);
		$res = $this->db->get($tabla);		
		if ($res->num_rows() > 0)
			return $res->result();
		return false;
	}

	public function insertar ($tabla, $data) {
		$this->db->insert($tabla, $data);
		if ($this->db->affected_rows() > 0) {
			$id = $this->db->insert_id();
			$fecha = new datetime();
			$this->db->insert("movimientos", array(
				'fecha' => $fecha->format("Y-m-d"),
				'tipo' => 0,
				'tabla' => $tabla,
				"id_usuario" => $this->session->userdata("id_usuario")
			));
			return $id;
		}
		return false;		
	}

	public function actualizar ($tabla, $id, $data) {
		$this->db->where("id", $id);
		$this->db->update($tabla, $data);
		$res = ($this->db->affected_rows() > 0);
		if ($res) {
			$fecha = new datetime();
			$this->db->insert("movimientos", array(
				'fecha' => $fecha->format("Y-m-d"),
				'tipo' => 1,
				'tabla' => $tabla,
				'id_usuario' => $this->session->userdata("id_usuario")
			));			
		}
		return $res;
	}

	public function buscar ($tabla, $id) {
		$this->db->where("id", $id);
		$res = $this->db->get($tabla);
		if ($res->num_rows() > 0)
			return $res->row();
		return false;
	}
}
