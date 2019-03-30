<?php $this->load->view("Global/header", array("titulo" => "Inicio")) ?>
<div class="content-wrapper" style="margin-left: 0px; margin-bottom: 1%">
	<div class="contenet">
		<?php if ($this->session->flashdata("reenviar_correo")): ?>
			<div class="row">
				<div class="panel panel-danger">
					<div class="panel-body alert-danger">
						Error al mandar confirmación
					</div>
					<div class="panel-footer">
						<?php 
							echo $this->session->flashdata("reenviar_correo");
							echo $this->session->flashdata("btn-reenviar");
							echo $this->session->flashdata("btn-cambiar-correo");
						?>
					</div>
				</div>
			</div>
		<?php elseif ($this->session->flashdata("error_crear")): ?>
			<div class="row">
				<div class="panel panel-danger">
					<div class="panel-body alert-danger">
						Error
					</div>
					<div class="panel-footer">
						<?php echo $this->session->flashdata("error_crear") ?>
					</div>
				</div>
			</div>
		<?php elseif ($this->session->flashdata("revisar_correo")): ?>
			<div class="row">
				<div class="panel panel-warning">
					<div class="panel-body alert-warning">
						Revisar correo
					</div>
					<div class="panel-footer">
						<?php 
							echo $this->session->flashdata("revisar_correo");
							echo $this->session->flashdata("btn-reenviar");
							echo $this->session->flashdata("btn-cambiar-correo");
						?>
					</div>
				</div>
			</div>
		<?php endif; ?>						
		<div class="row">
		<?php foreach ($viajes as $index => $viaje): ?>
			<?php if (($index % 3) == 0): ?>
				</div>
				<div class="row">
			<?php endif; ?>
			<div class="col-md-4">
				<?php $this->load->view("viajes/viaje_card", array("viaje" => $viaje)) ?>
			</div>			
		<?php endforeach; ?>
	</div>
</div>