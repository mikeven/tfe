<?php
	/* --------------------------------------------------------- */
	/* TFE Life Planner - Acceso a áreas */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function obtenerListaAreas( $dbh, $idu ){
		// Devuelve todos los registros de áreas
		$q = "select * from area where usuario_id = $idu";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerAreaPorId( $dbh, $id ){
		// Devuelve el registro de un área dado su id
		$q = "select id, nombre, date_format(creado,'%d/%m/%Y') as fregistro 
		from area where id = $id";
		
		$rst = mysqli_query( $dbh, $q );
		$data = mysqli_fetch_array( $rst );

		return $data;
	}
	/* --------------------------------------------------------- */
	function agregarAreaUsuario( $dbh, $area ){
		// Procesa el registro de nueva área
		$q = "insert into area ( nombre, creado, usuario_id ) values 
		('$area[nombre]', NOW(), $area[idu] )";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function editarArea( $dbh, $area ){
		//Modifica los datos de un registro de área
		$q = "update area set nombre = '$area[nombre]' where id = $area[id]";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	function tienePropositosArea( $dbh, $ida ){
		// Devuelve verdadero si área tiene propósitos asociados
		$asociado = false;
		$q = "select * from proposito where sujeto_objeto_id in (
		select id from sujeto_objeto where area_id = $ida )";
		$nrows = mysqli_num_rows( mysqli_query ( $dbh, $q ) );
		
		if( $nrows > 0 ) $asociado = true;

		return $asociado;
	}
	/* --------------------------------------------------------- */
	function eliminarArea( $dbh, $id ){
		//Elimina un registro de área
		$q = "delete from area where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	function eliminarSO_Area( $dbh, $ida ){
		// Elimina los registros de sujeto_objeto asociados al área dado su id
		$q = "delete from sujeto_objeto where area_id = $ida";

		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["narea"] ) ){ 
		// Invocación desde: js/fn-area.js
		include( "bd.php" );
		include( "data-sistema.php" );

		parse_str( $_POST["narea"], $area );
		$area = escaparCampos( $dbh, $area );
		
		if( nombreDisponible( $dbh, "area", "nombre", $area["nombre"], "", $area["idu"] ) ){
			$rsp = agregarAreaUsuario( $dbh, $area );
			if( $rsp != 0 ){
				$res["exito"] = 1;
				$res["mje"] = "Área registrada con éxito";
			}else{
				$res["exito"] = 1;
				$res["mje"] = "Error al registrar área";
			}
		}
		else{ 
			$rsp = -2;
			$res["mje"] = "Nombre de área ya registrado";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["earea"] ) ){ 
		// Editar área Invocación desde: js/fn-area.js
		include( "bd.php" );
		include( "data-sistema.php" );

		parse_str( $_POST["earea"], $area );
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
	if( isset( $_POST["elim_area"] ) ){
		// Invocación desde: js/fn-area.js
		include( "bd.php" );	
		$ida = $_POST["elim_area"];
		
		if( tienePropositosArea( $dbh, $ida ) ){
			$res["exito"] = -1;
			$res["mje"] = "No puede eliminar área, posee propósitos asociados";
		}else{
			eliminarArea( $dbh, $ida );
			eliminarSO_Area( $dbh, $ida );
			$res["exito"] = 1;
			$res["mje"] = "Área eliminada con éxito";
		}
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
?>