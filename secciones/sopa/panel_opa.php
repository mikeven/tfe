<div class="dd dd-nodrag" id="nestable">
	<ol class="dd-list ">
		<?php 
			foreach ( $s_o as $so ) { 
				$o["id"] = $so["idobjeto"];
				$o["nombre"] = $so["nobjeto"];
				$propositos = obtenerListaPropositosSO( $dbh, $so["id_so"] );
		?>
		<li class="dd-item" data-id="<?php echo $o['id']?>">
			<div class="dd-handle item_obj">
				<span class="icon_obj">
					<i class="fa fa-puzzle-piece" aria-hidden="true"></i>
				</span> | <?php echo $o["nombre"]?>
			</div>
			<ol class="dd-list">
				
				<?php 
					foreach ( $propositos as $p ) {
						$actividades = $p["lactividades"];
				?>
				
					<li class="dd-item" data-id="<?php echo $p['id']?>">
						<div class="dd-handle item_pro">
							<span class="icon_obj">
								<i class="fa fa-crosshairs" aria-hidden="true"></i>
							</span> | <?php echo $p["descripcion"]?>
							<div class="editableicon">
								<a href="#frm-edit-proposito" class="modal-sizes modal-with-zoom-anim i_edit_prop" 
								data-idp="<?php echo $p['id'] ?>" 
								data-desc="<?php echo $p['descripcion']?>">
									<i class="fa fa-edit" aria-hidden="true"></i>
								</a> 
								<?php if( count( $actividades ) == 0 ) { ?> 
								|<a href="#confirmar-accion" 
								class="modal-sizes modal-with-zoom-anim elim_prop" 
								data-idp="<?php echo $p["id"] ?>"
								data-desc="<?php echo $p['descripcion'];?>">
									<i class="fa fa-times" aria-hidden="true"></i>
								</a>
								<?php } ?>
							</div>
						</div>
						<ol class="dd-list">
							<?php foreach ( $actividades as $a ) { ?>
								<li class="dd-item" data-id="<?php echo $a['id']?>">
									<div class="dd-handle item_act">
										<span class="icon_obj">
										<i class="fa fa-thumb-tack" aria-hidden="true"></i>
										</span> | 
										<?php echo "(".strtoupper( $a["tipo"] ).") ". descActividad( $a )?>
										<div class="editableicon">
											<a href="#frm-edit-actividad" class="modal-sizes modal-with-zoom-anim i_edit_act" 
											data-ida="<?php echo $a['id'] ?>">
											<i class="fa fa-edit" aria-hidden="true"></i>
											</a>  
											<?php if( $a["estado"] == 'creada' ) { ?>
											   |<a href="#confirmar-accion" 
												class="modal-sizes modal-with-zoom-anim elim_actividad" 
												data-ida="<?php echo $a["id"] ?>"
												data-desc="<?php echo "(".strtoupper( $a["tipo"] ).") ". descActividad( $a )?>">
												<i class="fa fa-times" aria-hidden="true"></i>
												</a>
											<?php } ?>
										</div>
									</div>
								</li>
							<?php } ?>
							<li class="dd-item" data-id="nueva_actividad">
								<div class="dd-handle nopa">
									<a href="#frm-actividad" class="modal-sizes modal-with-zoom-anim btn_nactiv" 
									data-idp="<?php echo $p["id"]?>" 
									data-np="<?php echo $p['descripcion']?>" 
									data-toggle="tooltip" data-placement="top" 
									title="Agregar actividad">
										<button type="button" class="mb-xs mt-xs mr-xs btn btn-sm btn-act btn-no-ft">
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
						data-n-so="<?php echo $so['nsujeto'].' :: '.$o['nombre']?>"
						data-toggle="tooltip" data-placement="top" title="Agregar propósito">
							<button type="button" class="mb-xs mt-xs mr-xs btn btn-sm btn-pro btn-no-ft">
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

<?php include( "secciones/sopa/frm-edit-proposito.php" ); ?>
<?php include( "secciones/sopa/frm-edit-actividad.php" ); ?>