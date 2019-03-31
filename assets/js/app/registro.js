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
						res = parseInt(res);
						if (!isNaN(res)) {
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
								case 0:
									BootstrapDialog.show({
										title: "Registro completado",
										message: "Hemos mandado un correo de confirmación, favor de verificarlo antes de una semana o su usuario sera eliminado",
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
							console.log(res);
					}
					catch (e) {
						console.log(e)
					}
				}
			})
		}
	})
})