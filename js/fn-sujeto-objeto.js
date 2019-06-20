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
    $("#lareas").on( "change", function(){
        // Evento para invocar el llenado de la lista de sujetos según área seleccionada
        var idarea = $(this).val();
        obtenerSubjetosPorArea( idarea );
    });
    /* --------------------------------------------------------- */
    $("#lsujetos").on( "change", function(){
        // Evento para invocar el llenado de la lista de objetos según sujeto seleccionado
        var idsujeto = $(this).val();
        obtenerObjetosPorSujeto( idsujeto );
    });
    /* --------------------------------------------------------- */

}).apply( this, [ jQuery ]);

/* --------------------------------------------------------- */
function cargarOpcionesLista( regs, idlista ){
    // Carga una lista desplegable con valores de registros

    var lista = "";
    $( idlista ).html("");
    lista = "<option value></option>";
    $.each( regs, function( i, v ) {
        lista += "<option value=" + v.id + ">" + v.nombre + "</option>"; 
    });

    $( lista ).appendTo( idlista );
}
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
function obtenerSubjetosPorArea( ida ){
    //Invoca al servidor para obtener sujetos asociados a un área
    
    var espera = "<img src='img/loading.gif' width='60'>";
    $.ajax({
        type:"POST",
        url:"database/data-sujeto-objeto.php",
        data:{ sujetos_area: ida },
        beforeSend: function() {
            $("#response-reg").html( espera );
        },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            cargarOpcionesLista( res, "#lsujetos" );
        }
    });
}
/* --------------------------------------------------------- */
function obtenerObjetosPorSujeto( ids ){
    //Invoca al servidor para obtener objetos asociados a un sujeto
    
    var espera = "<img src='img/loading.gif' width='60'>";
    $.ajax({
        type:"POST",
        url:"database/data-sujeto-objeto.php",
        data:{ objetos_sujetos: ids },
        beforeSend: function() {
            $("#response-reg").html( espera );
        },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            cargarOpcionesLista( res, "#lobjetos" );
        }
    });
}
/* --------------------------------------------------------- */