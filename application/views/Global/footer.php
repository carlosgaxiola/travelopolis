	<?php 
		$noMargin = "style='margin-left: 0px;'";		
		if ($this->session->userdata("admin_active")) {		
			$noMargin = "";
		}
	?>
	<footer class="main-footer" <?php echo $noMargin ?>>
	    <div class="pull-right hidden-xs">
	      	<b>Version</b> 0.4
	    </div>
	    <strong>Copyright &copy; 2019 <a href="<?php echo base_url() ?>">Travelopolis</a>.</strong> All rights reserved.
	</footer>
</div>
<!-- ./wrapper -->
<!-- JQuery 3 -->
<script src="<?php echo base_url("assets/js/jquery-3.min.js")?>"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url("assets/js/bootstrap-3.min.js")?>"></script>
<!-- AdminLTE -->
<script src="<?php echo base_url("assets/js/adminlte.min.js") ?>"></script>
<!-- BootstrapDialog -->
<script src="<?php echo base_url("assets/js/bootstrap-dialog.min.js") ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url("assets/js/jquery.dataTables.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/dataTables.bootstrap.min.js") ?>"></script>
<!-- Travelopolis -->
<script>
	var tabla, base_url;

	function fechaJS($fecha) {
		return $fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
	}
		
	function getDate () {
		let fecha = new Date();				
		dia = fecha.getDate();
		mes = fecha.getMonth() + 1;
		año = fecha.getFullYear();
		dia = dia < 10? "0" + dia: dia;
		mes = mes < 10? "0" + mes: mes;				
		return dia + "/" + mes + "/" + año;			
	}

	$(document).ready( function () {
		base_url = '<?php echo base_url() ?>';
		tabla = $("table[data-table]").DataTable({
		    'paging'			: true,
		    'lengthChange' 		: false,
		    'searching'    		: true,
		    'ordering'     		: true,
		    'info'         		: true,
		    'scrollx'      		:true,
		    'autoWidth'    		: false,
		    'destroy'      		: true,
		    "iDisplayLength"	: 10,
		    "language"     : {  
		    	"url": '<?php echo base_url('assets/files/datatables/spanish.json')?>'  
		    }			     	
		})	

		$(".sidebar-toggle").click (function () {
			setTimeout( function () {
				if ($("body").hasClass("sidebar-collapse"))
					$.each($(".main-sidebar a .no-icon"), function (index, icon) {
						$(icon).show()
					})
				else
					$.each($(".main-sidebar a .no-icon"), function (index, icon) {
						$(icon).hide()
					})
			}, 500)
		})

		$(".btn-logout").click( function (e) {
			e.preventDefault();
			console.log("hola")
			BootstrapDialog.confirm({
				title: "Cerrar Sesión",
				message: "¿Confirmar cerrar sesión?",
				btnOKLabel: "Sí",
				btnOKClass: "btn-primary",
				btnCancelLabel: "No",
				callback: function (res) {
					if (res)
						window.location.href = base_url + "inicio/logout"				
				}
			})
		})		
	})
	var tablaId = $(".table").prop("id");
</script>
<!-- App -->
<?php if ($this->session->userdata("admin_active")): ?>
	<script src="<?php echo base_url("assets/js/app/listar.js") ?>"></script>
<?php endif; ?>
<?php if (isset($scripts) and is_array($scripts)): ?>
	<?php foreach ($scripts as $script): ?>
		<script src="<?php echo base_url("assets/js/".$script.".js") ?>"></script>
	<?php endforeach; ?>
<?php endif; ?>
<?php if (isset($modulo)): ?>
	<?php if (strcmp($modulo['nombre'], "Inicio Administrador") != 0): ?>
		<script src="<?php echo base_url("assets/js/app/".lcfirst($modulo['nombre'])).".js" ?>"></script>
		<script src="<?php echo base_url("assets/js/app/validaciones.js") ?>"></script>
	<?php endif; ?>
<?php endif; ?>
</body>
</html>