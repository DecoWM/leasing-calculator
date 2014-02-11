<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_front extends Base_Controller 
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
                Context::logIn();
                redirect(base_url());
            }
        }

        $this->load->library('alert');
        $this->data['alerts'] = Alert::getAlerts();

        $this->data['logout'] = true;
        $this->load->view('front/common/header_view',$this->data);
        $this->load->view('front/login_form',$this->data);
        $this->load->view('front/common/footer_view',$this->data);
    }
    
    function logout()
    {
        Context::logOut();
        redirect(base_url('auth/login'));
    }

    function check_username($username)
    {
        if($username != $this->config->item('username'))
        {
            $this->form_validation->set_message('check_username', 'Nombre de usuario incorrecto');
            return false;
        }
    }

    function check_password($password)
    {
        if($password != $this->config->item('password'))
        {
            $this->form_validation->set_message('check_password', 'Contraseña incorrecta');
            return false;
        }
    }

}