//MAIN CONTRATOS
// Scripts principales
// Login
jQuery(document).on('submit', '#form-login', function(event){
	event.preventDefault();

	jQuery.ajax({
	  url: 'main_app/login.php',
	  type: 'POST',
	  dataType: 'json',
	  data: $(this).serialize(),
	  beforeSend: function(){
	  	$('#submit').val('Validando...');
	  	}
	})
	.done(function(serverAnswer){//serverAnswer es la variable que contiene la respuesta del servidor
		if (!serverAnswer.error){
			console.log(serverAnswer);
			console.log("login exitoso");

		// Redireccionamiento al directorio correspondiente
			if(serverAnswer.rol == "Administrador") {
				location.href = 'Main_app/admin/';
			} else if (serverAnswer.rol == 'Director') {
				location.href = 'Main_app/director/';
			} else if (serverAnswer.rol == 'Matriculador') {
				location.href = 'Main_app/matriculador/';
			}else{
				$('#msg-error').slideDown('slow');
				setTimeout(function(){
					$('#msg-error').slideUp('slow');
				},3000);
				$('#submit').val('Ingresar');
			}
		}
	})

	.fail(function(answer){
		console.log(answer.responseText);
		console.log("No fue posible conectar con el servidor");
		$('#submit').val('Ingresar');
	})

	.always(function(){
		console.log("Script finalizado");
	});
	
});

// Ingreso de nuevo Empleado
jQuery(document).on('submit', '#ingresar-empleado', function(event){
	event.preventDefault();
	jQuery.ajax({
	  url: '../guardar_empleado.php',
	  type: 'POST',
	  dataType: 'json',
	  data: $(this).serialize(),
	  complete: function(resp) {
	    console.log("Script corriendo...");
	    if (!resp.error) {
	    	$("#exito").modal("show");
		}else{
			$("#error").modal("show");
		}
	  },
	  success: function(respuesta) {
	  	if (!respuesta.error) {
	    $("#exito").modal("show");
		}
	  },
	  error: function(anser) {
	    console.log(anser);
	  }
	});
	
	
});

// Envío de datos de contratos
jQuery(document).on('submit', '#ingresar-contrato', function(event){
	event.preventDefault();
jQuery.ajax({
  url: '../contratos.php',
  type: 'POST',
  dataType: 'json',
  data: $(this).serialize(),
  complete: function(resp) {
    if (!resp.error) {
    	$('#exito_contrato').modal("show");
    }else{
    	$('#error_contrato').modal("show");
    }
  },
  success: function(respuesta) {

  },
  error: function(rpta) {
   
  }
});
});
// Comprobación de coincidencia de contraseñas
$(document).ready(function() {
	//variables
	var pass1 = $('[name=password]');
	var pass2 = $('[name=password-repeat]');
	var confirmacion = "Las contraseñas coinciden";
	var longitud = "La contraseña debe estar formada entre 4-20 carácteres (ambos inclusive)";
	var negacion = "No coinciden las contraseñas";
	var vacio = "La contraseña no puede estar vacía";
	//oculto por defecto el elemento span
	var span = $('<span></span>').insertAfter(pass2);
	span.hide();
	//función que comprueba las dos contraseñas
	function coincidePassword(){
	var valor1 = pass1.val();
	var valor2 = pass2.val();
	//muestro el span
	span.show().removeClass();
	//condiciones dentro de la función
	if(valor1 != valor2){
	span.text(negacion).addClass('negacion');
	$('#enviar').addClass('disabled');	
	}
	if(valor1.length==0 || valor1==""){
	span.text(vacio).addClass('negacion');
	$('#enviar').addClass('disabled');	
	}
	if(valor1.length<4 || valor1.length>20){
	span.text(longitud).addClass('negacion');
	$('#enviar').addClass('disabled');
	}
	if(valor1.length!=0 && valor1==valor2){
	span.text(confirmacion).removeClass("negacion").addClass('confirmacion');
	$('#enviar').removeClass('disabled');
	}
	}
	//ejecuto la función al soltar la tecla
	pass2.keyup(function(){
	coincidePassword();
	});
});

// Ingreso de nuevos usuarios
jQuery(document).on('submit', '#ingresar-user', function(event){
	event.preventDefault();
jQuery.ajax({
  url: '../administradores.php',
  type: 'POST',
  dataType: 'json',
  data: $(this).serialize(),
  complete: function(respuesta) {
    if (!respuesta.error) {
    	$('#exito_admin').modal("show");
    }else{
    	$('#error_admin').modal("show");
    }
  },
  success: function(data, textStatus, xhr) {
    //called when successful
  },
  error: function(xhr, textStatus, errorThrown) {
    //called when there is an error
  }
});
});



// Busqueda automatica de CC en contratos

$(buscar_datos());


function buscar_datos(consulta){
	jQuery.ajax({
		url: '../listado.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta) {
		$("#select-contratos").html(respuesta);
	})
	.fail(function() {
		console.log("error");
	})
}




$(document).on('load', '#select-contratos', function(){
	var valor = $(this).val();
	if(valor !=""){
		buscar_datos(valor);
	} else {
		buscar_datos();
	}

});

//Tabla dinámica de Resumen
$(resumen());

function resumen(consulta){
	jQuery.ajax({
	  url: '../resumen.php',
	  type: 'POST',
	  dataType: 'html',
	  data: {consulta: consulta},
	})
	  .done(function(respuesta) {
		$("#tabla-resumen").html(respuesta);
	})
	.fail(function() {
		console.log("error");
	});
	
}

// Tabla dinámica de Gestión

$(gestion());
function gestion(transaccion){
	jQuery.ajax({
	  url: '../gestion-back.php',
	  type: 'POST',
	  dataType: 'html',
	  data: {transaccion: transaccion},
	})
	 .done(function(respuesta) {
		$("#tabla-gestion").html(respuesta);
	})
	.fail(function() {
		console.log("error");
	});
	
}

// Tabla dinámica de Resumen para Director
	
$(buscar_resumen());

function buscar_resumen(consulta){
	jQuery.ajax({
		url: '../resumen_director.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta) {
		$("#select").html(respuesta);
	})
	.fail(function() {
		console.log("error");
	})
}

// Intervalo de envío de mails
setInterval(mailer, 3600000);
	
function mailer(){
	// Función que inicializar el objeto HTTP
	function inicializar_XHR(){
		if (window.XMLHttpRequest) {
			peticionHTTP = new XMLHttpRequest();
		}else{
			peticionHTTP = new ActiveXObject("Microsoft.XMLHTTP");
		}
	};

	// Función que realiza la petición
	function realizarPeticion(url, metodo, funcion){
		peticionHTTP.onreadystatechange = funcion;
		peticionHTTP.open(metodo, url, true);
		peticionHTTP.send(null);
	};

	// Se realiza el llamado a Mailer
	function llamarArchivo(){
		inicializar_XHR();
		realizarPeticion('../mailer.php', 'POST', funcionActuadora);
	};

	function funcionActuadora(){
		if (peticionHTTP.readyState == 4) {
			if (peticionHTTP.status == 200) {
				console.log(peticionHTTP.responseText);
			}
		}
	};


	console.log("Esto es un contador de prueba");
};
