<div class="box box-widget widget-user">
    <?php 
        $imagen = '';
        if (isset($viaje['imagen']) && !empty($viaje['imagen']))
            $imagen = 'style="background: url('."'".base_url("assets/images/".$viaje['imagen'])."') center center;";
    ?>
    <div class="widget-user-header bg-blue" <?php echo $imagen ?>>
        <h3 class="widget-user-username"><?php echo $viaje['nombre'] ?></h3>
        <h5 class="widget-user-desc"><?php echo $viaje['descripcion'] ?></h5>
    </div>
    <div class="box-footer">
        <div class="row">
            <div class="col-sm-4 border-right">
                <div class="description-block">
                    <h5 class="description-header"><?php echo $viaje['dias_duracion'] ?></h5>
                    <span class="description-text">DIAS</span>
                </div>                
            </div>            
            <div class="col-sm-4 border-right">
                <div class="description-block">
                    <h5 class="description-header"><?php echo $viaje['minimo']." - ".$viaje['maximo'] ?></h5>
                    <span class="description-text">VIAJEROS</span>
                </div>            
            </div>            
            <div class="col-sm-4">
                <div class="description-block">
                    <h5 class="description-header"><?php echo "$ ".$viaje['precio']." MXN" ?></h5>
                    <span class="description-text">POR PERSONA</span>
                </div>                
            </div>            
        </div>    
    </div>
</div>