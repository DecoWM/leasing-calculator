<?php

class Auth_back extends Base_Controller
{
	function index()
    {
        die('Can\'t access directly');
    }

	function login($process = false)
	{
		$this->config->load('login');

        if($process) 
        {
        	$this->form_validation->set_rules('username','Username','required|callback_check_username');
            $this->form_validation->set_rules('password','Password','required|callback_check_password');

            if($this->form_validation->run())
            {
                Admincontext::logIn();
                redirect(base_url('admin'));
            }
        }

        $this->load->library('alert');
        $this->data['alerts'] = Alert::getAlerts();

        $this->data['logout'] = true;
        $this->load->view('admin/common/header_view',$this->data);
        $this->load->view('admin/login_form',$this->data);
        $this->load->view('admin/common/footer_view',$this->data);
	}
    
	function logout()
	{
		Admincontext::logOut();
		redirect(base_url('admin/auth/login'));
	}

    function check_username($username)
    {
        if($username != $this->config->item('admin_username'))
        {
            $this->form_validation->set_message('check_username', 'Nombre de usuario incorrecto');
            return false;
        }
    }

    function check_password($password)
    {
        if($password != $this->config->item('admin_password'))
        {
            $this->form_validation->set_message('check_password', 'Contraseña incorrecta');
            return false;
        }
    }
}