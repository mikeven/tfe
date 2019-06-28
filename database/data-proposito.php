<?php
	/* --------------------------------------------------------- */
	/* TFE Life Planner - Acceso a propósitos */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function obtenerListaPropositos( $dbh, $idso ){
		// Devuelve los propósitos asociados a un registro sujeto-objeto (id)
		$q = "select * from proposito where sujeto_objeto_id = $idso";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerPropositosPorSesion( $dbh, $idss ){
		// Devuelve los registros de propósitos realizados en una misma sesión
		$q = "select p.id as id, p.descripcion as descripcion, s.id as idsujeto, 
		s.nombre nsujeto, o.id as idobjeto, o.nombre as nobjeto 
		from proposito p, sujeto_objeto so, sesion ss, sujeto s, objeto o, area a
		where p.sujeto_objeto_id = so.id and s.id = so.sujeto_id 
		and o.id = so.objeto_id and a.id = so.area_id 
		and so.sesion_id = ss.id and ss.id = $idss";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerPropositosSujetoObjeto( $dbh, $ids, $ido ){
		// Devuelve los registros de propósitos asociados a un par sujeto-objeto
		$q = "select p.id as id, p.descripcion as descripcion 
		from proposito p, sujeto s, objeto o, sujeto_objeto so where p.sujeto_objeto_id = so.id 
		and s.id = so.sujeto_id and o.id = so.objeto_id and s.id = $ids and o.id = $ido";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerPropositoPorId( $dbh, $id ){
		// Devuelve el registro de un área dado su id
		$q = "select id, descripcion, date_format(creado,'%d/%m/%Y') as fregistro 
		from proposito where id = $id";

		$rst = mysqli_query( $dbh, $q );
		$data = mysqli_fetch_array( $rst );

		return $data;
	}
	/* --------------------------------------------------------- */
	function agregarProposito( $dbh, $proposito ){
		// Procesa el registro de nueva área
		$q = "insert into proposito ( descripcion, sujeto_objeto_id, creado ) values 
		('$proposito[descripcion]', $proposito[id_sujobj], NOW() )";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function editarProposito( $dbh, $proposito ){
		//Elimina un registro de área
		$q = "update proposito set descripcion = '$proposito[descripcion]' where id = $area[id]";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	function eliminarProposito( $dbh, $id ){
		//Elimina un registro de área
		$q = "delete from proposito where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["nproposito"] ) ){ 
		// Invocación desde: js/fn-area.js
		include( "bd.php" );
		include( "data-sistema.php" );

		parse_str( $_POST["nproposito"], $proposito );
		$proposito = escaparCampos( $dbh, $proposito );
		
		$rsp = agregarProposito( $dbh, $proposito );
		if( $rsp != 0 ){
			$res["exito"] = 1;
			$res["mje"] = "Propósito registrado con éxito";
		}else{
			$res["exito"] = 1;
			$res["mje"] = "Error al registrar propósito";
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