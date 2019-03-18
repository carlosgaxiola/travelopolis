<?php 
	$data = array();
	if (isset($titulo))
		$data = array("titulo" => $titulo);
	$this->load->view("Global/header", $data);
	$noMargin = "";
	$userLogin = $this->session->userdata("id_perfil") == 3 || $this->session->userdata("id_perfil") == 5;
	if (!$userLogin)
		$this->load->view("Global/aside", array("actual" => $actual));	
?>
<?php if (!$userLogin): ?>
	<main class="content-wrapper">
<?php endif; ?>
	<?php
		if (isset($contenidos))	{
			if (count($contenidos) > 2) {
				foreach ($contenidos as $index => $con) {
					if ($index == 0) {
						echo "<div class='content' id='".$con['id']."'>";
						$this->load->view($con['url']."_vista");
						echo "</div>";
					}
					else {
						echo "<div class='content' id='".$con['id']."' hidden>";
						$this->load->view($con['url']."_vista");
						echo "</div>";	
					}
				}
			}
			else {
				echo "<div class='content' id='".$contenidos['id']."'>";
				$this->load->view($contenidos['url']."_vista");
				echo "</div>";
			}
		}		
	?>
<?php if (!$userLogin): ?>
	</main>
<?php endif; ?>
<?php 
	$data = array();
	if (isset($scripts))
		$data = array('scripts' => $scripts);
	$this->load->view("Global/footer", $data);
?>