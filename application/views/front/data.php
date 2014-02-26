<div class="col-md-2 sidebar">
    <?php $this->load->view('front/data_navbar') ?>
</div>

<div class="col-md-10 main">
    <form class="form-horizontal" role="form">
        <?php $this->load->view('front/data_initial_data') ?>
        <?php $this->load->view('front/data_initial_cost') ?>
        <?php $this->load->view('front/data_periodic_cost') ?>
        <?php $this->load->view('front/data_oportunity_cost') ?>
    </form>
</div>