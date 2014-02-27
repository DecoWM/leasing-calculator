<div id="periodic_cost" class="section col-md-12">

	<!-- Subtitle -->
	<h2 class="sub-header">Costos Periodicos</h2>

	<br>

	<!-- Comision Periodica -->
	<div class="form-group col-md-5 <?php if(form_error('comisionPeriodica')) echo 'has-error' ?>">
	 	<label class="col-md-4 control-label">Comision Periodica</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="Comision Periodica" name="comisionPeriodica"
		      	value="<?php echo set_value('username') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('comisionPeriodica')) ?></span>
	    </div>
	</div>

	<!-- Seguro Riesgo (%) -->
	<div class="form-group col-md-5 <?php if(form_error('tasaSeguroRiesgo')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">Seguro Riesgo (%)</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="Seguro Riesgo (%)" name="tasaSeguroRiesgo"
	      		value="<?php echo set_value('tasaSeguroRiesgo') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('tasaSeguroRiesgo')) ?></span>
	    </div>
	</div>

</div>

<hr>