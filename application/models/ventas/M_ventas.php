<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_ventas extends CI_Model {

	public function record(){

		$params = array(
			'agencia'=>'7000',
			'mes'=>10,
			'año'=>2017,
			'reporte'=>'D'
		);

		$query = $this->db->query("XL_RECORD ?,?,?,?", $params);

		if($query->num_rows()):

			$arrResult = array();

			foreach ($query->result_array() as $row):
				$arrResult[] = array(
					'agencia' => $row['agencia'],
					'fecha' => $row['fecha'],
					'reporte_num' => $row['reporte_num'],
					'tc' => $row['tc'],
					'tarjeta_mn' => floatval($row['tarjeta_mn']),
					'tarjeta_a_us' => floatval($row['tarjeta_a_us'])
				);
			endforeach;
			echo json_encode($arrResult);

		endif;

	}

}
