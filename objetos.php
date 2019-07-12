<?php
    /*
     * TFE Life Planner - Sujetos
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-objeto.php" );
    checkSession( "" );
    $titulo_pagina = "Objetos";

    $idu = $_SESSION["user"]["id"];
    $objetos = obtenerListaObjetos( $dbh, $idu );
    $breadcrumb = $titulo_pagina;
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
						<div class="col-md-4 col-sm-6 col-xs-12 hidden">
							<section class="panel">
								<form id="frm-nuevo-objeto" class="form-horizontal">
									<input type="hidden" name="idu" value="<?php echo $idu?>">
									<header class="panel-heading">
										<h2 class="panel-title">Agregar objeto</h2>
									</header>
									<div class="panel-body">
										<p class="p_inst">Escriba un nombre para el objeto nuevo</p>
										
										<div class="row form-group">
											<div class="col-lg-12">
												<input type="text" name="nombre" placeholder="Nombre" class="form-control" required>
											</div>
										</div>
									</div>
									<footer class="panel-footer">
										<button class="btn btn-primary" type="submit">Agregar</button>
									</footer>
								</form>
							</section>
						</div>
						<div class="col-md-8 col-sm-6 col-xs-12">
							<section class="panel">
								<header class="panel-heading">
									<h2 class="panel-title">Objetos registrados</h2>
								</header>
								<div id="tabla_objetos" class="panel-body">
									<table id="datatable-default"
									class="table table-bordered table-striped mb-none" >
										<thead>
											<tr>
												<th width="50%">Nombre</th>
												<th width="20%">Editar</th>
												<th width="30%">Eliminar</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ( $objetos as $o ) { ?>
											<tr class="gradeX">
												<td><?php echo $o["nombre"] ?></td>
												<td>
													<a href="editar-objeto.php?id=<?php echo $o["id"]?>">
												<i class="fa fa-edit"></i> Editar</a>
												</td>
												<td>
													<a href="#confirmar-accion" 
													class="modal-sizes modal-with-zoom-anim elim_objeto" 
													data-ido="<?php echo $o["id"] ?>">
														<i class="fa fa-trash-o"></i> Eliminar
													</a>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</section>
							<?php include( "secciones/notificaciones/confirmar-accion.html" );?>
							<input id="id-objeto-e" type="hidden">
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
		<script src="js/fn-objeto.js"></script>
		<script src="js/validate-extend.js"></script>
		
	</body>
</html>