<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
</head>
<body>
	Bienvenido <?php echo $viajero['completo'] ?><br>
	Enlace de verificación: <a href="<?php echo base_url("inicio/validar/").$viajero['token'] ?>"><?php echo base_url("inicio/validar/").$viajero['token'] ?></a>
</body>
</html>