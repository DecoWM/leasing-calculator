<div id="oportunity_cost" class="section last col-md-12">

	<!-- Subtitle -->
	<h2 class="sub-header">Costo de Oportunidad</h2>

	<br>

	<!-- COK (%) -->
	<div class="form-group col-md-5 <?php if(form_error('tasaCOK')) echo 'has-error' ?>">
	 	<label class="col-md-4 control-label">COK (%)</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="COK (%)" name="tasaCOK"
		      	value="<?php echo set_value('username') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('tasaCOK')) ?></span>
	    </div>
	</div>

	<!-- WACC (%) -->
	<div class="form-group col-md-5 <?php if(form_error('tasaWACC')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">WACC (%)</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="WACC (%)" name="tasaWACC"
	      		value="<?php echo set_value('tasaWACC') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('tasaWACC')) ?></span>
	    </div>
	</div>

</div>