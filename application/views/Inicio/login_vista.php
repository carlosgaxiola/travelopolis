<link rel="stylesheet" href="<?php echo base_url('assets/css/main/formulario.css') ?>">
<?php $this->load->view("Global/header") ?>
<main class="content-wrapper" style="padding: 1%;">
	<div class="form-container">		
		<form id="frmIngresar" action="" method="post">			
			<fieldset class="form-group row">
				<input type="text" class="form-control texto required" name="txtUsuario" id="txtUsuario">
				<label for="txtUsuario">Usuario</label>
			</fieldset>					
			<fieldset class="form-group row">
				<input type="password" class="form-control contra required" id="txtContra" name="txtContra">
				<label for="txtContra">Contraseña</label>
			</fieldset>	
			<fieldset class="form-group row radio">
				<input type="radio" class="radio required" id="rdbHombre" name="rdbSexo" value="hombre">
				<label for="rdbHombre">Hombre</label>
				<input type="radio" class="radio required" id="rdbMujer" name="rdbSexo" value="mujer">
				<label for="rdbMujer">Mujer</label>
			</fieldset>
			<fieldset class="form-group row checkbox">
				<input type="checkbox" class="checkbox required" id="cbxTerminos" name="cbxTerminos" value="terminos">
				<label for="cbxTerminos">Acepto Terminos y Condiciones</label>
			</fieldset>
			<button type="summit" class="btn btn-primary" id="btn-entrar">Entrar</button>
		</form>
	</div>
</main>
<?php $this->load->view("Global/footer") ?>
<script src="<?php echo base_url("assets/js/app/formulario.js") ?>"></script>
<script src="<?php echo base_url("assets/js/app/login.js") ?>"></script>