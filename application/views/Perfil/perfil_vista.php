<?php 
	if (isset($usuario['persona'])) {
		$persona = $usuario['persona'][0];
		$usuario = $usuario['usuario'];
	}	
?>
<?php $this->load->view("Global/header") ?>
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-body box-profile">					
					<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url("assets/images/users/default.png") ?>" alt="Foto de perfil">					
					<h3 class="profile-username text-center"><?php echo $persona["nombre"]." ".$persona['a_paterno']." ".$persona['a_materno'] ?></h3>
					<p class="text-muted text-center"><?php echo $usuario["perfil"] ?></p>
					<ul class="list-group list-group-unbordered">						
						<li class="list-group-item">
							<b>Viajes realizados</b> <a class="pull-right"><?php echo isset($viajes['total'])? $viajes["total"]: '0'?></a>
						</li>
						<!-- <li class="list-group-item">
							<b>Viajes deseados</b> <a class="pull-right"><?php echo isset($viaje['me_gustan'])? $viaje['me_gustan']: '0' ?></a>
						</li> -->
					</ul>					
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Acerca de <?php echo $persona["nombre"] ?></h3>
				</div>
				<div class="box-body">
					<p class="text-muted">
						<?php echo $persona['informacion'] ?>
					</p>					
				</div>		
			</div>		
		</div>	
		<div class="col-md-9">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#timeline" data-toggle="tab" aria-expanded="true">Viajes</a></li>
					<?php if (strcmp($usuario['usuario'], $this->session->userdata("usuario")) == 0): ?>						
						<li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Configuración</a></li>	
					<?php endif; ?>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="timeline">
						<ul class="timeline timeline-inverse">
							<?php if (isset($viajes) and is_array($viajes)): ?>
								<?php if ($viajes['total'] > 1): ?>
									<?php foreach ($viajes as $viaje): ?>
										<?php if (!is_int($viaje)): ?>
											<li>
												<i class="fa fa-calendar bg-blue"></i>
												<div class="timeline-item">
													<a href="<?php echo base_url("viajes?buscar=".$viaje['nombre'])?>" style="color: black">
														<?php $this->load->view("Viajes/viaje_card_horizontal", array("viaje" => $viaje)) ?>
													</a>
												</div>
											</li>
										<?php endif; ?>
									<?php endforeach; ?>								
								<?php else: ?>
									<li>
										<i class="fa fa-calendar bg-blue"></i>
										<div class="timeline-item">
											<?php $this->load->view("Viajes/viaje_card_horizontal", array("viaje" => $viajes)) ?>
										</div>
									</li>
								<?php endif; ?>	
							<?php else: ?>
								<li>
									<i class="fa fa-check bg-blue"></i>
									<div class="timeline-item">
										<div class="panel panel-info">
											Aquí apareceran todos tus viajes realizados
										</div>
									</div>
								</li>
							<?php endif; ?>
							<li>
								<i class="fas fa-clock"></i>
							</li>
						</ul>
					</div>
					<?php if (strcmp($usuario['usuario'], $this->session->userdata("usuario")) == 0): ?>
						<div class="tab-pane" id="settings">
							<div class="alert alert-danger" id="msg-error" hidden>								
							</div>
							<?php if ($this->session->userdata("id_perfil") == 3): ?>
								<?php $this->load->view("perfil/form_viajero", array("persona" => $persona, "usuarios" => $usuario)) ?>
							<?php else: ?>	
								<?php $this->load->view("perfil/form_empleado", array("persona" => $persona, "usuarios" => $usuario)) ?>
							<?php endif; ?>
							<form action="" class="form-horizontal" id="frmCambiarContra" hidden="true">
								<div class="form-group">
									<label for="txtContra" class="col-sm-3">
										Contraseña Actual:
									</label>
									<div class="col-sm-4">
										<input type="password" class="form-control" name="txtContra" id="txtContra">
									</div>
									</div>
								<div class="form-group">
									<label for="txtConfirmar" class="col-sm-3">
										Confirmar Contraseña:
									</label>
									<div class="col-sm-4">
										<input type="password" class="form-control" id="txtConfirmar" name="txtConfirmar">
									</div>
								</div>
								<div class="form-group">
									<label for="txtNuevaContra" class="col-sm-3">
										Nueva Contraseña:
									</label>
									<div class="col-sm-4">
										<input type="password" id="txtNuevaContra" name="txtNuevaContra" class="form-control">
									</div>
								</div>
								<br><br>
								<div class="form-group">
									<button type="button" id="btn-cambiar-contra" class="btn btn-lg btn-primary pull-left">
										Cambiar
									</button>
								</div>
							</form>
						</div>		
					<?php endif; ?>
				</div>		
			</div>		
		</div>	
	</div>
