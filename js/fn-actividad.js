// Funciones sobre actividades
/*
 * fn-actividad.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
(function() {
    
    'use strict';

    // Formulario agregar actividad
    $("#frm-nactividad").validate({
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
            agregarActividad();
        }
    });
    /* --------------------------------------------------------- */
    // Formulario editar propósito
    $("#frm_edit_proposito").validate({
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
            editarProposito();
        }
    });

    /* Inits */
    /* --------------------------------------------------------- */
    $(".btn_nactiv").on( "click", function(){
        // Evento invocador para asignar id de sujeto-objeto en formulario de nuevo propósito
        var form = $("#frm-nactividad");
        form[0].reset();

        var idp = $(this).attr( "data-idp" );
        var nombre_prop = $(this).attr( "data-np" );
        $( "#id_prop_act" ).val( idp );
        $( "#lab_na_prop" ).html( nombre_prop );
    });
    /* --------------------------------------------------------- */
    $(".radio-custom").on( "click", function(){
        // Evento invocador para mostrar los campos de actividad según tipo
        $( ".campos_act" ).fadeOut();
        var clase_trg = $(this).attr( "data-tipo" );
        $( "." + clase_trg ).fadeIn( 300 );
    });
    /* --------------------------------------------------------- */

}).apply( this, [ jQuery ]);

/* --------------------------------------------------------- */
function iniciarBotonBorrarActividad(){
    //Asigna los textos de la ventana de confirmación para borrar un propósito
    iniciarVentanaModal( "btn_borrar_area", "btn_canc", 
                         "Eliminar área", 
                         "¿Confirma que desea eliminar área", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function agregarActividad(){
    //Invoca al servidor para agregar nuevo registro de actividad
    var frm_nactiv = $('#frm-nactividad').serialize();

    var espera = "<img src='img/loading.gif' width='60'>";
    
    $.ajax({
        type:"POST",
        url:"database/data-actividad.php",
        data:{ nactividad: frm_nactiv },
        beforeSend: function() {
            $("#response-reg").html( espera );
        },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            if( res.exito == 1 )
                location.reload( true );
            else
                notificar( "Actividad", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
function editarActividad(){
    //Invoca al servidor para editar datos de actividad
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
function eliminarActividad( id ){
    //Invoca al servidor para eliminar actividad
    $.ajax({
        type:"POST",
        url:"database/data-area.php",
        data:{ elim_area: id },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Propósito", res.mje, "success" );
                setTimeout( function() { window.location = "areas.php"; }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Eliminar propósito", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */