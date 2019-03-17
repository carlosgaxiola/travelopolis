<?php if (isset($viaje)): ?> 
    <?php $ancla = base_url("viajes?buscar=".str_replace(" ", "+", ($viaje['nombre'])))?>
    <div class="box box-widget widget-user-2" style="margin: 5% 10%; box-shadow: 5px 5px 20px;">
        <?php 
            $imagen = '';
            if (isset($viaje['url_imagen']))
                $imagen = 'style="background: url("'.base_url("assets/images/").$viaje['url_imagen'].'") center center;';            
        ?>
        <a href="<?php echo $ancla ?>">
            <div class="widget-user-header bg-blue" <?php echo $imagen ?>>
                <?php if (empty($imagen)): ?>
                    <div class="widget-user-name">
                        <strong><?php echo $viaje['nombre'] ?></strong>
                    </div>
                <?php endif; ?>
            </div>
        </a>
        <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
                <?php if (!empty($imagen)): ?>
                    <li>
                        <a href="<?php echo $ancla ?>">
                            <strong><?php echo $viaje['nombre'] ?></strong>
                        </a>
                    </li>
                <?php endif; ?>
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