<table id="tblAsignar" class="table no-margin table-striped" style="width:100%" data-table>
	<thead>
        <th>#</th>
        <th>Viaje</th>        
        <th>Inicio</th>
        <th>Fin</th>
        <th>Guia</th>
        <th>Estado</th>        
        <th>Opciones</th>
    </thead>    
    <tbody id="contenidoTabla" data-id-viaje="<?php echo $modulo['id'] ?>">     
    	<?php if (isset($registros) and !empty($registros) and is_array($registros)): ?>            
    		<?php foreach ($registros as $index => $viaje): ?>
                <?php
                    $guia = "N/A";
                    $status = "<span class='label label-default'>Sin agignar</span>";
                    $btn = "<button type='button' title='Asignar guia' class='btn btn-sm btn-primary btn-asignar'>Asignar guia</button>";
                    if (isset($viaje['guia'])) {
                        $guia = $viaje['guia'];
                        $status = "<span class='label label-primary'>Asignado</span>";
                        $btn = "<button type='button' title='Cambiar guia' class='btn btn-sm btn-warning btn-cambiar'>Cambiar guia</button>";
                    }
                ?>
                <tr>
                    <td data-id="<?php echo $viaje['id'] ?>"><?php echo $index + 1 ?></td>
    				<td><?php echo $viaje['nombre'] ?></td>
                    <td>
                        <?php 
                            $inicio = new datetime($viaje['f_inicio']);
                            echo $inicio->format("d/m/Y");
                        ?>
                    </td>
                    <td>
                        <?php 
                            $fin = new datetime($viaje['f_fin']);
                            echo $fin->format("d/m/Y");
                        ?>
                    </td>
                    <td><?php echo $guia ?></td>
                    <td><?php echo $status ?></td>
    				<td>
                        <?php echo $btn ?>
                    </td>
    			</tr>
    		<?php endforeach; ?>
    	<?php endif; ?>
    </tbody>
</table>
<script>
    var tablaId = "tblAsignar"
</script>