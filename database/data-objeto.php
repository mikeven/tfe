<?php
	/* --------------------------------------------------------- */
	/* TFE Life Planner - Acceso a objetos */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function obtenerListaObjetos( $dbh, $idu ){
		// Devuelve todos los registros de objetos asociados a un sujeto (id)
		$q = "select * from objeto where usuario_id = $idu";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerListaObjetosSujeto( $dbh, $ids ){
		// Devuelve todos los registros de objetos asociados a un sujeto (id)
		$q = "select * from objeto where sujeto_id = $ids";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerObjetoPorId( $dbh, $id ){
		// Devuelve el registro de un objeto dado su id
		$q = "select id, nombre, date_format(creado,'%d/%m/%Y') as fregistro, 
		date_format(modificado,'%d/%m/%Y') as fultact from objeto where id = $id";

		$rst = mysqli_query( $dbh, $q );
		$data = mysqli_fetch_array( $rst );

		return $data;
	}
	/* --------------------------------------------------------- */
	function agregarObjeto( $dbh, $objeto ){
		// Guarda un nuevo registro de objeto
		$q = "insert into objeto ( nombre, usuario_id, creado ) 
		values ('$objeto[nombre]', $objeto[idu], NOW())";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function editarObjeto( $dbh, $objeto ){
		//Modifica los datos de un registro de objeto
		$q = "update objeto set nombre = '$objeto[nombre]', modificado = NOW() where id = $objeto[id]";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	function eliminarObjeto( $dbh, $id ){
		//Elimina un registro de objeto
		$q = "delete from objeto where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["nobjeto"] ) ){ 
		// Invocación desde: js/fn-area.js
		include( "bd.php" );
		include( "data-sistema.php" );

		parse_str( $_POST["nobjeto"], $objeto );
		$objeto = escaparCampos( $dbh, $objeto );
		
		if( nombreDisponible( $dbh, "objeto", "nombre", $objeto["nombre"], "", "" ) ){
			$id = agregarObjeto( $dbh, $objeto );
			$objeto["id"] = $id;
			if( $id != 0 ){
				$res["exito"] = 1;
				$res["mje"] = "Objeto registrado con éxito";
				$res["reg"] = $objeto;
			}else{
				$res["exito"] = 1;
				$res["mje"] = "Error al registrar objeto";
			}
		}else{ 
			$res["exito"] = -2;
			$res["mje"] = "Nombre de objeto ya registrado";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["edit_objeto"] ) ){ 
		// Editar área Invocación desde: js/fn-area.js
		include( "bd.php" );
		include( "data-sistema.php" );

		parse_str( $_POST["edit_objeto"], $objeto );
		$objeto = escaparCampos( $dbh, $objeto );
		
		if( nombreDisponible( $dbh, "objeto", "nombre", $objeto["nombre"], $objeto["id"], "" ) ){
			$rsp = editarObjeto( $dbh, $objeto );
			if( $rsp != 0 ){
				$res["exito"] = 1;
				$res["mje"] = "Datos de objeto modificados";
			}else{
				$res["exito"] = 0;
				$res["mje"] = "Error al modificar objeto";
			}
		}
		else{ 
			$rsp = -2;
			$res["mje"] = "Nombre de objeto ya registrado";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["elim_objeto"] ) ){
		// Invocación desde: js/fn-area.js
		include( "bd.php" );	
		//include( "data-sistema.php" );
		
		if( false ){
			$res["exito"] = -1;
			$res["mje"] = "Debe eliminar registros asociados al objeto primero.";
		}else{
			eliminarArea( $dbh, $_POST["elim_area"] );
			$res["exito"] = 1;
			$res["mje"] = "Objeto eliminado con éxito";
		}
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
?>