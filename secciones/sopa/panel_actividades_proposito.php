<section class="panel panel-featured-top panel-featured-primary">
	<div class="panel-body">
		<div class="widget-summary">
			<div class="widget-summary-col widget-summary-col-icon">
				<div class="summary-icon bg-primary icono-tarea" data-toggle="tooltip" 
				data-placement="top" title="<?php echo etiqAct( $actividad['tipo_act'] ) ?>">
				<?php //echo iconoActividad( $actividad["tipo_act"] ) ?>
				</div>
			</div>
			<div class="widget-summary-col">
				<div class="summary">
					<h4 class="title"><?php //echo $actividad["narea"]?></h4>
					<hr>
					<div class="info">
						<i class="fa fa-flag-o"></i>
						<strong >Sujeto:</strong>
						<span>
							
						</span>
					</div>
					<div class="info">
						<i class="fa fa-puzzle-piece"></i>
						<strong >Objeto:</strong>
						<span>
							
						</span>
					</div>
					<div class="info">
						<i class="fa fa-crosshairs"></i>
						<strong >Propósito:</strong>
						<span>
							
						</span>
					</div>
					<div class="info">
						<i class="fa fa-thumb-tack"></i>
						<strong >Actividad:</strong>
						<span>
			
						</span>
					</div>
					<div class="info">
			<?php 
			//include( "secciones/sopa/data-actividad.php" ) ?>
					</div>
				</div>
				<div class="summary-footer">
					<button type="button" class="mb-xs mt-xs mr-xs btn btn-warning"><i class="fa fa-star"></i> Prioridad</button>
				</div>
			</div>
		</div>
	</div>
</section>