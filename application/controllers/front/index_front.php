<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_front extends Front_Controller 
{
	public function data()
	{
		$this->data['active'] = 'data';

		$this->load->view('front/common/header', $this->data);
		$this->load->view('front/data_form', $this->data);
		$this->load->view('front/common/footer', $this->data);
	}

	public function process()
	{
		$this->load->library('financial');

		//$this->form_validation->set_rules('username','Username','required');
        //$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run())
        {
        	$costesNotariales = $this->input->post('costesNotariales');
        	$costesRegistrales = $this->input->post('costesRegistrales');
        	$tasacion = $this->input->post('tasacion');
        	$comisionEstudio = $this->input->post('comisionEstudio');
        	$comisionActivacion = $this->input->post('comisionActivacion');

        	$tasaSeguroRiesgo = $this->input->post('tasaSeguroRiesgo');
        	$comisionPeriodica = $this->input->post('comisionPeriodica');

			$gastosIniciales = Application::getInitialTotal(
				$costesNotariales, 
				$costesRegistrales, 
				$tasacion,
				$comisionEstudio,
				$comisionActivacion
			);

			$gastosPeriodicos = Application::getPeriodicTotal(
				$comisionPeriodica, 
				$tasaSeguroRiesgo, 
				$precioVenta, 
				$frecuenciaPago
			);

			$precioVenta = $this->input->post('precioVenta');
			$periodoTotal = $this->input->post('periodoTotal'); 
			$frecuenciaPago = $this->input->post('frecuenciaPago'); 
			$tasaEfectivaAnual = $this->input->post('tasaEfectivaAnual'); 
			$tasaIGV = $this->input->post('tasaIGV'); 
			$tasaImpuestoRenta = $this->input->post('tasaImpuestoRenta'); 
			$tasaRecompra = $this->input->post('tasaRecompra'); 
			$tasaCOK = $this->input->post('tasaCOK'); 
			$tasaWACC = $this->input->post('tasaWACC');

			$leasing = Application::calculateLeasing(
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
			);

			Context::setLeasing($leasing);
			redirect(base_url('results'));
        }
        else
        {
        	$this->data();
        }
	}

	public function results()
	{
		$this->data['active'] = 'results';

		$leasing = Context::getLeasing();

		$this->load->view('front/common/header', $this->data);
		$this->load->view('front/results', $leasing);
		$this->load->view('front/common/footer', $this->data);
	}
}