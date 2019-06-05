<div class="dd dd-nodrag" id="nestable">
	<ol class="dd-list ">
		<?php 
			foreach ( $s_o as $so ) { 
			$o["id"] = $so["idobjeto"];
			$o["nombre"] = $so["nobjeto"];
			$propositos = obtenerListaPropositos( $dbh, $o["id"] );
		?>
		<li class="dd-item" 
		data-id="<?php echo $o["id"]?>">
			<div class="dd-handle">
				<?php echo $o["nombre"]?>
				
			</div>
			<ol class="dd-list">
				<?php foreach ( $propositos as $p ) { 
					?>
				<li class="dd-item" data-id="3">
					<div class="dd-handle"><?php echo $p["descripcion"]?></div>
				</li>
				<?php } ?>
				<li class="dd-item" data-id="nuevo_proposito">
					<div class="dd-handle">
					<a href="#frm-proposito" class="modal-sizes modal-with-zoom-anim" 
					data-ido="<?php echo $o["id"]?>">
						<button type="button" class="mb-xs mt-xs mr-xs btn btn-xs btn-success btn-no-ft">
							<i class="fa fa-plus" aria-hidden="true"></i> Propósito
						</button>
					</a>
					</div>
				</li>
			</ol>
		</li>
		<?php }  ?>
									
	</ol>
</div>