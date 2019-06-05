<?php
	/* --------------------------------------------------------- */
	/* TFE Life Planner - Acceso a propósitos */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function obtenerSujetoObjetoPorSesion( $dbh, $idss ){
		// Devuelve todos los registros de sujeto-objeto realizados en una sesión
		$q = "select s.id as idsujeto, s.nombre nsujeto, o.id as idobjeto, o.nombre as nobjeto, 
		a.id as idarea, a.nombre as narea 
		from sujeto_objeto so, sujeto s, objeto o, area a, sesion ss 
		where s.id = so.sujeto_id and o.id = so.objeto_id and a.id = so.area_id 
		and so.sesion_id = ss.id and ss.id = $idss";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerListaSujetoObjetos( $dbh, $ido ){
		// Devuelve todos los registros de propósitos asociados a un objeto (id)
		$q = "select * from proposito where id = $ido";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerSujetoObjetoPorId( $dbh, $id ){
		// Devuelve el registro de un área dado su id
		$q = "select id, descripcion, date_format(creado,'%d/%m/%Y') as fregistro 
		from proposito where id = $id";

		$rst = mysqli_query( $dbh, $q );
		$data = mysqli_fetch_array( $rst );

		return $data;
	}
	/* --------------------------------------------------------- */
	function agregarSesionSO( $dbh, $idu ){
		// Crea un nuevo registro de sesión sujeto-objeto
		$q = "insert into sesion ( creado, usuario_id ) values ( NOW(), $idu )";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh ); 
	}
	/* --------------------------------------------------------- */
	function agregarSujetoObjeto( $dbh, $s_o, $idss ){
		// Agrega un nuevo registro de sujeto-objeto
		$q = "insert into sujeto_objeto ( sujeto_id, objeto_id, area_id, sesion_id, creado ) 
		values ( $s_o[idsujeto], $s_o[idobjeto], $s_o[idarea], $idss, NOW() )";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function obtenerIdSesionNuevoSO( $dbh, $s_o ){
		//

		if( isset( $s_o["idsesion"] ) )
			$idss = $s_o["idsesion"];
		else
			$idss = agregarSesionSO( $dbh, $s_o["idu"] );
		return $idss;
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["n_sub_obj"] ) ){ 
		// Invocación desde: js/fn-proposito.js
		include( "bd.php" );
		parse_str( $_POST["n_sub_obj"], $s_o );
		
		$idss = obtenerIdSesionNuevoSO( $dbh, $s_o );
		if( $idss != 0 ){
			$rsp = agregarSujetoObjeto( $dbh, $s_o, $idss );
			if( $rsp != 0 ){
				$res["exito"] = 1;
				$res["mje"] = "Registro realizado con éxito";
				$res["idss"] = $idss;
			}else{
				$res["exito"] = -1;
				$res["mje"] = "Error al realizar registro de sujeto-objeto";
			}
		}else{
			$res["exito"] = -2;
			$res["mje"] = "Error al realizar registro de sesión sujeto-objeto";
		}

		echo json_encode( $res );
	}
	
	/* --------------------------------------------------------- */
	if( isset( $_POST["elim_s_o"] ) ){
		// Invocación desde: js/fn-area.js
		include( "bd.php" );	
		
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