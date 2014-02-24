<?php if(!isset($logout)): ?>
<div class="navbar">
    <div class="navbar-inner" style="padding:0">
        <div class="container">
            <ul class="nav">

                <li <?php if($active == 'data') echo "class='active'" ?>>
                    <a href="<?php echo base_url() ?>">Datos</a>
                </li>

                <li <?php if($active == 'results') echo "class='active'" ?>>
                    <a href="<?php echo base_url('results') ?>">Resultados</a>
                </li>
                
            </ul>
        </div>
    </div>
</div><!-- /.navbar -->
<?php endif; ?>