<?php $this->load->view("Global/header", array("titulo" => "Inicio")) ?>
<div class="content-wrapper" style="margin-left: 0px; margin-bottom: 1%">
	<div class="content">		
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
<?php $this->load->view("Global/footer") ?>