<form class="form-horizontal" action="<?php echo base_url('auth/login/process') ?>" method="post">

    <legend>Formulario de Acceso</legend>

    <div class="control-group <?php if(form_error('username')) echo 'error' ?>">
        <label class="control-label">Usuario</label>
        <div class="controls">
            <input type="text" name="username" class="input-xlarge"
               value="<?php echo set_value('username') ?>" placeholder="Usuario" style="height: auto">
            <span class="help-inline"><?php echo strip_tags(form_error('username')) ?></span>
        </div>
    </div>    

    <div class="control-group <?php if(form_error('password')) echo 'error' ?>">
        <label class="control-label">Password</label>
        <div class="controls">
            <input type="password" name="password" class="input-xlarge"
               value="<?php echo set_value('password') ?>" placeholder="Password" style="height: auto">
            <span class="help-inline"><?php echo strip_tags(form_error('password')) ?></span>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">
                Ingresar
            </button>
            <a class="btn" href="<?php echo $base_url ?>">Cancelar</a>
        </div>
    </div>

</form>