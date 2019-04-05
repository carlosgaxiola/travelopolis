$(document).ready( function () {    

	$("#btn-registrar").click( function (e) {
		e.preventDefault();
		let valido = true;
		$.each($("#frmRegistro input"), function (index, input) {
			let type = $(input).prop("type");			
			switch (type) {
				case "text":
				case "password":
				case "email":					
					valido = $(input).val() != "";					
					break;					
			}			
		})
		if (valido) {
			$.ajax({
				url: base_url + "inicio/crear",
				type: "POST",
				data: $("#frmRegistro").serialize() + "&fecha=" + getDate(),
				success: function (res) {
					try {						
						if (!isNaN(parseInt(res))) {
							switch (res) {
								case 0:
									BootstrapDialog.alert({
										title: "Error",
										message: "Ocurrio un error en el registro." +
											"<br>Intentelo más tarde",
										type: BootstrapDialog.TYPE_WARNING,
										size: BootstrapDialog.SIZE_SMALL
									});
									break;
								default:
									BootstrapDialog.show({
										title: "Registro completado",
										message: "Ya ha sido registrado como viajero en Tavelopolis" +
											"<br>Ya puede iniciar sesión con los datos que ingreso en su registro",
										type: BootstrapDialog.TYPE_SUCCESS,
										buttons: [
											{
												label: "Iniciar sesión",
												cssClass: "btn-primary",
												action: function (dialog) {
													window.location.href = base_url + "inicio/ingresar";
												}
											}
										]										
									})
									break;
							}
						}
						else 
							$("#msg-error").html(res).show()
					}
					catch (e) {
						console.log(e)
					}
				}
			})
		}
	})
})