</section>
<?php $this->load->view("Global/footer") ?>
<script>
	$(document).ready( function () {
		$("#txtDescripcion").text($("#txtDescripcion").text().trim())

		$("#btn-guardar").click(function () {
				<?php if ($this->session->userdata("id_perfil") == 3): ?>
					<?php $funcion = "editar_viajero" ?>
					let nuevosDatos = {
						nombre: $("#txtNombre").val(),
						paterno: $("#txtAPaterno").val(),
						materno: $("#txtAMaterno").val(),
						correo: $("#txtCorreo").val(),
						usuario: $("#txtUsuario").val(),
						descripcion: $("#txtDescripcion").val(),
						telefono: $("#txtTelefono").val(),
						estado: $("#cmbEstado").val(),
						sexo: $("#cmbSexo").val()
					}
				<?php else: ?>
					<?php $funcion = "editar_empleado" ?>
					let nuevosDatos = {
						nombre: $("#txtNombre").val(),
						paterno: $("#txtAPaterno").val(),
						materno: $("#txtAMaterno").val(),
						correo: $("#txtCorreo").val(),
						usuario: $("#txtUsuario").val(),
						descripcion: $("#txtDescripcion").val(),
						nss: $("#txtNSS").val(),
						rfc: $("#txtRFC").val(),
						telefono: $("#txtTelefono").val()
					}
				<?php endif; ?>				
				$.ajax({
					url: base_url +  "perfil/<?php echo $funcion ?>",
					type: "POST",
					data: nuevosDatos,
					success: function (res) {
						try {
							res = parseInt(res)
							if (!isNaN(res)) {
								switch (res) {
									case 0:
										BootstrapDialog.alert({
											title: "Error",
											message: "Ocurrio un error desconocido",
											type: BootstrapDialog.TYPE_DANGER,
											size: BootstrapDialog.SIZE_SMALL
										})
										break;
									default:
										BootstrapDialog.show({
											title: "Datos cambiados",
											message: "Se cambio su información satisfactoriamente",
											type: BootstrapDialog.TYPE_SUCCESS,
											size: BootstrapDialog.SIZE_SMALL
										});										
										break;
								}
								$("#msg-error").html("");
								$("#msg-error").hide();
							}
							else {
								$("#msg-error").html(res);
								$("#msg-error").show();
							}
						}
						catch (e) {
							console.error(e);
						}
					}
				})
		})
		
		$("#btn-cambiar").click( function () {
			$("#frmPerfil").hide()
			$("#frmCambiarContra").show()
		})

		$("#btn-cambiar-contra").click( function () {
			$.ajax({
				url: base_url + "perfil/cambiar_contra",
				data: {
					contra: $("#txtContra").val(),
					confirmar: $("#txtConfirmar").val(),
					nueva: $("#txtNuevaContra").val(),
					id: '<?php echo $usuario['id'] ?>'
				},
				type: "POST",
				success: function (res) {
					try {						
						if (isNaN(parseInt(res))) {
							$("#msg-error").html(res)
							$("#msg-error").show()								
						}
						else {
							if (parseInt(res) != 0)
								BootstrapDialog.show({
									title: "Datos cambiados",
									message: "Se cambio la contraseña satisfactoriamente",
									type: BootstrapDialog.TYPE_SUCCESS,
									size: BootstrapDialog.SIZE_SMALL
								})
							else
								BootstrapDialog.show({
									title: "Error",
									message: "Ocurrio un error desconocido",
									type: BootstrapDialog.TYPE_DANGER,
									size: BootstrapDialog.SIZE_SMALL
								})
						}
					}
					catch (e) {
						console.error(e)
					}
				}
			})			
		})
	})
</script>