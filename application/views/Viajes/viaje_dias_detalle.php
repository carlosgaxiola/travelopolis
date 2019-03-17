<div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
        <?php foreach ($dias as $index => $dia): ?>
            <li <?php echo $index == 0? 'active': '' ?>>
                <a href="#<?php echo $indice ?>" data-toggle="tab" aria-expanded="<?php echo $index == 0? 'true': 'false' ?>">
                    <?php echo $dia['nombre'] ?>
                </a>
            </li>
        <?php endforeach; ?>
        <li class="pull-left header"><i class="fas fa-calendar-alt"></i> Itinirario</li>
    </ul>
    <div class="tab-content">
        <?php foreach ($dias as $index => $dia): ?>
            <div class="tab-pane <?php echo $index==0? 'active': '' ?>" id="<?php echo $dia['indice'] ?>">
                <b><?php echo $dia['f_dia'] ?></b>
                <p><?php echo $dia['descripcion'] ?></p>
            </div>
        <?php endforeach; ?>    
    </div>
</div>