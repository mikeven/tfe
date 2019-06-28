<div class="widget-summary">
	<div class="widget-summary-col widget-summary-col-icon">
		<div class="summary-icon bg-primary icono-tarea">
			<i class="fa fa-thumb-tack"></i>
		</div>
	</div>
	<div class="widget-summary-col">
		<div class="summary">
			<h2 class="title"> Propósitos </h2><hr>
			<div class="info">
				<div class="toggle" data-plugin-toggle data-plugin-options='{ "isAccordion": true }'>
					<?php 
						foreach ( $propositos as $p ) { 
							$actividades = obtenerListaActividades( $dbh, $p["id"] );
					?>
					<section class="toggle">
						<label><?php echo $p["descripcion"] ?></label>
						<div class="toggle-content accord_act_cont">
							<?php 
							foreach ( $actividades as $a ) { ?>
							<p>
								<?php echo iconoActividad( $a["tipo"] )?>
								<a href="#!">
									<?php echo " ".descActividad( $a ) ?>
								</a>
							</p>	
							<?php } ?>
						</div>
					</section>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>