<?php
	/* --------------------------------------------------------- */
	/* TFE Life Planner - Acceso a actividades */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function obtenerTodasActividades( $dbh, $idu ){
		// Devuelve todos los registros de actividades de un propósito
		$q = "select * from actividad where proposito_id = $idp";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerListaActividades( $dbh, $idp ){
		// Devuelve todos los registros de actividades de un propósito
		$q = "select * from actividad where proposito_id = $idp";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerActividadPorId( $dbh, $id ){
		// Devuelve el registro de un área dado su id
		$q = "select act.id, act.tipo, act.estado, act.tarea, act.lugar, act.direccion, 
		act.motivo, act.contacto, date_format(act.creado,'%d/%m/%Y') as fregistro, 
		p.id as idprop, p.descripcion as proposito from actividad act, proposito p 
		where act.proposito_id = p.id and act.id = $id";

		$rst = mysqli_query( $dbh, $q );
		$data = mysqli_fetch_array( $rst );

		return $data;
	}
	/* --------------------------------------------------------- */
	function obtenerPrioridades( $dbh, $idu ){
		// Devuelve las actividades marcadas con prioridad

		$q = "select act.id as id_act, act.tipo, act.estado, act.tarea, act.lugar, act.direccion, 
		act.motivo, act.contacto,   
		date_format(act.fecha_prioridad,'%d/%m/%Y %h:%i %p') as tprioridad, 
		s.id as idsujeto, s.nombre nsujeto, o.id as idobjeto, o.nombre as nobjeto 
		from actividad act, proposito p, sujeto s, objeto o, sujeto_objeto so, sesion ss 
		where act.proposito_id = p.id and act.estado = 'prioridad' and p.sujeto_objeto_id = so.id 
		and so.sujeto_id = s.id and so.objeto_id = o.id and so.sesion_id = ss.id and ss.usuario_id = $idu 
		order by act.fecha_prioridad ASC";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerActividadesAgendadas( $dbh, $idu ){
		// Devuelve las actividades agendadas en calendario

		$q = "select act.id as id_act, act.tipo, act.estado, act.tarea, act.lugar, act.direccion, 
		act.motivo, act.contacto,   
		date_format(act.fecha_agenda,'%d/%m/%Y %h:%i %p') as fecha_agendada,
		date_format(act.fecha_calendario,'%Y-%m-%d') as fecha_calendario, 
		s.id as idsujeto, s.nombre nsujeto, o.id as idobjeto, o.nombre as nobjeto 
		from actividad act, proposito p, sujeto s, objeto o, sujeto_objeto so, sesion ss 
		where act.proposito_id = p.id and act.estado = 'agendada' and p.sujeto_objeto_id = so.id 
		and so.sujeto_id = s.id and so.objeto_id = o.id and so.sesion_id = ss.id and ss.usuario_id = $idu 
		order by act.fecha_prioridad ASC";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function agregarActividad( $dbh, $a ){
		// Procesa el registro de nueva actividad
		$estado = "creada";
		$q = "insert into actividad ( tipo, estado, tarea, lugar, direccion, motivo, contacto, 
		creado, proposito_id ) values ('$a[tipo]', '$estado', '$a[tarea]', '$a[lugar]', 
		'$a[direccion]', '$a[motivo]', '$a[contacto]', NOW(), $a[id_prop_act] )";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function editarActividad( $dbh, $a ){
		// Edita un registro de actividad
		$q = "update actividad set tipo = '$a[tipo]', tarea = '$a[eatarea]', 
		lugar = '$a[ealugar]', direccion = '$a[eadireccion]', motivo = '$a[eamotivo]', 
		contacto = '$a[eacontacto]', modificado = NOW() where id = $a[id_eact]";
		
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	function asignarPrioridad( $dbh, $actividad ){
		// Edita un registro de actividad para actualizar su valor de prioridad
		$q = "update actividad set estado = '$actividad[estado]', 
		fecha_prioridad = $actividad[fecha_p] where id = $actividad[id]";
		
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	function agendarPrioridad( $dbh, $actividad ){
		// Edita un registro de actividad para asignar fecha en calendario
		$q = "update actividad set estado = '$actividad[estado]', 
		fecha_agenda = NOW(), fecha_calendario = '$actividad[fecha_cal]' 
		where id = $actividad[id_actividad]";
		
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	function eliminarActividad( $dbh, $id ){
		// Elimina un registro de actividad
		$q = "delete from actividad where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	function limpiarCamposTipoActividad( $actividad ){
		// Elimina el contenido de los campos de actividad según tipo
		if( $actividad["tipo"] == "g" ){
			$actividad["eamotivo"] = $actividad["eacontacto"] = "";
		}
		if( $actividad["tipo"] == "e" ){
			$actividad["eamotivo"] = $actividad["eacontacto"] = "";
			$actividad["ealugar"] = $actividad["eadireccion"] = "";
		}
		if( $actividad["tipo"] == "l" ){
			$actividad["ealugar"] = $actividad["eatarea"] = $actividad["eadireccion"] = "";
		}

		return $actividad;
	}
	/* --------------------------------------------------------- */
	function obtenerDataPrioridad( $ida, $accion ){
		// Devuelve los datos para la asignación de prioridad en una actividad
		
		$actividad["id"] = $ida; 
		if( $accion == "dar_p" ){
			$actividad["estado"] = "prioridad";
			$actividad["fecha_p"] = "NOW()";
		}
		if( $accion == "quitar_p" ){
			$actividad["estado"] = "creada";
			$actividad["fecha_p"] = "NULL";
		}
		return $actividad;
	}
	/* --------------------------------------------------------- */
	function titActividad( $actividad ){
      // Devuelve el texto descriptivo de una actividad según tipo
      $texto = array(
        'g' => $actividad["tarea"],
        'e' => $actividad["tarea"],
        'l' => $actividad["contacto"]." ($actividad[motivo])"
      );

      return $texto[ $actividad["tipo"] ];
    }
	/* --------------------------------------------------------- */
    function colorActividad( $actividad ){
      // Devuelve el texto descriptivo de una actividad según tipo
      $color = array(
        'g' => '#47a447',
        'e' => '#d2322d',
        'l' => '#ed9c28'
      );

      return $color[ $actividad["tipo"] ];
    }
	/* --------------------------------------------------------- */
	if( isset( $_POST["nactividad"] ) ){ 
		// Invocación desde: js/fn-actividad.js
		include( "bd.php" );

		parse_str( $_POST["nactividad"], $actividad );
		$actividad = escaparCampos( $dbh, $actividad );
		
		$rsp = agregarActividad( $dbh, $actividad );
		if( $rsp != 0 ){
			$res["exito"] = 1;
			$res["mje"] = "Actividad registrada con éxito";
		}else{
			$res["exito"] = -1;
			$res["mje"] = "Error al registrar actividad";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["edit_act"] ) ){ 
		// Invocación desde: js/fn-actividad.js
		include( "bd.php" );

		parse_str( $_POST["edit_act"], $actividad );
		$actividad = escaparCampos( $dbh, $actividad );
		$actividad = limpiarCamposTipoActividad( $actividad );

		$rsp = editarActividad( $dbh, $actividad );
		
		if( $rsp == 1 ){
			$res["exito"] = 1;
			$res["mje"] = "Actividad editada con éxito";
		}else{
			$res["exito"] = -1;
			$res["mje"] = "Error al editar actividad";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["mostrar_act"] ) ){ 
		// Invocación desde: js/fn-actividad.js
		include( "bd.php" );

		$ida = $_POST["mostrar_act"];
		$actividad = obtenerActividadPorId( $dbh, $ida );
		
		if( $actividad != NULL ){
			$res["exito"] = 1;
			$res["reg"] = $actividad;
		}else{
			$res["exito"] = -1;
			$res["mje"] = "Error al obtener actividad";
		}
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */	
	if( isset( $_POST["elim_act"] ) ){ 
		// Invocación desde: js/fn-actividad.js
		include( "bd.php" );
		
		$rsp = eliminarActividad( $dbh, $_POST["elim_act"] );
		if( $rsp != 0 ){
			$res["exito"] = 1;
			$res["mje"] = "Actividad eliminada con éxito";
		}else{
			$res["exito"] = -1;
			$res["mje"] = "Error al eliminar actividad";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["prioridad"] ) ){ 
		// Invocación desde: js/fn-actividad.js
		include( "bd.php" );

		$ida = $_POST["prioridad"];
		$accion = $_POST["valor_a"];
		$actividad = obtenerDataPrioridad( $ida, $accion );
		
		$rsp = asignarPrioridad( $dbh, $actividad );
		if( $rsp == 1 ){
			$res["exito"] = 1;
			$res["mje"] = "Actividad actualizada";
		}else{
			$res["exito"] = -1;
			$res["mje"] = "Error al actualizar actividad";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["agendar_act"] ) ){ 
		// Invocación desde: js/fn-actividad.js
		include( "bd.php" );

		parse_str( $_POST["agendar_act"], $actividad );
		$actividad["estado"] = "agendada";
		$actividad["fecha_cal"] = cambiaf_a_mysql( $actividad["fecha_cal"] );
		
		$rsp = agendarPrioridad( $dbh, $actividad );
		if( $rsp == 1 ){
			$res["exito"] = 1;
			$res["mje"] = "Actividad migrada a calendario con éxito";
		}else{
			$res["exito"] = -1;
			$res["mje"] = "Error al agendar actividad";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["agendados"] ) ){
		// Invocación desde: js/fn-calendario.js
		include( "bd.php" );

		session_start();
		$e = array();
		$idu = $_SESSION["user"]["id"];
		$actividades = obtenerActividadesAgendadas( $dbh, $idu );
		$eventos = array();
		
		foreach ( $actividades as $a ) {
			
			$e['id'] = $a["id_act"];
	    	$e['title'] = titActividad( $a );
	    	$e['start'] = $a["fecha_calendario"];
	    	$e['allDay'] = true;
	    	$e['color'] = colorActividad( $a );

	    	array_push( $eventos, $e );
		}
		
	    echo json_encode( $eventos );
	}
?>