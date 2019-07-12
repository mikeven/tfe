<div id="actividad-historial" class="modal-block modal-block-primary mfp-hide">
	<section id="panel_act_prop" class="panel panel-warning">
		<header class="panel-heading ph-icono-act">
			<h2 class="panel-title">
				<i id="icono_actividad" class="fa fa-act"></i> |
				<strong ><span id="tx_act"> </span></strong>
			</h2>
		</header>
		<div class="panel-body">
			<div class="widget-summary">
				<div class="widget-summary-col">
					<div class="summary">
						<div class="info">
							<i class="fa fa-flag-o"></i>
							<strong >Sujeto:</strong>
							<span id="tx_sujeto_act"> </span>
						</div>
						<div class="info">
							<i class="fa fa-puzzle-piece"></i>
							<strong >Objeto:</strong>
							<span id="tx_objeto_act"> </span>
						</div>
						<div class="info">
							<i class="fa fa-crosshairs"></i>
							<strong >Propósito:</strong>
							<span id="tx_prop_act"> </span>
						</div>
						
						<div class="info">
							<div id="info-g" class="data_act_info">
								<div> 
									<b>Lugar: </b> <span id="act_lugar"></span> 
								</div>
								<div> 
									<b>Dirección: </b> <span id="act_dir"></span> 
								</div>
								<div> 
									<b>Tarea: </b> <span id="act_tarea_g"></span> 
								</div>
							</div>
							<div id="info-e" class="data_act_info">
								<div> 
									<b>Tarea: </b> <span id="act_tarea_e"></span> 
								</div>
							</div>
							<div id="info-l" class="data_act_info">
								<div> 
									<b>Contacto: </b> <span id="act_contacto"></span> 
								</div>
								<div> 
									<b>Motivo: </b> <span id="act_motivo"></span> 
								</div>
							</div>
						</div>
						<hr>
						<div id="resultado_actual">
							<div class="resultado">
								<b>Resultado: </b> <span class="tx_resultado_act"></span>
							</div>
							<div>
								<a id="lnk_editr" href="#!">
								<i class="fa fa-edit"></i> Editar resultado</a>
							</div>
						</div>
						<div id="edicion_resultado">
							<form id="frm_editresult">
								<div class="form-group">
									<label class="col-md-3 control-label" for="textareaDefault">Resultado</label>
									<div class="col-md-9">
										<textarea name="resultado" class="form-control tx_resultado_act" rows="3" 
										id="tx_nvoresult" required></textarea>
									</div>
									<input id="id_act" type="hidden" name="id_actfin">
								</div>
								<div >
									<div class="col-sm-9 col-sm-offset-3">
										<button id="canc_edit_r" type="button" class="btn btn-default">Cancelar</button>
										<button type="submit" class="btn btn-primary">Guardar</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>			
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button id="cl_data_hist_act" class="btn btn-default modal-dismiss">Cerrar</button>
				</div>
			</div>
		</footer>
	</section>
</div>