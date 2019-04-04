<?php 	
	$this->load->view("Global/header");
	$this->load->view("Global/aside", array('actual' => $actual));		
?>
<main class="content-wrapper">	
	<div class="content" id="tabla">
		<div class="container-fluid">
			<div class="row">
				<blockquote style=" border-left: 5px solid #264d78;">
					<?php if (!empty($formularios)): ?>
						<button type="button" class="btn btn-primary pull-right" id="btn-add" title="Nuevo registro"><i class="fas fa-plus"></i></button> 		
					<?php endif; ?>
					<h1 class="text-justify"><?php echo is_array($actual)? $actual["nombre"]: 'Sin Nombre' ?></h1>
					<small><?php echo is_array($actual)? $actual['descripcion']: 'Sin descripcion' ?></small>
				</blockquote>
			</div>
			<div class="row">
				<div class="box box-primary">
	                <div class="box-header with-border">
	                    <h3 class="box-title"><i class="fa fa-list"></i>  Listado de <?php echo is_array($actual)? $actual["nombre"]: 'registros' ?></h3>
	                    <div class="box-tools pull-right">
	                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                    </div>
	                </div>
	                <div class="box-body">
	                	<div class="table-responsive">
	                		<table id="tbl<?php echo $titulo  ?>" class="table no-margin table-striped" style="width:100%">
	                    		 <thead>                        		 	
						            <tr> 
						                <th>#</th>    					                
						                <?php foreach ($indices as $index => $valor): ?>
						                	<th><?php echo $index ?></th>
						                <?php endforeach; ?>
						                <th>Opciones</th>
						            </tr>
						        </thead>
						        <tbody id="contenidoTabla">
						        	<?php if (is_array($registros)): ?>
	    					        	<?php foreach ($registros as $index => $registro): ?>
	    					        		<tr data-id="<?php echo $registro['id'] ?>">
	    					        			<td><?php echo $index + 1 ?></td>	    					        			
		    					        		<?php foreach ($indices as $index => $value): ?>		    					        					    					        			
		    					        			<?php if (isset($registro['status']) && strcmp($value, "status") == 0): ?>
		    					        				<td data-status="<?php echo $registro['status'] ?>">
		    					        					<?php if ($registro["status"] == 1): ?>		    					        					
		    					        						<label class="label label-success">Activo</label>
		    					        					<?php else: ?>
		    					        						<label class="label label-danger">Inactivo</label>
		    					        					<?php endif; ?>
		    					        				</td>		    					        					    					        		
													<?php elseif (isset($value['data']) && !empty($value['data'])):  ?>
														<td data-<?php echo $value['data'] ?>="<?php echo $registro[$value['db']] ?>">
		    					        					<?php echo $registro[$value['db']] ?>
		    					        				</td>
		    					        			<?php else: ?>
		    					        				<td><?php echo $registro[$value['db']] ?></td>
													<?php endif; ?>
		    					        		<?php endforeach; ?>
		    					        		<td>
		    					        			<button type="button" class="btn btn-warning btn-edit-log" data-id="<?php echo $registro['id'] ?>" title="Editar registro"><i class="fas fa-edit"></i></button>
													<?php if (isset($registro["status"])): ?>
														<?php 		    					        				
			    					        				$title = "Desactivar registro";
			    					        				if ($registro['status'] == 0)
			    					        					$title = "Activar registro";
			    					        			?>
														<button type="button" class="btn btn-danger btn-sm btn-toggle-log" data-id="<?php echo $registro['id'] ?>" title="<?php echo $title ?>" data-status="<?php echo $registro['status'] ?>">
															<?php if ($registro['status'] == 1): ?>
																<i class="fas fa-toggle-off"></i>
															<?php else: ?>
																<i class="fas fa-toggle-on"></i>
															<?php endif; ?>
														</button>
													<?php endif; ?>
		    					        		</td>
		    					        	</tr>
	    					        	<?php endforeach; ?>
	    					        <?php endif; ?> 					           
						        </tbody>
						    </table>
	                	</div>
	                </div>                
				</div>
			</div> <!-- /.row -->			
		</div>
	</div>
	<?php if (!empty($formularios)): ?>
		<div class="content" id="formulario" hidden>
			<div class="container-fluid">
				<div class="row">
					<button type="button" id="btn-close" class="btn btn-danger pull-right" title="Cerrar formulario"><i class="fas fa-times"></i></button>
				</div>
				<div class="row">
					<?php 						
						if (is_array($formularios))
							foreach ($formularios as $formulario)
								$this->load->view("administrar/".$formulario."_vista", array("extras" => $extras));
						else
							$this->load->view("administrar/".$formularios."_vista", array("extras" => $extras));
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</main>
<?php 
	$this->load->view("Global/footer", 
		array(
			"scripts" => array(
				"app/listar",
				$script
			)
		)
	) 
?>