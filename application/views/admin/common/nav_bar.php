<?php if(!isset($logout)): ?>
<div class="navbar">
    <div class="navbar-inner" style="padding:0">
        <div class="container">
            <ul class="nav">

                <li <?php if($active == 'home') echo "class='active'" ?>>
                    <a href="<?php echo base_url('admin') ?>">Inicio</a>
                </li>

                <li <?php if($active == 'season') echo "class='active'" ?>>
                    <a href="<?php echo base_url('admin/season') ?>">Jornada</a>
                </li>

                <li <?php if($active == 'ranking') echo "class='active'" ?>>
                    <a href="<?php echo base_url('admin/ranking') ?>">Ranking</a>
                </li>

                <li <?php if($active == 'quiz') echo "class='active'" ?>>
                    <a href="<?php echo base_url('admin/quiz') ?>">Quizzes</a>
                </li>

                <li <?php if($active == 'team') echo "class='active'" ?>>
                    <a href="<?php echo base_url('admin/team') ?>">Equipos</a>
                </li>

                <li <?php if($active == 'player') echo "class='active'" ?>>
                    <a href="<?php echo base_url('admin/player') ?>">Jugadores</a>
                </li>

                <li <?php if($active == 'game') echo "class='active'" ?>>
                    <a href="<?php echo base_url('admin/game') ?>">Encuentros</a>
                </li>

                <li <?php if($active == 'award') echo "class='active'" ?>>
                    <a href="<?php echo base_url('admin/award') ?>">Premios</a>
                </li>

                <li <?php if($active == 'question') echo "class='active'" ?>>
                    <a href="<?php echo base_url('admin/question') ?>">Preguntas</a>
                </li>

                <li <?php if($active == 'message') echo "class='active'" ?>>
                    <a href="<?php echo base_url('admin/message') ?>">Mensaje de Inicio</a>
                </li>
                
            </ul>
        </div>
    </div>
</div><!-- /.navbar -->
<?php endif; ?>