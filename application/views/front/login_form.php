<form class="form-signin col-md-4" action="<?php echo base_url('auth/login/process') ?>" method="post">

    <h2 class="form-signin-heading">Acceso</h2>

    <div class="form-group <?php if(form_error('username')) echo 'has-error' ?>">
        <label class="control-label">Usuario</label>
        <input type="text" class="form-control" placeholder="Usuario" name="username"
            value="<?php echo set_value('username') ?>" required="">
        <span class="help-block"><?php echo strip_tags(form_error('username')) ?></span>
    </div>
    
    <div class="form-group <?php if(form_error('password')) echo 'has-error' ?>">
        <label class="control-label">Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password"
            value="<?php echo set_value('password') ?>" required="">
        <span class="help-block"><?php echo strip_tags(form_error('password')) ?></span>
    </div>

    <button type="submit" class="btn btn-primary">
        Ingresar
    </button>
    <a class="btn" href="<?php echo $base_url ?>">Cancelar</a>

</form>