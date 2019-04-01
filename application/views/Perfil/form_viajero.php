<form class="form-horizontal" id="frmPerfil">
	<div class="form-group">
		<label for="txtNombre" class="col-sm-2 control-label">Nombre</label>
		<div class="col-sm-4">
			<input maxlength="45" type="text" class="form-control" id="txtNombre" value="<?php echo $persona['nombre'] ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="txtAPaterno" class="col-sm-2 control-label">Apellido Paterno</label>
		<div class="col-sm-4">
			<input maxlength="45" type="text" class="form-control" id="txtAPaterno" value="<?php echo $persona['a_paterno'] ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="txtAMaterno" class="col-sm-2 control-label">Apellido Materno</label>
		<div class="col-sm-4">
			<input maxlength="45" type="text" class="form-control" id="txtAMaterno" value="<?php echo $persona['a_materno'] ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="txtCorreo" class="col-sm-2 control-label">Correo</label>
		<div class="col-sm-4">
			<input maxlength="100" type="text" class="form-control" id="txtCorreo" value="<?php echo $persona['correo'] ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="txtTelefono" class="col-sm-2 control-label">Teléfono</label>
		<div class="col-sm-4">
			<input maxlength="10" type="text" class="form-control" id="txtTelefono" value="<?php echo $persona['telefono'] ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="cmbSexo" class="col-sm-2 control-label">Sexo</label>
		<div class="col-sm-4">
			<select name="cmbSexo" id="cmbSexo" class="form-control">
				<option value="Hombre">Hombre</option>
				<option value="Mujer">Mujer</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="cmbEstado" class="col-sm-2 control-label">Estado</label>
		<div class="col-sm-4">
			<select name="cmbEstado" id="cmbEstado" class="form-control">
				<option value="0">Seleccione un estado</option>
				<?php foreach ($estados as $estado): ?>
					<option value="<?php echo $estado['nombre'] ?>"><?php echo $estado['nombre'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="txtUsuario" class="col-sm-2 control-label">Usuario</label>
		<div class="col-sm-4">			
			<?php if (is_array($usuario['usuario'])): ?>
				<input maxlength="45" type="text" class="form-control" id="txtUsuario" value="<?php echo $usuario['usuario']['usuario'] ?>">
			<?php else: ?>
				<input maxlength="45" type="text" class="form-control" id="txtUsuario" value="<?php echo $usuario['usuario'] ?>">
			<?php endif; ?>
		</div>
	</div>
	<div class="form-group row">
		<label for="txtDescripcion" class="col-sm-2" style="padding-left: 0px; margin-right: 0px; padding-right: 0px; width: 10%; margin-left: 6.5%;">Descripción</label>
		<div class="col-sm-10">
			<textarea maxlength="1000" style="resize: none;" type="text" name="txtDescripcion" class="form-control" id="txtDescripcion">
				<?php echo $persona['informacion'] ?>
			</textarea>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-6 col-md-offset-2">
			<button type="button" class="btn btn-primary" id="btn-guardar">Guardar cambios</button>
		</div>
		<div class="col-md-3" style="margin-left: 5%;">										
			<button type="button" class="btn btn-default" id="btn-cambiar">Cambiar usuario y/o contraseña</button>
		</div>
	</div>
</form>