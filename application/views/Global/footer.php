</div>
<!-- ./wrapper -->

<script>
	var base_url = "<?php echo base_url() ?>";
</script>
<!-- JQuery 3 -->
<script src="<?php echo base_url("assets/js/jquery/jquery-3.min.js")?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url("assets/js/bootstrap/bootstrap-4.min.js")?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url("assets/js/app/plantilla.min.js") ?>"></script>
<!-- Ajuste -->
<script>
	$(document).ready( function () {				
		if ($("aside").length == 0) {			
			$("main").addClass("no-margin-left")			
			$("nav").addClass("no-margin-left")		
		}
	})
</script>
</body>
</html>