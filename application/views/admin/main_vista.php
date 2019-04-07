<?php 
	$this->load->view("Global/header", array("titulo" => "Administrar"));
	$this->load->view("Global/aside", array("actual" => $modulo));
	if (strcmp($modulo['nombre'], "Inicio Administrador") != 0)
		$nombre = $modulo['nombre'];
?>
<main class="content-wrapper">	
	<?php if (isset($nombre)): ?>
		<div class="content" id="tabla">
			<div class="container-fluid">
				<div class="row">
					<blockquote style=" border-left: 5px solid #264d78;">
						<?php if (isset($allowAdd)): ?>
							<button type="button" class="btn btn-primary pull-right" id="btn-add" title="Nuevo registro"><i class="fas fa-plus"></i></button> 								
						<?php endif; ?>											
						<h1 class="text-justify">
							<?php
								if (isset($modulo['nombre_personalizado'])) 
									echo $modulo['nombre_personalizado'];
								else
									echo $nombre;
							?>
						</h1>
						<small><?php echo $modulo['descripcion'] ?></small>
					</blockquote>
				</div>
				<div class="row">
					<div class="box box-primary">
		                <div class="box-header with-border">
		                    <h3 class="box-title"><i class="fa fa-list"></i> 		                    	
		                    	<?php 
		                    		if (isset($modulo['listado_personalizado'])) 
										echo $modulo['listado_personalizado'];
									else
										echo "Listado de ".$nombre;
		                    	?>
		                    </h3>
		                    <div class="box-tools pull-right">
		                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                    </div>
		                </div>
		                <div class="box-body">
		                	<div class="table-responsive">
		                		<?php $this->load->view("admin/".lcfirst($nombre)."/tabla", $registros) ?>
		                	</div>
		                </div>                
					</div>
				</div>
			</div>
		</div>	
		<div class="content" id="formulario" hidden>
			<?php 
				if (isset($extras))
					$this->load->view("admin/".lcfirst($nombre)."/form", $extras);
				else
					$this->load->view("admin/".lcfirst($nombre)."/form");
				
			?>
		</div>
	<?php endif; ?>
</main>
<?php $this->load->view("Global/footer") ?>