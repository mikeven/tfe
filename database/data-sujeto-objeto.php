<?php
	/* --------------------------------------------------------- */
	/* TFE Life Planner - Acceso a sujeto - objeto */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function obtenerSujetoObjetoPorUsuario( $dbh, $idu ){
		// Devuelve todos los registros de sujeto-objeto realizados en una sesión
		$q = "select so.id as id_so, s.id as idsujeto, s.nombre nsujeto, o.id as idobjeto, 
		o.nombre as nobjeto, a.id as idarea, a.nombre as narea 
		from sujeto_objeto so, sujeto s, objeto o, area a, sesion ss, usuario u 
		where s.id = so.sujeto_id and o.id = so.objeto_id and a.id = so.area_id 
		and so.sesion_id = ss.id and ss.usuario_id = u.id and u.id = $idu";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerSujetoObjetoPorids( $dbh, $ids, $ido ){
		// Devuelve el registro de sujeto - objeto según sus ids correspondientes
		$q = "select s.id as idsujeto, s.nombre nsujeto, o.id as idobjeto, 
		o.nombre as nobjeto from sujeto_objeto so, sujeto s, objeto o 
		where s.id = so.sujeto_id and o.id = so.objeto_id and s.id = $ids and o.id = $ido";
		
		$data = mysqli_fetch_array( mysqli_query( $dbh, $q ) );

		return $data;
	}
	/* --------------------------------------------------------- */
	function obtenerSujetoObjetoPorSesion( $dbh, $idss ){
		// Devuelve todos los registros de sujeto-objeto realizados en una sesión
		$q = "select so.id as id_so, s.id as idsujeto, s.nombre nsujeto, o.id as idobjeto, 
		o.nombre as nobjeto, a.id as idarea, a.nombre as narea 
		from sujeto_objeto so, sujeto s, objeto o, area a, sesion ss 
		where s.id = so.sujeto_id and o.id = so.objeto_id and a.id = so.area_id 
		and so.sesion_id = ss.id and ss.id = $idss";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerSujetosPorArea( $dbh, $ida ){
		// Devuelve todos los registros de sujeto-objeto realizados en una sesión
		$q = "select distinct(s.id) as id, s.nombre as nombre from sujeto_objeto so, sujeto s, area a
		where s.id = so.sujeto_id and a.id = so.area_id and a.id = $ida order by nombre ASC";

		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerObjetosPorSujeto( $dbh, $ids ){
		// Devuelve todos los registros de sujeto-objeto realizados en una sesión
		$q = "select distinct(o.id) as id, o.nombre as nombre from sujeto_objeto so, objeto o, sujeto s 
		where o.id = so.objeto_id and so.sujeto_id = s.id and s.id = $ids order by nombre ASC";

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
	function soExistente( $dbh, $s_o, $idss ){
		// Devuelve verdadero si ya existe un registro existente sesion-sujeto-objeto
		// Evita duplicidad dos o más objetos con el mismo sujeto en una misma sesión
		$existe = false;
		$q = "select * from sujeto_objeto where sujeto_id = $s_o[idsujeto] and 
		objeto_id = $s_o[idobjeto] and sesion_id = $idss";
		
		$data 	= mysqli_query ( $dbh, $q );
		$nregs 	= mysqli_num_rows( $data );
		if( $nregs > 0 ) $existe = true;
		
		return $existe;
	}
	/* --------------------------------------------------------- */
	function obtenerIdSesionNuevoSO( $dbh, $s_o ){
		// Devuelve el id de la sesión para un nuevo registro sujeto-objeto

		if( isset( $s_o["idsesion"] ) )
			$idss = $s_o["idsesion"]; 						// Sesión ya existente
		else
			$idss = agregarSesionSO( $dbh, $s_o["idu"] ); 	// Nueva sesión
		return $idss;
	}
	/* --------------------------------------------------------- */
	// Nuevo registro Sujeto - Objeto
	if( isset( $_POST["n_sub_obj"] ) ){ 
		// Invocación desde: js/fn-proposito.js
		include( "bd.php" );
		$exito = -1; $rsp = 0;
		parse_str( $_POST["n_sub_obj"], $s_o );
		
		$idss = obtenerIdSesionNuevoSO( $dbh, $s_o );
		
		if( $idss != 0 ){ // Registro exitoso de sesión
			
			if( soExistente( $dbh, $s_o, $idss ) == false ){
				// Registro no duplicado de sujeto-objeto en misma sesión
				$rsp = agregarSujetoObjeto( $dbh, $s_o, $idss );
				if( $rsp != 0 ){
					// Registro exitoso de sujeto-objeto
					$exito = 1;
					$res["idss"] = $idss;
				
				}else
					$res["mje"] = "Error al realizar registro de sujeto-objeto";
			}
			else 
				$res["mje"] = "Registro sujeto-objeto ya existente para esta sesión";
			
		}else
			$res["mje"] = "Error al realizar registro de sesión sujeto-objeto";
		
		$res["exito"] = $exito;

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
			eliminarSO( $dbh, $_POST["elim_area"] );
			$res["exito"] = 1;
			$res["mje"] = "Área eliminada con éxito";
		}
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["sujetos_area"] ) ){
		// Invocación desde: js/fn-sujeto-objeto.js
		include( "bd.php" );	
		$ida = $_POST["sujetos_area"];
		$sujetos = obtenerSujetosPorArea( $dbh, $ida );

		echo json_encode( $sujetos );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["objetos_sujetos"] ) ){
		// Invocación desde: js/fn-sujeto-objeto.js
		include( "bd.php" );	
		$ids = $_POST["objetos_sujetos"];
		$sujetos = obtenerObjetosPorSujeto( $dbh, $ids );

		echo json_encode( $sujetos );
	}
	/* --------------------------------------------------------- */
?>