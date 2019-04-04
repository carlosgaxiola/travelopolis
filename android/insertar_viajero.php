<?php


	include "conexion.php";
	$nombre = $_POST["nombre"];
	$apellido_p = $_POST["a_paterno"];
	$apellido_m = $_POST["a_materno"];
	$nueva_foto = $_POST["ruta_foto"];
	$telefono = $_POST["telefono"];
	$correo = $_POST["correo"];
	$id_usuario = $_POST["id_usuario"];
	$f_registro = $_POST["f_registro"];
	$status = $_POST["status"];

	$consulta = "insert into viajeros(nombre,a_paterno,a_materno,ruta_foto,telefono,correo,id_usuario,f_registro,status) values('LORA','LORA','LORA','LORA','LORA','LORA','1','','1')";
	mysql_query($conexion,$consulta) or die (mysql_error());
	mysql_close($conexion);

?>