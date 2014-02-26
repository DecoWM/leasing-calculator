<?php

class Application
{
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
		$tasaWACC
	)
	{
		$leasing = array();

		$igvTotal = $precioVenta * ($tasaIGV / (1 + $tasaIGV));
		$valorRealVenta = $precioVenta - $igvTotal;
		$montoLeasing = $valorRealVenta + $gastosIniciales;
		$tasaEfectivaPeriodo = pow(1 + $tasaEfectivaAnual, $periodoTotal / $frecuenciaPago) - 1;

		$intereses = 0;
		$amortizacionCapital = 0;
		$desembolsoTotal = 0;
		$tceaFlujoBruto = 0;
		$tceaFlujoNeto = 0;
		$vanFlujoBruto = $montoLeasing;
		$vanFlujoneto = $montoLeasing;

		$arregloFlujoBruto = array();
		$arregloFlujoNeto = array();

		$saldoFinal = $montoLeasing;
		$depreciacion = $valorRealVenta / $periodoTotal;

		$tasaVANBruto = pow(1 + $COK, $periodoTotal / $frecuenciaPago) - 1;
		$tasaVANNeto = pow(1 + $WACC, $periodoTotal / $frecuenciaPago) - 1;

		$leasing['reporte'] = array();

		for($i = 1; $i <= $periodoTotal; $i++)
		{
			$saldoInicial = $saldoFinal;
			$interes = $saldoInicial * $tasaEfectivaPeriodo;
			$amortizacion = $saldoInicial / ($periodoTotal - $i + 1);
			$cuota = $interes + $amortizacion;
			$saldoFinal = $saldoInicial - $amortizacion;
			$ahorroTributario = $interes + $depreciacion + $gastosPeriodicos;

			if(i < $periodoTotal)
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

			$arregloFlujoBruto[$i] = $flujoBruto;
			$arregloFlujoNeto[$i] = $flujoNeto;

			$leasing['reporte'][$i] = array(
				'periodo' => $i,
				'saldoInicial' => $saldoInicial,
				'interes' => $interes,
				'cuota' => $cuota,
				'amortizacion' => $amortizacion,
				'gastosPeriodicos' => $gastosPeriodicos,
				'recompra' => $recompra,
				'saldoFinal' => $saldoFinal,
				'depreciacion' => $depreciacion,
				'ahorroTributario' => $ahorroTributario,
				'igv' => $igv,
				'flujoBruto' => $flujoBruto,
				'flujo' => $flujo,
				'flujoNeto' => $flujoNeto
			);
		}

		$leasing['intereses'] = $intereses;
		$leasing['amortizacionCapital'] = $amortizacionCapital;
		$leasing['desembolsoTotal'] = $desembolsoTotal;

		$tirFlujoBruto = $this->financial->IRR($arregloFlujoBruto);
		$tirFlujoNeto = $this->financial->IRR($arregloFlujoNeto);

		$tceaFlujoBruto = pow(1 + $tirFlujoBruto, $frecuenciaPago / $periodoTotal);
		$tceaFlujoNeto = pow(1 + $tirFlujoNeto, $frecuenciaPago / $periodoTotal);

		$leasing['vanFlujoBruto'] = $vanFlujoBruto;
		$leasing['vanFlujoNeto'] = $vanFlujoNeto;
		$leasing['tceaFlujoBruto'] = $tceaFlujoBruto;
		$leasing['tceaFlujoNeto'] = $tceaFlujoNeto;

		return $leasing;
	}
}