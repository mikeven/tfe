// Funciones sobre sujeto
/*
 * fn-sujeto.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
(function() {
    
    'use strict';

    // Formulario agregar sujeto
    $("#frm-sopa-sujeto, #frm-nuevo-sujeto").validate({
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
            agregarSujeto( "#" + $(form).attr('id') );
        }
    });
    /* --------------------------------------------------------- */
    // Formulario editar sujeto
    $("#frm_edit_sujeto").validate({
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
            editarSujeto( "#" + $(form).attr('id') );
        }
    });

    /* Inits */
    /* --------------------------------------------------------- */
    $("#tabla_sujetos").on( "click", ".elim_sujeto", function(){
        // Evento invocador de ventana modal para confirmar la eliminación de sujeto
        $("#id-sujeto-e").val( $(this).attr( "data-ids" ) );
        iniciarBotonBorrarSujeto();
    });

    $(document).on( 'click', '#btn_borrar_sujeto', function(){
        $("#btn_canc").click();
        eliminarSujeto( $("#id-sujeto-e").val() );
    });

    $("#lsujetos").on( 'change', function(){
        mostrarSelObj();
    });
    /* --------------------------------------------------------- */

}).apply( this, [ jQuery ]);

/* --------------------------------------------------------- */
function mostrarSelObj(){
    $("#agg_objeto").fadeIn(300);
}
/* --------------------------------------------------------- */
function agregarSujetoALista( res ){
    agregarElementoLista( "#lsujetos", res.reg );
    mostrarSelObj();
}
/* --------------------------------------------------------- */
function bloquearListasAreaSujeto(){
    $("#lareas").prop('disabled', true );
    $("#lsujetos").prop( 'disabled', true );
    $("#agg_objeto, #agg-s-o").show();
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarSujeto(){
    //Asigna los textos de la ventana de confirmación para borrar un sujeto
    iniciarVentanaModal( "btn_borrar_sujeto", "btn_canc", 
                         "Eliminar sujeto", 
                         "¿Confirma que desea eliminar sujeto", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function agregarSujeto( frm ){
	//Invoca al servidor para agregar nuevo sujeto
	var frm_asuj = $(frm).serialize();
	var espera = "<img src='img/loading.gif' width='60'>";
	
	$.ajax({
        type:"POST",
        url:"database/data-sujeto.php",
        data:{ nsujeto: frm_asuj, frm_o: frm },
        beforeSend: function() {
        	$("#response-reg").html( espera );
        },
        success: function( response ){
        	console.log( response );
        	res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                notificar( "Sujeto", res.mje, "success" );
                if( frm == "#frm-sopa-sujeto" ){
                    agregarSujetoALista( res );
                }
                if( frm == "#frm-nuevo-sujeto" ){ location.reload(); }
            }

            if( res.exito == -2 ){
                if( frm == "#frm-sopa-sujeto" ){
                    notificar( "Sujeto", res.mje, "warning" );
                    agregarSujetoALista( res );
                }
                if( frm == "#frm-nuevo-sujeto" ){ notificar( "Sujeto", res.mje + frm, "error" ); }
            }

            if( res.exito == -1 ){
                notificar( "Sujeto", res.mje, "error" );
            }

            $("#cl_frm-sujeto").click();
        }
    });
}
/* --------------------------------------------------------- */
function editarSujeto( frm ){
    //Invoca al servidor para editar datos de área
    var frm_es = $(frm).serialize();
    var espera = "<img src='img/loading.gif' width='60'>";
    
    $.ajax({
        type:"POST",
        url:"database/data-sujeto.php",
        data:{ edit_sujeto: frm_es },
        beforeSend: function() {
            $("#response-reg").html( espera );
        },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                notificar( "Sujeto", res.mje, "success" );
                setTimeout( function() { window.location = "sujetos.php"; }, 3000 );
            }
            else
                notificar( "Sujeto", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
function eliminarSujeto( id ){
    //Invoca al servidor para eliminar sujeto
    $.ajax({
        type:"POST",
        url:"database/data-sujeto.php",
        data:{ elim_sujeto: id },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Sujetos", res.mje, "success" );
                setTimeout( function() { window.location = "sujetos.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Eliminar sujeto", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */