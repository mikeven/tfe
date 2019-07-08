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
    $("#frm-editactividad").validate({
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
            editarActividad();
        }
    });
    /* --------------------------------------------------------- */
    $("#frm-nagenda").validate({
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
            agendarActividad();
        }
    });
    /* --------------------------------------------------------- */
    $("#frm_edit_hora_act").validate({
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
            editarHoraActividad();
        }
    });
    /* --------------------------------------------------------- */
    /* Inits */
    /* --------------------------------------------------------- */
    $("#arbol_opa").on( "click", ".elim_actividad", function(){
        // Evento invocador de ventana modal para confirmar la eliminación de área
        $("#id-actividad-e").val( $(this).attr( "data-ida" ) );
        var p = $(this).attr("data-desc");
        iniciarBotonBorrarActividad( p );
    });

    $(document).on( 'click', '#btn_borrar_actividad', function(){
        $("#btn_canc").click();
        eliminarActividad( $("#id-actividad-e").val() );
    });

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
    $(".rnva_act").on( "click", function(){
        // Evento para mostrar los campos de actividad según tipo (crear actividad)
        $( ".campos_act" ).fadeOut();
        var clase_trg = $(this).attr( "data-tipo" );
        $( "." + clase_trg ).fadeIn( 300 );
    });
    /* --------------------------------------------------------- */
    $(".redit_act").on( "click", function(){
        // Muestra los campos de actividad según tipo (edición actividad)
        $( ".campos_edit_act" ).hide();
        var clase_trg = $(this).attr( "data-tipo" );
        $( "." + clase_trg ).fadeIn( 300 );
    });
    /* --------------------------------------------------------- */
    $(".sel_actprop").on( "click", function(){
        // Evento invocador para obtener los datos de una actividad seleccionada
        // panel_propositos_so.php 
        
        var ida = $(this).attr("data-ida");
        $("#tx_prop_act").html( $(this).attr("data-prop") );
        mostrarActividad( ida, "panel" );
    });
    /* --------------------------------------------------------- */
    $(".i_edit_act").on( "click", function(){
        // Evento invocador para obtener los datos de una actividad 
        // seleccionada y abrir formulario para editarla (panel_opa.php)
        $( ".campos_edit_act" ).hide();
        $( ".campos_edit_act :text" ).val("");
        var ida = $(this).attr("data-ida");
        mostrarActividad( ida, "edit" );
    });
    /* --------------------------------------------------------- */
    $(".btn_priord").on( "click", function(){
        // Evento invocador para dar / quitar prioridad a una actividad 
        // (panel_actividades_proposito.php)
        var ida = $(this).attr("data-ida");
        var acc = $(this).attr("id");

        asignarPrioridadActividad( ida, acc );
    });
    /* --------------------------------------------------------- */
    $(".act_prior_cal").on( "click", function(){
        // Evento invocador mostrar el formulario para agendar una actividad de prioridad
        // (prioridades.php)
        var ida = $(this).attr("data-ida");
        var data = $(this).attr("data-desc");
        $("#id_actividad_cal").val( ida );
        $("#info_actividad").html( data );
    });
    /* --------------------------------------------------------- */
    $("#cnf_edithora").on( "click", function(){
        // Evento invocador para editar hora de una actividad en calendario
        var id = $("#ida_nvahora").val();
        var f = $("#fecha_act_cal").val();
        var h = $("#nueva_hora").val();
        var nueva_fecha = f + " " + h;
        $("#cl_data_desag_act").click();
        
        reasignarFechaActividad( id, nueva_fecha, "hora" );    
    });
    /* --------------------------------------------------------- */
}).apply( this, [ jQuery ]);

