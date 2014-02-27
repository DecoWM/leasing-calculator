<html>
<head>
    <title>Leasing Calculator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo $css_path ?>/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $css_path ?>/front.css" rel="stylesheet">
    
    <script>
        var host = "<?php echo $base_url ?>";
    </script>
</head>
<body data-controller="<?php echo $controller ?>" class="<?php echo $controller ?>">

<div class="container" >

    <div class="masthead row">
        <h3 class="muted col-md-4"><a href="<?php echo base_url() ?>">Leasing Calculator</a></h3>
        <div class="col-md-3 col-md-offset-5" style="text-align: right; margin-top: 15px">
            <?php if(!isset($logout)): ?>
            <a class="btn btn-danger" href="<?php echo base_url('auth/logout') ?>">Salir</a>
            <?php endif; ?>
        </div>
    </div>

    <?php $this->load->view('front/common/navbar') ?>
    <?php $this->load->view('front/common/alerts') ?>

    <div class="content row">