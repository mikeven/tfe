// Cuenta de usuario
/*
 * fn-usuario.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
(function() {
	
	'use strict';

	// Formulario de registro
	$("#frm_registro").validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
		onkeyup: false,
		errorPlacement: function( error, element ) {
			var placement = element.closest('.input-group');
			if (!placement.get(0)) {
				placement = element;
			}
			if (error.text() !== '') {
				placement.after(error);
			}
		},
		rules : {
            password : {
                minlength : 6
            },
            cnf_password : {
                minlength : 6,
                equalTo : "#pwd"
            }
        },
		submitHandler: function(form) {
		    registrar();
		}
	});

	$("#frm_passw").validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
		onkeyup: false,
		errorPlacement: function( error, element ) {
			var placement = element.closest('.input-group');
			if (!placement.get(0)) {
				placement = element;
			}
			if (error.text() !== '') {
				placement.after(error);
			}
		},
		submitHandler: function(form) {
		    //asignarPassword();
		}
	});

	$("#frm_npass").validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
		rules: {
		    pass1: "required",
		    pass2: {
		      equalTo: "#passw1"
		    }
		 },
		onkeyup: false,
		errorPlacement: function( error, element ) {
			var placement = element.closest('.input-group');
			if (!placement.get(0)) {
				placement = element;
			}
			if (error.text() !== '') {
				placement.after(error);
			}
		},
		submitHandler: function(form) {
		    actualizarPassword();
		}
	});

	// validation summary
	var $summaryForm = $("#summary-form");
	$summaryForm.validate({
		errorContainer: $summaryForm.find( 'div.validation-message' ),
		errorLabelContainer: $summaryForm.find( 'div.validation-message ul' ),
		wrapper: "li"
	});

	/* Inits */
	/* --------------------------------------------------------- */

	$("[data-hide]").on("click", function(){
        $(this).closest("." + $(this).attr("data-hide")).fadeOut(200);
    });

	/* --------------------------------------------------------- */

	/* -- Habilitación de usuarios -- */

	$(".chvotable").on('change', function (e) {
		// Inicia la invocación para blockear/desbloquear usuarios

		var valor = 'no';
		if( $(this).is( ":checked" ) ) valor = 'si';
		var id_p = $(this).attr( "data-idp" );
		var suiche = $(this).closest( ".switch" );
		//var espera = "<img src='../assets/images/loading.gif' width='30'>";

		$.ajax({
	        type:"POST",
	        url:"database/data-participantes.php",
	        data:{ habilitar: valor, idp: id_p },
	        beforeSend: function() {
	        	//$(".accion-adj").html( espera );
	        },
	        success: function( response ){
	        	console.log( response );
				var res = jQuery.parseJSON( response );
				if( res.exito == 1 ){
					notificar( "Participantes", res.mje, "success" );
					tooltipSuiche( valor, suiche );
				}
				else
					notificar( "Participantes", res.mje, "error" );
	        }
	    });
	});

	/* -- Habilitación de usuarios -- */
	/* --------------------------------------------------------- */

}).apply( this, [ jQuery ]);

/* --------------------------------------------------------- */
function tooltipSuiche( valor, suiche ){
	// Actualiza el texto tooltip del suiche después de ser usado
	console.log( $( suiche ).attr( "data-original-title" ) );
	if( valor == 'no' )
		$( suiche ).attr( "data-original-title", "Habilitar" ); 
	else
		$( suiche ).attr( "data-original-title", "Deshabilitar" );
} 
/* --------------------------------------------------------- */
function actualizarPassword(){
	// Invoca al servidor para actualizar contraseña de usuario 
	var form = $('#frm_npass');
	$.ajax({
        type:"POST",
        url:"database/data-participantes.php",
        data:form.serialize(),
        beforeSend: function(){
        },
        success: function( response ){
        	console.log( response );
        	form[0].reset();
        	res = jQuery.parseJSON( response );
			alertaMensaje( res.exito, res.mje );
        }
    });	
}
/* --------------------------------------------------------- */
function asignarPassword(){
	// Invoca al servidor para asignar contraseña a usuario

	var form = $('#frm_passw');
	$.ajax({
        type:"POST",
        url:"database/data-participantes.php",
        data:form.serialize(),
        beforeSend: function() {
        	$(".alert").removeClass("alert-danger");
        	$(".alert").removeClass("alert-success");
        	$(".alert").hide();
        },
        success: function( response ){
        	console.log( response );
        	form[0].reset();
        	res = jQuery.parseJSON( response );
			alertaMensaje( res.exito, res.mje );
        }
    });
}
/* --------------------------------------------------------- */