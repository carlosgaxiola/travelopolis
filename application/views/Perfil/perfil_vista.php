<?php $this->load->view("Global/header") ?>
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<?php if ($usuario["url_foto_perfil"]): ?>
						<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url("assets/images/users/".$usuario["url_foto_perfil"]."/profile_160x160.jpg") ?>" alt="Foto de perfil">
					<?php else: ?>
						<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url("assets/images/users/default.png") ?>" alt="Foto de perfil">
					<?php endif; ?>
					<h3 class="profile-username text-center"><?php echo $usuario["completo"] ?></h3>
					<p class="text-muted text-center"><?php echo $usuario["perfil"] ?></p>
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Amigos</b> <a class="pull-right"><?php echo isset($amigos['total'])? $amigos['total']: '0' ?></a>
						</li>	
						<li class="list-group-item">
							<b>Viajes realizados</b> <a class="pull-right"><?php echo isset($viajes['total'])? $viajes["total"]: '0'?></a>
						</li>
						<li class="list-group-item">
							<b>Viajes deseados</b> <a class="pull-right"><?php echo isset($viaje['me_gustan'])? $viaje['me_gustan']: '0' ?></a>
						</li>
					</ul>
					<?php if (strcmp($usuario['nombre'], $this->session->userdata("nombre")) != 0): ?>
						<a href="#" class="btn btn-primary btn-block"><b>Solicitar amistad</b></a>
					<?php endif; ?>
				</div>
			</div>				
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Acerca de <?php echo $usuario["nombre"] ?></h3>
				</div>		
				<div class="box-body">					
					<p class="text-muted">
						<?php echo $usuario['descripcion'] ?>
					</p>					
				</div>		
			</div>		
		</div>	
		<div class="col-md-9">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">					
					<li class="active"><a href="#timeline" data-toggle="tab" aria-expanded="true">Viajes</a></li>
					<?php if (strcmp($usuario['nombre'], $this->session->userdata("usuario")) == 0): ?>						
						<li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Configuración</a></li>	
					<?php endif; ?>
				</ul>
				<div class="tab-content">					
					<div class="tab-pane active" id="timeline">
						<ul class="timeline timeline-inverse">		
							<li class="time-label">
								<span class="bg-red">
									10 Feb. 2014
								</span>
							</li>		
							<li>
								<i class="fa fa-envelope bg-blue"></i>
								<div class="timeline-item">
									<?php $this->load->view("Viajes/viaje_card_horizontal", array("viaje" => $viajes[0])) ?>
								</div>
							</li>		
							<li>
								<i class="fa fa-user bg-aqua"></i>
								<div class="timeline-item">
									<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
									<h3 class="timeline-header no-border">
										<a href="#">Sarah Young</a> accepted your friend request
									</h3>
								</div>
							</li>
							<li>
								<i class="fa fa-comments bg-yellow"></i>
								<div class="timeline-item">
									<span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>			
									<h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
									<div class="timeline-body">
										Take me to your leader!
										Switzerland is small and neutral!
										We are more like Germany, ambitious and misunderstood!
									</div>
									<div class="timeline-footer">
										<a class="btn btn-warning btn-flat btn-xs">View comment</a>
									</div>
								</div>
							</li>
							<li class="time-label">
								<span class="bg-green">
									3 Jan. 2014
								</span>
							</li>
							<li>
								<i class="fa fa-camera bg-purple"></i>
								<div class="timeline-item">
									<span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
									<h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

									<div class="timeline-body">
										<img src="http://placehold.it/150x100" alt="..." class="margin">
										<img src="http://placehold.it/150x100" alt="..." class="margin">
										<img src="http://placehold.it/150x100" alt="..." class="margin">
										<img src="http://placehold.it/150x100" alt="..." class="margin">
									</div>
								</div>
							</li>
							<li>
								<i class="fa fa-clock-o bg-gray"></i>
							</li>
						</ul>
					</div>
					<?php if (strcmp($usuario['nombre'], $this->session->userdata("usuario")) == 0): ?>
						<div class="tab-pane" id="settings">
							<form class="form-horizontal">
								<div class="form-group">
									<label for="txtNombre" class="col-sm-2 control-label">Nombre</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="txtNombre" value="<?php echo $usuario['nombre'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="txtAPaterno" class="col-sm-2 control-label">Apellido Paterno</label>
									<div class="col-sm-10">
										<input type="email" class="form-control" id="txtAPaterno" value="<?php echo $usuario['a_paterno'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="txtAMaterno" class="col-sm-2 control-label">Apellido Materno</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="txtAMaterno" value="<?php echo $usuario['a_materno'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="txtCorreo" class="col-sm-2 control-label">Correo</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="txtCorreo" value="<?php echo $usuario['correo'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="txtUsuario" class="col-sm-2 control-label">Usuario</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="txtUsuario" value="<?php echo $usuario['usuario'] ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtDescripcion" class="col-sm-2" style="padding-left: 0px; margin-right: 0px; padding-right: 0px; width: 10%; margin-left: 6.5%;">Descripción</label>
									<div class="col-sm-10">
										<textarea type="text" name="txtDescripcion" class="form-control" id="txtDescripcion">
											<?php echo $usuario['descripcion'] ?>
										</textarea>
									</div>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-default" id="btn-cambiar">Cambiar usuario y/o contraseña</button>
								</div>
							</form>
						</div>		
					<?php endif; ?>
				</div>		
			</div>		
		</div>	
	</di
	v>
</section>
<?php $this->load->view("Global/footer") ?>
<script>
	$(document).ready( function () {
		$("#txtDescripcion").text($("#txtDescripcion").text().trim())
	})
</script>