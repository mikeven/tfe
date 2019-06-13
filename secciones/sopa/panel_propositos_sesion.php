<section class="panel panel-featured-top panel-featured-primary">				
	<div class="panel-body">
		<div class="widget-summary">
			<div class="widget-summary-col widget-summary-col-icon hidden">
				<div class="summary-icon bg-primary icono-tarea">
					<i class="fa fa-thumb-tack"></i>
				</div>
			</div>
			<div class="widget-summary-col">
				<div class="summary">
					<h4 class="title">
						Propósitos de la sesión de Sujeto-Objeto actual
					<hr>
					<div class="info">
					<?php 
						foreach ( $propositos as $p ) {
							if( $p["id"] != $actividad["idprop"] ){
								$pact = obtenerListaActividades( $dbh, $p["id"] );	 
					?>
						
						<div>
						<?php echo $p["descripcion"] ?>
						</div>
						
						<?php  foreach ( $pact as $pa ) { ?>
							<div class="act_sesion">
								<?php echo iconoActividad( $pa["tipo"] )?>
								<a href="actividad.php?id=<?php echo $pa['id'] ?>">
									<?php echo " ".descActividad( $pa ) ?>
								</a>
							</div>
						<?php  } ?>

							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>