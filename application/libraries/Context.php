<?php

class Context 
{
	//Get actual controller
	public static function getController()
    {
		$router =& load_class('Router', 'core');
		$controller = $router->fetch_class();
        $from = array('_front', '_back');
        $to = array('','');
        $controller = str_replace($from, $to, $controller);
        return $controller;
	}
	
	//Get actual method
	public static function getMethod()
    {
		$router =& load_class('Router', 'core');		
		return $router->fetch_method();
	}

	public static function logIn()
	{
		$CI =& get_instance();
		$CI->session->set_userdata('logged_in', TRUE);
	}

	public static function logOut()
	{
		$CI =& get_instance();
		$CI->session->set_userdata('logged_in', FALSE);
	}

	public static function isLoggedIn()
	{
		$CI =& get_instance();
		return $CI->session->userdata('logged_in') ? TRUE : FALSE;
	}

	public static function setLeasing($leasing)
	{
		$CI =& get_instance();
		$CI->session->set_userdata('leasing', $leasing);
	}

	public static function getLeasing()
	{
		$CI =& get_instance();
		return $CI->session->userdata('leasing');
	}
}