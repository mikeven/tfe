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
		$q = "select act.id, act.tipo, act.tarea, act.lugar, act.direccion, 
		act.motivo, act.contacto, date_format(act.creado,'%d/%m/%Y') as fregistro, 
		p.descripcion as proposito from actividad act, proposito p 
		where act.proposito_id = p.id and act.id = $id";

		$rst = mysqli_query( $dbh, $q );
		$data = mysqli_fetch_array( $rst );

		return $data;
	}
	/* --------------------------------------------------------- */
	function agregarActividad( $dbh, $a ){
		// Procesa el registro de nueva área
		$q = "insert into actividad ( tipo, tarea, lugar, direccion, motivo, contacto, 
		creado, proposito_id ) values ('$a[tipo]', '$a[tarea]', '$a[lugar]', 
		'$a[direccion]', '$a[motivo]', '$a[contacto]', NOW(), $a[id_prop_act] )";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function editarActividad( $dbh, $a ){
		//Elimina un registro de área
		$q = "update actividad set tipo = '$a[tipo]' where id = $a[id]";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	function eliminarActividad( $dbh, $id ){
		//Elimina un registro de área
		$q = "delete from actividad where id = $id";
		return mysqli_query( $dbh, $q );
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
			$res["exito"] = 1;
			$res["mje"] = "Error al registrar actividad";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["edit_actividad"] ) ){ 
		// Editar área Invocación desde: js/fn-area.js
		include( "bd.php" );
		include( "data-sistema.php" );

		parse_str( $_POST["edit_area"], $area );
		$area = escaparCampos( $dbh, $area );
		
		if( nombreDisponible( $dbh, "area", "nombre", $area["nombre"], $area["id"], "" ) ){
			$rsp = editarArea( $dbh, $area );
			if( $rsp != 0 ){
				$res["exito"] = 1;
				$res["mje"] = "Datos de área modificados";
			}else{
				$res["exito"] = 0;
				$res["mje"] = "Error al modificar área";
			}
		}
		else{ 
			$rsp = -2;
			$res["mje"] = "Nombre de área ya registrado";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["elim_actividad"] ) ){
		// Invocación desde: js/fn-area.js
		include( "bd.php" );	
		//include( "data-sistema.php" );
		
		//registrosAsociadosLinea( $dbh, $_POST["id_elimlinea"] )
		if( false ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar registros asociados al área primero.";
		}else{
			eliminarArea( $dbh, $_POST["elim_area"] );
			$res["exito"] = 1;
			$res["mje"] = "Área eliminada con éxito";
		}
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
?>