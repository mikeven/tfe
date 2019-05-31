<section class="panel">
	<header class="panel-heading">
		<h2 class="panel-title">Sujeto</h2>
	</header>
	<div class="panel-body">
		<div class="form-group">
			<label class="control-label">
				<?php echo $sujeto["nombre"]." (".$sujeto["area"].")" ?>
			</label>
		</div>
		<?php if( count( $objetos ) > 0 ) { ?> 
		<div class="form-group">
			<a href="#frm-objeto" class="modal-sizes modal-with-zoom-anim">
				<button class="btn btn-primary" type="submit">
					<i class="fa fa-plus"></i> Agregar objeto
				</button>
			</a>
		</div>
		<?php } ?>
	</div>
</section>
<?php include( "secciones/sopa/frm-objeto.php" ); ?>
<?php include( "secciones/sopa/frm-proposito.php" ); ?>