<div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
        <?php if (!isset($dias['indice'])): ?>
            <?php foreach ($dias as $index => $dia): ?>
                <li <?php echo $index == 0? 'class="active"': '' ?>>
                    <a href="#<?php echo $dia['indice'] ?>" data-toggle="tab" aria-expanded="<?php echo $index == 0? 'true': 'false' ?>">
                        <?php echo $dia['nombre'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="active">
                <a href="#<?php $dias['indice'] ?>" data-toggle="tab" aria-expanded="true"></a>
            </li>
        <?php endif; ?>
        <li class="pull-left header"><i class="fas fa-calendar-alt"></i> Descripción de los días del viaje</li>
    </ul>
    <div class="tab-content">
        <?php if (!isset($dias['indice'])): ?>
            <?php foreach ($dias as $index => $dia): ?>
                <div class="tab-pane <?php echo $index==0? 'active': '' ?>" id="<?php echo $dia['indice'] ?>">
                    <b>
                        <?php 
                            $fecha = new datetime($dia['f_dia']);
                            echo $fecha->format("d/m/Y");
                        ?> 
                    </b>
                    <p><?php echo $dia['descripcion'] ?></p>
                </div>
            <?php endforeach; ?>    
        <?php else: ?>
            <div class="tab-pane active" id="<?php echo $dias['indice'] ?>">
                <b>
                    <?php                         
                        $fecha = new datetime($dias['f_dia']);
                        echo $fecha->format("d/m/Y");
                    ?>
                </b>
                <p><?php echo $dias['descripcion'] ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>