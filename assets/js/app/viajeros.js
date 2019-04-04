$(document).ready( function () {	

	init()

	//Necesarias
	$("#btn-save").click( function () {
		if ($("#idViajero").val() === "") {
			add( function () {
				BootstrapDialog.alert({
					title: "Viajero registrado",
					message: "Se registro el viajero correctamente." +
						"<br>Recuerde revisar el correo de confirmación.",
					type: BootstrapDialog.TYPE_SUCCESS,
					size: BootstrapDialog.SIZE_SMALL
				});
				toggleMain()
				$("#msg-error").hide()
				$("#list-error").html("")
			})
		}
		else {
			edit( function () {				
				toggleMain()
				$("#msg-error").hide()
				$("#list-error").html("")
				tabla.draw()
			});
		}
	})

	function add ( callback ) {
		$.ajax({
			url: base_url + "admin/viajeros/add",
			data: getFormLog(),
			type: "POST",
			success: function (res) {
				try {
					if (!isNaN(parseInt(res))) {
						switch (parseInt(res)) {
							case 0:
								BootstrapDialog.alert({
									title: "Error",
									message: "Ocurrio un error desconocido",
									btnOKLabel: "Aceptar",
									type: BootstrapDialog.TYPE_DANGER,
									size: BootstrapDialog.SIZE_SMALL
								})
								break;
							default:
								let viajero = getFormLog(res)
								addTableLog(viajero)
								callback()
								break;
						}
					}
					else {
						$("#list-error").html(res)
						$("#msg-error").show()
					}
				}
				catch (e) {
					console.error(e)
				}
			}
		})
	}

	function edit ( callback ) {
		let viajero = getFormLog($("#idViajero").val())
		console.log(viajero)
		$.ajax({
			url: base_url + "admin/viajeros/edit",
			data: getFormLog($("#idViajero").val()),
			type: "POST",
			success: function (res) {
				try {
					if (!isNaN(parseInt(res))) {
						switch (parseInt(res)) {							
							case 0:
								BootstrapDialog.alert({
									title: "Error",
									message: "No se pudo editar el viajero",
									type: BootstrapDialog.TYPE_DANGER,
									size: BootstrapDialog.SIZE_SMALL,
									btnOKLabel: "Aceptar"
								})
								break;
							default:
								let viajero = getFormLog(res);
								editTableLog(viajero);
								callback();
								break;
						}
					}
					else {
						$("#list-error").html(res)
						$("#msg-error").show()
					}
				}
				catch (e) {
					console.error(e)
				}
			}
		})
	}	
})

function setFormLog (viajero) {
	$("#idViajero").val(viajero.id).data("viajero", viajero)
	$("#txtNombre").val(viajero.nombre)
	$("#txtAPaterno").val(viajero.paterno)
	$("#txtAMaterno").val(viajero.materno)
	$("#txtEdad").val(viajero.edad)
	$("#txtCorreo").val(viajero.correo)
	$("#txtSexo").val(viajero.sexo)
	$("#txtTelefono").val(viajero.telefono)
	$("#txtEstado").val(viajero.estado)
	$("#txtUsuario").val(viajero.usuario)
	$("#contra-group").hide()	
	$("#txtInformacion").val(viajero.informacion)	
}

function getFormLog (idViajero) {	
	let viajero = {
		id: idViajero,
		nombre: $("#txtNombre").val(),
		paterno: $("#txtAPaterno").val(),
		materno: $("#txtAMaterno").val(),
		edad: $("#txtEdad").val(),
		sexo: $("#txtSexo").val(),
		correo: $("#txtCorreo").val(),
		telefono: $("#txtTelefono").val(),
		estado: $("#txtEstado").val(),
		usuario: $("#txtUsuario").val(),
		contra: hex_sha1($("#txtContra").val()),
		confirmar: hex_sha1($("#txtConfirmar").val()),
		informacion: $("#txtInformacion").val(),		
		fecha: getDate()
	};	
	if ($("#idViajero").data("viajero"))
		viajero.status = $("#idViajero").data("viajero").status;
	return viajero;	
}

