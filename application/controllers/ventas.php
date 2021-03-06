<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ventas/m_ventas');
  }

  public function record_ventas(){

    $data = array(
      'mes' => $this->input->post('mes')
    );
    echo $this->m_ventas->record($data);
  }




  public function excel(){

    $this->load->library('excel');
    $spreadsheet = new PHPExcel();

    ob_start();
    /* start: contenido */

    $linea = 5;
    $linInicio = $linea;
    $colFinal = 0;
    $columnas = $_POST["columnas"];

    $titulo ="RECORD DE VENTAS - MES DE OCTUBRE 2017";
    $subtit = "OFICINA AREQUIPA";

    $bordes = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('rgb' => '666666')
        )
      )
    );

    $tabla_header = array(
      'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '333333'),
        'size'  => 8,
        'name'  => 'Calibri'
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      ),
    );

    $tabla_detalle = array(
      'font'  => array(
        'bold'  => false,
        'size'  => 9,
        'name'  => 'Calibri'
      )
    );

    $css_titulo = array(
      'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '000000'),
        'size'  => 14,
        'name'  => 'Calibri'
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      ),
    );

    $css_subtit = array(
      'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '000000'),
        'size'  => 12,
        'name'  => 'Calibri'
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      ),
    );


    $domingo = array(
      'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '666666'),
        'size'  => 9,
        'name'  => 'Calibri'
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'e4e4e4')
      )
    );

    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(2);

    foreach ($columnas as $key => $value){
      $letraCol = PHPExcel_Cell::stringFromColumnIndex($key+1);

      if(isset($value["ancho"])):
        $spreadsheet->getActiveSheet()->getColumnDimension($letraCol)->setWidth($value["ancho"]);
      else:
        $spreadsheet->getActiveSheet()->getColumnDimension($letraCol)->setAutoSize(true);
      endif;

      $spreadsheet->getActiveSheet()->SetCellValue($letraCol.$linea, $value["title"]);
      $spreadsheet->getActiveSheet()->getStyle($letraCol.$linea)
      ->applyFromArray($bordes)
      ->applyFromArray($tabla_header);
      $colFinal = $key;
    };

    $spreadsheet->getActiveSheet()->getRowDimension($linea)->setRowHeight(23);
    $spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(4);
    $spreadsheet->getActiveSheet()->getRowDimension(4)->setRowHeight(4);

    ++$linea;

    $spreadsheet->getActiveSheet()->SetCellValue("B2", $titulo);
    $spreadsheet->getActiveSheet()->getStyle("B2")->applyFromArray($css_titulo);

    $spreadsheet->getActiveSheet()->SetCellValue("B3", $subtit);
    $spreadsheet->getActiveSheet()->getStyle("B3")->applyFromArray($css_subtit);

    $spreadsheet->getActiveSheet()->mergeCells('B2:'.PHPExcel_Cell::stringFromColumnIndex($colFinal+1).'2');
    $spreadsheet->getActiveSheet()->mergeCells('B3:'.PHPExcel_Cell::stringFromColumnIndex($colFinal+1).'3');

    $spreadsheet->getActiveSheet()->freezePane('A'.$linea);
    $spreadsheet->getActiveSheet()->setShowGridlines(false);

    $contenido = $_POST["contenido"];
    foreach ($contenido as $key => $value):
      foreach ($columnas as $ck => $cv):
        $letraCol = PHPExcel_Cell::stringFromColumnIndex($ck+1);

        $spreadsheet->getActiveSheet()->SetCellValue($letraCol.$linea, $value[$ck]);
        $spreadsheet->getActiveSheet()->getRowDimension($linea)->setRowHeight(15);


        if(isset($cv["className"]) && $cv["className"]=="htCenter"):
          $spreadsheet->getActiveSheet()->getStyle($letraCol.$linea)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        endif;

        if(isset($cv["type"]) && $cv["type"]=="numeric"):
          $spreadsheet->getActiveSheet()->getStyle($letraCol.$linea)->getNumberFormat()->setFormatCode('#,##0.00');
        endif;

        if($cv["title"]=="FECHA"):
          list($day,$month,$year) = explode('/', $value[$ck]);
          $fecha = strtotime($year.'/'.$month.'/'.$day);
          $dia = date("l", $fecha);
          $dia = strtolower($dia);

          $spreadsheet->getActiveSheet()->SetCellValue($letraCol.$linea, $value[$ck]);

          if($dia=="sunday"):
            $letraFinal = PHPExcel_Cell::stringFromColumnIndex($colFinal+1);
            $spreadsheet->getActiveSheet()->getStyle($letraCol.$linea.':'.$letraFinal.$linea)->applyFromArray($domingo);
          endif;
        endif;



      endforeach;
      ++$linea;
    endforeach;


    $spreadsheet->getActiveSheet()->getStyle('B'.($linInicio+1).':'.PHPExcel_Cell::stringFromColumnIndex($colFinal+1).($linea-1))->applyFromArray($bordes);
    $spreadsheet->getActiveSheet()->getStyle('B'.($linInicio+1).':'.PHPExcel_Cell::stringFromColumnIndex($colFinal+1).($linea-1))->applyFromArray($tabla_detalle);
    $spreadsheet->getActiveSheet()->getStyle('A1:Z150')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

    $spreadsheet->getActiveSheet()->setSelectedCell('A1');
    /* end: contenido */

    $objWriter = new PHPExcel_Writer_Excel2007($spreadsheet);
    $objWriter->save('php://output');
    $xlsData = ob_get_contents();
    ob_end_clean();

    $response =  array(
      'status' => 'ok',
      'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
    );
    die(json_encode($response));

  }

}
