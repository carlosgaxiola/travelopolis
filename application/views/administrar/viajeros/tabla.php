<table id="tblViajeros" class="table no-margin table-striped" style="width:100%" data-table="true">
	<thead>        
        <th>#</th>    					                
        <th>Nombre</th>
        <th>Sexo</th>
        <th>Edad</th>        
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Opciones</th>
    </thead>
    <tbody id="contenidoTabla">        
    	<?php if (isset($registros) and !empty($registros) and is_array($registros)): ?>
    		<?php foreach ($registros as $index => $viajero): ?>
    			<tr>
                    <td><?php echo $index + 1 ?></td>
    				<td><?php echo $viajero['nombre'] ?></td>
    				<td><?php echo $viajero['sexo'] ?></td>
                    <td><?php echo $viajero['edad'] ?></td>
                    <th><?php echo $viajero['telefono'] ?></th>
                    <th><?php echo $viajero['correo'] ?></th>
    				<td>
    					<button title="Editar viajero" type="button" class="btn-edit-log btn btn-warning" data-id="<?php echo $viajero['id'] ?>"><i class="fas fa-edit"></i></button>                        
    				</td>
    			</tr>
    		<?php endforeach; ?>
    	<?php endif; ?>
    </tbody>
</table>
<script>
    var tablaId = "tblViajeros"
</script>