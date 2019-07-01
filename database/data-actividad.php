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
?>