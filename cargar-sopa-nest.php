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
    include( "fn/fn-forms.php" );
    checkSession( "" );
    $titulo_pagina = "Cargar fórmula S.O.P.A";

    $ida = NULL;
    $idu = $_SESSION["user"]["id"];
    $areas = obtenerListaAreas( $dbh, $idu );
    $sujetos = obtenerListaSujetos( $dbh );
    if( isset( $_GET["id_area"] ) ){
        $ida = $_GET["id_area"];
        $area = obtenerAreaPorId( $dbh, $ida );
    }
    if( isset( $_GET["id_s"] ) ){
    	$ids = $_GET["id_s"];
    	$sujeto = obtenerSujetoPorId( $dbh, $ids );
    	$objetos = obtenerListaObjetos( $dbh, $ids );
    }
    
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
		
		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<style type="text/css">
			.icon-xx{ float: right; }
			.btn-no-ft{ float: right; }
			.drag_disabled{
			    -webkit-user-select: none;
				-webkit-user-drag: none;
				-webkit-app-region: no-drag;
				cursor: default;
			}
			.ssel, .ssel .btn-group, .ssel button{ width: 100%; }
			.ssel button{ text-align: left; }
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
								if( isset( $sujeto ) )
									include("secciones/sopa/panel_sujeto.php");
								else
									include("secciones/sopa/panel_crear_sujeto.php");
							?>
						</div>
					
						<?php if( isset( $sujeto ) ) { ?>
						<div class="col-md-8 col-sm-6 col-xs-12">
							<section class="panel">
								<div class="panel-body">
									<div class="dd dd-nodrag" id="nestable">
										<ol class="dd-list drag_disabled" onmousedown="return false">
											<?php 
											if( count( $objetos ) > 0 )
												foreach ( $objetos as $o ) { 
											?>
											<li class="dd-item drag_disabled" 
											data-id="<?php echo $o["id"]?>">
								
												<div class="dd-handle ">
													<?php echo $o["descripcion"]?>
													<a href="#frm-proposito" class="modal-sizes modal-with-zoom-anim" 
													data-ido="<?php echo $o["id"]?>">
														<button type="button" class="mb-xs mt-xs mr-xs btn btn-xs btn-success btn-no-ft">
															<i class="fa fa-plus" aria-hidden="true"></i> Propósito
														</button>
													</a>
												</div>
											
											</li>
											<?php } 
											else 
												include( "secciones/sopa/panel_agr_obj.php" ); 
											?>
												
											<li class="dd-item hidden" data-id="2">
												<div class="dd-handle">Item 2</div>
												<ol class="dd-list">
													<li class="dd-item" data-id="3"><div class="dd-handle">Item 3</div></li>
													<li class="dd-item" data-id="4"><div class="dd-handle">Item 4</div></li>
													<li class="dd-item" data-id="5">
														<div class="dd-handle">Item 5</div>
														<ol class="dd-list">
															<li class="dd-item" data-id="6"><div class="dd-handle">Item 6</div></li>
															<li class="dd-item" data-id="7"><div class="dd-handle">Item 7</div></li>
															<li class="dd-item" data-id="8"><div class="dd-handle">Item 8</div></li>
														</ol>
													</li>
													<li class="dd-item" data-id="9"><div class="dd-handle">Item 9</div></li>
													<li class="dd-item" data-id="10"><div class="dd-handle">Item 10</div></li>
												</ol>
											</li>
											
										</ol>
									</div>
								</div>									
							</section>
						</div>
						<?php } ?>
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
		
		
		<script src="assets/javascripts/ui-elements/examples.nestable_.js"></script>
		
		<script src="js/fn-ui.js"></script>
		<script src="js/fn-acceso.js"></script>
		<script src="js/fn-area.js"></script>
		<script src="js/fn-sujeto.js"></script>
		<script src="js/fn-objeto.js"></script>
		<script src="js/validate-extend.js"></script>
	</body>
</html>