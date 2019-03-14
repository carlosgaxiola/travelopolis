<form id="frmPerfil">
	<input type="hidden" name="idPerfil" id="idPerfil">
	<div class="container-fluid">
		<div class="row">
			<div class="form-group col-md-3">
				<label for="txtNombre">Nombre:</label>
				<input type="text" class="form-control" name="txtNombre" id="txtNombre">
			</div>
			<div class="form-group col-md-9">
				<label for="txtDescripcion">Descripcion:</label>
				<textarea class="form-control" name="txtDescripcion" id="txtDescripcion" rows="5"></textarea>
			</div>		
		</div>
		<div class="row">
			<?php if (isset($modulos) && is_array($modulos)): ?>
				<?php foreach ($modulos as $modulo): ?>
					<div class="col-md-2">
						<fieldset class="checkbox">
							<input type="checkbox" class="checkbox required" id="cbx<?php echo $modulo['nombre'] ?>" name="cbx<?php echo $modulo['nombre'] ?>" value="<?php echo $modulo['id'] ?>">
							<label for="cbx<?php echo $modulo['nombre'] ?>"><?php echo $modulo['nombre'] ?></label>
						</fieldset>
					</div>	
				<?php endforeach; ?>
			<?php elseif (isset($modulos)): ?>
				<div class="col-md-2">
					<fieldset class="checkbox">
						<input type="checkbox" class="checkbox required" id="cbx<?php echo $modulo['nombre'] ?>" name="cbx<?php echo $modulo['nombre'] ?>" value="<?php echo $modulo['id'] ?>">
						<label for="cbx<?php echo $modulo['nombre'] ?>"><?php echo $modulo['nombre'] ?></label>
					</fieldset>
				</div>
			<?php else: ?>
				<div class="alert alert-danger">
					No hay modulos disponibles
				</div>
			<?php endif; ?>						
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