<table id="tblPerfiles" class="table no-margin table-striped" style="width:100%">
	<thead>                        		 	
        <tr> 
            <th>#</th>    					                
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody id="contenidoTabla">
    	<?php if (isset($registros) and !empty($registros) and is_array($registros)): ?>
    		<?php foreach ($registros as $perfil): ?>
    			<tr>
    				<td><?php echo $perfil['nombre'] ?></td>
    				<td><?php echo $perfil['descripcion'] ?></td>
    				<td>
    					<button title="Editar perfil" type="button" class="btn-edit-perfil btn btn-warning" data-id-perfil="<?php echo $perfil['id'] ?>"><i class="fas fa-edit"></i></button>
    				</td>
    			</tr>
    		<?php endforeach; ?>
    	<?php endif; ?>
    </tbody>
</table>