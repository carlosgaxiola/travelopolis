$(document).ready( function () {				

	$("#txtFecha").daterangepicker({
		locale: {
			format: "DD/MM/YYYY"
		}
	});

	$("#txtImagen").change(function () {
	    filePreview(this);
	    console.log("hola")
	});

	$(".daterangepicker .fa-calendar").removeClass().addClass("fas fa-calendar");

	$("#txtFecha").change( function () {
		let inicio = {
			string: $(this).val().split(" ")[0]			
		};
		inicio.array = inicio.string.split("/");
		inicio.dia = inicio.array[0];
		inicio.mes = inicio.array[1];
		inicio.año = inicio.array[2];
		let fin = {
			string: $(this).val().split(" ")[2]			
		};
		fin.array = fin.string.split("/");
		fin.dia = fin.array[0];
		fin.mes = fin.array[1];
		fin.año = fin.array[2];
		$("#txtFechaInicio").val(inicio.string)
		$("#txtFechaFin").val(fin.string)
		inicio.moment = moment()
		inicio.moment.set({
			'date': inicio.dia,
			'month': inicio.mes,
			'year': inicio.año
		})
		fin.moment = moment();
		fin.moment.set({
			'date': fin.dia,
			'month': fin.mes,
			'year': fin.año
		})
		let dias = fin.moment.diff(inicio.moment, 'days');
		$("#txtDias").val(dias)
		$("#txtNoches").val(dias - 1)
	})
	
	//Necesarias
	$("#btn-save").click( function () {
		console.log(getFormLog());
		// if ($("#idViaje").val() === "") {
		// 	add( function () {
		// 		BootstrapDialog.alert({
		// 			title: "Viaje registrado",
		// 			message: "Se registro el viaje correctamente",
		// 			type: BootstrapDialog.TYPE_SUCCESS,					
		// 		});
		// 		toggleMain();
		// 		$("#msg-error").hide();
		// 	})
		// }
		// else {
		// 	edit( function () {				
		// 		toggleMain();
		// 		$("#msg-error").hide();
		// 		tabla.draw()
		// 	});
		// }
	})

	function add ( callback ) {
		$.ajax({
			url: base_url + "admin/viajes/add",
			type: "POST",
			data: $("#frmViaje").serialize() + "&fecha=" + getDate(),
			success: function ( res ) {
				try {
					if ( !isNaN( parseInt( res ) ) ) {
						switch ( res ) {
							case 0:
								console.error( "Error::" + res )
								break
							default:
								let viaje = getFormLog( res )
								addTableLog ( viaje )
								callback()
								break
						}
					} else {
						$("#msg-error").show()
						$("#list-error").html(res)
					}
				} catch ( e ) {
					console.error( e )
				}				
			},
			error: function ( jqXHR, textStatus, errorThrown ) {
				console.error("Error::" + errorThrown)
			}
		})
	}

	function edit ( callback ) {
		$.ajax({
			url: base_url + "admin/viajes/edit",
			type: "POST",
			data: $("#frmViaje").serialize(),
			success: function (res) {				
				try  {					
					if (!isNaN(parseInt(res)))
						switch (res) {
							case 0:
								console.error("error: "  + res);
								break
							default:
								let viaje = getFormLog(res);								
								editTableLog(guia);
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

	$("#txtFechaInicio").val($("#txtFecha").val().split(" ")[0])
	$("#txtDias").val("1");
	$("#txtFechaFin").val($("#txtFecha").val().split(" ")[2])
	$("#txtNoches").val("1");
	
	$("#btn-add-dia").click( function () {
		let nombre = $("#txtNombreDia").val(),
			descripcion = $("#txtDescripcionDia").val();
		if (nombre != "" && descripcion != "") {
			let filas = $("#tblDias tbody tr").length + 1,
				tr = "<tr></tr>", tdContador = "<td>" + filas + "</td>",
				tdNombre = "<td>" + nombre + "</td>", tdDescripcion = "<td>" + descripcion+ "</td>",
				btnEliminar = 
					"<button type='button' class='btn btn-sm btn-danger btn-del-dia' title='Eliminar día'>" + 
						"<i class='fas fa-times'></i>" +
					"</button>",
				tdEliminar = "<td>" + btnEliminar + "</td>";
			$("#tblDias tbody")
				.append($(tr)
					.append($(tdContador))
					.append($(tdNombre))
					.append($(tdDescripcion))
					.append($(tdEliminar))
					.data("nombre", nombre).data("descripcion", descripcion)
				)
		}
	})

	$("#tblDias").delegate(".btn-del-dia", "click", function () {
		$(this).parent().parent().remove();
		$.each($("#tblDias tbody tr"), function (index, tr) {
			$("td:eq(0)", tr).text(index + 1)
		})
	})
});

//Genericas
function setFormLog (viaje) {
	if (viaje != null && viaje != undefined) {
		$("#idViaje").val(viaje.id)
		$("#txtNombre").val(viaje.nombre)
		$("#txtDescripcion").val(viaje.descripcion)
		$("#txtMinimo").val(viaje.minimo)
		$("#txtMaximo").val(viaje.maximo)
		$("#txtPrecio").val(viaje.precio)	
		return true;
	}
	else {
		BootstrapDialog.alert({
			title: "Error",
			message: "El guia que desea editar no existe",
			type: BootstrapDialog.TYPE_DANGER,
			size: BootstrapDialog.SIZE_DANGER				
		})
		return false;
	}
}

function getTableLog (that) {
	let $tr = $(that).parent().parent();	
	guia = {
		id: $tr.data("id"),
		nombre: tabla.row($tr).data()[1],
		aPaterno: tabla.row($tr).data()[2].split(" ")[0],
		aMaterno: tabla.row($tr).data()[2].split(" ")[1],
		telefono: tabla.row($tr).data()[3],
		correo: tabla.row($tr).data()[4],
		rfc: $tr.data("rfc"),
		nss: $tr.data("nss"),
		usuario: $tr.data("usuario")
	};
	return guia;
}

function getFormLog (idViaje) {
	viaje = {
		id: idViaje,		
		nombre: $("#txtNombre").val(),
		descripcion: $("#txtDescripcion").val(),
		minimo: $("#txtMinimo").val(),
		maximo: $("#txtMaximo").val(),
		precio: $("#txtPrecio").val(),
		inicio: $("#txtFechaInicio").val(),
		fin: $("#txtFechaFin").val(),
		dias: $("#txtDias").val(),
		noches: $("#txtNoches").val(),
		diasDevolucion: $("#txtDiasDevolucion").val(),
		foto: $("#txtImagen").val(),		
	};	
	let dias = [];
	$.each($("#tblDias tbody tr"), function (index, tr) {			
		dias.push({
			nombre: $(tr).data("nombre"),
			descripcion: $(tr).data("descripcion")
		})
	})
	viaje.dias = dias;
	return viaje;
}

function editTableLog (viaje) {
	let Break = {};
	try {		
		$.each($("#tblViajes tbody tr"), function (index, tr) {			
			if ($(tr).data("id") == viaje.id) {
				$("td:eq(1)", tr).text(viaje.nombre);
				tabla.row(tr).data()[1] = viaje.nombre;				
				$("td:eq(2)", tr).text(viaje.precio);
				tabla.row(tr).data()[2] = viaje.precio;
				$("td:eq(3)", tr).text(viaje.dias);
				tabla.row(tr).data()[3] = viaje.dias;
				$("td:eq(4)", tr).text(viaje.minimo + " - " + viaje.maximo);
				tabla.row(tr).data()[4] = viaje.minimo + " - " + viaje.maximo;
				$(tr).data("descripcion", viaje.descripcion);
				$(tr).data("inicio", viaje.inicio);
				$(tr).data("fin", viaje.fin);
				$(tr).data("dias", viaje.dias);
				$(tr).data("noches", viaje.noches);
				$(tr).data("diasDevolucion", viaje.diasDevolucion);
				$(tr).data("")
				throw Break;
			}
		});
	} catch (e) {
		// console.error(e)
	}	
}

function addTableLog (guia) {
	tabla.row.add([
		tabla.rows().count() + 1,
		guia.nombre,
		guia.aPaterno + " " + guia.aMaterno,
		guia.telefono,		
		guia.correo,		
		getDate(),
		'<label class="label label-success">Activo</label>',
		'<button type="button" class="btn btn-warning btn-edit-log" data-id="' + guia.id + '" title="Editar registro"><i class="fas fa-edit"></i></button>&nbsp;' +
		'<button type="button" class="btn btn-danger btn-toggle-log" data-id="' + guia.id  + '" title="Desactivar registro" data-status="1"><i class="fas fa-toggle-off"></i></button>'
	]).draw();	
	$("#tblGuias tbody tr:last").data("id", guia.id);
	$("#tblGuias tbody tr:last").data("nss", guia.nss);
	$("#tblGuias tbody tr:last").data("rfc", guia.rfc);
	$("#tblGuias tbody tr:last").data("usuario", guia.usuario);
	clearFormData();
}

function clearFormData () {
	$("#txtNombre").val("")
	$("#txtAPaterno").val("")
	$("#txtAMaterno").val("")
	$("#txtTelefono").val("")
	$("#txtCorreo").val("")
	$("#txtNSS").val("")
	$("#txtRFC").val("")
	$("#txtUsuario").val("")
	$("#txtContra").val("")
	$("#txtConfirmar").val("")
	$("#idGuia").val("")
}

function toggleLog (that) {
	let $tr = $(that).parent().parent(),
		nombre = $("td:eq(1)", $tr).text(),
		idGuia = $(that).data("id"),
		status = $(that).data("status")
		accion = 'dar de baja al guia',
		tipo = BootstrapDialog.TYPE_DANGER,
		okClass = "btn-danger",
		cancelClass = "btn-default";
	if (status == 0) {
		tipo = BootstrapDialog.TYPE_SUCCESS;
		okClass = "btn-success";
		cancelClass = "btn-default";
		accion = "dar de alta al guia";
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
					url: base_url + "admin/guias/toggle",
					type: "POST",
					data: {
						idGuia: idGuia,
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

function filePreview (input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#txtPreview').empty();
            $('#txtPreview').append('<img class="img-responsive img-thumbnail" src="'+e.target.result+'"/>');            
        }
        reader.readAsDataURL(input.files[0]);
    }
}