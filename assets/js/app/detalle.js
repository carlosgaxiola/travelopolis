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
						let cantidad = $("#txtCantidad").val(),
							idViaje = $("#contenidoTabla").data("id-viaje"),
							idUsuario = detalle.id;
						abonar(cantidad, idViaje, idUsuario, 
							function () {
								detalle.resto -= cantidad
								$tr.children("td:eq(5)").text(detalle.resto)
								if (detalle.resto <= '0') {
									$tr.children("td:eq(6)").empty()
										.append("<span class='label label-success'>Pagado</span>")
									$tr.find(".btn-abonar").remove()
									$tr.find(".btn-cancelar").remove()
								}
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
					$.each( data, function (index, detalle) {
						$(filas).find("[data-id='" + detalle.id + "']").parent().data("detalle", detalle);
					})
				}
				else {
					errorDialog()
				}
			}
			catch (e) {
				console.error(e)
			}
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
				if (isNaN(parseInt(res)))
					reject(res)
				else
					resolve()
			}
			catch ( e ) {
				console.error(e)
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
