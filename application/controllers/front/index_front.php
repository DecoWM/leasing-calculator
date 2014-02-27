<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_front extends Front_Controller 
{
	public function data()
	{
		$this->data['active'] = 'data';

		$this->load->view('front/common/header', $this->data);
		$this->load->view('front/data', $this->data);
		$this->load->view('front/common/footer', $this->data);
	}

	public function process()
	{
		$this->load->library('financial');

		$this->form_validation->set_rules('costesNotariales','Costos Notariales','numeric');
		$this->form_validation->set_rules('costesRegistrales','Costos Registrales','numeric');
		$this->form_validation->set_rules('tasacion','Tasacion','numeric');
		$this->form_validation->set_rules('comisionEstudio','Comision de Estudio','numeric');
		$this->form_validation->set_rules('comisionActivacion','Comision de Activacion','numeric');
		$this->form_validation->set_rules('tasaSeguroRiesgo','Seguro Riesgo (%)','required|numeric');
		$this->form_validation->set_rules('comisionPeriodica','Comision Periodica','required|numeric');
		$this->form_validation->set_rules('precioVenta','Precio de Venta','required|numeric');
		$this->form_validation->set_rules('periodoTotal','Numero de Periodos','required|numeric');
		$this->form_validation->set_rules('frecuenciaPago','Frecuencia de Pago','required|numeric');
		$this->form_validation->set_rules('tasaEfectivaAnual','TEA (%)','required|numeric');
		$this->form_validation->set_rules('tasaIGV','IGV (%)','required|numeric');
		$this->form_validation->set_rules('tasaImpuestoRenta','IR (%)','required|numeric');
		$this->form_validation->set_rules('tasaRecompra','Recompra (%)','required|numeric');
		$this->form_validation->set_rules('tasaCOK','COK (%)','required|numeric');
		$this->form_validation->set_rules('tasaWACC','WACC (%)','required|numeric');
		$this->form_validation->set_rules('periodosGraciaTotal','Periodos de Gracia Total','numeric');

		if($this->form_validation->run())
        {
        	$costesNotariales = $this->input->post('costesNotariales') ? $this->input->post('costesNotariales') : 0;
        	$costesRegistrales = $this->input->post('costesRegistrales') ? $this->input->post('costesRegistrales') : 0;
        	$tasacion = $this->input->post('tasacion') ? $this->input->post('tasacion') : 0;
        	$comisionEstudio = $this->input->post('comisionEstudio') ? $this->input->post('comisionEstudio') : 0;
        	$comisionActivacion = $this->input->post('comisionActivacion') ? $this->input->post('comisionActivacion') : 0;

        	$tasaSeguroRiesgo = $this->input->post('tasaSeguroRiesgo') ? $this->input->post('tasaSeguroRiesgo')/100 : 0;
        	$comisionPeriodica = $this->input->post('comisionPeriodica') ? $this->input->post('comisionPeriodica') : 0;

			$precioVenta = $this->input->post('precioVenta') ? $this->input->post('precioVenta') : 0;
			$periodoTotal = $this->input->post('periodoTotal') ? $this->input->post('periodoTotal') : 0;
			$frecuenciaPago = $this->input->post('frecuenciaPago') ? $this->input->post('frecuenciaPago') : 0;
			$tasaEfectivaAnual = $this->input->post('tasaEfectivaAnual') ? $this->input->post('tasaEfectivaAnual')/100 : 0;
			$tasaIGV = $this->input->post('tasaIGV') ? $this->input->post('tasaIGV')/100 : 0;
			$tasaImpuestoRenta = $this->input->post('tasaImpuestoRenta') ? $this->input->post('tasaImpuestoRenta')/100 : 0;
			$tasaRecompra = $this->input->post('tasaRecompra') ? $this->input->post('tasaRecompra')/100 : 0;
			$periodosGraciaTotal = $this->input->post('periodosGraciaTotal') ? $this->input->post('periodosGraciaTotal') : 0;

			$tasaCOK = $this->input->post('tasaCOK') ? $this->input->post('tasaCOK')/100 : 0;
			$tasaWACC = $this->input->post('tasaWACC') ? $this->input->post('tasaWACC')/100 : 0;

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
				$tasaWACC,
				$tasaSeguroRiesgo,
				$periodosGraciaTotal
			);
			
			/*Context::setLeasing($leasing);
			redirect(base_url('results'));*/

			$this->data['active'] = 'results';
			
			$this->load->view('front/common/header', $this->data);
			$this->load->view('front/results', $leasing);
			$this->load->view('front/common/footer', $this->data);
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