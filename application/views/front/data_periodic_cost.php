<div id="periodic_cost" style="display:inline-block">

	<!-- Subtitle -->
	<h2 class="sub-header">Costos Periodicos</h2>

	<br>

	<!-- Costos Notariales -->
	<div class="form-group col-md-5 <?php if(form_error('costesNotariales')) echo 'has-error' ?>">
	 	<label class="col-md-4 control-label">Costos Notariales</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="Costos Notariales" name="costesNotariales"
		      	value="<?php echo set_value('username') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('costesNotariales')) ?></span>
	    </div>
	</div>

	<!-- Comision de Estudio -->
	<div class="form-group col-md-5 <?php if(form_error('comisionEstudio')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">Comision de Estudio</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="Comision de Estudio" name="comisionEstudio"
	      		value="<?php echo set_value('comisionEstudio') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('comisionEstudio')) ?></span>
	    </div>
	</div>

	<!-- Costos Registrales -->
	<div class="form-group col-md-5 <?php if(form_error('costesRegistrales')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">Costos Registrales</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="Costos Registrales" name="costesRegistrales"
	      		value="<?php echo set_value('costesRegistrales') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('costesRegistrales')) ?></span>
	    </div>
	</div>

	<!-- Comision de Activacion -->
	<div class="form-group col-md-5 <?php if(form_error('comisionActivacion')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">Comision de Activacion</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="Comision de Activacion" name="comisionActivacion"
	      		value="<?php echo set_value('comisionActivacion') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('comisionActivacion')) ?></span>
	    </div>
	</div>

	<!-- Tasacion -->
	<div class="form-group col-md-5 <?php if(form_error('tasacion')) echo 'has-error' ?>">
	    <label class="col-md-4 control-label">Tasacion</label>
	    <div class="col-md-7">
	      	<input type="text" class="form-control" placeholder="Tasacion" name="tasacion"
	      		value="<?php echo set_value('tasacion') ?>" required="">
	        <span class="help-block"><?php echo strip_tags(form_error('tasacion')) ?></span>
	    </div>
	</div>

</div>