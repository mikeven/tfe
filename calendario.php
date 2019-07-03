<?php
    /*
     * TFE Life Planner - Calendario
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    checkSession( "" );
    $titulo_pagina = "Calendario";

    $idu = $_SESSION["user"]["id"];
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Título -->
		<title>Calendario | TFE Life Planner</title>
		<?php include( "secciones/meta-tags.html" );?>

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/fullcalendar/fullcalendar.css" />
		<link rel="stylesheet" href="assets/vendor/fullcalendar/fullcalendar.print.css" media="print" />

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
					<section class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4 hidden">
									<p class="h4 text-light">Actividades</p>

									<hr />

									<div id='external-events'>
										<div class="external-event label label-default" data-event-class="fc-event-default">Default Event</div>
										<div class="external-event label label-primary" data-event-class="fc-event-primary">Primary Event</div>
										<div class="external-event label label-success" data-event-class="fc-event-success">Success Event</div>
										<div class="external-event label label-warning" data-event-class="fc-event-warning">Warning Event</div>
										<div class="external-event label label-info" data-event-class="fc-event-info">Info Event</div>
										<div class="external-event label label-danger" data-event-class="fc-event-danger">Danger Event</div>
										<div class="external-event label label-dark" data-event-class="fc-event-dark">Dark Event</div>

										<hr />
										<div>
											<div class="checkbox-custom checkbox-default ib">
												<input id="RemoveAfterDrop" type="checkbox"/>
												<label for="RemoveAfterDrop">remove after drop</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div id="calendar"></div>
								</div>
								
							</div>
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
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/fullcalendar/lib/moment.min.js"></script>
		<script src="assets/vendor/fullcalendar/fullcalendar.js"></script>
		<script src="assets/vendor/fullcalendar/lang/es.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		<script src="assets/javascripts/ui-elements/examples.modals.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		<script src="js/fn-acceso.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		<script src="js/fn-calendario.js"></script>
		<script>
			(function() {
				
				$('#calendar').fullCalendar({
					events: [
				      {
				        title  : 'event1',
				        start  : '2019-07-01'
				      },
				      {
				        title  : 'event2',
				        start  : '2019-07-09'
				      },
				      {
				        title  : 'event3',
				        start  : '2019-07-05',
				        allDay : false // will make the time show
				      }
				    ]
				});

			}).apply( this, [ jQuery ]);
		</script>
	</body>
</html>