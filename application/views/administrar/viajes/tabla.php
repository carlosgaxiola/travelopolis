<table id="tblPerfiles" class="table no-margin table-striped" style="width:100%" data-table>
	<thead>        
        <th>#</th>    					                
        <th>Nombre</th>        
        <th>Precio</th>
        <th>Duración</th>
        <th>Viajeros</th>
        <th>Estado</th>
        <th>Opciones</th>        
    </thead>
    <tbody id="contenidoTabla">        
    	<?php if (isset($registros) and !empty($registros) and is_array($registros)): ?>
    		<?php foreach ($registros as $index => $viaje): ?>
    			<tr data-descripcion="<?php echo $viaje['descripcion'] ?>">
                    <td><?php echo $index + 1 ?></td>
    				<td><?php echo $viaje['nombre'] ?></td>    				
                    <td><?php echo $viaje['precio'] ?></td>
                    <td><?php echo $viaje['dias_duracion'] ?></td>
                    <td><?php echo $viaje['minimo']." - ".$viaje['maximo'] ?></td>
                    <td>
                        <?php if ($viaje['status'] == 0): ?>
                            <?php 
                                $title = "Abrir registro"; 
                                $icon = "fa-door-closed";
                                $btnToggleClass = "btn-primary";
                            ?>
                            <span class="label label-danger">Inactivo</span>
                        <?php elseif ($viaje['status'] == 1): ?>
                            <?php
                                $title = "Cerrar registro"; 
                                $icon = "fa-door-open";
                                $btnToggleClass = "btn-success";
                            ?>
                            <span class="label label-primary">Abierto</span>
                        <?php elseif ($viaje['status'] == 2): ?>
                            <?php 
                                $title = "Terminar";
                                $icon = "fa-check";
                                $btnToggleClass = "btn-default";
                            ?>
                            <span class="label label-success">Listo</span>
                        <?php else: ?>
                            <span class="label label-success">Terminado</span>
                        <?php endif; ?>
                    </td>
    				<td>
    					<button title="Editar viaje" type="button" class="btn-edit-log btn btn-warning" 
                            data-id="<?php echo $viaje['id'] ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button title="<?php echo $title ?>" type="button" 
                            class="btn-toggle-status btn <?php echo $btnToggleClass ?>" 
                            data-id="<?php echo $viaje['id'] ?>"
                            data-status="<?php echo $viaje['status'] ?>">
                            <i class="fas <?php echo $icon?>"></i>
                        </button>
    				</td>
    			</tr>
    		<?php endforeach; ?>
    	<?php endif; ?>
    </tbody>
</table>
<script>
    var tablaId = "tblViajes"
</script>