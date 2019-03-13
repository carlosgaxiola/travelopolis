<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists("modulos")) {
	function modulos ($idPerfil) {
		$that =& get_instance();
		$that->load->model("PerfilesModulosModelo");        
		$modulos = $that->PerfilesModulosModelo->modulosPerfil($idPerfil);		
		return $modulos;
	}	
}

if (!function_exists("menu")) {
	function menu ($modulos, $idActual = 1) {    
		if (is_array($modulos)) {
		    foreach ($modulos as $modulo) {                                
                echo "<li class='".(($modulo['id'] == $idActual)? "active": "")."'>";
                echo "  <a href='".base_url($modulo['ruta'])."'>";
                if (strcmp($modulo['fa_icon'], "0") == 0)
                    echo "<i class='no-icon' style='display: none;'>".$modulo['nombre'][0]."</i>";
                else                        
                    echo "      <i class='".$modulo['fa_icon']."' ></i>";
                echo "      <span>".$modulo['nombre']."</span>";
                echo "  </a>";
                echo "</li>";                
            }
        }
	}
}

if (!function_exists("hasAccess"))  {
    function hasAccess ($idPerfil, $idModulo) {        
        $that =& get_instance();
        $that->load->model("PerfilesModulosModelo");
        return $that->PerfilesModulosModelo->get($idPerfil, $idModulo);
    }
}