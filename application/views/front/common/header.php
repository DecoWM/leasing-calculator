<html>
<head>
    <title>Leasing Calculator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo $css_path ?>/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $css_path ?>/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo $css_path ?>/bootstrap-fileupload.min.css" rel="stylesheet">
    <link href="<?php echo $css_path ?>/data-tables.css" rel="stylesheet">
    <link href="<?php echo $css_path ?>/front.css" rel="stylesheet">
    
    <script>
        var host = "<?php echo $base_url ?>";
    </script>
</head>
<body data-controller="<?php echo $controller ?>" class="<?php echo $controller ?>">

<div class="container" >

    <div class="masthead">
        <div class="row-fluid">
            <h3 class="muted span4"><a href="<?php echo base_url() ?>">Leasing Calculator</a></h3>
            <div class="span4 offset4" style="text-align: right; margin-top: 15px">
                <?php if(!isset($logout)): ?>
                <a class="btn btn-danger" href="<?php echo base_url('auth/logout') ?>">Salir</a>
                <?php endif; ?>
            </div>
        </div>
        <?php $this->load->view('front/common/navbar') ?>
        <?php $this->load->view('front/common/alerts') ?>
    </div>