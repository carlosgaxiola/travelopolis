<?php 
    function imprimirModulos ($modulos) {        
        if (is_array($modulos)):
            foreach ($modulos as $modulo):
                if (empty($modulo->hijos)):
                    echo "<li class='treeview ".($modulo->actual)? "active": ""."'>";
                    echo "  <a href='".$modulo->ruta."'>";
                    echo "      <i class='fas ".$modulo->fa_icon_class."'></i>";
                    echo "      <span>".$modulo->nombre."</span>";
                    echo "  </a>";
                    echo "</li>";
                else:
                    echo "<li class='treeview ".($modulo->actual)? 'active menu-open': ''."'>";
                    echo "  <a href='#'>";
                    echo "      <i class='fas ".$modulo->fa_icon_class."'></i>";
                    echo "      <span>".$modulo->nombre."</span>";
                    echo "      <span class='pull-right-container'>";
                    echo "          <i class='fas fa-angle-left pull-right'></i>";
                    echo "      </span>";
                    echo "  </a>";
                    echo "  <ul class='treeview-menu'>";
                    imprimirModulos($modulo->hijos);
                    echo "  </ul>";
                    echo "</li>";
                endif;
            endforeach;
        endif;
    }    
?>
<aside class="main-sidebar" style="background-color: gray;">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url("assets/images/logo.png") //echo $this->session->userdata('ruta_foto') ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata("nombre")." ".$this->session->userdata("a_paterno")." ".$this->session->userdata("a_materno") ?></p>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <?php imprimirModulos($modulos) ?>
        </ul>
    </section>
</aside>