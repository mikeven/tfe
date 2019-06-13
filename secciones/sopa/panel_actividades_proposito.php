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
						Otras actividades para <br> 
						"<b><?php echo $actividad["proposito"] ?> </b>"
					<hr>
					<div class="info">
					<?php 
						foreach ( $pactividades as $a ) {
							if( $a["id"] != $actividad["idact"] ){ 
					?>
						<div>
							<?php echo iconoActividad( $a["tipo"] )?>
							<a href="actividad.php?id=<?php echo $a['id'] ?>">
								<?php echo " ".descActividad( $a ) ?>
							</a>
						</div>
					<?php 	
							} 
						} 
					?>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
</section>