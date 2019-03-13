<?php 
    $noMargin = "";
    if ($this->session->userdata("login") == null)
        $noMargin = "style='margin-left: 0px !important;'";  
?>
<nav class="navbar navbar-static-top" <?php echo $noMargin ?>>      
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <i class="fas fa-bars"></i>
        <span class="sr-only">Conmutar menu lateral</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">            
            <li class="nav-item">
                <a href="<?php echo base_url() ?>" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <?php if ($this->session->userdata("login") != null): ?>
                <li class="nav-item">
                    <a href="<?php echo base_url("perfil") ?>" class="nav-link">
                        <i class="fas fa-user"></i>
                        <span>Mi perfil</span>                        
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link btn-logout">
                        <i class="fas fa-door-open"></i>
                        <span>Salir</span>                        
                    </a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a href="<?php echo base_url("inicio/ingresar") ?>" class="nav-link">
                        <i class="fas fa-door-closed"></i>
                        <span>Ingresar</span>
                    </a>
                </li>                    
            <?php endif; ?>
        </ul>
    </div>
</nav>