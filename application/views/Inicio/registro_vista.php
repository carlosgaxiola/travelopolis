<div class="form-container">
	<div class="alert alert-danger" id="msg-error" hidden>
	</div>
	<form id="frmRegistro" action="<?php echo base_url("inicio/crear")?>" method="post">	
		<h4 class="text-muted">Los campos con * son obligatorios</h4>
		<div class="clear">&nbsp;</div>
		<div class="form-group col-md-4 fieldset">			
			<input type="text" class="required texto" name="txtNombre" id="txtNombre" maxlength="45">
			<label for="txtNombre">Nombre *</label>
		</div>
		<div class="form-group col-md-4 fieldset">
			<input type="text" class="required texto" name="txtAPaterno" id="txtAPaterno" maxlength="45">
			<label for="txtAPaterno">Apellido Paterno *</label>			
		</div>
		<div class="form-group col-md-4 fieldset">
			<input type="text" class="required texto" name="txtAMaterno" id="txtAMaterno" maxlength="45">
			<label for="txtAMaterno">Apellido Materno *</label>			
		</div>		
		<div class="form-group col-md-6 fieldset">
			<input type="text" class="required alfanumerico" name="txtUsuario" id="txtUsuario" maxlength="45">
			<label for="txtUsuario">Usuario *</label>			
		</div>
		<div class="form-group col-md-6 fieldset">
			<input type="email" class="required email" name="txtCorreo" id="txtCorreo" maxlength="100">
			<label for="txtCorreo">Correo *</label>			
		</div>			
		<div class="form-group col-md-4 fieldset">
			<input type="number" class="required phone" id="txtTelefono" name="txtTelefono" maxlength="10">
			<label for="txtTelefono">Teléfono</label>
		</div>		
		<div class="form-group col-md-6 fieldset">
			<input type="password" class="required contra" id="txtContra" name="txtContra">
			<label for="txtContra">Contraseña *</label>			
		</div>
		<div class="from-group col-md-6 fieldset">
			<input type="password" class="required contra" id="txtConfirmar" name="txtConfirmar">
			<label for="txtConfirmar">Confirmar Contraseña *</label>			
		</div>
		<button type="submit" form="frmRegistro" class="btn btn-primary bg-blue">
			Registrarse
		</button>
		&nbsp;&nbsp;&nbsp;&nbsp;Ó&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="<?php echo base_url("inicio/ingresar") ?>">
			Iniciar sesión
		</a>		
	</form>
</div>