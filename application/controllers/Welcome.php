<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()	{
		$this->load->view('login/login');
	}

	public function inicio()	{
		$this->load->view('inicio');
	}

	public function archivos_clientes()	{
		$this->load->view('archivos/clientes');
	}

	public function stock_neumaticos() {
		$this->load->view('stock/neumaticos');
	}

	public function ventas_record() {
		$this->load->view('ventas/record');
	}


}
