<table id="tblViajes" class="table no-margin table-striped" style="width:100%" data-table>
	<thead>        
        <th>#</th>    					                
        <th>Nombre</th>        
        <th>Precio</th>
        <th>Duración</th>
        <th>Tipo</th>
        <th>Viajeros</th>
        <th>Estado</th>
        <th>Opciones</th>        
    </thead>
    <tbody id="contenidoTabla">     
    	<?php if (isset($registros) and !empty($registros) and is_array($registros)): ?>            
    		<?php foreach ($registros as $index => $viaje): ?>
                <?php 
                    $fechaInicio = new datetime($viaje['f_inicio']);
                    $fechaFin = new DateTime($viaje['f_fin']);                    
                ?>
                <tr data-id="<?php echo $viaje['id'] ?>">
                    <td><?php echo $index + 1 ?></td>
    				<td>
                        <?php echo trim($viaje['nombre'], " ") ?>
                    </td>
                    <td>
                        <?php echo trim($viaje['precio'], " ") ?>
                    </td>
                    <td>
                        <?php echo trim($viaje['dias_duracion'], " ") ?>
                    </td>
                    <td>
                        <?php echo trim($viaje['tipo'], " ") ?>
                    </td>
                    <td>
                        <?php echo trim($viaje['minimo'], " ")." - ".trim($viaje['maximo'], " ") ?>
                    </td>
                    <td>
                        <?php if ($viaje['status'] == 0): ?>
                            <?php 
                                $title = "Abrir registro"; 
                                $icon = "fa-door-closed";
                                $btnToggleClass = "btn-primary btn-abrir-registro";
                            ?>
                            <span class="label label-danger">Inactivo</span>
                        <?php elseif ($viaje['status'] == 1): ?>
                            <?php
                                $title = "Cerrar registro"; 
                                $icon = "fa-door-open";
                                $btnToggleClass = "btn-success btn-cerrar-registro";
                            ?>
                            <span class="label label-primary">Abierto</span>
                        <?php elseif ($viaje['status'] == 2): ?>
                            <?php 
                                $title = "Empezar";
                                $icon = "fa-check";
                                $btnToggleClass = "btn-default btn-empezar";
                            ?>
                            <span class="label label-success">Listo</span>
                        <?php elseif ($viaje['status'] == 4): ?>}
                            <?php 
                                $title = "Terminar";
                                $icon = "fa-check";
                                $btnToggleClass = "btn-default btn-terminar";
                            ?>
                            <span class="label label-primary">En curso</span>
                        <?php else: ?>
                            <span class="label label-success">Terminado</span>
                        <?php endif; ?>
                    </td>
    				<td>
                        <?php if ($viaje['status'] == 0): ?>
        					<button title="Editar viaje" type="button" class="btn-edit-log btn btn-warning" data-id="<?php echo $viaje['id'] ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                        <?php endif; ?>
                        <button title="<?php echo $title ?>" type="button" class="btn <?php echo $btnToggleClass ?>" data-id="<?php echo $viaje['id'] ?>" data-status="<?php echo $viaje['status'] ?>">
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