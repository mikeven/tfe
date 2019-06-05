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
    $("#frm-nsujeto").validate({
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
            agregarSujeto( '#frm-nsujeto' );
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
            editarSujeto();
        }
    });

    /* Inits */
    /* --------------------------------------------------------- */
    $("#tabla_areas").on( "click", ".elim_area", function(){
        // Evento invocador de ventana modal para confirmar la eliminación de área
        $("#id-area-e").val( $(this).attr( "data-ida" ) );
        iniciarBotonBorrarArea();
    });

    $(document).on( 'click', '#btn_borrar_area', function(){
        $("#btn_canc").click();
        eliminarSujeto( $("#id-area-e").val() );
    });

    $("#lsujetos").on( 'change', function(){
        aggObj();
    });
    /* --------------------------------------------------------- */

}).apply( this, [ jQuery ]);

/* --------------------------------------------------------- */
function aggObj(){
    $("#agg_objeto").fadeIn(300);
}
/* --------------------------------------------------------- */
function bloquearListasAreaSujeto(){
    $("#lareas").prop('disabled', true );
    $("#lsujetos").prop( 'disabled', true );
    $("#agg_objeto, #agg-s-o").show();
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarArea(){
    //Asigna los textos de la ventana de confirmación para borrar un área
    iniciarVentanaModal( "btn_borrar_area", "btn_canc", 
                         "Eliminar área", 
                         "¿Confirma que desea eliminar área", 
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
        data:{ nsujeto: frm_asuj },
        beforeSend: function() {
        	$("#response-reg").html( espera );
        },
        success: function( response ){
        	console.log( response );
        	res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                if( frm == "#frm-nsujeto" ){
                    notificar( "Sujeto", res.mje, "success" );
                    agregarElementoLista( "#lsujetos", res.reg );
                    aggObj();
                }
            }else
                notificar( "Sujeto", res.mje, "error" );

            $("#cl_frm-sujeto").click();
        }
    });
}
/* --------------------------------------------------------- */
function editarSujeto(){
    //Invoca al servidor para editar datos de área
    var frm_ea = $('#frm_edit_area').serialize();
    var espera = "<img src='img/loading.gif' width='60'>";
    
    $.ajax({
        type:"POST",
        url:"database/data-area.php",
        data:{ earea: frm_ea },
        beforeSend: function() {
            $("#response-reg").html( espera );
        },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                notificar( "Área", res.mje, "success" );
                setTimeout( function() { window.location = "areas.php"; }, 3000 );
            }
            else
                notificar( "Área", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
function eliminarSujeto( id ){
    //Invoca al servidor para eliminar área
    $.ajax({
        type:"POST",
        url:"database/data-area.php",
        data:{ elim_area: id },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Área", res.mje, "success" );
                setTimeout( function() { window.location = "areas.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Eliminar área", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */