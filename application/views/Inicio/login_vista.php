<?php $this->load->view("Global/header", array("titulo" => "Inicio")) ?>
<div class="content-wrapper" style="margin-left: 0px">
	<div class="content">
		<div class="form-container" autocomplete="off">
			<div class="alert alert-danger" hidden id="msg-error">
			</div>
			<form id="frmLogin">			
				<div class="fieldset form-group row">
					<input type="text" class="texto required" name="txtUsuario" id="txtUsuario">
					<label for="txtUsuario">Usuario</label>
				</div>					
				<div class="fieldset form-group row">
					<input type="password" class="contra required" id="txtContra" name="txtContra">
					<label for="txtContra">Contraseña</label>
				</div>			
				<button type="button" class="btn btn-primary" id="btn-login">Entrar</button>
			</form>
			<div class="row">
				<a href="<?php echo base_url("inicio/registro") ?>">Crear una cuenta</a>		
			</div>
		</div>
	</div>
</div>
<?php $this->load->view("Global/footer") ?>
<script src="<?php echo base_url("assets/js/app/login.js") ?>"></script>
<script src="<?php echo base_url("assets/js/app/formulario.js") ?>"></script>