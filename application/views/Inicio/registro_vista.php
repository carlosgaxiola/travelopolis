<?php 
	$this->load->view("Global/header");
	$this->load->view("Global/navbar");
?>
<main>
	<form id="frmRegistro">
		{elapsed_time}
		<div class="row">
			<div class="form-group col-md-4">
				<fieldset>
					<input type="text" class="form-control required texto" name="txtNombre" id="txtNombre">
					<label for="txtNombre">Nombre</label>
				</fieldset>
			</div>
			<div class="form-group col-md-4">
				<fieldset>
					<input type="text" class="form-control required texto" name="txtAPaterno" id="txtAPaterno">
					<label for="txtAPaterno">Apellido Paterno</label>
				</fieldset>
			</div>
			<div class="form-group col-md-4">
				<fieldset>
					<input type="text" class="form-control required texto" name="txtAMaterno" id="txtAMaterno">
					<label for="txtAMaterno">Apellido Materno</label>
				</fieldset>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				<fieldset>
					<input type="text" class="form-control required alfanumerico" name="txtUsuario" id="txtUsuario">
					<label for="txtUsuario">Usuario</label>
				</fieldset>
			</div>
			<div class="form-group col-md-6">
				<fieldset>
					<input type="email" class="form-control required email" name="txtCorreo" id="txtCorre">
					<label for="txtCorreo">Correo</label>
				</fieldset>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				<fieldset>
					<input type="password" class="form-control required contra" id="txtContra" name="txtContra">
					<label for="txtContra">Contraseña</label>
				</fieldset>
			</div>
			<div class="from-group col-md-6">
				<fieldset>
					<input type="password" class="form-control required contra" id="txtConfirmar" name="txtConfirmar">
					<label for="txtConfirmar">Confirmar Contraseña</label>
				</fieldset>
			</div>
		</div>
	</form>	
</main>
<?php $this->load->view("Global/footer") ?>