<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists("iniciar")) {
	function iniciar ($titulo) {
		$that =& get_instance();		
		$data = array( 
			'titulo' => $titulo,
			'hola' => "Hola Mundo!"
		);
	}
}
if (!function_exists("modulos")) {
	function modulos () {
		$that =& get_instance();
		$that->load->model("ModulosModelo");
		$modulos = $that->ModulosModelo->modulosPerfil($that->session->userdata("id_perfil"));
		return $modulos;
	}
}
if (!function_exists("imprimirModulos")) {
	function imprimirModulos ($modulos) {        
	    if (is_array($modulos)) {
	        foreach ($modulos as $modulo) {
	            if (empty($modulo->hijos)) {
	                echo "<li class='treeview ".($modulo->actual)? "active": ""."'>";
	                echo "  <a href='".$modulo->ruta."'>";
	                echo "      <i class='fas ".$modulo->fa_icon_class."'></i>";
	                echo "      <span>".$modulo->nombre."</span>";
	                echo "  </a>";
	                echo "</li>";
	            }
	            else {
	                echo "<li class='treeview ".($modulo->actual)? 'active menu-open': ''."'>";
	                echo "  <a href='#'>";
	                echo "      <i class='fas ".$modulo->fa_icon_class."'></i>";
	                echo "      <span>".$modulo->nombre."</span>";
	                echo "      <span class='pull-right-container'>";
	                echo "          <i class='fas fa-angle-left pull-right'></i>";
	                echo "      </span>";
	                echo "  </a>";
	                echo "  <ul class='treeview-menu'>";
	                imprimirModulos($modulo->hijos);
	                echo "  </ul>";
	                echo "</li>";
	            }
	        }
	    }
	}
}