<?php
	/* --------------------------------------------------------- */
	/* TFE Life Planner - Acceso a Sujetos */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function obtenerListaSujetos( $dbh ){
		// Devuelve todos los registros de sujetos de un usuario por área
		$q = "select * from sujeto";
		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerListaSujetosArea( $dbh, $ida ){
		// Devuelve todos los registros de sujetos de un usuario por área
		$q = "select * from sujeto where area_id = $ida";
		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerSujetoPorId( $dbh, $id ){
		// Devuelve el registro de un área dado su id
		$q = "select s.id, s.nombre as nombre, a.nombre as area, 
		date_format(s.creado,'%d/%m/%Y') as fregistro 
		from sujeto s, area a where s.area_id = a.id and s.id = $id";
		
		$rst = mysqli_query( $dbh, $q );
		$data = mysqli_fetch_array( $rst );

		return $data;
	}
	/* --------------------------------------------------------- */
	function agregarSujeto( $dbh, $sujeto ){
		// Procesa el registro de nuevo sujeto
		$q = "insert into sujeto ( nombre, creado ) values ('$sujeto[nombre]', NOW())";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function editarSujeto( $dbh, $sujeto ){
		//Edita un registro de sujeto
		$q = "update sujeto set nombre = '$area[nombre]', modificado = NOW() 
		where id = $area[id]";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	function eliminarSujeto( $dbh, $id ){
		//Elimina un registro de sujeto
		$q = "delete from sujeto where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["nsujeto"] ) ){ 
		// Invocación desde: js/fn-area.js
		include( "bd.php" );
		include( "data-sistema.php" );

		parse_str( $_POST["nsujeto"], $sujeto );
		$sujeto = escaparCampos( $dbh, $sujeto );
		
		if( nombreDisponible( $dbh, "sujeto", "nombre", $sujeto["nombre"], "", "" ) ){
			$ids = agregarSujeto( $dbh, $sujeto );
			$sujeto["id"] = $ids;
			if( $ids != 0 ){
				$res["exito"] = 1;
				$res["mje"] = "Sujeto registrado con éxito";
				$res["reg"] = $sujeto;
			}else{
				$res["exito"] = -1;
				$res["mje"] = "Error al registrar sujeto";
			}
		}else{ 
			$res["exito"] = -2;
			$res["mje"] = "Nombre de sujeto ya registrado";
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