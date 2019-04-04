<table id="tblViajeros" class="table no-margin table-striped" style="width:100%" data-table="true">
	<thead>        
        <th>#</th>    					                
        <th>Nombre</th>
        <th>Sexo</th>
        <th>Edad</th>        
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Estado</th>
        <th>Opciones</th>
    </thead>
    <tbody id="contenidoTabla">        
    	<?php if (isset($registros) and !empty($registros) and is_array($registros)): ?>
    		<?php foreach ($registros as $index => $viajero): ?>
    			<tr>
                    <td><?php echo $index + 1 ?></td>
    				<td><?php echo $viajero['nombre']." ".$viajero['paterno'] ?></td>
    				<td><?php echo $viajero['sexo'] ?></td>
                    <td><?php echo $viajero['edad'] ?></td>
                    <td><?php echo $viajero['telefono'] ?></td>
                    <td><?php echo $viajero['correo'] ?></td>
                    <?php 
                        if ($viajero['status'] == 2) {
                            $title = "Dar de alta al viajero";
                            $btnToggleClass = "btn-toggle-log btn-success";
                            $iconClass = "fa-toggle-on";
                            $labelClass = "label-danger";
                            $labelText = "Inactivo";
                        }
                        else if ($viajero['status'] == 1) {
                            $title = "Dar de baja al viajero";
                            $btnToggleClass = "btn-toggle-log btn-danger";
                            $iconClass = "fa-toggle-off";
                            $labelClass = "label-success";
                            $labelText = "Verificado";
                        }
                        else {
                            $title = "Borrar viajero";
                            $btnToggleClass = "btn-danger btn-borrar";
                            $iconClass = "fa-times";
                            $labelClass = "label-default";
                            $labelText = "Sin verificar";
                        }
                    ?>
                    <td><span class="label <?php echo $labelClass ?>"><?php echo $labelText ?></span></td>
    				<td>                        
    					<button title="Editar viajero" type="button" class="btn-edit-log btn btn-sm btn-warning" data-id="<?php echo $viajero['id'] ?>"><i class="fas fa-edit"></i></button>                        
                        <button title="<?php echo $title ?>" class="btn btn-sm <?php echo $btnToggleClass ?>"><i class="fas <?php echo $iconClass ?>"></i></button>
    				</td>
    			</tr>
    		<?php endforeach; ?>
    	<?php endif; ?>
    </tbody>
</table>
<script>
    var tablaId = "tblViajeros"
</script>