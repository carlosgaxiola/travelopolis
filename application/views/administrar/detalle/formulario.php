<script type="text/x-jQuery-tmpl" id="abono">
	<div class="container-fluid">
		<div id="error-abono" class="alert alert-danger" hidden>
		</div>
		<div class="container-fluid">
			<label for="txtAbono">Cantidad:</label>
			<input type="text" id="txtAbono" class="form-control">
		</div>
	</div>	
</script>
<script type="text/x-jQuery-tmpl" id="cancelar">
	<div class="container-fluid">
		<div id="error-cancelar" class='alert alert-danger' hidden>
		</div>
		<div class="container-fluid">
			<label for="txtMotivo">Motivo:</label>
			<input type="text" id="txtMotivo" class="form-control">
		</div>
	</div>
</script>
<div class="row">
	<button type="button" id="btn-close" class="btn btn-danger col-md-offset-11" title="Cerrar formulario"><i class="fas fa-times"></i></button>
</div>
<form id="frmDatosViajero">
	<div class="row">
		<div class="row">
			<h3>Datos del viajero</h3>
		</div>
		<div class="row">
			<div class="form-group col-md-3">
				<label for="txtViaje">Viaje</label>
				<input type="text" class="form-control" id="txtViaje" name="txtViaje">
			</div>
			<div class="form-group col-md-3">
				<label for="txtCantidad">Cantidad</label>
				<input type="text" class="form-control" id="txtCantidad" id="txtCantidad">
			</div>
			<div class="form-group col-md-3">
				<label for="txtResto">Resto</label>
				<input type="text" class="form-control" name="txtResto" id="txtResto">
			</div>
			<div class="form-group col-md-3">
				<label for="txtCompra">Estado de la compra</label>
				<div class="form-control" id="txtCompra" name="txtCompra">
					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-3">
				<label for="txtNombre">Nombre</label>
				<input type="text" id="txtNombre" name="txtNombre" class="form-control">
			</div>
			<div class="form-group col-md-3">
				<label for="txtAPaterno">Apellido Paterno</label>
				<input type="text" id="txtAPaterno" name="txtAPaterno" class="form-control">
			</div>
			<div class="form-group col-md-3">
				<label for="txtAMaterno">Apellido Materno</label>
				<input type="text" id="txtAMaterno" name="txtAMaterno" class="form-control">
			</div>
			<div class="form-group col-md-3">
				<label for="txtCorreo">Correo</label>
				<input type="text" class="form-control" name="txtCorreo" id="txtCorreo">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-3">
				<label for="txtSexo">Sexo</label>
				<input type="text" class="form-control" id="txtSexo" name="txtSexo">
			</div>
			<div class="form-group col-md-3">
				<label for="txtEdad">Edad</label>
				<input type="text" class="form-control" id="txtEdad" name="txtEdad">
			</div>
			<div class="form-group col-md-3">
				<label for="txtEstado">Estado</label>
				<input type="text" class="form-control" id="txtEstado" name="txtEstado">
			</div>
			<div class="form-group col-md-3">
				<label for="txtTelefono">Teléfono</label>
				<input type="text" class="form-control" id="txtTelefono" name="txtTelefono">
			</div>
		</div>
	</div>
	<br><br>
	<div class="row" id="acompañantesGroup">
		<div class="row">
			<h3>Datos de los acompañantes</h3>
		</div>
		<div class="row">
			<table id="tblAcompañantes" class="table table-hover table-bordered table-responsive table-striped" style="background-color: white;">
				<thead>
					<th>#</th>
					<th>Nombre</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Edad</th>
					<th>Teléfono</th>
					<th>Parentesco</th>
				</thead>
				<tbody id="tblAcompañantesBody">
				</tbody>
			</table>
		</div>
	</div>	
	<div class="row" id="aceptarGroup" hidden="true">
		<div class="col-md-3">
			<button type="button" class="btn btn-success" id="btn-enviar-cotizacion">Enviar Cotización</button>
		</div>
	</div>
</form>