<table id="tblGuias" class="table no-margin table-striped table-hover" style="width:100%">
	<thead>        
        <th>#</th>    					                
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Télefono</th>
        <th>Correo</th>
        <th>Registro</th>
        <th>Estado</th>
        <th>Opciones</th>
    </thead>
    <tbody id="contenidoTabla">        
    	<?php if (isset($registros) and !empty($registros) and is_array($registros)): ?>
    		<?php foreach ($registros as $index => $guia): ?>
    			<tr data-id="<?php echo $guia['id'] ?>" data-nss="<?php echo $guia['nss'] ?>" data-rfc="<?php echo $guia['rfc'] ?>" data-usuario="<?php echo $guia['usuario'] ?>">
                    <td><?php echo $index + 1 ?></td>
    				<td><?php echo $guia['nombre'] ?></td>
    				<td><?php echo $guia['a_paterno']." ".$guia['a_materno'] ?></td>
                    <td><?php echo $guia['telefono'] ?></td>
                    <td><?php echo $guia['correo'] ?></td>
                    <td>
                        <?php 
                            $fecha = new datetime($guia['f_registro']);
                            echo $fecha->format("d/m/Y");
                        ?>
                    </td>
                    <td>
                        <?php if ($guia['status'] == 1): ?>
                            <?php 
                                $title = "Desactivar"; 
                                $icon = "fa-toggle-off";
                                $btnToggleClass = "btn-danger";
                            ?>
                            <span class="label label-success">Activo</span>
                        <?php else: ?>
                            <?php 
                                $title = "Activar"; 
                                $icon = "fa-toggle-on";
                                $btnToggleClass = "btn-success";
                            ?>
                            <span class="label label-danger">Inactivo</span>
                        <?php endif; ?>
                    </td>                    
    				<td>
    					<button title="Editar guia" type="button" class="btn-edit-log btn btn-warning" data-id="<?php echo $guia['id'] ?>"><i class="fas fa-edit"></i></button>
                        <button title="<?php echo $title ?>" type="button" class="btn-toggle-log btn <?php echo $btnToggleClass ?>" data-id="<?php echo $guia['id'] ?>" data-status="<?php echo $guia['status'] ?>"><i class="fas <?php echo $icon ?>"></i></button>
    				</td>
    			</tr>
    		<?php endforeach; ?>
    	<?php endif; ?>
    </tbody>
</table>
<script>
    var tablaId = "tblGuias"
</script>