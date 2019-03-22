$(document).ready( function () {		
	
	//Especial
	initTabla();

	$("#cmbIcono").change( function () {
		if ($(this).val() === "0") {
			if ($("#txtNombre").val() !== "")
				$(".icon-target #icon").removeClass().text($("#txtNombre").val()[0]);
		}
		else
			$(".icon-target #icon").removeClass().addClass($("option:selected", this).val()).text("");
	})

	$("#txtNombre").keyup( function (e) {
		if ($("#cmbIcono").val() === "0" && $(this).val() !== "")
			$(".icon-target #icon").text($(this).val()[0]);
	})

	$("#btn-clear").click( function (e) {
		$(".icon-target #icon").removeClass().text("");
	})	

	//Generico
	$("#btn-save").click( function () {		
		edit( function () {
			toggleMain();
			$("#msg-error").hide();
			tabla.draw()
		});		
	})

	function edit (callback) {
		$.ajax({
			url: base_url + "admin/modulos/edit",
			type: "POST",
			data: $("#frmModulo").serialize(),
			success: function (res) {				
				try  {					
					if (!isNaN(parseInt(res)))
						switch (res) {
							case 0:
								console.error("error: "  + res);
								break
							default:
								let modulo = getFormLog(res);
								editTableLog(modulo);
								callback();
								break
						}
					else {
						$("#msg-error").show();
						$("#list-error").html(res);
					}
				}
				catch (e) {
					console.error(e);
				}				
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.error("Error::" + errorThrown);
			}
		})
	}
});

//Generico
function setFormLog (modulo) {	
	if (modulo != null && modulo != undefined) {
		$("#idModulo").val(modulo.id);
		$("#txtNombre").val(modulo.nombre);
		$("#txtRuta").val(modulo.ruta);
		$("#cmbIcono").val(modulo.iconoClass);
		if (modulo.iconoClass === "0")
			$(".icon-target #icon").text(modulo.nombre[0]).removeClass();
		else
			$(".icon-target #icon").text("").addClass(modulo.iconoClass);		
		$("#txtDescripcion").val(modulo.descripcion);
		return true;
	}
	else {
		BootstrapDialog.alert({
			title: "Error",
			message: "El modulo que desea editar no existe",
			type: BootstrapDialog.TYPE_DANGER,
			size: BootstrapDialog.SIZE_DANGER				
		})
		return false;
	}
}

function getTableLog (that) {
	let $tr = $(that).parent().parent();
	modulo =  {
		id: $(that).data("id"),
		nombre: tabla.row($tr).data()[1],
		descripcion: tabla.row($tr).data()[2],
		ruta: tabla.row($tr).data()[3],
		iconoClass: tabla.row($tr).data()[4]		
	};
	return modulo;
}

function getFormLog (idModulo) {
	modulo = {
		id: idModulo,
		nombre: $("#txtNombre").val(),
		descripcion: $("#txtDescripcion").val(),
		ruta: $("#txtRuta").val(),
		iconoClass: $("#cmbIcono").val()
	}	
	return modulo;
}

function editTableLog (modulo) {	
	let Break = {};
	try {		
		$.each($("#tblModulos tbody tr"), function (index, tr) {			
			if ($(tr).data("id") == modulo.id) {
				$("td:eq(1)", tr).text(modulo.nombre);
				tabla.row(tr).data()[1] = modulo.nombre;
				$("td:eq(2)", tr).text(modulo.descripcion);
				tabla.row(tr).data()[2] = modulo.descripcion;
				$("td:eq(3)", tr).text(modulo.ruta);
				tabla.row(tr).data()[3] = modulo.ruta;
				tabla.row(tr).data()[4] = modulo.iconoClass;				
				throw Break;
			}
		})		
	} catch (e) {
		// console.error(e)
	}	
}

function toggleLog (that) {
	let $tr = $(that).parent().parent(),
		nombre = $("td:eq(1)", $tr).text(),
		idModulo = $(that).data("id"),
		status = $(that).data("status")
		accion = 'desactivar el modulo',
		tipo = BootstrapDialog.TYPE_DANGER,
		okClass = "btn-danger",
		cancelClass = "btn-default";
	if (status == 0) {
		tipo = BootstrapDialog.TYPE_SUCCESS;
		okClass = "btn-success";
		cancelClass = "btn-default";
		accion = "activar el modulo";
	}		
	BootstrapDialog.confirm({
		title: "Cambiar estado",
		message: "¿Desea " + accion + " de " + nombre + "?",
		type: tipo,
		size: BootstrapDialog.SIZE_SMALL,
		btnOKLabel: "Sí",
		btnOKClass: okClass,
		btnCancelLabel: "No",
		btnCancelClass: cancelClass,
		callback: function (res) {
			if (res) {
				$.ajax({
					url: base_url + "administrar/modulos/toggle",
					type: "POST",
					data: {
						idModulo: idModulo,
						status: status
					},
					success: function (res) {						
						try {
							res = JSON.parse(res);
							let iconClass = "fas fa-toggle-off",
								labelClass = "label label-success",
								labelText = "Activo",
								btnTitle = "Desactivar registro";
							if (res) {
								if (status == 1) {
									labelClass = "label label-danger";
									labelText = "Inactivo";
									iconClass = "fas fa-toggle-on";
									btnTitle = "Activar registro";
								}
								$(that).data("status", status? 0 : 1);
							}							
							$(".btn-toggle-log", $tr).prop("title", btnTitle);
							$("label", $tr).removeClass().addClass(labelClass).text(labelText);
							$(".btn-toggle-log i", $tr).removeClass().addClass(iconClass);
						} catch (e) {
							console.error(e);
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.error("Error::" + errorThrown);
					}
				});
			}
		}
	});
}

function clearFormData () {
	$("#txtNombre").val("");
	$("#txtDescripcion").val("");	
	$("#txtRuta").val("");
	$("#cmbPadre").val("0");
	$("#cmbIcono").val("0");
	$(".icon-target #icon").text("");
	$("#idModulo").val("");
}

//Especial
function initTabla () {
	$.each($("#tblModulos tbody tr"), function (index, tr) {	
		let tdIcon =  $("td:eq(4)", tr);
		if (tabla.cell(tdIcon).data() == "0")
			tdIcon.empty().append("<i class='fas'>" + $("td:eq(1)", tr).text()[0] + "</i>");
		else
			tdIcon.empty().append("<i class='" + tabla.cell(tdIcon).data() + "'></i>");		
	});
}