<nav class="navbar navbar-expand-lg bg-primary">
    <a class="navbar-brand" href="#" style="width: 10%;">
        <!-- <img src="<?php //echo base_url("assets/images/logo.jpg")?>" alt="Inicio icono" style="width: 40%;"> -->
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if ($this->session->userdata("login")): ?>
                <?php foreach ($this->session->userdata("modulos") as $modulo): ?>           
                <?php endforeach; ?>
            <?php else: ?>                
                <li class="nav-item">
                    <a class="nav-link" style="color: white;" href="<?php echo base_url("assets/inicio")?>">Inicio</a>
                </li>
            <?php endif;?>
        </ul>
        <?php //if ($this->session->userdata("login") != null): ?>
            <!-- <div class="nav-item"> -->
                <!-- <a href="<?php //echo base_url("index.php/Inicio/salir")?>" class="nav-link">Salir</a> -->
            <!-- </div> -->
        <?php //endif;?>
    </div>
</nav>