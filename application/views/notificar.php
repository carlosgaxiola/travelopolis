<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="<?php base_url("notificar/notificar") ?>" method="post" id="frmData">
		<label>Nombre</label>
		<input type="text" name="nombre">
		<br>
		<label>Referencia</label>
		<input type="text" name="referencia">
		<br>
		<label>Precio</label>
		<input type="text" name="precio">
		<br>
		<label>Total</label>
		<input type="text" name="total">
		<br>
		<label>Anticipo</label>
		<input type="text" name="anticipo">
		<br>
		<label>Resto</label>
		<input type="text" name="resto">
		<br>
		<label>Correo</label>
		<input type="text" name="correo">
		<br>
		<button type="button" id="btn-notificar">Mandar</button>
	</form>
	<script src="<?php echo base_url("assets/js/jquery-3.min.js")?>"></script>
	<script>
		var base_url = '<?php echo base_url() ?>'
		$(document).ready( function () {
			$("#btn-notificar").click( function () {
				$.ajax({
					url: base_url + "notificar/notificar",
					data: $("#frmData").serialize(),
					type: "POST",
					success: function (res) {
						console.log(res)
					}
				})
			})
		})
	</script>
</body>
</html>