/* --------------------------------------------------------- */
function infoActividad( actividad ){
    // Devuelve los datos de actividad según tipo
    $(".data_act_info").hide();
    $("#tx_prop_act").html( actividad.proposito );
    if( actividad.tipo == 'g' ){
        $("#act_lugar").html( actividad.lugar );
        $("#act_dir").html( actividad.direccion );
        $("#act_tarea_g").html( actividad.tarea );
    }
    if( actividad.tipo == 'e' ){
        $("#act_tarea_e").html( actividad.tarea );
    }
    if( actividad.tipo == 'l' ){
        $("#act_motivo").html( actividad.motivo );
        $("#act_contacto").html( actividad.contacto );
    }   
}
/* --------------------------------------------------------- */
function resetClasePanelAct(){
    // Elimina el color del panel de actividades
    $("#panel_act_prop").removeClass( "panel-danger panel-warning panel-success");
    $("#icono_actividad").removeClass();
    $("#fecha_act_agenda").hide();
}
/* --------------------------------------------------------- */
function botonPrioridad( actividad ){
    // Muestra los elementos de prioridad de una actividad según estado
    $(".btn_priord, #act_prioridad, #act_agendada").hide();
    $(".btn_priord").attr( "data-ida", actividad.id ); 
    
    if( actividad.estado == "creada" ) $("#dar_p").show();
    
    if( actividad.estado == "prioridad" ) {
        $("#quitar_p").show(); 
        $("#act_prioridad").show();
    }

    if( actividad.estado == "agendada" ) {
        $("#act_agendada").show();
        $("#fecha_act_agenda").html( "<b>Fecha asignada: </b>" + actividad.fcalendario );
        $("#fecha_act_agenda").show();     
    }
}
/* --------------------------------------------------------- */
function actualizarBotonPrioridad( accion ){
    // Muestra el botón de prioridad según estado, posterior a una actualización
    $(".btn_priord").hide(); 
    if( accion == "dar_p" ){ $("#quitar_p").show(); $("#act_prioridad").fadeIn(); }
    if( accion == "quitar_p" ){ $("#dar_p").show(); $("#act_prioridad").fadeOut(); }
}
/* --------------------------------------------------------- */
function claseColorIconoAct( tipo ){
    // Devuelve la clase correspondiente a una actividad según su tipo     
}
/* --------------------------------------------------------- */
function claseColorAct( tipo ){
    // Devuelve el clase color correspondiente a una actividad según su tipo
    var color = {   "g" : "success",
                    "e" : "danger",
                    "l" : "warning" }; 
    return color[tipo];
}
/* --------------------------------------------------------- */
function iconoActividad( tipo ){
    // Devuelve la clase ícono correspondiente a una actividad según su tipo
    var iconos = {  "g" : "fa fa-automobile",
                    "e" : "fa fa-desktop",
                    "l" : "fa fa-phone" }; 
    return iconos[tipo];
}
/* --------------------------------------------------------- */
function etiquetaActividad( tipo ){
    // Devuelve la etiqueta del tipo de actvidad según su tipo
    var texto = {   "g" : "Gestión",
                    "e" : "Escritorio",
                    "l" : "Llamada" }; 
    return texto[tipo];
    }
