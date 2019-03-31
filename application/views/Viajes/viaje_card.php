<?php if (isset($viaje)): ?> 
    <?php $ancla = base_url("viajes?buscar=".str_replace(" ", "+", ($viaje['nombre'])))?>
    <div class="box box-widget widget-user-2" style="margin-left: 3%; margin-top: 3%; width: 90%; box-shadow: 5px 5px 20px;">
        <?php
            switch ($viaje['tipo_viaje']) {
                case "Arqueologíco":
                    $imagen = "piramide_normal.jpg";
                    break;
                case "Playero":
                    $imagen = "playa_normal.jpg";
                    break;
                case "Natural":
                    $imagen = "bosque_normal.jpg";
                    break;
                case "Pueblo":
                    $imagen = "pueblo_normal.jpg";
                    break;
                case "Cabaña":
                    $imagen = "cabana_normal.jpg";
                    break;
            }
        ?>
        <a href="<?php echo $ancla ?>">
            <div class="widget-user-header bg-blue" style="background: url('<?php echo base_url("assets/images/viajes/$imagen") ?>') center center;">  
                <div class="widget-user-name">
                    <strong><?php echo $viaje['nombre']." - ".$viaje['tipo_viaje'] ?></strong>
                </div>                
            </div>
        </a>
        <div class="box-footer no-padding">
            <ul class="nav nav-stacked">               
                <li>
                    <a href="<?php echo $ancla ?>">
                        <?php echo $viaje['dias_duracion']." dias" ?>                     
                    </a>
                </li>
                <li>
                    <a href="<?php echo $ancla ?>">
                        <?php echo "De ".$viaje['minimo']." a ".$viaje['maximo']." viajeros" ?>                    
                    </a>
                </li>
                <li>
                    <a href="<?php echo $ancla ?>">
                        <?php echo "$ ".$viaje['precio']." MX por persona" ?>                    
                    </a>
                </li>
            </ul>
        </div>
    </div>
<?php else: ?>
    <div class="box box-widget widget-user">        
        <div class="widget-user-header bg-white">
            <h3 class="widget-user-username">No hay informacion de este viaje</h3>
            <h5 class="widget-user-desc">Fallo al cargar los datos</h5>
        </div>        
    </div>
<?php endif; ?>