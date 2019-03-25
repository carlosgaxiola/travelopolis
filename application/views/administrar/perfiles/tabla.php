<table id="tblPerfiles" class="table no-margin table-striped" style="width:100%" data-table="true">
	<thead>        
        <th>#</th>    					                
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Opciones</th>        
    </thead>
    <tbody id="contenidoTabla">        
    	<?php if (isset($registros) and !empty($registros) and is_array($registros)): ?>
    		<?php foreach ($registros as $index => $perfil): ?>
    			<tr>
                    <td><?php echo $index + 1 ?></td>
    				<td><?php echo $perfil['nombre'] ?></td>
    				<td><?php echo $perfil['descripcion'] ?></td>
    				<td>
    					<button title="Editar perfil" type="button" class="btn-edit-log btn btn-warning" data-id="<?php echo $perfil['id'] ?>"><i class="fas fa-edit"></i></button>
    				</td>
    			</tr>
    		<?php endforeach; ?>
    	<?php endif; ?>
    </tbody>
</table>
<script>
    var tablaId = "tblPerfiles"
</script>