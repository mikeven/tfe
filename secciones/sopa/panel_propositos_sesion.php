<section class="panel">				
	<div class="panel-body">
		<div class="widget-summary">
			<div class="widget-summary-col widget-summary-col-icon">
				<div class="summary-icon bg-info icono-tarea">
					<i class="fa fa-bell"></i>
				</div>
			</div>
			<div class="widget-summary-col">
				<div class="summary">
					<h4 class="title">
						Propósitos de la sesión de actividad actual
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
							<div>
								<a href="actividad.php?id=<?php echo $pa['id'] ?>" 
									class="act_sesion"> 
									<?php echo etiqAct( $pa["tipo"] ) ?>
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