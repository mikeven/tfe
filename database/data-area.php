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
		$q = "select id, date_format(creado,'%d/%m/%Y') as fregistro where id = $id";

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
	function eliminarArea( $dbh, $id ){
		//Elimina un registro de área
		$q = "delete from area where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["narea"] ) ){ 
		// Invocación desde: js/fn-usuario.js
		include( "bd.php" );
		include( "data-sistema.php" );

		parse_str( $_POST["narea"], $area );
		
		if( nombreDisponible( $dbh, "area", "nombre", $area["nombre"], "", "" ) ){
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
	if( isset( $_POST["elim_area"] ) ){
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