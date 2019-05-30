<?php
    /*
     * TFE Life Planner - Perfil de usuario
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-usuario.php" );
    checkSession( "" );
    $titulo_pagina = "Perfil de usuario";

    $idu = $_SESSION["user"]["id"];
    $usr = obtenerDatosUsuario( $dbh, $idu );
 
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Título -->
		<title>Perfil de usuario | TFE Life Planner</title>
		<?php include( "secciones/meta-tags.html" );?>

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		
		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<style type="text/css">
		    .alert{ display: none; margin-top: 20px; }
		</style>
	</head>
	
	<body>
		<section class="body">

			<!-- start: header -->
			<?php include( "secciones/header.php" ); ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include( "secciones/navegacion.php" ); ?>
				<!-- end: sidebar -->
				<section role="main" class="content-body">
					<?php include( "secciones/titulo_pagina.php" ); ?>
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<section class="panel-group mb-xlg">
								<header class="panel-heading bg-primary">
									<div class="widget-profile-info">
										<div class="profile-info">
											<h4 class="name text-semibold">
												<?php echo $usr["nombre"]; ?>
											</h4>
											<h5 class="role"><?php echo $usr["email"]; ?></h5>
											
										</div>
									</div>
								</header>
								<div class="panel-body text-left">
									<p>	<i class="fa fa-clock-o"></i> Registrado: 
										<?php echo $usr["fregistro"]; ?> </p>
									<p>	<i class="fa fa-clock-o"></i> Último ingreso: 
										<?php echo $usr["ult_ingreso"]; ?> </p>
								</div>
							</section>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<section class="panel">
								<div class="tabs tabs-primary">
									<ul class="nav nav-tabs nav-justified">
										<li class="active">
											<a href="#tfe_dp" data-toggle="tab" class="text-center"><i class="fa fa-user"></i> Datos personales</a>
										</li>
										<li>
											<a href="#tfe_pwd" data-toggle="tab" class="text-center"><i class="fa fa-lock"></i> Contraseña</a>
										</li>
									</ul>
									<div class="tab-content">
										<div id="tfe_dp" class="tab-pane active">
											<p>Datos personales </p>
											<form id="frm_mdatos_pers" class="form-horizontal">
												<input type="hidden" name="idu" 
												value="<?php echo $idu ?>">
												<div class="row form-group">
													<div class="col-lg-12">
														<label control-label">Nombre 
														<span class="required">*</span></label>
														<input type="text" name="nombre" placeholder="Nombre" 
														class="form-control" required 
														value="<?php echo $usr['nombre']?>">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-lg-12">
														<label control-label">Email 
														<span class="required">*</span></label>
														<input type="email" name="email" placeholder="Email" class="form-control" required 
														value="<?php echo $usr['email']?>">
													</div>
												</div>
												<footer class="panel-footer">
													<div class="row">
														<div class="col-sm-9 col-sm-offset-3">
															<button class="btn btn-primary">Guardar</button>
														</div>
													</div>
												</footer>
											</form>
										</div>
										<div id="tfe_pwd" class="tab-pane">
											<p>Cambiar contraseña </p>
											<form id="frm_actpwd" class="form-horizontal">
												<input type="hidden" name="idu" 
												value="<?php echo $idu ?>">
												<div class="row form-group">
													<div class="col-lg-12">
														<label control-label">Contraseña 
														<span class="required">*</span></label>
														<input id="pwd1" type="password" name="pwd1" class="form-control" required>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-lg-12">
														<label control-label">Confirmar contraseña 
														<span class="required">*</span></label>
														<input type="password" name="pwd2" class="form-control" required>
													</div>
												</div>
												
												<footer class="panel-footer">
													<div class="row">
														<div class="col-sm-9 col-sm-offset-3">
															<button type="submit" class="btn btn-primary">Guardar</button>
														</div>
													</div>
												</footer>
											</form>
										</div>
									</div>
								</div>
								<?php include( "secciones/notificaciones/alert.html" );?>
							</section>
						</div>
					</div>

				</section>
			</div>
			
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		<script src="js/init.modals.js"></script>

		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>

		<script src="js/fn-ui.js"></script>
		<script src="js/fn-acceso.js"></script>
		<script src="js/fn-usuario.js"></script>
		<script src="js/validate-extend.js"></script>
		
	</body>
</html>