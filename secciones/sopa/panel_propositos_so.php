<section class="panel panel-primary">	
	<header class="panel-heading">
		<h2 class="panel-title">
			<i class="fa fa-crosshairs"></i> |
			<strong >Propósitos</strong>
		</h2>
	</header>					
	<div class="panel-body">
		<div class="widget-summary">
			<div class="widget-summary-col">
				<div class="summary">
					
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
					<hr>
					<a href="<?php echo $lnk_gestion_pa ?>">
					Gestionar propósitos y actividades</a>
				</div>
			</div>
		</div>
	</div>
</section>