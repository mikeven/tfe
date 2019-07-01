<div id="frm-edit-actividad" class="modal-block modal-block-primary mfp-hide">
	<section class="panel">
		<form id="frm-editactividad" class="form-horizontal mb-lg">
			<header class="panel-heading">
				<h2 class="panel-title">
					Editar actividad (<span id="lab_ea_prop"></span>)
				</h2>
			</header>
			<div class="panel-body">
				<input id="id_edit_act" type="hidden" name="id_eact" value="">
				<div class="row">
					<div class="col-sm-3">
						<div class="radio-custom radio-primary redit_act" 
						data-tipo="ae_gestion">
							<input type="radio" id="gestion" name="tipo" required value="g">
							<label for="gestion">Gestión</label>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="radio-custom radio-primary redit_act" 
						data-tipo="ae_escritorio">
							<input type="radio" id="escritorio" name="tipo" required value="e">
							<label for="escritorio">Escritorio</label>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="radio-custom radio-primary redit_act" 
						data-tipo="ae_llamada">
							<input type="radio" id="llamada" name="tipo" required value="l">
							<label for="llamada">Llamada</label>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group mt-lg ae_gestion campos_edit_act">
					<label class="col-sm-3 control-label">Lugar</label>
					<div class="col-sm-9">
						<input type="text" id="editlugar" name="ealugar" class="form-control" 
						placeholder="Escriba un lugar para esta actividad" required/>
					</div>
				</div>
				<div class="form-group mt-lg ae_gestion campos_edit_act">
					<label class="col-sm-3 control-label">Dirección</label>
					<div class="col-sm-9">
						<input type="text" id="editdir" name="eadireccion" class="form-control" 
						placeholder="Escriba una dirección para esta actividad" required/>
					</div>
				</div>
				<div class="form-group mt-lg ae_gestion ae_escritorio campos_edit_act">
					<label class="col-sm-3 control-label">Tarea</label>
					<div class="col-sm-9">
						<input type="text" id="edittarea" name="eatarea" class="form-control" placeholder="Escriba una tarea para esta actividad" required/>
					</div>
				</div>
				<div class="form-group mt-lg ae_llamada campos_edit_act">
					<label class="col-sm-3 control-label">Contacto</label>
					<div class="col-sm-9">
						<input type="text" id="editcontacto" name="eacontacto" class="form-control" placeholder="Escriba un contacto para esta actividad" required/>
					</div>
				</div>
				<div class="form-group mt-lg ae_llamada campos_edit_act">
					<label class="col-sm-3 control-label">Motivo</label>
					<div class="col-sm-9">
						<input type="text" id="editmotivo" name="eamotivo" class="form-control" placeholder="Escriba un motivo para esta actividad" required/>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary">Guardar</button>
						<button id="cl_frm-edit_act" class="btn btn-default modal-dismiss">Cancelar</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>