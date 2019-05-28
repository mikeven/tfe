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
	// Recuperar contraseña (asinc)
	if( isset( $_POST["lyrpass"] ) ){ 
		// Invocación desde: js/fn-usuario.js
		include( "bd.php" );
		$rsp = checkEmailLogin( $dbh, $_POST["email"] );
		if( $rsp["valido"] ){
			enviarPasswordEmail( $_POST["email"], $rsp["reg"]["password"] );
			$res["exito"] = 1;
			$res["mje"] = "Se ha enviado un mensaje a tu correo electrónico con tu contraseña";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "No existe cuenta asociada a este correo electrónico, verifique sus datos e intente nuevamente";
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