<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificar extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->library("email");
	}

	public function index () {
		$this->load->view("notificar");
	}

	public function notificar () {
		$data = $this->input->post();		
		$this->load->library('email');
	    $config = array(
	    	'protocol' => 'smtp',
     		'smtp_host' => 'ssl://smtp.googlemail.com',
     		'smtp_port' => 465,
     		'smtp_user' => 'travelopolislacapitaldelviaje@gmail.com',
     		'smtp_pass' => 'travelopoliscapital',
     		'mailtype' => 'html',
     		'charset' => 'utf-8',
     		'wordwrap' => true,
     		'validate' => true
	    );
		$this->email->initialize($config);		
		$this->email->set_mailtype("html");
    	$this->email->set_newline("\r\n");
		$this->email->from('travelopolislacapitaldelviaje@gmail.com', 'Travelopolis');
		$this->email->to($data['correo']);

		$this->email->subject("Confirmación de registro de cuenta");
		$this->email->message($this->load->view("correos/correo_cotizacion", array("data" => $data), true));
		
		if ($this->email->send()) {			
			echo json_encode(array('respuesta' => 'correcto')); 
		}
		else {			
			echo json_encode(array('respuesta' => 'incorrecto')); 	
		}
	}
}