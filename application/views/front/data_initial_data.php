<div id="initial_data" class="section col-md-12">

	<!-- Subtitle -->
	<h2 class="sub-header">Datos Iniciales</h2>

	<br>

	<!-- Precio Venta -->
	<div class="form-group col-md-5 <?php if(form_error('precioVenta')) echo 'has-error' ?>">
	 	<label class="col-md-4 control-label">Precio Venta</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="Precio Venta" name="precioVenta"
		      	value="<?php echo set_value('username') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('precioVenta')) ?></span>
	    </div>
	</div>

	<!-- Recompra (%) -->
	<div class="form-group col-md-5 <?php if(form_error('tasaRecompra')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">Recompra (%)</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="Recompra (%)" name="tasaRecompra"
	      		value="<?php echo set_value('tasaRecompra') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('tasaRecompra')) ?></span>
	    </div>
	</div>

	<!-- TEA (%) -->
	<div class="form-group col-md-5 <?php if(form_error('tasaEfectivaAnual')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">TEA (%)</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="TEA (%)" name="tasaEfectivaAnual"
	      		value="<?php echo set_value('tasaEfectivaAnual') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('tasaEfectivaAnual')) ?></span>
	    </div>
	</div>

	<!-- Numero de Periodos -->
	<div class="form-group col-md-5 <?php if(form_error('periodoTotal')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">Numero de Periodos</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="Numero de Periodos" name="periodoTotal"
	      		value="<?php echo set_value('periodoTotal') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('periodoTotal')) ?></span>
	    </div>
	</div>

	<!-- IGV (%) -->
	<div class="form-group col-md-5 <?php if(form_error('tasaIGV')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">IGV (%)</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="IGV (%)" name="tasaIGV"
	      		value="<?php echo set_value('tasaIGV') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('tasaIGV')) ?></span>
	    </div>
	</div>

	<!-- Frecuencia de Pago -->
	<div class="form-group col-md-5 <?php if(form_error('frecuenciaPago')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">Frecuencia de Pago</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="Frecuencia de Pago" name="frecuenciaPago"
	      		value="<?php echo set_value('frecuenciaPago') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('frecuenciaPago')) ?></span>
	    </div>
	</div>

	<!-- IR (%) -->
	<div class="form-group col-md-5 <?php if(form_error('tasaImpuestoRenta')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">IR (%)</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="IR (%)" name="tasaImpuestoRenta"
	      		value="<?php echo set_value('tasaImpuestoRenta') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('tasaImpuestoRenta')) ?></span>
	    </div>
	</div>

	<!-- Periodos de Gracia Total -->
	<div class="form-group col-md-5 <?php if(form_error('periodosGraciaTotal')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">Periodos de Gracia Total</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="Periodos de Gracia Total" name="periodosGraciaTotal"
	      		value="<?php echo set_value('periodosGraciaTotal') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('periodosGraciaTotal')) ?></span>
	    </div>
	</div>

</div>

<hr>