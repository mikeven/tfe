<section class="panel">
	<form id="frm_sujeto_objeto">
		<header class="panel-heading">
			<h2 class="panel-title">Seleccionar Sujeto - Objeto</h2>
		</header>
		<input type="hidden" name="idu" value="<?php echo $idu ?>">
		<input type="hidden" name="idsesion" value="<?php echo $idsesion ?>">
		<div class="panel-body">
			<div class="form-group">
				<label class="control-label">Área</label>
				<select id="lareas" class="form-control" required>
					<option value=""></option>
					<?php foreach ( $areas as $a ) { ?>
					<option value="<?php echo $a["id"] ?>" 
						<?php echo sop( $a["id"], $ida ) ?>><?php echo $a["nombre"] ?>
					</option>
					<?php } ?>
				</select>
				<input type="hidden" name="idarea" value="<?php echo $ida ?>">
			</div>
			<hr>
			<div class="form-group">
				<label class="control-label">Sujeto</label>
				<select id="lsujetos" data-plugin-selectTwo 
				class="form-control populate" required >
					<option value=""></option>
					<?php foreach ( $sujetos as $s ) { ?>
						<option value="<?php echo $s["id"] ?>" 
							<?php echo sop( $s["id"], $ids ) ?>><?php echo $s["nombre"] ?>
						</option>
					<?php } ?>
				</select>
				<input type="hidden" name="idsujeto" value="<?php echo $ids?>">
			</div>
			<div id="agg_objeto" class="form-group">
				<label class="control-label">Objeto</label>
				<table width="100%">
					<th width="80%">
						<select id="lobjetos" data-plugin-selectTwo 
						class="form-control populate" required name="idobjeto">
							<option value=""></option>
							<?php foreach ( $objetos as $o ) { ?>
								<option value="<?php echo $o["id"] ?>">
									<?php echo $o["nombre"] ?>
								</option>
							<?php } ?>
						</select>
					</th>
					<th width="20%" style="text-align: right;">
						<a href="#frm-objeto" class="modal-sizes modal-with-zoom-anim">
						<button type="button" class="mb-xs mt-xs mr-xs btn btn-success"><i class="fa fa-plus"></i> </button>
						</a>
					</th>
				</table>
			</div>				
		</div>
		<footer id="agg-s-o" class="panel-footer">
			<button type="submit" class="mb-xs mt-xs mr-xs btn btn-success">
				Agregar <i class="fa fa-arrow-right"></i>
			</button>
		</footer>
	</form>
</section>
<?php include( "secciones/sopa/frm-sujeto.php" ); ?>
<?php include( "secciones/sopa/frm-objeto.php" ); ?>