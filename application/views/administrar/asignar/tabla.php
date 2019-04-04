<table id="tblDetViaje" class="table no-margin table-striped" style="width:100%" data-table>
	<thead>
        <th>#</th>
        <th>Viaje</th>        
        <th>Inicio</th>
        <th>Fin</th>
        <th>Guia</th>
        <th>Estado</th>        
        <th>Opciones</th>
    </thead>    
    <tbody id="contenidoTabla" data-id-viaje="<?php echo $modulo['id_viaje'] ?>">     
    	<?php if (isset($registros) and !empty($registros) and is_array($registros)): ?>            
    		<?php foreach ($registros as $index => $viaje): ?>
                <?php
                    $guia = "N/A";
                    $status = "<span class='label label-default'>Sin agignar</span>";
                    if (isset($viaje['guia'])) {
                        $guia = $viaje['guia'];
                        $status = "<span class='label label-primary'>Asignado</span>";
                    }
                ?>
                <tr>
                    <td data-id="<?php echo $viaje['id'] ?>"><?php echo $index + 1 ?></td>
    				<td><?php echo $viaje['nombre'] ?></td>
                    <td><?php echo $viaje['f_inicio'] ?></td>
                    <td><?php echo $viajero['correo'] ?></td>
                    <td><?php echo $viajero['cantidad'] ?></td>
                    <td><?php echo $viajero['resto'] ?></td>
                    <td><?php echo $label ?></td>
    				<td>
                        <?php 
                            echo $btnCancelar;
                            echo $btnVerAcompañantes;
                            echo $btnAbonar;
                        ?>
                    </td>
    			</tr>
    		<?php endforeach; ?>
    	<?php endif; ?>
    </tbody>
</table>
<script>
    var tablaId = "tblDetViaje"
</script>