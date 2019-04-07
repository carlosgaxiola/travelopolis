$(document).ready( function () {
	
	$("#tblDetViaje").delegate(".btn-abonar", "click", function () {
		let $btn = $(this), $tr = $btn.parent().parent(), detalle = $tr.data("detalle")			
		BootstrapDialog.show({
			title: "Abonar",
			message: function (dialog) {
				return $("#abono").tmpl();
			},
			buttons: [
				{
					label: "Abonar",
					cssClass: "btn-primary",
					action: function (dialog) {
						let cantidad = $("#txtAbono").val(),
							idViaje = $("#contenidoTabla").data("id-viaje"),
							idUsuario = detalle.id;
						abonar(cantidad, idViaje, idUsuario, 
							function (res) {
								switch (JSON.parse(res)) {
									case "liquidado":
										$tr.children("td:eq(6)").html("<span class='label label-success'>Pagado</span>");
										$tr.find(".btn-abonar").remove()
										$tr.find(".btn-cancelar").remove()
										detalle.status = '3';
										break;
									case "anticipo":
										$tr.children("td:eq(6)").html("<span class='label label-primary'>Anticipo dado</span>");
										detalle.status = '2';
										break;
								}
								detalle.resto -= cantidad
								$tr.children("td:eq(5)").text(detalle.resto)								
								$tr.data("detalle", detalle)
								dialog.close()
							},
							function (msg) {
								$("#error-abono").html(msg).show()
							}
						)
					}
				},
				{
					label: "Cancelar",
					action: function (dialog) {
						dialog.close();
					}
				}
			]
		})
	})

	$("#tblDetViaje").delegate(".btn-cancelar", "click", function () {
		let $btn = $(this), $tr = $btn.parent().parent(), detalle = $tr.data("detalle"), idViaje = $("#contenidoTabla").data("id-viaje");
		BootstrapDialog.show({
			title: "Cancelar viaje",
			message: function (dialog) {
				return $("#cancelar").tmpl();
			},
			type: BootstrapDialog.TYPE_DANGER,
			buttons: [
				{
					label: "Mandar cancelación",
					cssClass: "btn-danger",
					action: function (dialog) {
						cancelar(idViaje, detalle.id, $("#txtMotivo").val(),
							function () {
								$tr.find(".btn-abonar").remove()
								$tr.find(".btn-cancelar").remove()
								$tr.children("td:eq(6)")
									.empty()
									.append("<span class='label label-danger'>Cancelado</span>")
								$tr.children("td:eq(5)").text("0")
								dialog.close()
							},
							function (msg) {
								$("#error-cancelar").html(msg).show()
							}
						)
					}
				},
				{
					label: "Cerrar",
					action: function (dialog) {
						dialog.close()
					}				
				}
			]
		})
	})

	$("#tblDetViaje").delegate(".btn-ver", "click", function () {
		let $btn = $(this), 
			$tr = $btn.parent().parent(), 
			familiares = $tr.data("familiares"),
			viajero = $tr.data("detalle");
		if (!familiares)
			$("#acompañantesGroup").hide()
		else
			loadAcompañantes(familiares);
		setFormLog(viajero)
		toggleMain();
	})

	$("#tblDetViaje").delegate(".btn-enviar-cotizacion", "click", function () {
		let $tr = $(this).parent().parent(), detalle = $tr.data("detalle");		
		enviarCotizacion(detalle, $tr);	
	})

	$("#btn-enviar-cotizacion").click( function () {
		let detalle = $("#frmDatosViajero").data("detalle");
		let filas = tabla.rows().nodes();
		let $tr = $($(filas).find("[data-id='" + detalle.id + "']").parent());		
		enviarCotizacion(detalle, $tr, function () {
			toggleMain();
		});	
	})

	init();	
})

function init () {
	$.ajax({
		url: base_url + "admin/viajes/detalle",
		data: { idViaje: $("#contenidoTabla").data("id-viaje") },
		type: "POST",
		success: function (data) {
			try {
				data = JSON.parse(data)
				if (data) {
					let filas = tabla.rows().nodes();
					if (data.id)
						$(filas).find("[data-id='" + data.id + "']").parent().data("detalle", data);
					else
						$.each( data, function (index, detalle) {						
							$(filas).find("[data-id='" + detalle.id + "']").parent().data("detalle", detalle);
						})
				}
				else {
					//errorDialog()
				}
			}
			catch (e) {
				console.error(e)
			}
		}
	})
	$.ajax({
		url: base_url + "admin/viajes/familiares/" + $("#contenidoTabla").data("id-viaje"),		
		success: function (data) {			
			if (data != false) {
				let filas = tabla.rows().nodes();
				if (JSON.parse(data).id_viajero)
					$(filas).find("[data-id='" + data.id_viajero + "']").parent().data("familiares", JSON.parse(data).familiares);
				else
					$.each(JSON.parse(data), function (index, value) {
						$(filas).find("[data-id='" + value.id_viajero + "']").parent().data("familiares", value.familiares);
					})
			}
			else
				console.log("hola")
		}
	})	
}

