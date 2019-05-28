<?php
	/* --------------------------------------------------------- */
	/* - TFE Life Planner - Funciones sobre cuentas de usuario - */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function enviarMensajeEmail( $u ){
		// Envía un mensaje por email sobre nuevo registro de usuario

		$e_mail = "info@lydianlionacademy.com";
		$asunto = "Inscripción Lydian Lion A.";

		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $cabeceras .= "From: Lydian Lion Academy web <info@lydianlionacademy.com>"."\r\n";

        $mensaje .= "Se he recibido un nuevo registro de inscripción <br>";
        $mensaje .= "Datos: <br>";
        $mensaje .= "Nombre: $u[nombre]<br>";
        $mensaje .= "Teléfono: $u[telefono]<br>";
        $mensaje .= "Email: $u[correo]<br>";
        $mensaje .= "Ciudad: $u[ciudad]<br>";
        $mensaje .= "País: $u[pais]<br>";
        $mensaje .= "Código de descuento: $u[codigo]<br>";

		return mail( $e_mail, $asunto, $mensaje, $cabeceras );
	}
	/* --------------------------------------------------------- */
	function enviarPasswordEmail( $e_mail, $pass ){
		// Envía un mensaje por email con contraseña de usuario

		$asunto = "Envío de contraseña";
		$oemail = "cursos@lydianlionacademy.com";
		
		$cabeceras = "Reply-To: Lydian Lion Academy <$oemail>\r\n"; 
  		$cabeceras .= "Return-Path: Lydian Lion Academy <$oemail>\r\n";
  		$cabeceras .= "From: Lydian Lion Academy <$oemail>\r\n"; 
		$cabeceras .= "Organization: Lydian Lion Academy\r\n";
	  	$cabeceras .= "X-Priority: 3\r\n";
	  	$cabeceras .= "X-Mailer: PHP". phpversion() ."\r\n"; 
		$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        
        $mensaje .= "Se ha solicitado la recuperación de contraseña desde Lidian Lion Academy <br>";
        $mensaje .= "Tu contraseña es: $pass<br>";
        $mensaje .= "===================================================== <br>";
        $mensaje .= "<br><br>";
        $mensaje .= "<a href='http://lydianlionacademy.com/cursos/login.php'>Inicia sesión en Lydian Lion Academy<a>";

		return mail( $e_mail, $asunto, $mensaje, $cabeceras );
	}
	/* --------------------------------------------------------- */
	function registrarUsuario( $dbh, $usuario ){
		// Procesa el registro de nuevo usuario
		ini_set( 'display_errors', 1 );
		$q = "insert into usuario ( nombre, email, password, creado ) values 
		('$usuario[nombre]', '$usuario[email]', '$usuario[password]', NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function iniciarSesion( $data_u ){
		// Inicia la sesión de usuario
		//session_start();
		$_SESSION["login"] 	= 1;	
		$_SESSION["user"] 	= $data_u;
	}
	/* --------------------------------------------------------- */
	function actualizarUltimoIngreso( $dbh, $idp ){
		// Actualiza la fecha de último inicio de sesión de un usuario
		$q = "update usuario set ultimo_ingreso = NOW() where id = $idp";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_affected_rows( $dbh );
	}
	/* --------------------------------------------------------- */
	function obtenerUsuarioLogin( $dbh, $email, $passw ){
		// Devuelve los datos del usuario que inicia sesión
		$data_u = NULL;
		$q = "select * from usuario where email = '$email' and password = '$passw'";
		
		$data 	= mysqli_query ( $dbh, $q );
		$nrows 	= mysqli_num_rows( $data );
		if( $nrows > 0 )
			$data_u = mysqli_fetch_array( $data );

		return $data_u;
	}
	/* --------------------------------------------------------- */
	function checkLogin( $dbh, $email, $passw ){
		// Verifica si un usuario existe y está habilitado para ingresar

		$data_login["valido"] = false;
		
		$data_u = obtenerUsuarioLogin( $dbh, $email, $passw );

		if( $data_u != NULL ){
			$data_login["valido"] = true;
			$data_login["usuario"] = $data_u;
			iniciarSesion( $data_u );
		}
		
		return $data_login;
	}
	/* --------------------------------------------------------- */
	function checkEmailLogin( $dbh, $email ){
		// Devuelve válido si email está registrado

		$rsp["valido"] = false;
		$rsp["reg"] = NULL;

		$q = "select * from usuario where email = '$email'";		
		$data 	= mysqli_query ( $dbh, $q );
		$data_u = mysqli_fetch_array( $data );
		$nrows 	= mysqli_num_rows( $data );

		if( $nrows > 0 ) {
			$rsp["valido"] = true;
			$rsp["reg"] = $data_u;
		}

		return $rsp;
	}
	/* --------------------------------------------------------- */
	function checkSession( $pag ){
		// Redirecciona a la página de inicio de sesión en caso de no existir sesión de usuario

		if( isset( $_SESSION["user"] ) ){ 
			// Hay sesión iniciada

			if( $pag == "login" ) 
				echo "<script> window.location = 'home.php'</script>";
		}else{
			// No existe sesión iniciada
			
			if( $pag != "login" )
				echo "<script> window.location = '../'</script>";		
		}
	}
	/* --------------------------------------------------------- */
	function soloAdmin(){
		// Redirecciona a la página de inicio en caso de no ser usuario autorizado
		if( $_SESSION["user"]["rol"] != "administrador" ) 
			echo "<script> window.location = 'home.php'</script>";
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