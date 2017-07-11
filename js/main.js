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
		}
			}else{
				$('#msg-error').slideDown('slow');
				setTimeout(function(){
					$('#msg-error').slideUp('slow');
				},3000);
				$('#submit').val('Ingresar');
			}
	})

	.fail(function(answer){
		console.log(answer);
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
	  beforeSend: function(){
	  	console.log("enviando");
	  	}
	})
	.done(function(serverAnswer){//serverAnswer es la variable que contiene la respuesta del servidor
		if (!serverAnswer.error){
			console.log(serverAnswer);
			console.log("envio exitoso");
			$('#exitoEmpleado').modal('show');					
		}else{
			$('#errorEmpleado').modal('show');
		}
	})

	.fail(function(answer){
		console.log(answer.responseText);
		console.log("No fue posible conectar con el servidor");
		
	})

	.always(function(){
		console.log("Script finalizado");
	});
	
});

// Envío de datos de contratos
jQuery(document).on('submit', '#cargar-contrato', function(event){
	event.preventDefault();
	jQuery.ajax({
	  url: '../contratos.php',
	  type: 'POST',
	  dataType: 'json',
	  data: $(this).serialize(),
	  beforeSend: function(){
		  	console.log("enviando");
		  	}
		})
		.done(function(servidorResp){
			if (!servidorResp.error){
				$('#exito_contrato').modal('show');					
			}else{
				$('#error_contrato').modal('show');
			}
		})
		.fail(function(sanswer){
			console.log("Error recibido: " + sanswer);
			
		})	
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
	var span = $('<div class="alert" role="alert"></div>').insertAfter(pass2);
	span.hide();
	//función que comprueba las dos contraseñas
	function coincidePassword(){
	var valor1 = pass1.val();
	var valor2 = pass2.val();
	//muestro el span
	span.show().removeClass();
	//condiciones dentro de la función
	if(valor1 != valor2){
	span.text(negacion).addClass('alert-danger');
	$('#enviar').addClass('disabled');	
	}
	if(valor1.length==0 || valor1==""){
	span.text(vacio).addClass('alert-danger');
	$('#enviar').addClass('disabled');	
	}
	if(valor1.length<4 || valor1.length>20){
	span.text(longitud).addClass('alert-danger');
	$('#enviar').addClass('disabled');
	}
	if(valor1.length!=0 && valor1==valor2){
	span.text(confirmacion).removeClass("alert-danger").addClass('alert-success');
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
    console.log("Ajax Request enviado");
  },
  success: function(data) {
  	console.log("Comprueba valor de error");
  	if (data.error === true) {
  		$('#error_admin').modal("show");
  	}else{
  		$('#exito_admin').modal("show");
  	}
  },
  error: function(rta) {
    
    
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
setInterval(mailer(1), 3600000);

function mailer(activacion){
	jQuery.ajax({
	  url: '../mailer.php',
	  type: 'POST',
	  dataType: 'json',
	  data: {activacion: activacion},
	  complete: function(resp) {
	    if (!resp.error) {
	    	console.log('Mailer funcionando');
	    }else{
	    	console.log('Mailer no funciona');
	    }
	  },
	  success: function(data, textStatus, xhr) {
	    //called when successful
	  },
	  error: function(respuesta) {
	    console.log(respuesta.responseText);
	  }
	});
	
}


// Busqueda en tiempo real de empleados
$(buscar_empleados());

function buscar_empleados(consulta){
	jQuery.ajax({
		url: '../buscar-empleado.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta) {
		$("#tabla-empleado").html(respuesta);
	})
	.fail(function() {
		console.log("error");
	})
}

$(document).on('keyup', '#search', function(){
	var contenido = $(this).val();
	if (contenido != "") {
		buscar_empleados(contenido);
	}else{
		buscar_empleados();
	}
});

//Pasaje de datos a ventana modal
$(document).on('click', '.open-modal', function(){
	var EmpCC = $(this).val();
	$(".modal-body #cc").val(EmpCC);
	loadDataModal(EmpCC);
});

// Carga de datos en Formulario Modal
function loadDataModal(input){
	jQuery.ajax({
		url: '../load-data-modal.php',
		type: 'POST',
		dataType: 'html',
		data: {input: input},
	})
	.done(function(respuesta) {
		$("#form-data-modal").html(respuesta);
	})
	.fail(function() {
		console.log("error");
	})
};

// Confirmación de cambios en empleados
jQuery(document).on('submit', '#form-data-modal', function(event){
	event.preventDefault();
	jQuery.ajax({
	  url: '../save-changes.php',
	  type: 'POST',
	  dataType: 'json',
	  data: $(this).serialize(),
	  complete: function(respuesta) {
	    if (!respuesta.error) {
	    	$('#success').slideDown('slow', function(){
	    		$(this).slideUp(3000);
	    	});
	    }else{
	    	$('#error').slideDown('slow', function(){
	    		$(this).slideUp(3000);
	    	});
	    }
	  },
	  success: function(answer) {
	    console.log(answer.responseText);
	  },
	  error: function(xhr, textStatus, errorThrown) {
	    //called when there is an error
	  }
	});
	
});

// Eliminación de empleados

$(document).on('click', '.eliminar-empleado', function(){
	var dellCC = $(this).val();
	$('#cc-empleado-eliminar').val(dellCC);
});

$(document).on('submit', '#eliminarEmpleado', function(event){
	event.preventDefault();
		jQuery.ajax({
		  url: '../eliminar-empleado.php',
		  type: 'POST',
		  dataType: 'json',
		  data: $(this).serialize(),
		  complete: function(respuesta) {
		    if (!respuesta.error) {
		    	$('#success-delete').slideDown('slow', function(){
	    		$(this).slideUp(3000);
	    	});
	    }else{
	    	$('#error-delete').slideDown('slow', function(){
	    		$(this).slideUp(3000);
	    	});
		    }
		  },
		  success: function(data, textStatus, xhr) {
		    //called when successful
		  },
		  error: function(answer) {
		    console.log(answer.responseText);
		  }
		});
			
});

// Modificación y eliminación de contratos

// Búsqueda en tiempo real de contratos
$(buscar_contratos());

function buscar_contratos(consulta){
	jQuery.ajax({
		url: '../buscar-contratos.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta) {
		$("#tabla-contrato").html(respuesta);
	})
	.fail(function() {
		console.log("error");
	})
};

$(document).on('keyup', '#searchContract', function(){
	var contenido = $(this).val();
	if (contenido != "") {
		buscar_contratos(contenido);
	}else{
		buscar_contratos();
	}
});

//Pasaje de datos a ventana modal
$(document).on('click', '.open-modal-contract', function(){
	var contID = $(this).val();
	$(".modal-body #id-contract").val(contID);
	loadContactModal(contID);
});

// Carga de datos en Formulario Modal
function loadContactModal(input){
	jQuery.ajax({
		url: '../load-contact-modal.php',
		type: 'POST',
		dataType: 'html',
		data: {input: input},
	})
	.done(function(respuesta) {
		$("#form-contract-modal").html(respuesta);
	})
	.fail(function() {
		console.log("error");
	})
};

// Confirmación de cambios en contratos

jQuery(document).on('submit', '#form-contract-modal', function(event){
	event.preventDefault();
	jQuery.ajax({
	  url: '../save-changes-contract.php',
	  type: 'POST',
	  dataType: 'json',
	  data: $(this).serialize(),
	  complete: function(respuesta) {
	    if (!respuesta.error) {
	    	$('#successContract').slideDown('slow', function(){
	    		$(this).slideUp(3000);
	    	});
	    }else{
	    	$('#errorContract').slideDown('slow', function(){
	    		$(this).slideUp(3000);
	    	});
	    }
	  },
	  success: function(answer) {
	    console.log(answer.responseText);
	  },
	  error: function(xhr, textStatus, errorThrown) {
	    //called when there is an error
	  }
	});
	
});

// Eliminación de contratos

$(document).on('click', '.eliminar-contrato', function(){
	var dellID = $(this).val();
	$('#cc-contrato-eliminar').val(dellID);
	
});

$(document).on('submit', '#eliminarContrato', function(event){
	event.preventDefault();
		jQuery.ajax({
		  url: '../eliminar-contrato.php',
		  type: 'POST',
		  dataType: 'json',
		  data: $(this).serialize(),
		  complete: function(respuesta) {
		    if (!respuesta.error) {
		    	$('#success-delete-contract').slideDown('slow', function(){
	    		$(this).slideUp(3000);
	    	});
	    }else{
	    	$('#error-delete-contract').slideDown('slow', function(){
	    		$(this).slideUp(3000);
	    	});
		    }
		  },
		  success: function(data, textStatus, xhr) {
		    //called when successful
		  },
		  error: function(answer) {
		    console.log(answer.responseText);
		  }
		});
			
});

// Modificación y eliminación de usuarios

// Búsqueda en tiempo real de usuarios
$(buscar_usuarios());

function buscar_usuarios(consulta){
	jQuery.ajax({
		url: '../buscar-usuarios.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta) {
		$("#tabla-usuario").html(respuesta);
	})
	.fail(function() {
		console.log("error");
	})
};

$(document).on('keyup', '#searchUser', function(){
	var contenido = $(this).val();
	if (contenido != "") {
		buscar_usuarios(contenido);
	}else{
		buscar_usuarios();
	}
});


//Pasaje de datos a ventana modal
$(document).on('click', '.modal-admin', function(){
	var userCC = $(this).val();
	$(".modal-body #ccAdmin").val(userCC);
	loadAdminModal(userCC);
});

// Carga de datos en Formulario Modal
function loadAdminModal(input){
	jQuery.ajax({
		url: '../load-admin-modal.php',
		type: 'POST',
		dataType: 'html',
		data: {input: input},
	})
	.done(function(respuesta) {
		$("#form-admin-modal").html(respuesta);
	})
	.fail(function() {
		console.log("error");
	})
};

// Confirmación de cambios en usuarios

jQuery(document).on('submit', '#form-admin-modal', function(event){
	event.preventDefault();
	jQuery.ajax({
	  url: '../save-changes-admin.php',
	  type: 'POST',
	  dataType: 'json',
	  data: $(this).serialize(),
	  complete: function(respuesta) {
	    if (!respuesta.error) {
	    	$('#success-admin').slideDown('slow', function(){
	    		$(this).slideUp(3000);
	    	});
	    }else{
	    	$('#error-admin').slideDown('slow', function(){
	    		$(this).slideUp(3000);
	    	});
	    }
	  },
	  success: function(answer) {
	    console.log(answer.responseText);
	  },
	  error: function(xhr, textStatus, errorThrown) {
	    //called when there is an error
	  }
	});
	
});

// Eliminación de contratos

$(document).on('click', '.eliminar-admin', function(){
	var dellAdmin = $(this).val();
	$('#cc-admin-eliminar').val(dellAdmin);
	
});

$(document).on('submit', '#eliminaradmin', function(event){
	event.preventDefault();
		jQuery.ajax({
		  url: '../eliminar-admin.php',
		  type: 'POST',
		  dataType: 'json',
		  data: $(this).serialize(),
		  complete: function(respuesta) {
		    if (!respuesta.error) {
		    	$('#success-delete-admin').slideDown('slow', function(){
	    		$(this).slideUp(3000);
	    		});
	    }else{
	    	$('#error-delete-admin').slideDown('slow', function(){
	    		$(this).slideUp(3000);
	    	});
		    }
		  },
		  success: function(data, textStatus, xhr) {
		    //called when successful
		  },
		  error: function(answer) {
		    
		  }
		});
			
});

$(document).on('click', '.btnCerrar', function(){
	$('body').removeClass('modal-open');
	$('.modal-backdrop').remove();
});