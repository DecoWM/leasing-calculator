<?php

class Front_Controller extends Base_Controller 
{
	public function __construct()
	{
		parent::__construct();
        
        if(!Context::isLoggedIn()) 
        {
           redirect(base_url('auth/login'));
        }
        
        $this->instances = array();
        
        $this->load->library('alert');
        $this->data['alerts'] = Alert::getAlerts();
	}
}