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
						Actividades del propósito de actividad actual
					<hr>
					<div class="info">
					<?php 
						foreach ( $pactividades as $a ) {
						if( $a["id"] != $actividad["idact"] ){ 
					?>
						<div>
						<a href="#!">
							<?php echo etiqAct($a["tipo"])?>
						</a>
						</div>
					<?php } } ?>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
</section>