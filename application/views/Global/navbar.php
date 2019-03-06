<nav class="navbar navbar-expand-lg bg-primary">
    <a class="navbar-brand" href="#" style="width: 10%; color: white;">
        <i class="fas fa-bars"></i>
    </a>    
    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Conmutar Menu</span>
                </a>
            </li>
            <li class="nav-item">
                <a style="color: white;" class="nav-link" href="<?php echo base_url() ?>">Inicio</a>
            </li>            
            <li class="nav-item">
                <?php if ($this->session->userdata("login") != null): ?>
                    <a href="<?php echo base_url("inicio/perfil") ?>" class="nav-link" style="color: white;">Perfil</a>
                <?php else: ?>
                    <a style="color: white;" href="<?php echo base_url("inicio/ingresar") ?>" class="nav-link">Ingresar</a>
                <?php endif; ?>
            </li>
        </ul>  
        <?php if ($this->session->userdata("login") != null): ?>     
            <div class="nav-item">
                <a href="<?php echo base_url("inicio/logout") ?>" class="nav-link">Salir</a>
            </div>
        <?php endif; ?>
    </div>
</nav>