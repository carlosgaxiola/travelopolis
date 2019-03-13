$(document).ready( function () {
	$("#btn-login").click( function () {
		login();
	})

	$("#txtContra").keydown( function (e) {
		if (e.keyCode == 13)
			login();		
	})
	function login () {
		$("#msg-error").hide();
		if ($("#txtUsuario").hasClass("error") || $("#txtContra").hasClass("error") || $("#txtUsuario").val() == "" || $("#txtContra").val() == "") {
			$("#msg-error").fadeIn(300);
			$("#msg-error").html("<p>Usuario y/o contraseña incorrectos</p>");
		}
		else {
			$.ajax({
				url: base_url + "inicio/login",
				type: "POST",
				data: $("#frmLogin").serialize(),
				success: function (res) {					
					if (!JSON.parse(res)) {
						$("#msg-error").fadeIn(300);
						$("#msg-error").html("<p>Usuario y/o contraseña incorrectos</p>");
					}
					else
						window.location.href = base_url;
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.error("Error::" + errorThrown)
				}
			})
		}
	}
})