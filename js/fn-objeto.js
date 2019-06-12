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
    $( "#frm-sopa-objeto, #frm-nuevo-objeto" ).validate({
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
            agregarObjeto( "#" + $(form).attr('id') );
        }
    });
    /* --------------------------------------------------------- */
    // Formulario editar objeto
    $("#frm_edit_objeto").validate({
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
            editarObjeto( "#" + $(form).attr('id') );
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
        eliminarArea( $("#id-area-e").val() );
    });

    $("#lobjetos").on( 'change', function(){
        aggS_O();
    });
    /* --------------------------------------------------------- */

}).apply( this, [ jQuery ]);

/* --------------------------------------------------------- */
function aggS_O(){
    $("#agg-s-o").fadeIn(300);
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
function agregarObjeto( frm ){
	//Invoca al servidor para agregar nuevo objeto
	var frm_aobj = $( frm ).serialize();
    var id_s = $('#id_s').val();
	var espera = "<img src='img/loading.gif' width='60'>";
	
	$.ajax({
        type:"POST",
        url:"database/data-objeto.php",
        data:{ nobjeto: frm_aobj },
        beforeSend: function() {
        	$("#response-reg").html( espera );
        },
        success: function( response ){
        	console.log( response );
        	res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                if( frm == "#frm-sopa-objeto" ){
                    notificar( "Objeto", res.mje, "success" );
                    agregarElementoLista( "#lobjetos", res.reg );
                    aggS_O();
                }
                if( frm == "#frm-nuevo-objeto" ){ location.reload(); }
            }else
                notificar( "Objeto", res.mje, "error" );

            $("#cl_frm-objeto").click();
        }
    });
}
/* --------------------------------------------------------- */
function editarObjeto( frm ){
    //Invoca al servidor para editar datos de área
    var frm_eo = $(frm).serialize();
    var espera = "<img src='img/loading.gif' width='60'>";
    
    $.ajax({
        type:"POST",
        url:"database/data-objeto.php",
        data:{ edit_objeto: frm_eo },
        beforeSend: function() {
            $("#response-reg").html( espera );
        },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                notificar( "Objeto", res.mje, "success" );
                setTimeout( function() { window.location = "objetos.php"; }, 3000 );
            }
            else
                notificar( "Objeto", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
function eliminarArea( id ){
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