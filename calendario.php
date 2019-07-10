<?php
    /*
     * TFE Life Planner - Calendario
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-actividad.php" );

    include( "fn/fn-actividad.php" );

    checkSession( "" );
    $titulo_pagina = "Calendario";

    $idu = $_SESSION["user"]["id"];
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
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css"/>

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/fullcalendar/fullcalendar.css" />
		<link rel="stylesheet" href="assets/vendor/fullcalendar/fullcalendar.print.css" media="print" />
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<style type="text/css">
			#selector_act_cal, #frm_edithora{ display: none; } 
			.data_act_info, .btn_priord, 
			
			#act_prioridad, #fecha_act_agenda, #confirmacion_desagendar, 
			#confirmar_finalizacion{ display: none; }

			#act_agendada{ float: right; }

			.ph-icono-act .fa, #finalizar_act .fa,  
			#frm_edithora .fa{ color: #FFFFFF !important; }
			
			#desagendar_act .fa{ color: #000 !important;  }

			#act_agendada .fa{ color: yellow !important; }
			#confirmar_desagendar_act{ color: #d2322d;  }

			.subt_accion{ color: #000 !important; float: left; }
			#frm_edithora{ margin-bottom: 50px; }
			#confirmar_finalizacion{ padding: 20px 0 80px 0; background: #f1f1f1; }
			.tit_fin_act{ text-align: center; }
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
					<section class="panel">
						<div class="panel-body">
							<div class="row">
								
								<div class="col-md-12">
									<input id="id_ssu" type="hidden" name="id_usuario" 
									value="<?php echo $idu ?>">
									<div id="calendar"></div>
								</div>
								
							</div>
							<a id="selector_act_cal" href="#actividad-calendario" 
							class="modal-sizes modal-with-zoom-anim" data-ida=""></a>
							<?php include( "secciones/data-actividad-cal.php" ); ?>
						</div>
					</section>
				</section>
			</div>
			
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/fullcalendar/lib/moment.min.js"></script>
		<script src="assets/vendor/fullcalendar/fullcalendar.js"></script>
		<script src="assets/vendor/fullcalendar/lang/es.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		<script src="assets/javascripts/ui-elements/examples.modals.js"></script>
		
		<!-- Theme Custom -->
		<!--<script src="assets/javascripts/theme.custom.js"></script>-->
		<script src="js/fn-acceso.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		<script src="js/fn-ui.js"></script>
		<script src="js/fn-calendario.js"></script>
		<script src="js/fn-actividad.js"></script>
		<script src="js/validate-extend.js"></script>
		<script type="text/javascript">
			/*var idu = $("#id_ssu").val();
			$.ajax({
		        data:{ agendados: 1, id_u: idu },
	            url:"database/data-actividad.php",
	            type: 'POST', // Send post data
	            success: function(response) {
		            //get your events from response.events
		            console.log(response);
		        },
	            error: function() {
	                alert('There was an error while fetching events.');
	            }
		    });*/
		</script>
		
	</body>
</html>