function getTableLog (that) {
	return $(that).parent().parent().data("viajero");
}

function addTableLog (viajero) {
	let fila = tabla.row.add([
		tabla.rows().count(),
		viajero.nombre + " " + viajero.paterno,
		viajero.sexo,
		viajero.edad,
		viajero.telefono,
		viajero.correo,
		"<span class='label label-success'>Activo</span>",
		"<button type='button' class='btn bnt-warning btm-edit-log' data-id='" + viajero.id + "'><i class='fas fa-edit'></i></button>" +
		"<button type='button' class='btn bnt-warning btn-toggle-status' data-id='" + viajero.id + "' data-status='1'><i class='fas fa-toggle-off'></i></button>"
	]).draw();
	$(fila).data("viajero", viajero);	
}

function editTableLog (viajero) {
	let filas = tabla.rows().nodes(),
		$tr = $(filas).find("[data-id='" + viajero.id + "']").parent().parent();
	$tr.find("td:eq(1)").text(viajero.nombre + " " + viajero.paterno)
	$tr.find("td:eq(2)").text(viajero.sexo)
	$tr.find("td:eq(3)").text(viajero.edad)
	$tr.find("td:eq(4)").text(viajero.telefono)
	$tr.find("td:eq(5)").text(viajero.correo)
	$tr.data("viajero", viajero);
}

function clearFormData () {
	$("#txtNombre").val("")
	$("#txtAPaterno").val("")
	$("#txtAMaterno").val("")
	$("#txtEdad").val("")
	$("#txtSexo").val("Hombre")
	$("#txtCorreo").val("")
	$("#txtTelefono").val("")
	$("#txtEstado").val("0")
	$("#txtConfirmar").val("")	
	$("#txtContra").val("")	
	$("#txtInformacion").val("")
	$("#txtUsuario").val()
	$("#idViajero").val("")
	$("#list-error").html("")
	$("#msg-error").hide()
	$("#contra-group").show()	
}

function init () {
	$.ajax({
		url: base_url + "admin/viajeros/data",
		success: function (data) {
			let filas = tabla.rows().nodes();
			$.each(JSON.parse(data), function (index, viajero) {
				$(filas).find("[data-id='" + viajero.id + "']").parent().parent().data("viajero", viajero);
			})
		}
	})
}

function toggleLog (that) {
	console.log($(that).parent().parent().data("viajero"))
	let $tr = $(that).parent().parent(),
		nombre = $("td:eq(1)", $tr).text(),
		idViajero = $tr.data("viajero").id,
		status = $tr.data("viajero").status
		accion = 'dar de baja al viajero',
		tipo = BootstrapDialog.TYPE_DANGER,
		okClass = "btn-danger",
		cancelClass = "btn-default";
	if (status == 0) {
		tipo = BootstrapDialog.TYPE_SUCCESS;
		okClass = "btn-success";
		cancelClass = "btn-default";
		accion = "dar de alta al viajero";
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
					url: base_url + "admin/viajeros/toggle",
					type: "POST",
					data: {
						idViajero: idViajero,
						status: status
					},
					success: function (res) {						
						try {
							res = JSON.parse(res);
							let iconClass = "fas fa-toggle-off",
								labelClass = "label label-success",
								labelText = "Activo",
								btnTitle = "Baja al viajero";								
							if (res) {

								if (status == 1) {
									labelClass = "label label-danger";
									labelText = "Inactivo";
									iconClass = "fas fa-toggle-on";
									btnTitle = "Alta al viajero";
									btnClass = "btn-success";
									$(".btn-toggle-log", $tr).removeClass("btn-danger").addClass("btn-success");
								}
								else if (status == 0)
									$(".btn-toggle-log", $tr).removeClass("btn-success").addClass("btn-danger");
								$(that).data("status", status? 0 : 1);
							}							
							$(".btn-toggle-log", $tr).prop("title", btnTitle);
							$("span", $tr).removeClass().addClass(labelClass).text(labelText);
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