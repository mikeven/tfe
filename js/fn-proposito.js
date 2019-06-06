// Funciones sobre propósitos
/*
 * fn-proposito.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
(function() {
    
    'use strict';

    // Formulario agregar propósito
    $("#frm-nproposito").validate({
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
    $(".btn_nprop").on( "click", function(){
        // Evento invocador para asignar id de sujeto-objeto en formulario de nuevo propósito
        var iso = $(this).attr( "data-iso" );
        var nombre_suj_obj = $(this).attr( "data-n-so" );
        $( "#id_prop_so" ).val( iso );
        $( "#lab_np_obj" ).html( nombre_suj_obj );
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
    //Invoca al servidor para agregar nuevo registro sujeto - objeto
    var frm_nprop = $('#frm-nproposito').serialize();
    var espera = "<img src='img/loading.gif' width='60'>";
    
    $.ajax({
        type:"POST",
        url:"database/data-proposito.php",
        data:{ nproposito: frm_nprop },
        beforeSend: function() {
            $("#response-reg").html( espera );
        },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            if( res.exito == 1 )
                location.reload( true );
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