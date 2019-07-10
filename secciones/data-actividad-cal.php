<div id="actividad-calendario" class="modal-block modal-block-primary mfp-hide">
	<section id="panel_act_prop" class="panel panel-warning">
		<header class="panel-heading ph-icono-act">
			<h2 class="panel-title">
				<i id="icono_actividad" class="fa fa-act"></i> |
				<strong ><span id="tx_act"> </span></strong>
				<div id="act_agendada"><i class="fa fa-calendar"></i></div>
			</h2>
		</header>
		<div class="panel-body">
			<div class="widget-summary">
				<div class="widget-summary-col">
					<div class="summary">
			
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
							<div>
								<span id="fecha_act_agenda"></span> 
							</div>
							<div>
								<a id="editar_hora" href="#!">
									<i class="fa fa-clock-o"></i> Editar hora
								</a>
							</div>
							<div id="frm_edithora">
								<form id="frm_edit_hora_act">
									<span class="">Hora de tarea</span>
									<div class="input-group mb-md">
										<input id="nueva_hora" type="text" 
										data-plugin-timepicker class="form-control" 
										data-plugin-options='{ "showMeridian": false }'>
										<span class="input-group-btn">
											<button id="cnf_edithora" class="btn btn-success" 
											type="button" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<i class="fa fa-check"></i>
											</button>
										</span>
										<input type="hidden" id="ida_nvahora" value="">
										<input type="hidden" id="fecha_act_cal" value="">
									</div>
								</form>	
							</div>
						</div>
					</div>
					<div class="summary-footer">
						<div>
							<p class="subt_accion panel-subtitle">Quitar actividad del calendario</p>
							<a id="desagendar_act" href="#!">
								<button type="button" class="btn btn-default">
									<i class="fa fa-calendar-times-o"></i> Desagendar
								</button>
							</a>
						</div>
						
						<div id="confirmacion_desagendar">
							<a id="confirmar_desagendar_act" href="#!">
								<button type="button" class="btn btn-danger">Confirmar</button>
							</a> o 
							<a id="cancelar_desagendar_act" href="#!">
								Cancelar 
							</a>
						</div>
						<hr>
						<div id="finalizar_act">
							<p class="subt_accion panel-subtitle">Marcar actividad finalizada</p>
							<a id="finalizar_act" href="#!">
								<button type="button" class="btn btn-success">
									<i class="fa fa-check"></i> Finalizar
								</button>
							</a>
						</div>
						<div id="confirmar_finalizacion">
							<form id="frm_finalizaract">
								<div class="form-group">
									<h4 class="col-md-12 control-label tit_fin_act">Migrar actividad a historial</h4>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="textareaDefault">Resultado</label>
									<div class="col-md-9">
										<textarea name="resultado" class="form-control" rows="3" id="textareaDefault" required></textarea>
									</div>
									<input id="id_actfinalizar" type="hidden" name="id_actfin">
								</div>
								<div >
									<div class="col-sm-9 col-sm-offset-3">
										<a id="confirmar_finalizar_act" href="#!">
											<button type="submit" class="btn btn-primary">Finalizar</button>
										</a>
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
					<button id="cl_data_desag_act" class="btn btn-default modal-dismiss">Cerrar</button>
				</div>
			</div>
		</footer>
	</section>
</div>