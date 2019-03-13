<?php 
	$data = array();
	if (isset($titulo))
		$data = array("titulo" => $titulo);
	$this->load->view("Global/header", $data);
	$noMargin = "";
	if ($this->session->userdata("login") == null)
		$noMargin = "style='margin-left: 0px !important;'";		
?>
<main class="content-wrapper" <?php echo $noMargin ?>>
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
</main>
<?php 
	$data = array();
	if (isset($scripts))
		$data = array('scripts' => $scripts);
	$this->load->view("Global/footer", $data);
?>