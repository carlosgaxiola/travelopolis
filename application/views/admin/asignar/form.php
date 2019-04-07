<script type="text/x-jQuery-tmpl" id="asignar">
	<div class="container-fluid">
		<div id="error-asignar" class="alert alert-danger" hidden>
		</div>
		<div class="container-fluid">
			<?php if (is_array($guias)): ?>				
				<select name="cmbGuias" id="cmbGuias" class="form-control">
					<option value="0">Selecciona un guia</option>
					<?php foreach ($guias as $guia): ?>
						<option value="<?php echo $guia['id'] ?>"><?php echo $guia['nombre']." ".$guia['a_paterno']." ".$guia['a_materno'] ?></option>
					<?php endforeach; ?>
				</select>
			<?php else: ?>
				<div class="alert alert-danger">No hay guias disponibles</div>
			<?php endif; ?>
		</div>
	</div>	
</script>