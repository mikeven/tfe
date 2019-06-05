// Funciones sobre objeto
/*
 * fn-objeto.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
(function() {
    
    'use strict';

    // Formulario agregar sujeto-objeto
    $("#frm_sujeto_objeto").validate({
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
            agregarSujetoObjeto();
        }
    });
    /* --------------------------------------------------------- */
    /* Inits */
    /* --------------------------------------------------------- */
    $(".frm_np").on( "click", function(){
        // Evento invocador de ventana modal para confirmar la eliminación de propósito
        alert("NP");//$("#fire_np").click();
    });

    /* --------------------------------------------------------- */

}).apply( this, [ jQuery ]);

/* --------------------------------------------------------- */
function iniciarBotonBorrarProposito(){
    //Asigna los textos de la ventana de confirmación para borrar un propósito
    iniciarVentanaModal( "btn_borrar_area", "btn_canc", 
                         "Eliminar área", 
                         "¿Confirma que desea eliminar área", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function agregarSujetoObjeto(){
    //Invoca al servidor para agregar nuevo registro sujeto - objeto
    var frm_nso = $('#frm_sujeto_objeto').serialize();
    var espera = "<img src='img/loading.gif' width='60'>";
    
    $.ajax({
        type:"POST",
        url:"database/data-sujeto-objeto.php",
        data:{ n_sub_obj: frm_nso },
        beforeSend: function() {
            $("#response-reg").html( espera );
        },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            if( res.exito == 1 )
                enviarRespuesta( res, "redireccion", "cargar-sopa.php?s=" + res.idss );
            else
                notificar( "S.O.P.A.", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */