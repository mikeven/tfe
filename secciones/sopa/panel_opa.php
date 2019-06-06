<div class="dd dd-nodrag" id="nestable">
	<ol class="dd-list ">
		<?php 
			foreach ( $s_o as $so ) { 
				$o["id"] = $so["idobjeto"];
				$o["nombre"] = $so["nobjeto"];
				$propositos = obtenerListaPropositos( $dbh, $so["id_so"] );
		?>
		<li class="dd-item" data-id="<?php echo $o['id']?>">
			<div class="dd-handle item_obj">
				<span class="icon_obj">OBJ</span> | <?php echo $o["nombre"]?>
			</div>
			<ol class="dd-list">
				
				<?php 
					foreach ( $propositos as $p ) {
						$actividades = obtenerListaActividades( $dbh, $p["id"] );
				?>
				
					<li class="dd-item" data-id="<?php echo $p['id']?>">
						<div class="dd-handle item_pro">
							<span class="icon_obj">PRO</span> | <?php echo $p["descripcion"]?>
						</div>
						<ol class="dd-list">
							<?php foreach ( $actividades as $a ) { ?>
								<li class="dd-item" data-id="<?php echo $a['id']?>">
									<div class="dd-handle item_act">
										<span class="icon_obj">ACT</span> | 
										<?php echo "(".strtoupper( $a["tipo"] ).") ".
									"$a[tarea] $a[lugar] $a[direccion] $a[contacto] $a[motivo]" ?>
									</div>
								</li>
							<?php } ?>
							<li class="dd-item" data-id="nueva_actividad">
								<div class="dd-handle nopa">
									<a href="#frm-actividad" class="modal-sizes modal-with-zoom-anim btn_nactiv" 
									data-idp="<?php echo $p["id"]?>" 
									data-np="<?php echo $p['descripcion']?>">
										<button type="button" class="mb-xs mt-xs mr-xs btn btn-sm btn-info btn-no-ft">
											<i class="fa fa-plus" aria-hidden="true"></i> Actividad
										</button>
									</a>
								</div>
							</li>
						</ol>
					</li>
				
				<?php } ?>
				
				<li class="dd-item" data-id="nuevo_proposito">
					<div class="dd-handle nopa">
						<a href="#frm-proposito" class="modal-sizes modal-with-zoom-anim btn_nprop" 
						data-iso="<?php echo $so["id_so"]?>" 
						data-n-so="<?php echo $so['nsujeto'].' :: '.$o['nombre']?>">
							<button type="button" class="mb-xs mt-xs mr-xs btn btn-sm btn-success btn-no-ft">
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
<?php include( "secciones/sopa/frm-proposito.php" ); ?>
<?php include( "secciones/sopa/frm-actividad.php" ); ?>