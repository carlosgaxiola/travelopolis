$(document).ready( function () {				
	var inicio, fin;
	$("#txtFecha").daterangepicker({
		locale: {
			format: "DD/MM/YYYY"
		}
	});

	$(".daterangepicker .fa-calendar").removeClass().addClass("fas fa-calendar");
	
	function actualizarFechas () {
		inicio = {
			string: $("#txtFecha").val().split(" ")[0]
		},
		fin = {
			string: $("#txtFecha").val().split(" ")[2]
		};
		inicio.array = inicio.string.split("/");
		inicio.dia = inicio.array[0];
		inicio.mes = inicio.array[1];
		inicio.año = inicio.array[2];
		fin.array = fin.string.split("/");
		fin.dia = fin.array[0];
		fin.mes = fin.array[1];
		fin.año = fin.array[2];
		inicio.moment = moment()
		inicio.moment.set({
			'date': inicio.dia,
			'month': inicio.mes - 1,
			'year': inicio.año
		})
		fin.moment = moment();
		fin.moment.set({
			'date': fin.dia,
			'month': fin.mes - 1,
			'year': fin.año
		})
	}

	actualizarFechas()
	$("#txtFecha").change( function () {
		actualizarFechas()
		$("#txtFechaInicio").val(inicio.string)
		$("#txtFechaFin").val(fin.string)		
		let noches = fin.moment.diff(inicio.moment, 'days');
		$("#txtDias").val(noches + 1).data("dias", noches + 1)
		$("#txtNoches").val(noches).data("noches", noches)
	})
	
	//Necesarias
	$("#btn-save").click( function () {
		// console.log(getFormLog());
		if ($("#tblDias tbody tr").length == 0) {
			BootstrapDialog.alert({
				title: "Registra un día",
				message: "Debe registrar al menos un 1 del viaje",
				type: BootstrapDialog.TYPE_WARNING,
				size: BootstrapDialog.SIZE_SMALL
			})
		}
		else {
			if ($("#idViaje").val() === "") {
				add( function () {
					BootstrapDialog.alert({
						title: "Viaje registrado",
						message: "Se registro el viaje correctamente",
						type: BootstrapDialog.TYPE_SUCCESS,					
					});
					toggleMain();
					$("#msg-error").hide();
				})
			}
			else {
				edit( function () {				
					toggleMain();
					$("#msg-error").hide();
					tabla.draw()
				});
			}	
		}
	})

	function add ( callback ) {
		let viaje = getFormLog()
		$.ajax({
			url: base_url + "admin/viajes/add",
			type: "POST",
			data: {
				viaje: viaje
			},
			success: function ( res ) {
				try {
					if ( !isNaN( parseInt( res ) ) ) {
						switch ( res ) {
							case 0:
								console.error( "Error::" + res )
								break
							default:
								viaje.idViaje = res;
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
			descripcion = $("#txtDescripcionDia").val(),
			fecha = inicio;	
		if (nombre != "" && descripcion != "") {
			let filas = $("#tblDias tbody tr").length;
				tr = "<tr></tr>", tdContador = "<td>" + (filas + 1) + "</td>",
				tdNombre = "<td>" + nombre + "</td>", tdDescripcion = "<td>" + descripcion+ "</td>",
				btnEliminar = 
					"<button type='button' class='btn btn-sm btn-danger btn-del-dia' title='Eliminar día'>" + 
						"<i class='fas fa-times'></i>" +
					"</button>",				
				tdEliminar = "<td>" + btnEliminar + "</td>";			
			if (filas >= 1) {
				fecha.moment.add(1, "d");
				tdFecha = "<td>" + fecha.moment.format("DD/MM/YYYY") + "</td>";				
			}
			else {
				tdFecha = "<td>" + fecha.moment.format("DD/MM/YYYY") + "</td>";				
			}
			if (filas == $("#txtDias").data("dias")) {
				BootstrapDialog.alert({
					title: "No puede ingresar más días",
					message: "Para ingresar más días debe cambiar el rango",
					size: BootstrapDialog.SIZE_SMALL
				})
			}
			else {
				$("#tblDias tbody")
				.append($(tr)
					.append($(tdContador))
					.append($(tdNombre))
					.append($(tdFecha))
					.append($(tdDescripcion))
					.append($(tdEliminar))
					.data("nombre", nombre).data("descripcion", descripcion).data("fecha", fecha.moment.format("DD/MM/YYYY"))
				)
			}			
		}
	})

	$("#tblDias").delegate(".btn-del-dia", "click", function () {
		$(this).parent().parent().remove();
		actualizarFechas();
		$.each($("#tblDias tbody tr"), function (index, tr) {
			$("td:eq(0)", tr).text(index + 1)
			let fecha = inicio;
			if (index == 0) 
				$("td:eq(2)", tr).text(fecha.moment.format("DD/MM/YYYY"))
			else {
				fecha.moment.add(1, "d")
				$("td:eq(2)", tr).text(fecha.moment.format("DD/MM/YYYY"))
			}

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
		$("#txtDiasDevolucion").val(viaje.devolucion)
		setTableDias(viaje);		
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
	viaje = {
		id: $tr.data("id"),
		nombre: $tr.children("td:eq(1)").data("nombre"),
		minimo: $tr.children("td:eq(4)").data("minimo"),
		maximo: $tr.children("td:eq(4)").data("maximo") ,
		descripcion: $tr.children("td:eq(1)").data("descripcion"),
		precio: $tr.children("td:eq(2)").data("precio") ,
		inicio: $tr.data("f-inicio"),
		fin: $tr.data("f-fin"),
		urlFoto: $tr.data("url-foto"),
		dias: $tr.children("td:eq(3)").data("dias"),
		noches: $tr.children("td:eq(3)").data("noches"),
		devolucion: $tr.children("td:eq(3)").data("devolucion")
	};
	return viaje;
}

function getFormLog (idViaje = 0) {
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
	};	
	let dias = [];
	$.each($("#tblDias tbody tr"), function (index, tr) {			
		dias.push({
			nombre: $(tr).data("nombre"),
			descripcion: $(tr).data("descripcion"),
			fecha: $(tr).data("fecha")			
		})
	})
	viaje.diasDescripcion = dias;
	return viaje;
}

function editTableLog (viaje) {
	let Break = {};
	try {		
		$.each($("#tblViajes tbody tr"), function (index, tr) {			
			if ($(tr).data("id") == viaje.id) {
				$("td:eq(1)", tr).text(viaje.nombre);
				$(tr).child("td:eq(1)").data("nombre", viaje.nombre);
				$(tr).child("td:eq(1)").data("descripcion", viaje.descripcion);
				$("td:eq(2)", tr).text(viaje.precio);
				$(tr).child("td:eq(3)").data("precio", viaje.precio);
				$("td:eq(3)", tr).text(viaje.dias);
				$(tr).child("td:eq(4)").data("dias", viaje.dias);
				$(tr).child("td:eq(4)").data("noches", viaje.noches);
				$(tr).child("td:eq(4)").data("devolucion", viaje.devolucion);
				$("td:eq(4)", tr).text(viaje.minimo + " - " + viaje.maximo);				
				$(tr).child("td:eq(4)").data("maximo", viaje.maximo);
				$(tr).child("td:eq(4)").data("minimo", viaje.minimo);
				$(tr).data("f-inicio", viaje.inicio);
				$(tr).data("f-fin", viaje.fin);				
				throw Break;
			}
		});
	} catch (e) {
		// console.error(e)
	}	
}

function addTableLog (viaje) {
	tabla.row.add([
		tabla.rows().count() + 1,
		viaje.nombre,
		viaje.precio,
		viaje.dias,
		viaje.minimo + " - " + viaje.maximo,		
		'<span class="label label-danger">Inactivo</span>',
		'<button type="button" class="btn btn-warning btn-edit-log" data-id="' + viaje.id + '" title="Editar registro"><i class="fas fa-edit"></i></button>&nbsp;' +
		'<button type="button" class="btn btn-danger btn-toggle-log" data-id="' + viaje.id  + '" title="Desactivar registro" data-status="1"><i class="fas fa-toggle-off"></i></button>'
	]).draw();	
	$("#tblViajes tbody tr:last").data("id", viaje.id);
	$("#tblViajes tbody tr:last").data("f-inicio", viaje.inicio);
	$("#tblViajes tbody tr:last").data("f-fin", viaje.fin);	
	$("#tblViajes tbody tr:last td:(1)").data("nombre", viaje.nombre);
	$("#tblViajes tbody tr:last td:(1)").data("descripcion", viaje.descripcion);
	$("#tblViajes tbody tr:last td:(2)").data("precio", viaje.precio);
	$("#tblViajes tbody tr:last td:(3)").data("dias", viaje.dias);
	$("#tblViajes tbody tr:last td:(3)").data("noches", viaje.noches);
	$("#tblViajes tbody tr:last td:(3)").data("devolucion", viaje.devolucion);
	$("#tblViajes tbody tr:last td:(4)").data("minimo", viaje.minimo);	
	$("#tblViajes tbody tr:last td:(4)").data("maximo", viaje.maximo);
	$("#tblViajes tbody tr:last").data("dias-descripcion", viaje.diasDescripcion);	
	clearFormData();
}

function clearFormData () {
	$("#txtNombre").val("")
	$("#txtMinimo").val("")
	$("#txtMaximo").val("")
	$("#txtPrecio").val("")
	let fechaHoy = moment(new Date());
	$("#txtFecha").val(fechaHoy.format("DD/MM/YYY") + " - " + fechaHoy.format("DD/MM/YYYY"))
	$("#tblDias").empty()
	$("#txtDescripcion").val("")
	$("#txtImagen").val("")
	$("#txtPreview").empty()
	$("#txtDias").val("1")
	$("#txtNoches").val("0")	
	$("#idViaje").val("")
}

function toggleLog (that) {
	let $tr = $(that).parent().parent(),
		nombre = $("td:eq(1)", $tr).text(),
		idGuia = $(that).data("id"),
		status = $(that).data("status"),
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

function setTableDias (viaje) {
	$.ajax({
		url: base_url + "admin/viajes/diasviaje",
		type: "POST",
		data: {
			idViaje: viaje.id
		},
		success: function (res) {
			try {
				res = JSON.parse(res);
				if (res) {
					$("#tblDias tbody").empty();
					let btnEliminarDia = "<button class='bnt bnt-sm bnt-danger btn-del-dia'><i class='fas fa-times'></i></button>";
					$.each(res, function (index, dia) {
						$("#tblDias tbody").append("<tr><td>" + (index + 1) + "</td><td>" + dia.nombre + "</td><td>" + dia.fecha + "</td><td>" + dia.descripcion + "</td><td>" + btnEliminarDia + "</td></tr>");
					})
				}
			} 
			catch ( e ) {
				console.error(e)
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.error("Error::" + errorThrown)
		}
	})
} 