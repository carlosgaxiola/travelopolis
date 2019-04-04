<div class="box box-widget widget-user">
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
    <div class="widget-user-header bg-blue" style="background: url('<?php echo base_url("assets/images/viajes/$imagen") ?>') center center;">
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