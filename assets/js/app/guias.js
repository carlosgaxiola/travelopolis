$(document).ready( function () {				

	//Necesarias
	$("#btn-save").click( function () {
		if ($("#idGuia").val() === "") {
			add( function () {
				BootstrapDialog.alert({
					title: "Guia registrado",
					message: "Se registro el guia correctamente",
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
	})

	function add ( callback ) {
		$.ajax({
			url: base_url + "admin/guias/add",
			type: "POST",
			data: $("#frmGuia").serialize() + "&fecha=" + getDate(),
			success: function ( res ) {
				try {
					if ( !isNaN( parseInt( res ) ) ) {
						switch ( res ) {
							case 0:
								console.error( "Error::" + res )
								break
							default:
								let guia = getFormLog( res )
								addTableLog ( guia )
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
			url: base_url + "admin/guias/edit",
			type: "POST",
			data: $("#frmGuia").serialize(),
			success: function (res) {				
				try  {					
					if (!isNaN(parseInt(res)))
						switch (res) {
							case 0:
								console.error("error: "  + res);
								break
							default:
								let guia = getFormLog(res);								
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
});

//Genericas
function setFormLog (guia) {
	if (guia != null && guia != undefined) {
		$("#idGuia").val(guia.idGuia)		
		$("#txtNombre").val(guia.nombre)
		$("#txtAMaterno").val(guia.aMaterno)
		$("#txtAPaterno").val(guia.aPaterno)
		$("#txtCorreo").val(guia.correo)
		$("#txtTelefono").val(guia.telefono)
		$("#txtRFC").val(guia.rfc)
		$("#txtNSS").val(guia.nss)
		$("#txtUsuario").val(guia.usuario)			
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

function getFormLog (idGuia) {
	return {
		id: idGuia,		
		nombre: $("#txtNombre").val(),
		aPaterno: $("#txtAPaterno").val(),
		aMaterno: $("#txtAMaterno").val(),
		telefono: $("#txtTelefono").val(),
		correo: $("#txtCorreo").val(),
		nss: $("#txtNSS").val(),
		rfc: $("#txtRFC").val(),
		usuario: $("#txtUsuario").val()
	};	
}

function editTableLog (guia) {
	let Break = {};
	try {		
		$.each($("#tblGuias tbody tr"), function (index, tr) {			
			if ($(tr).data("id") == guia.id) {
				$("td:eq(1)", tr).text(guia.nombre);
				tabla.row(tr).data()[1] = guia.nombre;				
				$("td:eq(2)", tr).text(guia.aPaterno + " " + guia.aMaterno);
				tabla.row(tr).data()[2] = guia.aPaterno + " " + guia.aMaterno;
				$("td:eq(3)", tr).text(guia.telefono);
				tabla.row(tr).data()[3] = guia.telefono;
				$("td:eq(4)", tr).text(guia.correo);
				tabla.row(tr).data()[4] = guia.correo;				
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