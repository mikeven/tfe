<section class="panel panel-featured-top panel-featured-primary">						
	<div class="panel-body">
		<div class="widget-summary">
			<div class="widget-summary-col widget-summary-col-icon">
				<div class="summary-icon bg-primary icono-tarea">
					<i class="fa fa-crosshairs"></i>
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
									<h2 class="title">Actividades</h2>
									<?php 
									foreach ( $actividades as $a ) { ?>
									<div>
										<?php echo iconoActividad( $a["tipo"] )?>
										<a class="sel_actprop" href="#!" 
										data-ida="<?php echo $a['id'] ?>" 
										data-prop="<?php echo $p['descripcion'] ?>">
											<?php echo " ".descActividad( $a ) ?>
										</a>
									</div>	
									<?php } ?>
								</div>
							</section>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>