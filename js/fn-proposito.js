// Funciones sobre objeto
/*
 * fn-objeto.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
(function() {
    
    'use strict';

    // Formulario agregar objeto
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
            agregarProposito();
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
    $(".frm_np").on( "click", function(){
        // Evento invocador de ventana modal para confirmar la eliminación de propósito
        alert("NP");//$("#fire_np").click();
    });

    $('#treeBasic').on('select_node.jstree', function (e, data) {
            if (data.node.children.length > 0) {
                $('#treeBasic').jstree(true).deselect_node(data.node);                    
                $('#treeBasic').jstree(true).toggle_node(data.node);                    
            }
        })
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
function agregarProposito(){
	//Invoca al servidor para agregar nuevo propósito
	var frm_aobj = $('#frm_sujeto_objeto').serialize();
	var espera = "<img src='img/loading.gif' width='60'>";
	
	$.ajax({
        type:"POST",
        url:"database/data-objeto.php",
        data:{ nobjeto: frm_aobj, ids: id_s },
        beforeSend: function() {
        	$("#response-reg").html( espera );
        },
        success: function( response ){
        	console.log( response );
        	res = jQuery.parseJSON( response );
            if( res.exito == 1 )
                enviarRespuesta( res, "redireccion", "cargar-sopa.php?id_s=" + res.reg.id );
            else
                notificar( "Área", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
function editarProposito(){
    //Invoca al servidor para editar datos de propósito
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
function eliminarProposito( id ){
    //Invoca al servidor para eliminar propósito
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