<?php
    /*
     * TFE Life Planner - Ficha actividad sujeto-objeto
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-sopa.php" );
    include( "database/data-sujeto-objeto.php" );
    include( "database/data-actividad.php" );
    include( "database/data-proposito.php" );

    include( "fn/fn-actividad.php" );
    include( "fn/fn-sujeto-objeto.php" );
    checkSession( "" );
    
    $idu = $_SESSION["user"]["id"];
    if( isset( $_GET["ids"], $_GET["ido"] ) ){
        $ids = $_GET["ids"];	$ido = $_GET["ido"];
        $reg_so = obtenerSujetoObjetoPorids( $dbh, $ids, $ido );
        $propositos = obtenerPropositosSujetoObjeto( $dbh, $ids, $ido );

        $indice = obtenerIndiceSOPAPorUsuario( $dbh, $idu );
        $so_ant_sig = obtenerSOAntSig( $indice, $ids, $ido );
        $lnk_gestion_pa = "cargar-sopa.php?ids=$ids&ido=$ido";
    }
    $titulo_pagina = $reg_so["nsujeto"]." - ".$reg_so["nobjeto"];
    $breadcrumb = $titulo_pagina;
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
			
			#panel_act_prop, .data_act_info, .btn_priord, 
			#act_prioridad, #fecha_act_agenda{ display: none; }

			.accord_act_cont{ margin-left: 25px; }
			#act_prioridad, #act_agendada{ float: right; color: yellow; }

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
							<?php 
								include( "secciones/sopa/panel_propositos_so.php" ); 
							?>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12">
							<?php 
								include( "secciones/sopa/panel_actividades_proposito.php" ); 
							?>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<?php include( "secciones/sopa/nav_sujetos_objetos.php" ); ?>
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
		<script src="js/fn-actividad.js"></script>
		<script src="js/validate-extend.js"></script>
		
	</body>
</html>