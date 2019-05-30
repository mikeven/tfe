// Acceso
/*
 * fn-acceso.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
(function() {
	
	'use strict';

	/* Inits */
	/* --------------------------------------------------------- */

	$("[data-hide]").on("click", function(){
        $(this).closest("." + $(this).attr("data-hide")).fadeOut(200);
    });

	$("#logout").on("click", function(){
        log_out();
    });

	/* --------------------------------------------------------- */

}).apply( this, [ jQuery ]);

// Masked Input
(function( $ ) {

    'use strict';

    if ( $.isFunction($.fn[ 'mask' ]) ) {

        $(function() {
            $('[data-plugin-masked-input]').each(function() {
                var $this = $( this ),
                    opts = {};

                var pluginOptions = $this.data('plugin-options');
                if (pluginOptions)
                    opts = pluginOptions;

                $this.themePluginMaskedInput(opts);
            });
        });

    }

}).apply(this, [ jQuery ]);

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
function log_in(){
	//Invoca al servidor para iniciar sesión de usuario
	var form = $('#loginform');
	$.ajax({
        type:"POST",
        url:"database/data-acceso.php",
        data:form.serialize(), //data invocación: #usr_login (index.php)
        beforeSend: function() {
        	$(".alert").removeClass("alert-danger");
        	$(".alert").removeClass("alert-success");
        	$(".alert").hide();
        },
        success: function( response ){
        	console.log( response );
        	res = jQuery.parseJSON( response );
			if( res.exito == 1 )
				window.location = "home.php";
			else
				alertaMensaje( res.exito, res.mje );
        }
    });
}
/* --------------------------------------------------------- */
function log_out(){
	//Invoca al servidor para cerrar sesión de usuario
	
	$.ajax({
        type:"POST", url:"database/data-acceso.php",
        data:{ logout: true },
        success: function( response ){
            console.log( response );
        	if( response == 1 ) window.location = 'index.php'
        }
    });
}
/* --------------------------------------------------------- */
function r_password(){
	//Invoca al servidor para recuperar contraseña
	var form = $('#ly_rpassw');
	$.ajax({
        type:"POST",
        url:"database/data-acceso.php",
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
function registrar(){
	//Invoca al servidor para registrar nuevo usuario
	var form_reg = $('#frm_registro').serialize();
	var espera = "<img src='img/loading.gif' width='60'>";
	
	$.ajax({
        type:"POST",
        url:"database/data-acceso.php",
        data:{ usr_reg: form_reg },
        beforeSend: function() {
        	$("#response-reg").html( espera );
        },
        success: function( response ){
        	console.log( response );
        	res = jQuery.parseJSON( response );
            document.getElementById("frm_registro").reset();
            if( res.exito == 1 )
                alertaMensajeBoton( res.exito, res.mje, 'index.php', 'Ingresar' );
            else
                alertaMensaje( res.exito, res.mje );
        }
    });
}
/* --------------------------------------------------------- */