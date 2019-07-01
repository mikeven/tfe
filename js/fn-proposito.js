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
    $("#frm-editproposito").validate({
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
    $("#arbol_opa").on( "click", ".elim_prop", function(){
        // Evento de ventana modal para confirmar la eliminación de propósito
        $("#id-proposito-e").val( $(this).attr( "data-idp" ) );
        var p = $(this).attr( "data-desc" );
        iniciarBotonBorrarProposito( p );
    });
    /* --------------------------------------------------------- */
    $(document).on( 'click', '#btn_borrar_proposito', function(){
        $("#btn_canc").click();
        eliminarProposito( $("#id-proposito-e").val() );
    });
    /* --------------------------------------------------------- */
    $(".btn_nprop").on( "click", function(){
        // Evento invocador para asignar id de sujeto-objeto en formulario de nuevo propósito
        var iso = $(this).attr( "data-iso" );
        var nombre_suj_obj = $(this).attr( "data-n-so" );
        $( "#id_prop_so" ).val( iso );
        $( "#lab_np_obj" ).html( nombre_suj_obj );
    });
    /* --------------------------------------------------------- */
    $('#treeBasic').on('select_node.jstree', function (e, data) {
        if (data.node.children.length > 0) {
            $('#treeBasic').jstree(true).deselect_node(data.node);                    
            $('#treeBasic').jstree(true).toggle_node(data.node);                    
        }
    })
    /* --------------------------------------------------------- */
    $(".i_edit_prop").on( "click", function(){
        // Evento invocador para mostrar los datos de propósito a editar 
        // (panel_opa.php)
        $("#id_edit_prop").val( $(this).attr( "data-idp" ) );
        $("#desc_edit_prop").val( $(this).attr( "data-desc" ) );
    });
    /* --------------------------------------------------------- */

}).apply( this, [ jQuery ]);

/* --------------------------------------------------------- */
function iniciarBotonBorrarProposito( param ){
    //Asigna los textos de la ventana de confirmación para borrar un propósito
    iniciarVentanaModal( "btn_borrar_proposito", "btn_canc", 
                         "Eliminar " + param, 
                         "¿Confirma que desea eliminar propósito?", 
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
    var frm_ep = $('#frm-editproposito').serialize();
    var espera = "<img src='img/loading.gif' width='60'>";
    
    $.ajax({
        type:"POST",
        url:"database/data-proposito.php",
        data:{ edit_prop: frm_ep },
        beforeSend: function() {
            $("#response-reg").html( espera );
        },
        success: function( response ){
            res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                notificar( "S.O.P.A.", res.mje, "success" );
                setTimeout( function() { location.reload( true ); }, 3000 );
            }
            else
                notificar( "S.O.P.A.", res.mje, "error" );

            $("#cl_frm-edit_prop").click();
        }
    });
}
/* --------------------------------------------------------- */
function eliminarProposito( id ){
    //Invoca al servidor para eliminar propósito
    $.ajax({
        type:"POST",
        url:"database/data-proposito.php",
        data:{ elim_proposito: id },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "S.O.P.A.", res.mje, "success" );
                setTimeout( function() { location.reload( true ); }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "S.O.P.A.", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */