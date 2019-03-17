<?php $this->load->view("Global/header") ?>
<main class="content">
	<?php 
		$this->load->view("Viajes/viaje_card_horizontal", array("viaje" => $viaje) );
		$this->load->view("Viajes/viaje_detalle", array("viaje" => $viaje));
		if (isset($dias))
			$this->load->view("Viajes/viaje_dias_detalle", array("dias" => $dias));
	?>
</main>
<?php $this->load->view("Global/footer") ?>