function errorDialog (msg = "Ocurrio un error desconocido") {
	BootstrapDialog.alert({
		title: "Error",
		message: msg,
		type: BootstrapDialog.TYPE_DANGER,
		size: BootstrapDialog.SIZE_SMALL,
		btnOKLabel: "Aceptar"
	})
}

function abonar (cantidad, idViaje, idUsuario, resolve, reject) {
	$.ajax({
		url: base_url + "admin/viajes/abonar",
		data: {
			cantidad: cantidad,
			idViaje: idViaje,
			idUsuario: idUsuario
		},
		type: "POST",
		success: function ( res ) {
			try {
				switch (JSON.parse(res)) {
					case "error":
						errorDialog()
						break;
					default:
						resolve(res)
						break;
				}
			}
			catch ( e ) {
				reject(res)
			}
		}
	})
}

function cancelar (idViaje, idViajero, motivo, resolve, reject) {
	$.ajax({
		url: base_url + "admin/viajes/cancelar",
		type: "POST",
		data: {
			idViaje: idViaje,
			idViajero: idViajero,
			motivo: motivo
		},
		success: function (res) {
			try {
				if (isNaN(parseInt(res))) {
					reject(res)
				}
				else {
					switch (res) {
						case "0":
							errorDialog("No se pudo cancelar el viaje")
							break;
						default:
							resolve()
							break;
					}
				}
			}
			catch (e) {
				console.error(e)
			}
		}
	})
}

function clearFormData () {
	$("#txtNombre").val("")
	$("#txtAPaterno").val("")
	$("#txtAMaterno").val("")
	$("#txtSexo").val("")
	$("#txtEdad").val("")
	$("#txtTelefono").val("")
	$("#txtEstado").val("")
	$("#txtViaje").val("")
	$("#txtCantidad").val("")
	$("#txtResto").val("")
	$("#txtCompra").empty()
	$("#tblAcompañantesBody").empty()
	$("#acompañantesGroup").hide()
}

function loadAcompañantes (acomps) {
	$("#acompañantesGroup").show()
	$.each(acomps, function (index, acomp) {
		$("#tblAcompañantesBody")
			.append(
				"<tr><td>" + (index + 1) + "</td>" +
				"<td>" + acomp.nombre + "</td>" + 
				"<td>" + acomp.apellido_p + "</td>" + 
				"<td>" + acomp.apellido_m + "</td>" + 
				"<td>" + acomp.edad + "</td>" +
				"<td>" + acomp.telefono + "</td>" +
				"<td>" + acomp.tipo_familiar + "</td></tr>"
			)
	})
}

function setFormLog (viajero) {
	$("#frmDatosViajero").data("detalle", viajero)
	$("#txtNombre").val(viajero.nombre)
	$("#txtAPaterno").val(viajero.a_paterno)
	$("#txtAMaterno").val(viajero.a_materno)
	$("#txtSexo").val(viajero.sexo)
	$("#txtEdad").val(viajero.edad)
	$("#txtTelefono").val(viajero.telefono)
	$("#txtCorreo").val(viajero.correo)
	$("#txtViaje").val(viajero.viaje)
	$("#txtCantidad").val(viajero.cantidad)
	$("#txtResto").val(viajero.resto)
	$("#txtEstado").val(viajero.estado)
	switch (viajero.status) {
		case '1':
			$("#txtCompra").append("<span class='label label-warning'>Cotización enviada</span>");
			break;
		case '2':
			$("#txtCompra").append("<span class='label label-primary'>Anticipo pagado</span>");
			break;
		case '3':
			$("#txtCompra").append("<span class='label label-success'>Pagado</span>");
			break;
		case '4':
			$("#txtCompra").append("<span class='label label-default'>Solicitado</span>");
			$("#aceptarGroup").show();
			break;
		case '0':
			$("#txtCompra").append("<span class='label label-danger'>Cancelado</span>");
			break;
	}
}

function enviarCotizacion (detalle, $tr, callback ) {
	$.ajax({
		url: base_url + "admin/viajes/enviarCotizacion",
		data: { detalle: detalle },
		type: "POST",
		success: function ( res ) {
			try {
				res = JSON.parse(res);
				if (res['cotizacion'] && res['actualizado']) {
					detalle.status = '1';
					$("td:eq(7)", $tr).append("<button type='button' class='btn btn-success btn-abonar' title='Abonar'><i class='fas fa-money-bill-wave'></i></button>");
					$tr.find(".btn-enviar-cotizacion").remove();
					$tr.find(".label").removeClass("label-default").addClass("label-warning").text("Cotización enviada");
					BootstrapDialog.alert({
						title: "Cotización envia",
						message: "Se ha enviado por correo la cotización al viajero " + detalle.nombre,
						btnOKLabel: "Aceptar"
					})
					if (callback)
						callback();
					$tr.data("detalle", detalle);
				}
				else {
					errorDialog();
				}

			}
			catch ( e ) {
				console.error(e)
			}			
		}
	})
}
