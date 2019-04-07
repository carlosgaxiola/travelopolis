<div class="row">
	<button type="button" id="btn-close" class="btn btn-danger col-md-offset-11" title="Cerrar formulario"><i class="fas fa-times"></i></button>
</div>
<br>
<div id="msg-error" class="alert alert-error" hidden>
	<div id="list-error"></div>
</div>
<form id="frmViajero" class="form">	
	<input type="hidden" name="idViajero" id="idViajero">
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
				<label for="txtEdad">Edad:</label>
				<input type="text" class="form-control Numeros" name="txtEdad" id="txtEdad" maxlength="3">
			</div>
			<div class="form-group col-md-3">
				<label for="txtSexo">Sexo:</label>
				<select name="txtSexo" id="txtSexo" class="form-control">
					<option value="Hombre">Hombre</option>
					<option value="Mujer">Mujer</option>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="txtCorreo">Correo:</label>
				<input type="text" class="form-control email" name="txtCorreo" id="txtCorreo" maxlength="100">
			</div>
			<div class="form-group col-md-3">
				<label for="txtTelefono">Teléfono:</label>
				<input type="text" class="form-control Numeros" name="txtTelefono" id="txtTelefono" maxlength="10">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-3">
				<label for="txtEstado">Estado de residencia:</label>
				<select type="text" name="txtEstado" id="txtEstado" class="form-control">
					<option value="0">Selecciona un estado</option>
					<?php foreach ($estados as $estado): ?>
						<option value="<?php echo $estado['nombre'] ?>"><?php echo ucfirst(strtolower($estado['nombre'])) ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="txtUsuario">Usuario:</label>
				<input type="text" name="txtUsuario" id="txtUsuario" class="form-control LetrasNumeros" maxlength="45">
			</div>
			<div id="contra-group">
				<div class="form-group col-md-3">
					<label for="txtContra">Contraseña:</label>
					<input type="password" name="txtContra" id="txtContra" class="form-control LetrasNumeros" maxlength="45">
				</div>
				<div class="form-group col-md-3">
					<label for="txtConfirmar">Confirmar Contraseña:</label>
					<input type="password" name="txtConfirmar" id="txtConfirmar" class="form-control LetrasNumeros" maxlength="45">
				</div>
			</div>
		</div>
		<div class="row">			
			<div class="form-group col-md-12">
				<label for="txtInformacion">Información</label>
				<textarea name="txtInformacion" maxlength="1000" id="txtInformacion" rows="3" class="form-control LetrasNumeros" style="resize: none;"></textarea>
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