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

	function getDate () {
		let fecha = new Date();				
		dia = fecha.getDate();
		mes = fecha.getMonth() + 1;
		año = fecha.getFullYear();
		dia = dia < 10? "0" + dia: dia;
		mes = mes < 10? "0" + mes: mes;				
		return dia + "/" + mes + "/" + año;			
	}

	function logout () {
		console.log("hola")
		return false;
	}

	$(document).ready( function () {
		base_url = '<?php echo base_url() ?>';
		tabla = $(".table").DataTable({
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
</script>
<!-- App -->
<?php if (isset($scripts)): ?>
	<?php if (is_array($scripts)): ?>			
		<?php foreach ($scripts as $script): ?>
			<script src="<?php echo base_url("assets/js/".$script.".js") ?>"></script>
		<?php endforeach; ?>
	<?php else: ?>
		<script src="<?php echo base_url("assets/js/".$scripts.".js") ?>"></script>
	<?php endif; ?>
<?php endif; ?>
</body>
</html>