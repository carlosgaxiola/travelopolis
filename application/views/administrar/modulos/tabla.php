<table id="tblModulos" class="table no-margin table-striped" style="width:100%" data-table="true">
	<thead>
        <th>#</th>    					                
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Ruta</th>
        <th>Icono</th>
        <th>Opciones</th>        
    </thead>
    <tbody id="contenidoTabla">        
    	<?php if (isset($registros) and !empty($registros) and is_array($registros)): ?>
    		<?php foreach ($registros as $index => $modulo): ?>
    			<tr data-id="<?php echo $modulo['id'] ?>">
                    <td><?php echo $index + 1 ?></td>
    				<td><?php echo $modulo['nombre'] ?></td>
    				<td><?php echo $modulo['descripcion'] ?></td>
                    <td><?php echo $modulo['ruta']?></td>
                    <td><?php echo $modulo['fa_icon'] ?></td>
    				<td>                        
    					<button title="Editar modulo" type="button" class="btn-edit-log btn btn-warning" data-id="<?php echo $modulo['id'] ?>"><i class="fas fa-edit"></i></button>
    				</td>
    			</tr>
    		<?php endforeach; ?>
    	<?php endif; ?>
    </tbody>
</table>