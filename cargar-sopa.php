<?php
    /*
     * TFE Life Planner - Cargar S.O.P.A.
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-area.php" );
    include( "database/data-sujeto.php" );
    include( "database/data-objeto.php" );
    include( "database/data-sujeto-objeto.php" );
    include( "database/data-proposito.php" );
    
    include( "fn/fn-forms.php" );
    include( "fn/fn-sopa.php" );
    
    checkSession( "" );
    $titulo_pagina = "Cargar fórmula S.O.P.A";
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
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/jstree/themes/default/style.css" />
		
		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<style type="text/css">
			#agg_objeto, #agg-s-o{ display: none; }
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
						<div class="col-md-4 col-sm-6 col-xs-12">
							<?php 
								if( isset( $init_area ) )
									include( "secciones/sopa/panel_sujeto_objeto.php" );
								if( isset( $s_o ) ) 
									include( "secciones/sopa/panel_sesion_so.php" );
							?>
						</div>
						<?php if( isset( $s_o ) ) { ?>
						<div class="col-md-8 col-sm-6 col-xs-12">
							<section id="arbol_opa" class="panel">
								<header class="panel-heading">
									<h2 class="panel-title">Propósitos - Actividades</h2>
								</header>
								<div class="panel-body">
									<?php include( "secciones/sopa/panel_opa.php" ); ?>
								</div>									
							</section>
						</div>
						<?php } ?>
						
						<?php include( "secciones/sopa/frm-proposito.php" ); ?>
					
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
		<script src="assets/vendor/jquery-nestable/jquery.nestable.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jstree/jstree.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		<script src="assets/vendor/select2/select2_locale_es.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		<script src="js/init.modals.js"></script>

		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>
		<?php if( isset( $s_o ) ) { ?>
		<script src="assets/javascripts/ui-elements/examples.nestable.js"></script>
		<?php } ?>
		
		<script src="js/fn-ui.js"></script>
		<script src="js/fn-acceso.js"></script>
		<script src="js/fn-area.js"></script>
		<script src="js/fn-sujeto.js"></script>
		<script src="js/fn-objeto.js"></script>
		<script src="js/fn-sujeto-objeto.js"></script>
		<script src="js/fn-proposito.js"></script>
		<script src="js/validate-extend.js"></script>
		<?php if( isset( $s_o ) ) { ?>
			<script>  bloquearListasAreaSujeto(); </script>
		<?php } ?>
	</body>
</html>