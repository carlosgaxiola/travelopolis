<aside class="main-sidebar bg-white">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <?php if ($this->session->userdata("admin_active")): ?>
                    <img src="<?php echo base_url("assets/images/users/".$this->session->userdata("url_foto_perfil")."/profile_60x60.jpg") ?>" class="user-image img-circle" alt="User Image">
                <?php else: ?>
                    <img src="<?php echo base_url("assets/images/logo.png") ?>" class="img-circle" alt="User Image">
                <?php endif; ?>
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
                menu($modulos, $actual['id']);
            ?>
        </ul>
    </section>
</aside>