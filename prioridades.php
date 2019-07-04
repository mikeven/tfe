<?php
    /*
     * TFE Life Planner - Prioridades
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-actividad.php" );

    include( "fn/fn-actividad.php" );
    
    checkSession( "" );
    $titulo_pagina = "Prioridades";

    $idu = $_SESSION["user"]["id"];
    $prioridades = obtenerPrioridades( $dbh, $idu );
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
			.datepicker{ z-index:99999 !important; }
			.isuccess .fa{ color: #47a447 !important; }
			.iwarning .fa{ color: #ed9c28 !important; }
			.idanger .fa{ color: #d2322d !important; }
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
						
						<div class="col-md-12 col-sm-12 col-xs-12">
							
							<section class="panel">
								<header class="panel-heading">
									<h2 class="panel-title">Prioridades</h2>
									<p class="panel-subtitle">Haga clic en una prioridad para agendarla</p>
								</header>
								<div id="tabla_actividades_prioridad" class="panel-body">
									<table id="datatable-prioridades"
									class="table table-bordered table-striped mb-none" >
										<thead>
											<tr>
												<th width="70%">Actividad</th>
												<th width="30%">Fecha de prioridad</th>
												
											</tr>
										</thead>
										<tbody>
											<?php foreach ( $prioridades as $a ) { ?>
											<tr class="gradeX">
												<td>
													<a href="#frm-actividad-cal" 
													class="modal-sizes modal-with-zoom-anim act_prior_cal" 
													data-ida="<?php echo $a["id_act"] ?>" 
													data-desc="<?php infoPrioridadForm( $a ) ?>">
														<?php infoPrioridad( $a ) ?>
													</a>
												</td>
												<td><?php echo $a["tprioridad"] ?></td>
												
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
			<?php include( "secciones/sopa/frm-actividad-cal.php" ); ?>
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>

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
		
		<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
		<script src="//cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>

		<script src="js/fn-ui.js"></script>
		<script src="js/fn-acceso.js"></script>
		<script src="js/fn-actividad.js"></script>
		<script src="js/validate-extend.js"></script>
		<script type="text/javascript">
			$.fn.dataTable.moment( 'DD/MM/YY HH:mm A' );
    
		    var table = $('#datatable-prioridades').DataTable();
		    table.order( [ 1, 'asc' ] ).draw();

		    $("#fagenda_act").datepicker({
			    isRTL: false,
			    format: 'dd/mm/yyyy',
			    autoclose:true,
			    language: 'es'
			});
		</script>
		
	</body>
</html>