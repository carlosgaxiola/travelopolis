<table id="tblDetViaje" class="table no-margin table-striped" style="width:100%" data-table>
	<thead>
        <th>#</th>
        <th>Nombre</th>
        <th>Estado</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Cantidad</th>
        <th>Resto</th>
        <th>Estatus</th>
        <th>Opciones</th>
    </thead>
    <tbody id="contenidoTabla">     
    	<?php if (isset($registros) and !empty($registros) and is_array($registros)): ?>            
    		<?php foreach ($registros as $index => $viajero): ?>
                <?php
                    if ($viajero['status'] == 0) {
                        $label = "<span class='label label-danger'>Cancelado</span>";
                        $btnCancelar = "";
                        $btnAbonar = "";
                    }
                    else if ($viajero['status'] == 1) {
                        $label = "<span class='label label-warning'>Cotización enviada</span>";
                        $btnCancelar = "<button title='Cancelar' class='btn btn-danger btn-cancelar' type='button'><i class='fas fa-ban'></i></button>";
                        $btnAbonar = "&nbsp;<button type='button' class='btn btn-success btn-abonar'><i class='fas fa-money-bill-wave'></i></button>";
                    }
                    else if ($viajero['status'] == 2) {
                        $label = "<span class='label label-primary'>Anticipo dado</span>";
                        $btnCancelar = "<button title='Cancelar' type='button' class='btn btn-danger btn-cancelar'><i class='fas fa-ban'></i></button>";
                        $btnAbonar = "&nbsp;<button type='button' class='btn btn-success btn-abonar'><i class='fas fa-money-bill-wave'></i></button>";
                    }
                    else if ($viajero['status'] == 3) {
                        $label = "<span class='label label-success'>Pagado</span>";
                        $btnCancelar = "";
                        $btnAbonar = "&nbsp;<button type='button' class='btn btn-success btn-abonar'><i class='fas fa-money-bill-wave'></i></button>";
                    }
                ?>                
                <tr data-id="<?php echo $viajero['id'] ?>">
                    <td><?php echo $index + 1 ?></td>
    				<td><?php echo $viajero['nombre']." ".$viajero['a_paterno'] ?></td>                    
                    <td><?php echo $viajero['estado'] ?></td>
                    <td><?php echo $viajero['telefono'] ?></td>
                    <td><?php echo $viajero['correo'] ?></td>
                    <td><?php echo $viajero['cantidad'] ?></td>
                    <td><?php echo $viajero['resto'] ?></td>
                    <td><?php echo $label ?></td>
    				<td>
                        <?php 
                            echo $btnCancelar;
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