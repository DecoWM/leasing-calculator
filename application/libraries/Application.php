<?php

class Application
{
	static $leasing = array(
		'igvTotal' => 0,
		'valorRealVenta' => 0,
		'montoLeasing' => 0,
		'tasaEfectivaPeriodo' => 0,
		'depreciacion' => 0,
		'reporte' => array(),
		'intereses' => 0,
		'amortizacionCapital' => 0,
		'desembolsoTotal' => 0,
		'recompra' => 0,
		'seguroRiesgo' => 0,
		'comisionesPeriodicas' => 0,
		'vanFlujoBruto' => 0,
		'vanFlujoNeto' => 0,
		'tceaFlujoBruto' => 0,
		'tceaFlujoNeto' => 0
	);

	public static function getInitialTotal(
		$costesNotariales, 
		$costesRegistrales, 
		$tasacion,
		$comisionEstudio,
		$comisionActivacion
	)
	{
		return $costesNotariales + $costesRegistrales + $tasacion + $comisionEstudio + $comisionActivacion;
	}

	public static function getPeriodicTotal($comisionPeriodica, $tasaSeguroRiesgo, $precioVenta, $frecuenciaPago)
	{
		$seguroRiesgo = $precioVenta * ($tasaSeguroRiesgo / $frecuenciaPago);

		return $comisionPeriodica + $seguroRiesgo;
	}

	public static function calculateLeasing(
		$precioVenta,
		$periodoTotal,
		$frecuenciaPago,
		$tasaEfectivaAnual,
		$tasaIGV,
		$tasaImpuestoRenta,
		$tasaRecompra,
		$gastosIniciales,
		$gastosPeriodicos,
		$tasaCOK,
		$tasaWACC,
		$tasaSeguroRiesgo,
		$periodosGraciaTotal
	)
	{
		$igvTotal = $precioVenta * ($tasaIGV / (1 + $tasaIGV));
		$valorRealVenta = $precioVenta - $igvTotal;
		$montoLeasing = $valorRealVenta + $gastosIniciales;
		$tasaEfectivaPeriodo = pow(1 + $tasaEfectivaAnual, 1 / $frecuenciaPago) - 1;

		self::$leasing['igvTotal'] = $igvTotal;
		self::$leasing['valorRealVenta'] = $valorRealVenta;
		self::$leasing['montoLeasing'] = $montoLeasing;
		self::$leasing['tasaEfectivaPeriodo'] = $tasaEfectivaPeriodo;

		$intereses = 0;
		$amortizacionCapital = 0;
		$desembolsoTotal = 0;
		$gastosPeriodicosTotal = 0;
		$tceaFlujoBruto = 0;
		$tceaFlujoNeto = 0;
		$vanFlujoBruto = $montoLeasing;
		$vanFlujoNeto = $montoLeasing;

		$arregloFlujoBruto = array(0 => $montoLeasing);
		$arregloFlujoNeto = array(0 => $montoLeasing);

		$saldoFinal = $montoLeasing;
		$depreciacion = $valorRealVenta / $periodoTotal;

		self::$leasing['depreciacion'] = round($depreciacion, 2);

		$tasaVANBruto = pow(1 + $tasaCOK, 1 / $frecuenciaPago) - 1;
		$tasaVANNeto = pow(1 + $tasaWACC, 1 / $frecuenciaPago) - 1;

		self::$leasing['reporte'] = array();

		for($i = 1; $i <= $periodoTotal; $i++)
		{
			$saldoInicial = $saldoFinal;
			$interes = $saldoInicial * $tasaEfectivaPeriodo;

			if($i <= $periodosGraciaTotal)
			{
				$amortizacion = 0;
				$cuota = 0;
				$saldoFinal = $saldoInicial + $interes;
			}
			else
			{
				$amortizacion = $saldoInicial / ($periodoTotal - $i + 1);
				$cuota = $interes + $amortizacion;
				$saldoFinal = $saldoInicial - $amortizacion;
			}

			$ahorroTributario = ($interes + $depreciacion + $gastosPeriodicos) * $tasaImpuestoRenta;

			if($i < $periodoTotal)
				$recompra  = 0;
			else
				$recompra = $valorRealVenta * $tasaRecompra;

			$flujoBruto = $cuota + $recompra + $gastosPeriodicos;
			$igv = $flujoBruto * $tasaIGV;
			$flujo = $flujoBruto + $igv;
			$flujoNeto = $flujoBruto - $ahorroTributario;

			$intereses = $intereses + $interes;
			$amortizacionCapital = $amortizacionCapital + $amortizacion;
			$desembolsoTotal = $desembolsoTotal + $interes + $amortizacion + $recompra + $gastosPeriodicos;
			$vanFlujoBruto = $vanFlujoBruto - ($flujoBruto / pow(1 + $tasaVANBruto, $i));
			$vanFlujoNeto = $vanFlujoNeto - ($flujoNeto / pow(1 + $tasaVANNeto, $i));

			$arregloFlujoBruto[$i] = -1 * $flujoBruto;
			$arregloFlujoNeto[$i] = -1 * $flujoNeto;

			$gastosPeriodicosTotal += $gastosPeriodicos;

			self::$leasing['reporte'][$i] = array(
				'periodo' => $i,
				'saldoInicial' => round($saldoInicial, 2),
				'interes' => round(-1 * $interes, 2),
				'cuota' => round(-1 * $cuota, 2),
				'amortizacion' => round(-1 * $amortizacion, 2),
				'gastosPeriodicos' => round(-1 * $gastosPeriodicos, 2),
				'recompra' => round(-1 * $recompra, 2),
				'saldoFinal' => round($saldoFinal, 2),
				'depreciacion' => round(-1 * $depreciacion, 2),
				'ahorroTributario' => round(-1 * $ahorroTributario, 2),
				'igv' => round(-1 * $igv, 2),
				'flujoBruto' => round(-1 * $flujoBruto, 2),
				'flujo' => round(-1 * $flujo, 2),
				'flujoNeto' => round(-1 * $flujoNeto, 2)
			);
		}

		self::$leasing['intereses'] = round($intereses, 2);
		self::$leasing['amortizacionCapital'] = round($amortizacionCapital, 2);
		self::$leasing['desembolsoTotal'] = round($desembolsoTotal, 2);
		self::$leasing['recompra'] = round($valorRealVenta * $tasaRecompra, 2);
		self::$leasing['seguroRiesgo'] = round((($precioVenta * $tasaSeguroRiesgo) / $frecuenciaPago) * $periodoTotal, 2);
		self::$leasing['comisionesPeriodicas'] = round($gastosPeriodicosTotal - self::$leasing['seguroRiesgo'], 2);

		$CI =& get_instance();
		$tirFlujoBruto = $CI->financial->IRR($arregloFlujoBruto);
		$tirFlujoNeto = $CI->financial->IRR($arregloFlujoNeto);

		$tceaFlujoBruto = pow(1 + $tirFlujoBruto, $frecuenciaPago) - 1;
		$tceaFlujoNeto = pow(1 + $tirFlujoNeto, $frecuenciaPago) - 1;

		self::$leasing['vanFlujoBruto'] = round($vanFlujoBruto, 2);
		self::$leasing['vanFlujoNeto'] = round($vanFlujoNeto, 2);
		self::$leasing['tceaFlujoBruto'] = round($tceaFlujoBruto * 100, 2);
		self::$leasing['tceaFlujoNeto'] = round($tceaFlujoNeto * 100, 2);

		return self::$leasing;
	}

	public static function getLeasing()
	{
		return self::$leasing;
	}
}