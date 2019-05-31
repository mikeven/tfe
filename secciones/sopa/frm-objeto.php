<div id="frm-objeto" class="modal-block modal-block-primary mfp-hide">
	<section class="panel">
		<form id="frm-nobjeto" class="form-horizontal mb-lg" novalidate="novalidate">
			<header class="panel-heading">
				<h2 class="panel-title">Agregar objeto</h2>
			</header>
			<div class="panel-body">
				<input id="id_s" type="hidden" name="idsujeto" value="<?php echo $ids ?>">
				<div class="form-group mt-lg">
					<label class="col-sm-3 control-label">Descripción</label>
					<div class="col-sm-9">
						<input type="text" name="descripcion" class="form-control" placeholder="Escriba una descripción para el objeto" required/>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary">Agregar</button>
						<button class="btn btn-default modal-dismiss">Cancelar</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>