<div id="frm-edit-proposito" class="modal-block modal-block-primary mfp-hide">
	<section class="panel">
		<form id="frm-editproposito" class="form-horizontal mb-lg">
			<header class="panel-heading">
				<h2 class="panel-title">
					Editar propósito <span id="lab_np_obj"></span>
				</h2>
			</header>
			<div class="panel-body">
				<input id="id_edit_prop" type="hidden" name="id_prop">
				<div class="form-group mt-lg">
					<label class="col-sm-3 control-label">Descripción</label>
					<div class="col-sm-9">
						<input id="desc_edit_prop" type="text" name="descripcion" class="form-control" placeholder="Escriba una descripción para el propósito" required/>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary">Guardar</button>
						<button id="cl_frm-edit_prop" class="btn btn-default modal-dismiss">Cancelar</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>