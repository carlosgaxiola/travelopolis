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
                        if ($viajero['status'] == 0) {
                            $label = "<span class='label label-danger'>Inactivo</span>";
                            $btnStatus = "<button type='button' class='btn btn-sm btn-toggle-log btn-success' title='Dar de alta al viajero'><i class='fas fa-toggle-on'></i></button>";
                        }
                        else if ($viajero['status'] == 1) {
                            $label = "<span class='label label-success'>Activo</span>";
                            $btnStatus = "<button type='button' class='btn btn-sm btn-toggle-log btn-danger' title='Dar de baja al viajero'><i class='fas fa-toggle-off'></i></button>";
                        }
                    ?>
                    <td>
                        <?php echo $label ?>
                    </td>
    				<td>                        
    					<button title="Editar viajero" type="button" class="btn-edit-log btn btn-sm btn-warning" data-id="<?php echo $viajero['id'] ?>"><i class="fas fa-edit"></i></button>                        
                        <?php echo $btnStatus ?>
    				</td>
    			</tr>
    		<?php endforeach; ?>
    	<?php endif; ?>
    </tbody>
</table>
<script>
    var tablaId = "tblViajeros"
</script>