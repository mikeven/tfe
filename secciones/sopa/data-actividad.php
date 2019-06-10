<div class="info-act">
	<?php if( $actividad["tipo_act"] == "g" ) { ?>
		<div>
			<span><b>Lugar: </b> <?php echo $actividad["lugar"] ?></span>
		</div>
		<div>
			<span><b>Dirección: </b> <?php echo $actividad["direccion"] ?></span>
		</div>
		<div>
			<span><b>Tarea: </b> <?php echo $actividad["tarea"] ?></span>
		</div>
	<?php } ?>

	<?php if( $actividad["tipo_act"] == "e" ) { ?>
		<div>
			<span><b>Tarea: </b> <?php echo $actividad["tarea"] ?></span>
		</div>
	<?php } ?>

	<?php if( $actividad["tipo_act"] == "l" ) { ?>
		<div>
			<span><b>Contacto: </b> <?php echo $actividad["contacto"] ?></span>
		</div>
		<div>
			<span><b>Motivo: </b> <?php echo $actividad["motivo"] ?></span>
		</div>
	<?php } ?>
</div>