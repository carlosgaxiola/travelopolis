<div class="row">
	<div class="col-md-10">
		<div id="msg-error" class="alert alert-error" hidden>
			<div id="list-error"></div>
		</div>		
	</div>
	<div class="col-md-2">		
		<button type="button" id="btn-close" class="btn btn-danger col-md-offset-1" title="Cerrar formulario"><i class="fas fa-times"></i></button>
	</div>
</div>
<form id="frmViaje" class="form">	
	<input type="hidden" name="idViaje" id="idViaje">	
	<div class="container-fluid">
		<div class="row">
			<div class="form-group col-md-3">
				<label for="txtNombre">Nombre:</label>
				<input type="text" class="form-control LetrasNumeros" name="txtNombre" id="txtNombre" maxlength="45">
			</div>
			<div class="form-group col-md-4">				
				<div class="row">
					<div class="form-group col-md-6">
						<label style="margin-top: -5%;">Viajeros:</label>
						<label for="txtMinimo">Mínimo</label>
						<input type="text" class="form-control Numeros" name="txtMinimo" id="txtMinimo" maxlength="10">
					</div>
					<div class="form-group col-md-6">
						<label style="margin-top: -5%;">Viajeros:</label>
						<label for="txtMaximo">Máximo</label>
						<input type="text" class="form-control Numeros" name="txtMaximo" id="txtMaximo" maxlength="10">
					</div>
				</div>
			</div>
			<div class="form-group col-md-2">				
				<label for="txtPrecio">Precio:</label>
				<input type="text" class="form-control NumerosDecimales" name="txtPrecio" id="txtPrecio" maxlength="10">
			</div>
			<div class="form-group col-md-3">
				<label for="cmbTipoViaje">Tipo de viaje:</label>
				<select name="cmbTipoViaje" class="form-control" id="cmbTipoViaje">
					<option value="0">Selecciona un tipo de viaje</option>
					<?php foreach ($tiposViaje as $tipoViaje): ?>
						<option value="<?php echo $tipoViaje['id'] ?>"><?php echo $tipoViaje['nombre'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>		
		</div>		
		<div class="row">
			<div class="form-group col-md-4">
	            <label>Fecha de inicio y fin:</label>
	            <div class="input-group">
		            <div class="input-group-addon">
		            	<i class="fa fa-calendar"></i>
		            </div>
		            <input type="text" class="form-control pull-right" id="txtFecha" name="txtFecha">
	            </div>	            
          	</div>
          	<input type="hidden" name="txtFechaInicio" id="txtFechaInicio">
          	<input type="hidden" name="txtFechaFin" id="txtFechaFin">			
			<div class="form-group col-md-2">
				<label for="txtDias"><i class="fas fa-sun"></i> Días:</label>
				<input type="text" id="txtDias" name="txtDias" class="form-control Numeros" maxlength="3" disabled>
			</div>
			<div class="form-group col-md-2">
				<label for="txtNoches"><i class="fas fa-moon"></i> Noches:</label>
				<input type="text" id="txtNoches" name="txtNoches" class="form-control" maxlength="3" disabled>
			</div>
			<div class="form-group col-md-4">
				<label for="txtDiasDevolucion">Días para devolucion de pago:</label>
				<input type="text" class="form-control Numeros" id="txtDiasDevolucion" name="txtDiasDevolucion">				
			</div>
		</div>	
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="txtDescripcion">Descripción:</label>
					<textarea style="resize: none;" type="text" class="form-control Letras" name="txtDescripcion" id="txtDescripcion" maxlength="255" rows="2"></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-3">
				<label for="txtNombreDia">Nombre día:</label>
				<input type="text" class="form-control LetrasNumeros" id="txtNombreDia" name="txtNombreDia">				
			</div>
			<div class="form-group col-md-9">
				<div class="row">
					<div class="col-md-10">						
						<label for="txtDescripcionDia">Descripción Día:</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">						
						<input type="text" class="form-control LetrasNumeros" id="txtDescripcionDia" name="txtDescripcionDia">
					</div>	
					<div class="col-md-2">						
						<button id="btn-add-dia" type="button" class="btn btn-success">Agregar</button>
					</div>
				</div>				
			</div>			
		</div>
		<div class="row">
			<div class="col-md-12">				
				<table id="tblDias" class="table table-striped table-bordered table-hover" style="background-color: white;">
					<thead>
						<th>#</th>
						<th>Nombre</th>
						<th>Fecha</th>
						<th style="min-width: 300px">Descripción</th>
						<th style="max-width: 50px">Eliminar</th>
					</thead>
					<tbody>		
					</tbody>
				</table>
			</div>
		</div>
		<div class="clear">&nbsp;</div>
		<div class="row">
			<div class="col-md-3">
				<div class="row" id="btnGroup">					
					<button type="reset" id="btn-clear" class="btn btn-default btn-lg col-md-5"><i class="fas fa-broom"></i></button>					
					<button type="button" id="btn-save" class="btn btn-success btn-lg col-md-5 col-md-offset-1"><i class="fas fa-save"></i></button>
				</div>
			</div>
		</div>		
	</div>
</form>
<br>