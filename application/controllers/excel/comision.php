<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comision extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('USERNAME') == '' ){
			
            $regresar = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://' ) . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
            redirect( base_url() . 'login/index?r='.urlencode($regresar) );
        }		
	}

	public function info($id_cliente)
	{
		$this->load->model('users/clientes_model');
		$this->load->model('cuentas/comision_model');
		$this->load->helper('funciones_externas');

		$cliente = $this->clientes_model->datos_cliente(array('id_cliente'=>$id_cliente));
		$depositos = $this->comision_model->detalle_depositos(array('ad.id_cliente'=>$id_cliente, 'adc.fecha_movimiento >=' => $this->session->userdata('fecha_ini_comision'), 'adc.fecha_movimiento <=' => $this->session->userdata('fecha_fin_comision'), ));
		$db_com = $this->comision_model;


		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('America/Mexico_City');

		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');

			/** Include PHPExcel */
		require_once PATH.'/assets/phpexcel/phpexcel.php';

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
									 ->setLastModifiedBy("Maarten Balliauw")
									 ->setTitle("Office 2007 XLSX Test Document")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Test result file");


		// Add some data
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A1', strtoupper('Fecha depósito'))
		            ->setCellValue('B1', strtoupper('Monto del depósito'))
		            ->setCellValue('C1', strtoupper('Comisión'))
		            ->setCellValue('D1', strtoupper('Folio'))
		            ->setCellValue('E1', strtoupper('Empresa'))
		            ->setCellValue('F1', strtoupper('Banco'));


		$objPHPExcel->getActiveSheet()->getColumnDimension( 'A' )->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension( 'B' )->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension( 'C' )->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension( 'D' )->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension( 'E' )->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension( 'F' )->setAutoSize(true);

		$cellRespuesta=  $objPHPExcel->setActiveSheetIndex(0);
		
        $i=2;
		foreach($depositos as $deposito): 
          	$comision = (($deposito->monto_deposito / 1.16 ) * $cliente->comision);

            $cellRespuesta->setCellValue('A'.$i, formato_fecha_ddmmaaaa($deposito->fecha_deposito));
            $cellRespuesta->setCellValue('B'.$i, round($deposito->monto_deposito,2));
            $cellRespuesta->setCellValue('C'.$i, round($comision, 2));
            $cellRespuesta->setCellValue('D'.$i, $deposito->folio_depto);
            $cellRespuesta->setCellValue('E'.$i, $deposito->nombre_empresa);
            $cellRespuesta->setCellValue('F'.$i, $deposito->nombre_banco);
           $i++;
        endforeach;
		
		 // Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Reporte de comisión');


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="reporte_comision_'.date('d-m-Y').'.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
}