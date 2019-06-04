<section class="panel">
	<form id="frm_area_sujeto">
		<header class="panel-heading">
			<h2 class="panel-title">Seleccionar Sujeto</h2>
		</header>
		<div class="panel-body">
			<div class="form-group">
				<label class="control-label">Área</label>
				<select class="form-control" name="area" required>
					<option value=""></option>
					<?php foreach ( $areas as $a ) { ?>
					<option value="<?php echo $a["id"] ?>" 
						<?php echo sop( $a["id"], $ida ) 
						?>><?php echo $a["nombre"] ?>
					</option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Sujeto</label>
				<table width="100%">
					<th width="80%">
						<select id="lsujetos" data-plugin-selectTwo 
						class="form-control populate" required>
							<option value=""></option>
							<?php foreach ( $sujetos as $s ) { ?>
								<option value="<?php echo $s["id"] ?>">
									<?php echo $s["nombre"] ?>
								</option>
							<?php } ?>
						</select>
					</th>
					<th width="20%" style="text-align: right;">
						<a href="#frm-sujeto" class="modal-sizes modal-with-zoom-anim">
						<button type="button" class="mb-xs mt-xs mr-xs btn btn-success"><i class="fa fa-plus"></i> </button>
						</a>
					</th>
				</table>
			</div>
				
				
		</div>
		
		<footer class="panel-footer">
			<button class="btn btn-primary" type="submit">Continuar</button>
		</footer>
	</form>
</section>
<?php include( "secciones/sopa/frm-sujeto.php" ); ?>