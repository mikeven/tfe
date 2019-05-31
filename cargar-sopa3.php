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
    include( "fn/fn-forms.php" );
    checkSession( "" );
    $titulo_pagina = "Cargar fórmula S.O.P.A";

    $idu = $_SESSION["user"]["id"];
    $areas = obtenerListaAreas( $dbh, $idu );
    if( isset( $_GET["id_area"] ) ){
        $ida = $_GET["id_area"];
        $area = obtenerAreaPorId( $dbh, $ida );
    }
    if( isset( $_GET["id_s"] ) ){
    	$ids = $_GET["id_s"];
    	$sujeto = obtenerSujetoPorId( $dbh, $ids );
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
			.btn-no-ft{ float: right; margin-top: 28px; }
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
					<?php if( isset($sujeto) ) { ?>
						Sujeto: S
					<?php } else { ?>
					<section class="panel panel-transparent">
						<div class="panel-body">
							<form id="frm_agr_sujeto">
								<div class="row">
									<div class="col-sm-4">
										<div class="row">
											<div class="form-group">
												<label class="control-label">Área</label>
												<select class="form-control" name="area">
													<?php foreach ( $areas as $a ) { ?>
													<option value="<?php echo $a["id"] ?>" 
														<?php 
														echo sop( $a["id"], $area["id"] ) 
														?>><?php echo $a["nombre"] ?>
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="form-group">
												<label class="control-label">Sujeto</label>
												<input type="text" name="nombre" class="form-control" required>
												
											</div>
										</div>
										<div class="row">
											<button type="submit" 
											class="btn btn-primary btn-no-ft">
											Agregar</button></div>
									</div>
								</div>
							</form>
						</div>

					</section>
					<?php } ?>
					<?php if( isset( $sujeto ) ) { ?>
					<section class="panel">
						<form id="frm_edit_area" class="form-horizontal">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										
										<div class="row form-group">
											<div class="col-lg-12">
												<label class="control-label">Sujeto</label>
												<input type="text" name="sujeto" 
												class="form-control">
											</div>
										</div>
										
										<label class="control-label">Objeto</label>
										<div class="input-group mb-md">
											<input type="text" class="form-control">
											<span class="input-group-btn">
											<button class="btn btn-success" type="button">
											 Agregar
											</button>
											</span>
										</div>
										<div class="col-sm-9 col-sm-offset-3">
										<ol class="dd-list">
											<li class="dd-item" data-id="1">
												<div class="dd-handle">Obj 1
													<div class="icon-xx">
														<i class="fa fa-times"></i>
													</div>
												</div>
											</li>
											<li class="dd-item" data-id="2">
												<div class="dd-handle">Obj 2
													<div class="icon-xx">
														<i class="fa fa-times"></i>
													</div>
												</div>
											</li>
										</ol>
										</div>
										<div class="row form-group">
											<div class="col-lg-12">
												<label class="control-label">Propósito</label>
												<input type="text" name="proposisto" 
												class="form-control">
											</div>
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6 col-xs-12">
										<label class="control-label">Actividades</label>
										<div class="input-group mb-md">
											<input type="text" class="form-control">
											<span class="input-group-btn">
											<button class="btn btn-success" type="button"> Agregar</button>
											</span>
										</div>
										<div class="dd" id="nestable">
											<ol class="dd-list">
												<li class="dd-item" data-id="1">
													<div class="dd-handle">Item 1</div>
												</li>
												<li class="dd-item" data-id="1">
													<div class="dd-handle">Item 2</div>
												</li>
											</ol>
										</div>
									</div>
								</div>
							</div>
							<footer class="panel-footer">
								<button class="btn btn-primary" type="submit">Guardar</button>
							</footer>
						</form>
					</section>
					<?php } ?>	
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
		<script src="js/fn-area.js"></script>
		<script src="js/fn-sujeto.js"></script>
		<script src="js/validate-extend.js"></script>
		
	</body>
</html>