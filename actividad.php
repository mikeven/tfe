<?php
    /*
     * TFE Life Planner - Ficha actividad
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-sopa.php" );
    include( "database/data-actividad.php" );
    include( "database/data-proposito.php" );
    checkSession( "" );
    
    $idu = $_SESSION["user"]["id"];
    if( isset( $_GET["id"] ) ){
        $id_act = $_GET["id"];
        $actividad = obtenerActividadSOPAPorId( $dbh, $id_act );
        $pactividades = obtenerListaActividades( $dbh, $actividad["idprop"] );
        $propositos = obtenerPropositosPorSesion( $dbh, $actividad["idsesion"] );
    }
    $titulo_pagina = $actividad["nsujeto"]." - ".$actividad["nobjeto"];
    
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Título -->
		<title><?php echo $titulo_pagina ?> | TFE Life Planner</title>
		<?php include( "secciones/meta-tags.html" );?>

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />
		
		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<style type="text/css">
			.icono-tarea {
			    font-size: 25px !important;
			    font-size: 2.2rem;
			    width: 40px !important;
			    height: 40px !important;
			    line-height: 40px !important;
			}
			.info-act, .act_sesion{ margin-left: 35px; }
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
							<div class="pricing-table hidden">
								<div class="plan most-popular">
									<div class="plan-ribbon-wrapper hidden">
										<div class="plan-ribbon">Prioridad</div>
									</div>
									<h3>
										<?php echo $actividad["narea"] ?>
										<span>
											<i class="fa fa-file" aria-hidden="true"></i>
										</span>
									</h3>
									<button type="button" class="mb-xs mt-xs mr-xs btn btn-warning"><i class="fa fa-exclamation-triangle"></i> Prioridad</button>
									<ul>
										<li><b>5GB</b> Disk Space</li>
										<li><b>50GB</b> Monthly Bandwidth</li>
										<li><b>10</b> Email Accounts</li>
										<li><b>Unlimited</b> subdomains</li>
									</ul>
								</div>
							</div>

							<section class="panel panel-featured-top panel-featured-info">
								<div class="panel-body">
									<div class="widget-summary">
										<div class="widget-summary-col widget-summary-col-icon">
											<div class="summary-icon bg-info icono-tarea">
												<i class="fa fa-bell"></i>
											</div>
										</div>
										<div class="widget-summary-col">
											<div class="summary">
												<h4 class="title"><?php echo $actividad["narea"]?></h4>
												<hr>
												<div class="info">
													<strong >Sujeto:</strong>
													<span>
														<?php 
														echo $actividad["nsujeto"]?>
													</span>
												</div>
												<div class="info">
													<strong >Objeto:</strong>
													<span>
														<?php 
														echo $actividad["nobjeto"]?>
													</span>
												</div>
												<div class="info">
													<strong >Propósito:</strong>
													<span>
														<?php 
														echo $actividad["proposito"]?>
													</span>
												</div>
												<div class="info">
													<strong >Actividad:</strong>
													<span>
										<?php echo etiqAct( $actividad["tipo_act"] ) ?>
													</span>
												</div>
												<div class="info">
										<?php 
										include( "secciones/sopa/data-actividad.php" ) ?>
												</div>
											</div>
											<div class="summary-footer">
												<button type="button" class="mb-xs mt-xs mr-xs btn btn-warning"><i class="fa fa-star"></i> Prioridad</button>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12">
							<?php 
							include("secciones/sopa/panel_actividades_proposito.php"); ?>

							<?php 
							include("secciones/sopa/panel_propositos_sesion.php"); ?>	
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

		<script src="js/fn-ui.js"></script>
		<script src="js/fn-acceso.js"></script>
		<script src="js/fn-area.js"></script>
		<script src="js/validate-extend.js"></script>
		
	</body>
</html>