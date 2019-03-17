<div class="box box-info" style="border-top-color: rgba(88, 114, 145, 1) !important;">
    <div class="box-header with-border">
        <h3 class="box-title">Detalles</h3>
    </div>
    <div class="box-body">
        <strong><i class="fas fa-sun margin-r-5"></i>Dias</strong>
        &nbsp;<span class="text-muted"><?php echo $viaje['dias_duracion'] ?></span>

        &nbsp;&nbsp;&nbsp;<strong><i class="fas fa-moon margin-r-5"></i>Noches</strong>
        <span class="text-muted"><?php echo $viaje['noches_duracion'] ?></span>

        &nbsp;&nbsp;&nbsp;<strong><i class="fas fa-calendar margin-r-5"></i>Inicio</strong>
        <span class="text-muted"><?php echo $viaje['f_inicio'] ?></span>

        &nbsp;&nbsp;&nbsp;<strong><i class="fas fa-calendar margin-r-5"></i>Fin</strong>
        <span class="text-muted"><?php echo $viaje['f_fin'] ?></span>

        &nbsp;&nbsp;&nbsp;<strong><i class="fas fa-calendar-times margin-r-5"></i>Dias para cancelar</strong>
        <span class="text-muted"><?php echo $viaje['dias_espera_devolucion'] ?></span>

        <hr>
        <strong><i class="fas fa-file-alt margin-r-5"></i>Descripcion</strong>
        <p><?php echo $viaje['descripcion'] ?></p>
    </div>
</div>