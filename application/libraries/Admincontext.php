<?php

class Admincontext
{
	public static function logIn()
	{
		$CI =& get_instance();
		$CI->session->set_userdata('logged_in_admin', TRUE);
	}

	public static function logOut()
	{
		$CI =& get_instance();
		$CI->session->set_userdata('logged_in_admin', FALSE);
	}

	public static function isLoggedIn()
	{
		$CI =& get_instance();
		return $CI->session->userdata('logged_in_admin') ? TRUE : FALSE;
	}
}