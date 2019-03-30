$(document).ready( function () {    

	$("#btn-registrar").click( function (e) {
		e.preventDefault();
		$.each($("#frmRegistro input"), function (index, input) {
			let type = $(input).prop("type");
			let valido = true;
			switch (type) {
				case "text":
				case: "password":
				case: "email":					
					valido = $(input).val() != "";					
					break;					
			}
						
		})
	})
})