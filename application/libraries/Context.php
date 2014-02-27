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
		$CI->session->set_userdata('is_leasing', count($leasing['reporte']));
		$CI->session->set_userdata('leasing_intereses', $leasing['intereses']);
		$CI->session->set_userdata('leasing_amortizacionCapital', $leasing['amortizacionCapital']);
		$CI->session->set_userdata('leasing_desembolsoTotal', $leasing['desembolsoTotal']);
		$CI->session->set_userdata('leasing_recompra', $leasing['recompra']);
		$CI->session->set_userdata('leasing_seguroRiesgo', $leasing['seguroRiesgo']);
		$CI->session->set_userdata('leasing_comisionesPeriodicas', $leasing['comisionesPeriodicas']);
		$CI->session->set_userdata('leasing_vanFlujoBruto', $leasing['vanFlujoBruto']);
		$CI->session->set_userdata('leasing_vanFlujoNeto', $leasing['vanFlujoNeto']);
		$CI->session->set_userdata('leasing_tceaFlujoBruto', $leasing['tceaFlujoBruto']);
		$CI->session->set_userdata('leasing_tceaFlujoNeto', $leasing['tceaFlujoNeto']);

		foreach($leasing['reporte'] as $row)
		{
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_saldoInicial', $row['saldoInicial']);
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_interes', $row['interes']);
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_cuota', $row['cuota']);
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_amortizacion', $row['amortizacion']);
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_gastosPeriodicos', $row['gastosPeriodicos']);
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_recompra', $row['recompra']);
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_saldoFinal', $row['saldoFinal']);
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_depreciacion', $row['depreciacion']);
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_ahorroTributario', $row['ahorroTributario']);
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_igv', $row['igv']);
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_flujoBruto', $row['flujoBruto']);
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_flujo', $row['flujo']);
			$CI->session->set_userdata('leasing_reporte_'.$row['periodo'].'_flujoNeto', $row['flujoNeto']);
		}
	}

	public static function getLeasing()
	{
		$leasing = Application::getLeasing();

		$CI =& get_instance();
		if($CI->session->userdata('is_leasing'))
		{
			$leasing['intereses'] = $CI->session->userdata('intereses');
			$leasing['amortizacionCapital'] = $CI->session->userdata('amortizacionCapital');
			$leasing['desembolsoTotal'] = $CI->session->userdata('desembolsoTotal');
			$leasing['recompra'] = $CI->session->userdata('recompra');
			$leasing['seguroRiesgo'] = $CI->session->userdata('seguroRiesgo');
			$leasing['comisionesPeriodicas'] = $CI->session->userdata('comisionesPeriodicas');
			$leasing['vanFlujoBruto'] = $CI->session->userdata('vanFlujoBruto');
			$leasing['vanFlujoNeto'] = $CI->session->userdata('vanFlujoNeto');
			$leasing['tceaFlujoBruto'] = $CI->session->userdata('tceaFlujoBruto');
			$leasing['tceaFlujoNeto'] = $CI->session->userdata('tceaFlujoNeto');

			$reporte_count = $CI->session->userdata('is_leasing');

			for($i = 1; $i <= $reporte_count; $i++)
			{
				$leasing['reporte'][$i]['periodo'] = $i;
				$leasing['reporte'][$i]['saldoInicial'] = $CI->session->userdata('leasing_reporte_'.$i.'_saldoInicial');
				$leasing['reporte'][$i]['interes'] = $CI->session->userdata('leasing_reporte_'.$i.'_interes');
				$leasing['reporte'][$i]['cuota'] = $CI->session->userdata('leasing_reporte_'.$i.'_cuota');
				$leasing['reporte'][$i]['amortizacion'] = $CI->session->userdata('leasing_reporte_'.$i.'_amortizacion');
				$leasing['reporte'][$i]['gastosPeriodicos'] = $CI->session->userdata('leasing_reporte_'.$i.'_gastosPeriodicos');
				$leasing['reporte'][$i]['recompra'] = $CI->session->userdata('leasing_reporte_'.$i.'_recompra');
				$leasing['reporte'][$i]['saldoFinal'] = $CI->session->userdata('leasing_reporte_'.$i.'_saldoFinal');
				$leasing['reporte'][$i]['depreciacion'] = $CI->session->userdata('leasing_reporte_'.$i.'_depreciacion');
				$leasing['reporte'][$i]['ahorroTributario'] = $CI->session->userdata('leasing_reporte_'.$i.'_ahorroTributario');
				$leasing['reporte'][$i]['igv'] = $CI->session->userdata('leasing_reporte_'.$i.'_igv');
				$leasing['reporte'][$i]['flujoBruto'] = $CI->session->userdata('leasing_reporte_'.$i.'_flujoBruto');
				$leasing['reporte'][$i]['flujo'] = $CI->session->userdata('leasing_reporte_'.$i.'_flujo');
				$leasing['reporte'][$i]['flujoNeto'] = $CI->session->userdata('leasing_reporte_'.$i.'_flujoNeto');
			}
		}
		

		return $leasing;
	}
}