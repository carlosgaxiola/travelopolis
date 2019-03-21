<?php 
    $noMargin = "";
    if ($this->session->userdata("admin_active") == false)
        $noMargin = "style='margin-left: 0px !important;'";  
?>
<nav class="navbar navbar-static-top bg-blue" <?php echo $noMargin ?>> 
    <?php if ($this->session->userdata("admin_active") == true): ?>     
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <i class="fas fa-bars"></i>
            <span class="sr-only">Conmutar menu lateral</span>
        </a>        
    <?php endif; ?>
    <ul class="nav navbar-nav nav-left-side">
        <?php if ($this->session->userdata("admin_active") != true): ?>
            <li class="nav-item">
                <a href="<?php echo base_url() ?>" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span>
                </a>   
            </li>
        <?php endif; ?>
        <?php if ($this->session->userdata("login") and $this->session->userdata("admin_active") != true): ?>
            <li class="nav-item user user-menu">
                <a href="<?php echo base_url("perfil/".$this->session->userdata("usuario")) ?>">
                    <img src="<?php echo base_url("assets/images/users/".$this->session->userdata("url_foto_perfil")."/profile_60x60.jpg") ?>" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo $this->session->userdata("usuario") ?></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>        
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">            
            <?php if ($this->session->userdata("login") != null): ?>                
                <?php if ($this->session->userdata("id_perfil") != 3): ?>
                    <?php if ($this->session->userdata("admin_active")): ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url("administrar/salir")?>">                            
                                <i class="fas-fa-door-open"></i>                                
                                <span> Salir del administrador</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url("administrar") ?>">
                                <i class="fas fa-cogs"></i>
                                <span> Administrar</span>
                            </a>
                        </li>
                    <?php endif; ?>                
                <?php endif; ?>              
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