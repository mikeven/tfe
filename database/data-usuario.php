<?php
	/* --------------------------------------------------------- */
	/* -- TFE Life Planner - Funciones sobre datos de usuario -- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function obtenerDatosUsuario( $dbh, $id ){
		// Devuelve el registro de un usuario dado su id
		$q = "select id, nombre, email, date_format(creado,'%d/%m/%Y') as fregistro, 
		date_format(ultimo_ingreso,'%d/%m/%Y') as ult_ingreso from usuario where id = $id";

		$rst = mysqli_query( $dbh, $q );
		$data = mysqli_fetch_array( $rst );

		return $data;
	}
	/* --------------------------------------------------------- */
	function actualizarContrasena( $dbh, $usuario ){
		// Actualiza el campo de contraseña de un registro de usuario
		$q = "update usuario set password = '$usuario[pwd1]' where id = $usuario[idu]";

		$data = mysqli_query( $dbh, $q );
		return mysqli_affected_rows( $dbh );
	}
	/* --------------------------------------------------------- */
	function actualizarDatosPersonales( $dbh, $usuario ){
		// Actualiza los cámpos de datos personales de un registro de usuario
		$q = "update usuario set nombre = '$usuario[nombre]', 
		email = '$usuario[email]' where id = $usuario[idu]";

		$data = mysqli_query( $dbh, $q );
		return mysqli_affected_rows( $dbh );
	}
	/* --------------------------------------------------------- */
	//Inicio de sesión (asinc)
	if( isset( $_POST["usr_login"] ) ){ 
		// Invocación desde: js/fn-usuario.js
		session_start();
		include( "bd.php" );
		$email 	= escaparTexto( $dbh, $_POST["email"] );
		$pwd 	= escaparTexto( $dbh, $_POST["password"] );
		$login 	= checkLogin( $dbh, $email, $pwd );
		
		if( $login["valido"] ){
			actualizarUltimoIngreso( $dbh, $login["usuario"]["id"] );
			$res["exito"] = 1;
			$res["mje"] = "Inicio de sesión exitosa";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Email o contraseña incorrecta, verifique sus datos e intente nuevamente";
		}
		
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	// Actualizar datos personales (asinc)
	if( isset( $_POST["act_datap"] ) ){ 
		// Invocación desde: js/fn-usuario.js
		include( "bd.php" );
		include( "data-sistema.php" );
		parse_str( $_POST["act_datap"], $usuario );

		$usuario = escaparCampos( $dbh, $usuario );
		
		if( nombreDisponible($dbh, "usuario", "email", $usuario["nombre"], $usuario["idu"], "" )){
			$rsp = actualizarDatosPersonales( $dbh, $usuario );
			if( $rsp != -1 ){
				$res["exito"] = 1;
				$res["mje"] = "Datos actualizados con éxito";
				$res["mje2"] = "Si actualizó su email, recuerde usarlo la próxima vez que inicie sesión";
			} else {
				$res["exito"] = 0;
				$res["mje"] = "Error al actualizar datos de usuario";
			}
		}else{
			$res["exito"] = 0;
			$res["mje"] = "Este email ya está registrado";
		}
		
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	// Actualizar contraseña (asinc)
	if( isset( $_POST["act_pwd"] ) ){ 
		// Invocación desde: js/fn-usuario.js
		include( "bd.php" );
		parse_str( $_POST["act_pwd"], $usuario );

		$usuario = escaparCampos( $dbh, $usuario );
		$rsp = actualizarContrasena( $dbh, $usuario );

		if( $rsp != -1 ){
			$res["exito"] = 1;
			$res["mje"] = "Contraseña actualizada con éxito";
			$res["mje2"] = "Recuerde usar esta contraseña la próxima vez que inicie sesión";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al actualizar contraseña";
		}
		
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	//Registro de usuarios (asinc)
	if( isset( $_POST["usr_reg"] ) ){ 
		// Invocación desde: js/fn-usuario.js
		include( "bd.php" );
		parse_str( $_POST["usr_reg"], $usuario );
		$usuario = escaparCampos( $dbh, $usuario );

		$rsp = registrarUsuario( $dbh, $usuario );

		if( ( $rsp != 0 ) && ( $rsp != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Su usuario ha sido registrado con éxito. Puede iniciar sesión";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al registrar usuario";
		}
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	//Cierre de sesión
	if( isset( $_POST["logout"] ) ){
		session_start();
		
		unset( $_SESSION["login"] );
		unset( $_SESSION["user"] );
		echo 1;		
	}
	/* --------------------------------------------------------- */
?>