/* --------------------------------------------------------- */
function mostrarDatosPanelActividad( actividad ){
    // Muestra los datos de una actividad seleccionada panel sujeto-objeto
    
    resetClasePanelAct();
    botonPrioridad( actividad );
    $("#tx_act").html( etiquetaActividad( actividad.tipo ) );
    $("#icono_actividad").addClass( iconoActividad( actividad.tipo ) );
    $("#panel_act_prop").addClass( "panel-" + claseColorAct( actividad.tipo ) );
    $("#panel_act_prop").show();
    infoActividad( actividad );
    $("#info-" + actividad.tipo ).show();
}
/* --------------------------------------------------------- */
function infoEditActividad( actividad ){
    // Muestra los datos de una actividad para su edición según tipo
    
    if( actividad.tipo == 'g' ){
        $(".ae_gestion").show();
        $("#gestion").prop('checked', true);
        $("#editlugar").val( actividad.lugar );
        $("#editdir").val( actividad.direccion );
        $("#edittarea").val( actividad.tarea );
    }
    if( actividad.tipo == 'e' ){
        $(".ae_escritorio").show();
        $("#escritorio").prop('checked', true);
        $("#edittarea").val( actividad.tarea );
    }
    if( actividad.tipo == 'l' ){
        $(".ae_llamada").show();
        $("#llamada").prop('checked', true);
        $("#editmotivo").val( actividad.motivo );
        $("#editcontacto").val( actividad.contacto );
    }
}
/* --------------------------------------------------------- */
function mostrarDatosEditActividad( actividad ){
    // Muestra los datos de una actividad para su edición
    $("#lab_ea_prop").html( actividad.proposito );
    $("#id_edit_act").val( actividad.id );
    infoEditActividad( actividad );
}
/* --------------------------------------------------------- */
function resetPanelDesagendar(){
    // Reinicia los elementos visuales para confirmar la remoción de una actividad del calendario
    $("#confirmacion_desagendar").hide();
    $("#desagendar_act").show();
}
/* --------------------------------------------------------- */
function mostrarDatosVentanaCalendario( actividad ){
    // Muestra los datos de una actividad en la ventana emergente de calendario
    resetPanelDesagendar();
    mostrarDatosPanelActividad( actividad );
}
/* --------------------------------------------------------- */
function iniciarBotonBorrarActividad( param ){
    //Asigna los textos de la ventana de confirmación para borrar un propósito
    iniciarVentanaModal( "btn_borrar_actividad", "btn_canc", 
                         "Eliminar " + param, 
                         "¿Confirma que desea eliminar actividad?", 
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
    var frm_edit = $('#frm-editactividad').serialize();
    var espera = "<img src='img/loading.gif' width='60'>";
    
    $.ajax({
        type:"POST",
        url:"database/data-actividad.php",
        data:{ edit_act: frm_edit },
        beforeSend: function() {
            $("#response-reg").html( espera );
        },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                notificar( "S.O.P.A.", res.mje, "success" );
                setTimeout( function() { location.reload( true ); }, 3000 );
            }
            else
                notificar( "S.O.P.A.", res.mje, "error" );

            $("#cl_frm-edit_act").click();
        }
    });
}
/* --------------------------------------------------------- */
function agendarActividad(){
    // Invoca al servidor para agendar una actividad de prioridad
    var frm_act = $("#frm-nagenda").serialize();

    $.ajax({
        type:"POST",
        url:"database/data-actividad.php",
        data:{ agendar_act: frm_act },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Actividad", res.mje, "success" );
                setTimeout( function() { location.reload( true ); }, 3000 );
            }
            if( res.exito == -1 ){ 
                notificar( "Actividad", res.mje, "error" );
            }

            $("#cl_frm_act_cal").click();
        }
    });   
}
/* --------------------------------------------------------- */
function eliminarActividad( id ){
    //Invoca al servidor para eliminar actividad
    $.ajax({
        type:"POST",
        url:"database/data-actividad.php",
        data:{ elim_act: id },
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
function mostrarActividad( id, dst ){
    //Invoca al servidor para obtener actividad por id
    $.ajax({
        type:"POST",
        url:"database/data-actividad.php",
        data:{ mostrar_act: id },
        success: function( response ){
            
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                if( dst == "panel" )
                    mostrarDatosPanelActividad( res.reg ); 
                if( dst == "edit" )
                    mostrarDatosEditActividad( res.reg );
                if( dst == "ventana_cal" )
                    mostrarDatosVentanaCalendario( res.reg ); 
            }
            if( res.exito == -1 ){ 
                
            }
        }
    });
}
/* --------------------------------------------------------- */
function asignarPrioridadActividad( id, accion ){
    //Invoca al servidor para asignar/quitar prioridad a una actividad
    $.ajax({
        type:"POST",
        url:"database/data-actividad.php",
        data:{ prioridad: id, valor_a: accion },
        success: function( response ){
            console.log(response);
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "S.O.P.A.", res.mje, "success" );
                actualizarBotonPrioridad( accion );
            }
            else{
                notificar( "S.O.P.A.", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function reasignarFechaActividad( id, nfecha, p ){
    //Invoca al servidor para actualizar fecha de una actividad agendada
    $.ajax({
        type:"POST",
        url:"database/data-actividad.php",
        data:{ id_act: id, nueva_fecha: nfecha },
        success: function( response ){
            console.log(response);
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Calendario", res.mje, "success" );
                if( p == 'hora'){
                    setTimeout( function() { location.reload( true ); }, 3000 );
                }
            }
            else{
                notificar( "Calendario", res.mje, "error" );
            }
        }
    });
}
/* --------------------------------------------------------- */
function desagendarActividad( id ){
    //Invoca al servidor para desagendar una actividad del calendario
    $.ajax({
        type:"POST",
        url:"database/data-actividad.php",
        data:{ desagendar: id },
        success: function( response ){
            console.log(response);
            res = jQuery.parseJSON(response);
            if( res.exito == 1 ){ 
                notificar( "Calendario", res.mje, "success" );
                setTimeout( function() { location.reload( true ); }, 3000 );
            }
            else{
                notificar( "Calendario", res.mje, "error" );
            }

            $("#cl_data_desag_act").click();
        }
    });
}
/* --------------------------------------------------------- */