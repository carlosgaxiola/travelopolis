<?php 
	$this->load->view("Global/header", array("titulo" => "Administrar"));
	$this->load->view("Global/aside", array("actual" => $modulo));		
	if (strcmp($modulo['nombre'], "Inicio Administrar") != 0)
		$nombre = $modulo['nombre'];
?>
<main class="content-wrapper">	
	<?php if (isset($nombre)): ?>
		<div class="content" id="tabla">
			<div class="container-fluid">
				<div class="row">
					<blockquote style=" border-left: 5px solid #264d78;">
						<?php if (isset($allowAdd)): ?>
							<button title="<?php $allosAdd['btn-title'] ?>" id="<?php echo $allowAdd['btn-id'] ?>" class="btn btn-primary"><i class="fas fa-plus"></i></button>
						<?php endif; ?>
						<i class="fas fa-plus"></i></button> 							
						<h1 class="text-justify"><?php echo $nombre ?></h1>
						<small><?php echo $modulo['descripcion'] ?></small>
					</blockquote>
				</div>
				<div class="row">
					<div class="box box-primary">
		                <div class="box-header with-border">
		                    <h3 class="box-title"><i class="fa fa-list"></i> Listado de <?php echo $nombre ?></h3>
		                    <div class="box-tools pull-right">
		                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                    </div>
		                </div>
		                <div class="box-body">
		                	<div class="table-responsive">
		                		<?php $this->load->view("administrar/".lcfirst($nombre)."/tabla", $registros) ?>
		                	</div>
		                </div>                
					</div>
				</div>
			</div>
		</div>	
		<div class="content" id="formulario" hidden>
			<?php $this->load->view("administrar/".lcfirst($nombre)."/formulario", $extras) ?>
		</div>
	<?php endif; ?>
</main>
<?php $this->load->view("Global/footer") ?>