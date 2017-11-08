<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ventas/m_ventas');
  }

  public function record_ventas(){
    echo $this->m_ventas->record();
  }

}
