<?php
    require 'Token.php';

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$datos = json_decode(file_get_contents("php://input"),true);
		$respuesta = Token::ActualizarDatosToken($datos["usuario"],$datos["token"]);
        $respuesta2 = Token::ActualizarDatosTokenDiferentes($datos["token"],$datos["usuario"]);

		if($respuesta){
            echo json_encode(array('resultado' => 'El token se subio correctamente'));
		}else{
            echo json_encode(array('resultado' => 'error'));
		}
	}

?>