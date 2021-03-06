<?php
    /*
     * TFE Life Planner - Historial
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-actividad.php" );
    include( "database/data-sujeto-objeto.php" );

    include( "fn/fn-actividad.php" );
    
    checkSession( "" );
    $idu = $_SESSION["user"]["id"];

    if( isset( $_GET["ids"], $_GET["ido"] ) ){
        $ids = $_GET["ids"];	$ido = $_GET["ido"];
        $reg_so = obtenerSujetoObjetoPorids( $dbh, $ids, $ido );
        $historial = obtenerHistorialSujetoObjeto( $dbh, $ids, $ido );
    }
    $titulo_pagina = $reg_so["nsujeto"]." - ".$reg_so["nobjeto"];
    $breadcrumb = "<a href='historial.php'>Historial</a> / $titulo_pagina";
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Título -->
		<title><?php echo $titulo_pagina ?> | TFE Life Planner</title>
		<?php include( "secciones/meta-tags.html" );?>

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css"/>

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
		<style>
			#icono_actividad{ color: #FFF; }
			#edicion_resultado{ display: none; }
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
						
						<div class="col-md-8 col-sm-8 col-xs-12">
							<section class="panel">
								<header class="panel-heading">
									<h2 class="panel-title">
										Historial
										<?php echo $reg_so["nsujeto"]." - ".$reg_so["nobjeto"]?>
									</h2>
								</header>
								<div id="tabla_actividades_prioridad" class="panel-body">
									<table id="datatable-historial"
									class="table table-bordered table-striped mb-none thist">
										<thead>
											<tr>
												<th>Fecha</th>
												<th>Actividad</th>
												<th>Resultado</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ( $historial as $h ) { ?>
											<tr class="gradeX">
												<td> <?php echo $h["fcalendario"] ?> </td>
												<td> 
													<a href="#actividad-historial" class="info_hist modal-sizes modal-with-zoom-anim" data-ida="<?php echo $h["id_act"] ?>">
														<?php echo infoPrioridad( $h ) ?>
													</a> 
												</td>
												<td> <?php echo $h["resultado"] ?> </td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
									
								</div>
							</section>
						</div>

					</div>

				</section>
			</div>
			<?php include( "secciones/data-actividad-hist.php" ); ?>
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>

		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		<!-- <script src="//cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script> -->
		
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

		
		<script src="js/fn-ui.js"></script>
		<script src="js/fn-acceso.js"></script>
		<script src="js/fn-actividad.js"></script>
		<script src="js/validate-extend.js"></script>
		<script type="text/javascript">
			var table = $('#datatable-historial').DataTable();
		</script>
		
	</body>
</html>