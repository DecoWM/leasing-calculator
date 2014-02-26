<?php if(!isset($logout)): ?>
<nav class="navbar navbar-default" role="navigation" style="margin-top:10px">
    <!--div class="container"-->
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" style="display:none">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php if($active == 'data') echo "class='active'" ?>>
                    <a href="<?php echo base_url() ?>">Datos</a>
                </li>

                <li <?php if($active == 'results') echo "class='active'" ?>>
                    <a href="<?php echo base_url('results') ?>">Resultados</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    <!--/div--><!-- /.container-fluid -->
</nav><!-- /.navbar -->
<?php endif; ?>