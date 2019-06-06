// Funciones sobre elementos de interfaz gráfica de usuario
/*
 * fn-ui.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
function notificar( titulo, mensaje, tipo ){
	//Muestra una notificación: 

	var notice = new PNotify({
		title: titulo,
		text: mensaje,
		type: tipo,
		cornerclass: 'ui-pnotify-sharp',
		hide: true,
		buttons: {
			closer: false,
			sticker: false
		}
	});

	notice.get().click(function() {
		notice.remove();
	});
}
/* --------------------------------------------------------- */
function ventanaMensaje( exito, mensaje, enlace ){
	var clase_m = ["modal-danger", "modal-success"];
	if( exito == '1' )
		$("#tx-vmsj").html( enlace );
		
	$("#ventana_mensaje").addClass( clase_m[exito] );
	$("#tit_vmsj").html( mensaje );
	$("#enl_vmsj").click();
}
/* --------------------------------------------------------- */
function agregarElementoLista( lista, elem ){

	var o = new Option( elem.nombre, elem.id );
	$(o).html( elem.nombre );
	$( lista ).append(o);
	$(lista).select2('destroy');
	$( lista + ' option' ).filter(function() { 
	    return ($(this).text() == elem.nombre); //To select Blue
	}).prop('selected', true);
	$(lista).select2();
}
/* --------------------------------------------------------- */
function isNumberKey(evt){
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if ( charCode != 46 && charCode > 31 && ( charCode < 48 || charCode > 57 ))
		return false;
	return true;
}
/* --------------------------------------------------------- */
function isIntegerKey(evt){
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if ( charCode < 48 || charCode > 57 )
		return false;
	return true;
}
/* --------------------------------------------------------- */
function alertaMensaje( exito, mensaje ){
	
	var clase_m = ["alert-danger", "alert-success"];
		
	$("#resalerta").addClass( clase_m[exito] );
	$("#txmjealerta").html( mensaje );
	$("#resalerta").fadeIn("slow");
}
/* --------------------------------------------------------- */
function alertaMensajeBoton( exito, mensaje, enlace, tx_boton ){
	
	var clase_m = ["alert-danger", "alert-success"];	
	$("#resalerta_bot").addClass( clase_m[exito] );
	$("#tx_alerta_bot").html( mensaje );
	$("#lnk_bot").attr( "href", enlace );
	$("#tx_bot").html( tx_boton );
	$("#resalerta_bot").fadeIn("slow");
}
/* --------------------------------------------------------- */
function resetFrm( frm ){
	$( frm + " input" ).each(function() { $(this).val(""); 	});
}
/* --------------------------------------------------------- */
function marcarCampo( campo, error ){
	if( error == 1 )
		campo.css({'border-color' : '#dd4b39'});
	if( error == 0 )
		campo.css({'border-color' : '#ccc'});
}
/* --------------------------------------------------------- */
function enviarRespuesta( res, modo, url ){
	//Manejo de respuesta de acuerdo al modo indicado
	if( modo == "ventana" ){
		ventanaMensaje( res.exito, res.mje );
	}
	
	if( modo == "redireccion" ){
		window.location.href = url;
	}

	if( modo == "print" ){
		alertaMensaje( res.exito, res.mje );
	}
}
/* --------------------------------------------------------- */
function enviarRespuestaServidor( res, modo, idhtml, url_dest ){
	//Manejo de respuesta de acuerdo al modo indicado
	if( modo == "ventana" ){		//Muestra la respuesta en una ventana emergente
		ventanaMensaje( res.exito, res.mje );
	}
	if( modo == "redireccion" ){	//Redirige a una ubicación dada por url
		var url = url_dest + res.registro.id;
		window.location.href = url;
	}
	if( modo == "print" ){			//Muestra la respuesta dentro de una etiqueta indicada
		alertaMensaje( res.exito, res.mje );
	}
}
/* --------------------------------------------------------- */
function arrayMjes( modo ){
	//
	var amensajes = [], modalmje = [], alertmje = [];
	
	modalmje["idhtml"] = "#win-resp-msg";
	modalmje["titulo"] = "#titulo_msg";
	modalmje["mensaje"] = "#texto_msg";
	
	alertmje["idhtml"] = "#resalerta";
	alertmje["titulo"] = "#tresalerta";
	alertmje["mensaje"] = "#txmjealerta";
	alertmje["clase"] = "alert-danger";

	amensajes["modal"] = modalmje;
	amensajes["alerta"] = alertmje;

	return amensajes[modo];
}
/* --------------------------------------------------------- */
/* Ventana modal */
function iniciarVentanaModal( idok, idcanc, enc, texto, tx_btnok ){
	//Asigna valores a los elementos que conforman la ventana modal para mostrar mensaje de confirmación de acción

	$(".btn-ok").attr( "id", idok );						//Asigna id al botón de confirmación
	$(".btn-ok").html( tx_btnok );							//Texto botón confirmación de acción
	$(".btn-canc").attr( "id", idcanc );					//Asigna id al botón de cancelar
    $("#titulo_modal h4").html( enc );						//Título de la ventana
    $("#confirmar-accion .modal-text p").html( texto );		//Cuerpo del mensaje
}
/*=====================================================================================*/
$( document ).ready(function() {
	
	$(".close-alt").on( "click", function() {
		$("#" + $(this).attr("data-target") ).hide('slow');	
	});    
});
/* --------------------------------------------------------- */