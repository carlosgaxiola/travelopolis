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
			data: $("#frmViaje").serialize() + 
				"&txtDias=" + $("#txtDias").val() +
				"&txtNoches=" + $("#txtNoches").val(),
			success: function (res) {
				try  {					
					if (!isNaN(parseInt(res)))
						switch (res) {
							case 0:
								console.error("error: "  + res);
								break
							default:
								viaje.id = res;		
								editDiasDescripcion(viaje);								
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
		$("#txtFecha").val(viaje.inicio + " - " + viaje.fin)
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
				$(tr).data("dias", viaje.dias);
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
	$("#contenidoTabla").find("[data-id='" + viaje.id + "']").data("viaje", viaje);
	$("#contenidoTabla").find("[data-id='" + viaje.id + "']").data("dias", viaje.diasDescripcion);
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
	$("#txtImagen").val("")
	$("#txtPreview").empty()
	$("#txtDias").val("1")
	$("#txtNoches").val("0")	
	$("#idViaje").val("")
	$("#cmbTipoViaje").val("0")
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
		$("#tblDias tbody").append("<tr>" + (index + 1) + nombre + fecha + descripcion + btnEliminar + "</tr>")
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
						tipo: data.id_tipo_viaje							
					};										
					$("#contenidoTabla").find("[data-id='" + data.id + "']").data("viaje", viaje);					
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
			try {
				$.each(JSON.parse(data), function (index, viaje) {					
					$("#contenidoTabla").find("[data-id='" + viaje.id + "']").data("dias", viaje.dias);					
				})
			}
			catch (e) {
				console.error(e)
			}				
		}
	})
}