$(document).ready( function () {
	$("#tblAsignar").delegate(".btn-asignar", "click", function () {
		let $tr = $(this).parent().parent();
		accion($tr, asignar)
	})

	$("#tblAsignar").delegate(".btn-cambiar", "click", function () {
		let $tr = $(this).parent().parent();
		accion($tr, cambiar)
	})

	init()
})

function init () {
	$.ajax({
		url: base_url + "admin/viajes/data",
		success: function (res) {
			try {
				let filas = tabla.rows().nodes();
				$.each(JSON.parse(res), function (index, data) {
					let viaje = {
						id: data.id,
						nombre: data.nombre,
						descripcion: data.descripcion,
						minimo: data.minimo,
						maximo: data.maximo,
						precio: data.precio,
						dias: data.dias_duracion,
						noches: data.noches_duracion,
						devolucion: data.dias_espera_devolucion,
						inicio: moment(data.f_inicio).format("DD/MM/YYYY"),
						fin: moment(data.f_fin).format("DD/MM/YYYY"),
						tipo: data.id_tipo_viaje,
						diasDescripcion: '',
						status: data.status
					};
					$(filas).find("[data-id='" + data.id + "']").parent().data("viaje", viaje);
				})
			}
			catch (e) {
				console.error(e)
			}
		}
	})
}

function accion ($tr, callback) {
	let viaje = $tr.data("viaje");
	BootstrapDialog.show({
		title: "Asignar guia",
		message: function (dialog) {
			return $("#asignar").tmpl();
		},
		buttons: [
			{
				label: "Asignar",
				cssClass: "btn-primary",
				action: function (dialog) {
					callback($("#cmbGuias").val(), viaje, $tr, function () {
						dialog.close()
					})
				}
			},
			{
				label: "Cerrar",
				action: function (dialog) {
					dialog.close()
				}
			}
		],
		draggable: true
	})
}

function asignar (idGuia, viaje, $tr, callback) {
	$.ajax({
		url: base_url + "admin/asignar/asignar_guia",
		data:{
			idGuia: idGuia,
			idViaje: viaje.id
		},
		type: "POST",
		success: function (response) {
			try {
				response = JSON.parse(response);
				switch (response.result) {
					case "error":
						errorDialog()
						break;					
					case "no disponible":
						$("#error-asignar").html(response.message).show()
						break;
					case "asignado":
						$tr.find(".btn-asignar").remove()
						$("td:eq(6)", $tr).append("<button type='button' title='Cambiar guia' class='btn btn-sm btn-warning btn-cambiar'>Cambiar guia</button>")
						$tr.find(".label").removeClass("label-defualt").addClass("label-primary").text("Asignado")
						cambiarNombre(idGuia, $tr)
						callback()
						break;
				}
			}
			catch ( e ) {
				$("#error-asignar").html(response).show()
			}
		}
	})
}

function cambiar (idGuia, viaje, $tr, callback) {
	$.ajax({
		url: base_url + "admin/asignar/cambiar_guia",
		data:{
			idGuia: idGuia,
			idViaje: viaje.id
		},
		type: "POST",
		success: function (response) {
			try {
				response = JSON.parse(response);
				switch (response.result) {						
					case "error":
						errorDialog()
						break;
					case "no disponible":						
						$("#error-asignar").html(response.message).show()
						break;
					case "cambiado":
						cambiarNombre(idGuia, $tr)
						callback()
						break;
				}
			}
			catch ( e ) {
				console.error(e)
				$("#error-asignar").html(response).show()
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

function cambiarNombre (idGuia, $tr) {
	$.ajax({
		url: base_url + "admin/asignar/guia/" + idGuia,
		success: function (res) {
			res = JSON.parse(res)
			if (res) {
				$("td:eq(4)", $tr).text(res.nombre + " " + res.a_paterno + " " + res.a_materno);
			}
		}
	})
}