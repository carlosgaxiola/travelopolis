<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body style="background: gray;
		color: #2196f3;
		font-family: "Tahoma", "Geneva", sans-serif;">
	<section style="margin-left: 30%;
		margin-top: 1%;
		background: white;
		width: 520px;
		height: 330px;
		padding-top: 10px;
		color: #2196f3">
		<article style="height: 330px;">
			<b><p style="font-size: 20px;
		margin-top: 10%; 
		text-align: center;
		color: #2196f3;
		margin-top: 1.5%;">¡Datos del Viaje!</p></b>
			<b><p style="text-align: center;color: #2196f3;
		margin-top: 1.5%;">Querido(a): <b> <?php echo $data['nombre']." ".$data['a_paterno'].$data['a_materno'] ?></b> </p></b>	
			<p style="text-align: center;color: #2196f3;
		margin-top: 1.5%;">Estos son los datos del Viaje:  <b> <?php echo $data['viaje'] ?></b>   </p>
			<p style="text-align: center;color: #2196f3;
		margin-top: 1.5%;">Referencia: <b><?php echo $data['id_viaje'].$data["id_viajero"] ?></b></p>
			<p style="text-align: center;color: #2196f3;
		margin-top: 1.5%;">Cuenta Bancaria: <b>5501-2585-5225-2548</b></p>
		<p style="text-align: center;color: #2196f3;
		margin-top: 8.5%;" 	style="font-size: 7px;"> Travelopolis App | www.travelopolis.ddns.net/travelopolis</p>
		<p style="text-align: center;color: #2196f3;
		margin-top: 1.5%;" 	style="font-size: 7px;">©2019 Todos los Derechos Reservados</p>	
		</article>
	</section>
	
</body>
</html>