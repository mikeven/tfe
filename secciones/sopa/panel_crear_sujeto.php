<section class="panel">
	<form id="frm_agr_sujeto">
		<header class="panel-heading">
			<h2 class="panel-title">Crear Sujeto</h2>
		</header>
		<div class="panel-body">
			<div class="form-group">
				<label class="control-label">Área</label>
				<select class="form-control" name="area">
					<?php foreach ( $areas as $a ) { ?>
					<option value="<?php echo $a["id"] ?>" 
						<?php 
						echo sop( $a["id"], $area["id"] ) 
						?>><?php echo $a["nombre"] ?>
					</option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Sujeto</label>
				<input type="text" name="nombre" class="form-control" required>
			</div>
		</div>
		<footer class="panel-footer">
			<button class="btn btn-primary" type="submit">Agregar</button>
		</footer>
	</form>
</section>