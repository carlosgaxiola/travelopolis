$(document).ready( function () {				
	var inicio, fin;
	$("#txtFecha").daterangepicker({
		locale: {
			format: "DD/MM/YYYY"
		},
		opens: 'right'
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
	$("#txtFecha").on("apply.daterangepicker", function () {
		actualizarFechas()		
		let fechaInicio = $("#txtFechaInicio").val(),
			fechaFin = $("#txtFechaFin").val();
		if ((fechaInicio != inicio.string || fechaFin != fin.string) && $("#tblDias tbody tr").length > 0) {
			BootstrapDialog.confirm({
				title: "Cambiar las fechas",
				message: "Al cambiar las fechas de inicio y fin se reiniciara la tabla de los dias<br>¿Desea continuar?",
				type: BootstrapDialog.TYPE_WARNING,
				btnOKLabel: "Sí",
				btnOKClass: "btn-danger",
				btnCancelLabel: "No",
				callback: function (res) {
					if (res) {
						$("#tblDias tbody").html("")
						$("#txtFechaInicio").val(inicio.string)
						$("#txtFechaFin").val(inicio.string)
						let noches = fin.moment.diff(inicio.moment, 'days');
						$("#txtDias").val(noches + 1).data("dias", noches + 1)
						$("#txtNoches").val(noches).data("noches", noches)
					}
					else {
						$("#txtFecha").data("daterangepicker").setStartDate(fechaInicio)
						$("#txtFecha").data("daterangepicker").setEndDate(fechaFin)
					}
				}
			})
		}			
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
				txtNombre: $("#txtNombre").val(),
				txtDescripcion: $("#txtDescripcion").val(),
				txtMinimo: $("#txtMinimo").val(),
				txtMaximo: $("#txtMaximo").val(),
				txtPrecio: $("#txtPrecio").val(),
				txtFechaInicio: $("#txtFechaInicio").val(),
				txtFechaFin: $("#txtFechaFin").val(),
				txtDias: $("#txtDias").val(),
				txtNoches: $("#txtNoches").val(),
				txtDiasDevolucion: $("#txtDiasDevolucion").val(),
				cmbTipoViaje: $("#cmbTipoViaje").val(),
				dias: getTableDias(),
				fecha: getDate()
			},			
			success: function ( res ) {
				try {
					if ( !isNaN( parseInt( res ) ) ) {
						switch ( res ) {
							case 0:
								console.error( "Error::" + res )
								break
							default:
								viaje.id = res;
								addTableLog(viaje);
								callback();
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
		let viaje = getFormLog()
		let data = {
			idViaje: $("#idViaje").val(),
			txtNombre: $("#txtNombre").val(),
			txtDescripcion: $("#txtDescripcion").val(),
			txtMinimo: $("#txtMinimo").val(),
			txtMaximo: $("#txtMaximo").val(),
			txtPrecio: $("#txtPrecio").val(),
			txtFechaInicio: $("#txtFechaInicio").val(),
			txtFechaFin: $("#txtFechaFin").val(),
			txtDias: $("#txtDias").val(),
			txtNoches: $("#txtNoches").val(),
			txtDiasDevolucion: $("#txtDiasDevolucion").val(),
			cmbTipoViaje: $("#cmbTipoViaje").val(),
			dias: getTableDias(),
			fecha: getDate()
		}
		$.ajax({
			url: base_url + "admin/viajes/edit",
			type: "POST",
			data: data,
			success: function (res) {
				console.log(data);
				try  {					
					if (!isNaN(parseInt(res)))
						switch (parseInt(res)) {
							case 0:
								console.error("error: "  + res);
								break
							default:
								viaje.id = res;		
								editTableLog(viaje);
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
	
	$("#tblViajes").delegate(".btn-abrir-registro", "click", function () {
		let $tr = $(this).parent().parent(),
			viaje = $tr.data("viaje"),
			dias = $tr.data("dias");		
		if (parseInt(viaje.dias) > parseInt(dias.length))
			BootstrapDialog.alert({
				title: "Viaje aun no esta completo",
				message: "Debe registrar todos los días del viaje para poder abrir el registro del vaije",
				type: BootstrapDialog.TYPE_WARNING				
			})
		else {
			BootstrapDialog.confirm({
				title: "Abrir viaje",
				message: "¿Confimar abrir viaje " + viaje.nombre + "?",
				btnOKLabel: "Sí",
				btnCancelLabel: "No",
				btnOKClass: "btn-primary",
				callback: function (res) {
					if (res) {
						$.ajax({
							url: base_url + "admin/viajes/abrir/" + $tr.data("id"),
							success: function (res) {
								try {					
									if (isNaN(parseInt(res))) {
										BootstrapDialog.alert({
											title: "Error.",
											message: "Ocurrio un error desconocido"
										})
									}
									else {
										switch (parseInt(res)) {
											case -1:
												break;
											case 0:
												let btn = $tr.find(".btn-abrir-registro");
												btn.removeClass("btn-abrir-registro btn-primary")
													.addClass("btn-cerrar-registro btn-success")
													.find("i").removeClass("fa-door-closed")
													.addClass("fa-door-opened")
												$tr.find("btn-edit-log").remove();
												break;
											case 1:
												BootstrapDialog.show({
													title: "Viaje abierto.",
													message: "Se habrio el registro para el viaje "	+ $tr.data("viaje").nombre,
													type: BootstrapDialog.TYPE_SUCCESS,
													size: BootstrapDialog.TYPE_SMALL
												});
												break;							
										}
									}
								}
								catch (e) {
									console.log(e)
								}				
							}
						})
					}
				}
			})			
		}		
	})
	
	$("#tblViajes").delegate(".btn-cerrar-registro", "click", function () {
		let $tr = $(this).parent().parent(),
			viaje = $tr.data("viaje"),
			dias = $tr.data("dias"),
			btn = this;		
		if (viaje && viaje.status == "1") {
			BootstrapDialog.confirm({
				message: "El viaje aun no cuenta con los suficientes viajeros, ¿Desae cerrar el registro?",
				title: "Pasar viaje a listo",
				type: BootstrapDialog.TYPE_WARNING,
				size: BootstrapDialog.SIZE_SMALL,
				btnOKClass: "btn-warning",
				btnOKLabel: "Sí",
				btnCancelLabel: "No",
				callback: function (ok) {
					if (ok) {
						$.ajax({
							url: base_url + "admin/viajes/cerrar/" + viaje.id,
							success: function (res) {
								if (res) {
									$(btn).removeClass("btn-cerrar-registro btn-success")
										.addClass("btn-empezar btn-default")
										.prop("title", "Empezar viaje")
										.find("i").removeClass("fa-door-open")
											.addClass("fa-check").parent().parent().parent()
										.find(".label")
											.removeClass("label-primary")
											.addClass("label-success")
											.text("Listo")
								}
							}
						})
					}
				}				
			})
		}
	})

	$("#tblViajes").delegate(".btn-empezar", "click", function () {
		let $tr = $(this).parent().parent(),
			btn = $(this),
			viaje = $tr.data("viaje"),
			dias = $tr.data("dias"),
			fechaInicio = {};
		fechaInicio.split = viaje.inicio.split("/");
		fechaInicio.moment = moment();		
		fechaInicio.moment.set({
			'date': fechaInicio.split[0],
			'month': fechaInicio.split[1] - 1,
			'year': fechaInicio.split[2]
		})		
		if (fechaInicio.moment.diff(moment(), 'days') !== 0) {
			BootstrapDialog.confirm({
				title: "Empezar viaje",
				message: "El viaje que desea empezar aun no esta en su fecha de inicio" +
					"<br>¿Desea iniciarlo de todas formas?",
				type: BootstrapDialog.TYPE_WARNING,
				btnOKLabel: "Sí",
				btnOKClass: "btn-danger",
				btnCancelLabel: "No",
				callback: function (ok) {
					if (ok) {
						empezar(viaje, btn, $tr);
					}
				}
			})
		}
		else {
			empezar(viaje, btn, $tr);
		}
	})
	
	$("#tblViajes").delegate(".btn-terminar", "click", function () {
		let $btn = $(this), $tr = $btn.parent().parent(),
			viaje = $tr.data("viaje"), fechaFin = {};
		fechaFin.split = viaje.fin.split("/");
		fechaFin.moment = moment();
		fechaFin.moment.set({
			'date': fechaFin.split[0],
			'month': fechaFin.split[1] - 1,
			'year': fechaFin.split[2]
		})
		if (fechaFin.moment.diff(moment(), 'days') !== 0) {
			BootstrapDialog.confirm({
				title: "Terminar viaje",
				message: "El viaje aun no esta en su fecha de final." + 
					"<br>¿Desea terminarlo?",
				type: BootstrapDialog.TYPE_WARNING,
				btnOKLabel: "Sí",
				btnOKClass: "btn-danger",
				btnCancelLabel: "No",
				callback: function (ok) {
					if (ok) {
						terminar(viaje, $btn, $tr);
					}
				}
			})
		}
		else {
			terminar(viaje, $btn, $tr);
		}
	})

	$("#tblViajes").delegate(".btn-ver", "click", function () {		
		let $btn = $(this),
			$tr = $btn.parent().parent(),
			viaje = $tr.data("viaje"),
			dias = $tr.data("dias");
		$("#btnGroup").hide()
		viaje.diasDescripcion = dias;
		setFormLog(viaje)
		toggleMain()
	})

	$("#tblViajes").delegate(".btn-detalle", "click", function () {
		window.location.href = base_url + "admin/viajes/ver?viaje=" + $(this).parent().parent().data("viaje").nombre.split(" ").join("+");
	})

	init()
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
		$("#txtFechaInicio").val(viaje.inicio)
		$("#txtFechaFin").val(viaje.fin)
		$("#txtFecha").data("daterangepicker").setStartDate(viaje.inicio)
		$("#txtFecha").data("daterangepicker").setEndDate(viaje.fin)
		$("#txtDias").val(viaje.dias)
		$("#txtNoches").val(viaje.noches)
		$("#txtDiasDevolucion").val(viaje.devolucion)
		$("#cmbTipoViaje").val(viaje.tipo)
		setTableDias(viaje)
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
	let viaje = $tr.data("viaje");
	let dias = $tr.data("dias");
	viaje.diasDescripcion = dias;	
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
		devolucion: $("#txtDiasDevolucion").val(),
		tipo: $("#cmbTipoViaje").val()	
	};
	viaje.diasDescripcion = getTableDias();
	return viaje;
}

function editTableLog (viaje) {
	let Break = {};
	try {		
		$.each($("#tblViajes tbody tr"), function (index, tr) {			
			if ($(tr).data("id") == viaje.id) {
				$("td:eq(1)", tr).text(viaje.nombre);				
				$("td:eq(2)", tr).text(viaje.precio);				
				$("td:eq(3)", tr).text(viaje.dias);				
				$("td:eq(4)", tr).text(viaje.minimo + " - " + viaje.maximo);
				$(tr).data("viaje", viaje);
				$(tr).data("dias", viaje.diasDescripcion);
				throw Break;
			}
		});
	} catch (e) {
		// console.error(e)
	}	
}

function addTableLog (viaje) {
	let fila = tabla.row.add([
		tabla.rows().count() + 1,
		viaje.nombre,
		viaje.precio,
		viaje.dias,
		viaje.minimo + " - " + viaje.maximo,		
		'<span class="label label-danger">Inactivo</span>',
		'<button type="button" class="btn btn-warning btn-edit-log" data-id="' + viaje.id + '" title="Editar registro"><i class="fas fa-edit"></i></button>&nbsp;' +
		'<button title="Abrir registro" type="button" class="btn-toggle-status btn btn-primary" data-id="' + viaje.id + '" data-status="0">' +
        	'<i class="fas fa-door-closed"></i>' +
    	'</button>'
	]).draw();	
	$(tabla.row(fila).node()).data("viaje", viaje);
	$(tabla.row(fila).node()).data("dias", viaje.diasDescripcion);
	clearFormData();
}

function clearFormData () {
	$("#txtNombre").val("")
	$("#txtMinimo").val("")
	$("#txtMaximo").val("")
	$("#txtPrecio").val("")
	let fechaHoy = moment(new Date());
	$("#txtFecha").val(fechaHoy.format("DD/MM/YYY") + " - " + fechaHoy.format("DD/MM/YYYY"))
	$("#tblDias tbody").empty()
	$("#txtDescripcion").val("")	
	$("#txtDias").val("1")
	$("#txtNoches").val("0")	
	$("#idViaje").val("")
	$("#cmbTipoViaje").val("0")
	$("#txtNombreDia").val("")
	$("#txtDescripcionDia").val("")
	$("#btnGroup").show()
}

function setTableDias (viaje) {	
	$.each(viaje.diasDescripcion, function (index, dia) {		
		let nombre = "<td>" + dia.nombre + "</td>";
		let descripcion = "<td>" + dia.descripcion + "</td>";
		let fecha = "<td>" + dia.fecha + "</td>";
		let btnEliminar = "<td>" +
			"<button type='button' class='btn btn-sm btn-danger btn-del-dia' title='Eliminar día'>" + 
				"<i class='fas fa-times'></i>" +
			"</button>" +
		"</td>";
		$("#tblDias tbody").append("<tr><td>" + (index + 1) + "</td>" + nombre + fecha + descripcion + btnEliminar + "</tr>")
		$("#tblDias tbody tr:last").data("nombre", dia.nombre).data("descripcion", dia.descripcion).data("fecha", dia.fecha);
	})
}

function getTableDias () {
	let dias = [];
	$.each($("#tblDias tbody tr"), function (index, tr) {		
		dias.push({
			nombre: $(tr).data("nombre"),
			descripcion: $(tr).data("descripcion"),
			fecha: $(tr).data("fecha")
		})
	})
	return dias;
}

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
					$(filas).find("[data-id='" + data.id + "']").parent().parent().data("viaje", viaje);
				})
			}
			catch (e) {
				console.error(e)
			}
		}
	})
	$.ajax({
		url: base_url + "admin/viajes/dias",
		success: function (data) {
			let filas = tabla.rows().nodes();
			try {
				$.each(JSON.parse(data), function (index, viaje) {
					viaje.dias.forEach( function (dia) {
						dia.fecha = moment(dia.fecha).format("DD/MM/YYYY");											
					})
					$(filas).find("[data-id='" + viaje.id + "']").parent().parent().data("dias", viaje.dias);
				})
			}
			catch (e) {
				console.error(e)
			}				
		}
	})
}

function empezar (viaje, btn, $tr) {
	$.ajax({
		url: base_url + "admin/viajes/empezar/" + viaje.id,
		success: function (res) {
			try {
				if (JSON.parse(res)) {
					btn.removeClass("btn-empezar")
						.addClass("btn-terminar")
						.prop("title", "Terminar")
						.find("i")
							.removeClass("fa-check")
							.addClass("fa-times")
					$tr.find(".label")
						.removeClass(".label-success")
						.addClass(".label-primary")
						.text("En curso");
				}
				else {
					BootstrapDialog.alert({
						title: "Error",
						message: "No se pudo empezar",
						type: BootstrapDialog.TYPE_DANGER,
						size: BootstrapDialog.SIZE_SMALL,
						btnOKLabel: "Aceptar"
					})
				}
			}
			catch (e) {
				console.error(e)
			}
		}
	})
}

function terminar (viaje, $btn, $tr) {
	$.ajax({
		url: base_url + "admin/viajes/terminar/" + viaje.id,
		success: function (res) {
			try {
				if (res) {
					$btn.remove();
					$tr.find(".label")
						.removeClass("label-primary")
						.addClass("label-success")
						.text("Terminado")					
				}
				else {
					BootstrapDialog.alert({
						title: "Error",
						message: "No se pudo terminar el viaje",
						type: BootstrapDialog.TYPE_DANGER,
						size:BootstrapDialog.SIZE_SMALL,
						btnOKLabel: "Aceptar"
					})
				}
			}
			catch (e) {
				console.error(e);
			}
		}
	})
}