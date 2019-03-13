<aside class="main-sidebar" style="background-color: #aaaaaa; margin-top: 9%;">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url("assets/images/logo.png") ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata("usuario") ?></p>
                <small><?php echo $this->session->userdata("perfil") ?></small>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <?php
                $idPerfil = $this->session->userdata("id_perfil");                
                $modulos = modulos($idPerfil);
                menu($modulos, $idModuloActual);
            ?>
        </ul>
    </section>
</aside>