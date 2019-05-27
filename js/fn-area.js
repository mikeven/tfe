// Funciones sobre áreas
/*
 * fn-area.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
(function() {
    
    'use strict';

    // Formulario de registro
    $("#frm_narea").validate({
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
            agregarArea();
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
    /* --------------------------------------------------------- */

}).apply( this, [ jQuery ]);

/* --------------------------------------------------------- */
function iniciarBotonBorrarArea(){
    //Asigna los textos de la ventana de confirmación para borrar un área
    iniciarVentanaModal( "btn_borrar_area", "btn_canc", 
                         "Eliminar área", 
                         "¿Confirma que desea eliminar área", 
                         "Confirmar acción" );
}
/* --------------------------------------------------------- */
function agregarArea(){
	//Invoca al servidor para agregar nueva área
	var frm_na = $('#frm_narea').serialize();
	var espera = "<img src='img/loading.gif' width='60'>";
	
	$.ajax({
        type:"POST",
        url:"database/data-area.php",
        data:{ narea: frm_na },
        beforeSend: function() {
        	$("#response-reg").html( espera );
        },
        success: function( response ){
        	console.log( response );
        	res = jQuery.parseJSON( response );
            if( res.exito == 1 )
                location.reload();
            else
                notificar( "Área", res.mje, "error" );
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