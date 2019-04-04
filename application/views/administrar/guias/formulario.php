<div class="row">
	<button type="button" id="btn-close" class="btn btn-danger col-md-offset-11" title="Cerrar formulario"><i class="fas fa-times"></i></button>
</div>
<form id="frmGuia" class="form">	
	<input type="hidden" name="idGuia" id="idGuia">	
	<div class="container-fluid">
		<div class="row">
			<div class="form-group col-md-4">
				<label for="txtNombre">Nombre:</label>
				<input type="text" class="form-control Letras" name="txtNombre" id="txtNombre" maxlength="45">
			</div>
			<div class="form-group col-md-4">
				<label for="txtAPaterno">Apellido Paterno:</label>
				<input type="text" class="form-control Letras" name="txtAPaterno" id="txtAPaterno" maxlength="45">
			</div>
			<div class="form-group col-md-4">
				<label for="txtAMaterno">Apellido Materno:</label>
				<input type="text" class="form-control Letras" name="txtAMaterno" id="txtAMaterno" maxlength="45">
			</div>			
		</div>
		<div class="row">
			<div class="form-group col-md-3">
				<label for="txtTelefono">Télefono:</label>
				<input type="text" class="form-control Numeros" name="txtTelefono" id="txtTelefono" maxlength="10">
			</div>
			<div class="form-group col-md-3">
				<label for="txtRFC">RFC:</label>
				<input type="text" class="form-control LetrasNumeros" name="txtRFC" id="txtRFC" onkeyup="this.value=this.value.toUpperCase()" maxlength="16">
			</div>
			<div class="form-group col-md-3">
				<label for="txtNSS">NSS:</label>
				<input type="text" class="form-control Numeros" name="txtNSS" id="txtNSS" maxlength="11">
			</div>
			<div class="form-group col-md-3">
				<label for="txtCorreo">Correo:</label>
				<input type="text" class="form-control email" name="txtCorreo" id="txtCorreo" maxlength="100">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<label for="txtUsuario">Usuario:</label>
				<input type="text" id="txtUsuario" name="txtUsuario" class="form-control" maxlength="45">
			</div>
			<div class="form-group col-md-4">
				<label for="txtContra">Contraseña:</label>
				<input type="password" id="txtContra" name="txtContra" class="form-control" maxlength="45">
			</div>
			<div class="form-group col-md-4">
				<label for="txtConfirmar">Confirmar Contraseña:</label>
				<input type="password" id="txtConfirmar" name="txtConfirmar" class="form-control" maxlength="45">
			</div>
		</div>		
		<div class="clear">&nbsp;</div>
		<div class="row">
			<div class="col-md-3">
				<div class="row">					
					<button type="reset" id="btn-clear" class="btn btn-default btn-lg col-md-5"><i class="fas fa-broom"></i></button>					
					<button type="button" id="btn-save" class="btn btn-success btn-lg col-md-5 col-md-offset-1"><i class="fas fa-save"></i></button>
				</div>
			</div>
		</div>		
	</div>
</form>
<br>
<div id="msg-error" class="alert alert-error" hidden>
	<div id="list-error"></div>
</div>