<table id="tblDetViaje" class="table no-margin table-striped" style="width:100%" data-table>
	<thead>
        <th>#</th>
        <th>Nombre</th>        
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Cantidad</th>
        <th>Resto</th>
        <th>Estatus</th>
        <th>Opciones</th>
    </thead>    
    <tbody id="contenidoTabla" data-id-viaje="<?php echo $modulo['id_viaje'] ?>">     
    	<?php if (isset($registros) and !empty($registros) and is_array($registros)): ?>            
    		<?php foreach ($registros as $index => $viajero): ?>
                <?php
                    $btnVerAcompañantes = "&nbsp;<button title='Ver datos' class='btn btn-primary btn-ver' type='button'><i class='fas fa-user'></i></button>";
                    if ($viajero['cantidad'] > 1)
                        $btnVerAcompañantes = "&nbsp;<button class='btn btn-primary btn-ver' type='button' title='Ver acompañantes'><i class='fas fa-users'></i></button>";                    
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
                        $btnAbonar = "";
                    }                    
                ?>
                <tr>
                    <td data-id="<?php echo $viajero['id'] ?>"><?php echo $index + 1 ?></td>
    				<td><?php echo $viajero['nombre']." ".$viajero['a_paterno'] ?></td>                    
                    <td><?php echo $viajero['telefono'] ?></td>
                    <td><?php echo $viajero['correo'] ?></td>
                    <td><?php echo $viajero['cantidad'] ?></td>
                    <td><?php echo $viajero['resto'] ?></td>
                    <td><?php echo $label ?></td>
    				<td>
                        <?php 
                            echo $btnCancelar;
                            echo $btnAbonar;
                            echo $btnVerAcompañantes;
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