<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	protected $table;
	protected $uniqueFields = array();

	public function __construct () {
		parent::__construct();
		$this->load->model("CrudModel");
	}

	public function index () {
		
	}
}