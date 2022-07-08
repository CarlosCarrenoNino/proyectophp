<?php

include "connexion.php";
// require('../actions/encript.php');
include "PHPExcel.php";
//echo "<script>console.log('Ingreso');</script>";

$FECHA1 =  date('Y/m/d',strtotime($_POST['fecha-inicio-informe'])) ;
$FECHA2 = date('Y/m/d',strtotime($_POST['fecha-fin-informe'])) ;

//echo "<script>console.log('FECHA1: ".$FECHA1."');</script>";

if(isset($_POST['buttom-informe'])){

/* $params = array();
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

$myparams['fecha_inicio'] = $FECHA1;
$myparams['fecha_fin'] = $FECHA2; 

 $procedure_params = array(
 array(&$myparams['fecha_inicio'], SQLSRV_PARAM_IN),
 array(&$myparams['fecha_fin'], SQLSRV_PARAM_IN)
);  */
 

$sqlserver ="";


$stmt = odbc_exec($conexion, $sqlserver);


	/* function cellColor($cells,$color){
		global $objPHPExcel;

		$objPHPExcel->setActiveSheetIndex(0)->getStyle($cells)->getFill()->applyFromArray(array(
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'startcolor' => array(
				'rgb' => $color
			)
		));
	}
	cellColor('A1:S1', 'E6B8B7'); */

  $fila = 2;

	$objPHPExcel = new PHPExcel ();
	$objPHPExcel->getProperties ()->setCreator("Descargue_Informe_JD_Duquesa")->setDescription("Descargue_Informe_JD_Duquesa");
	$objPHPExcel->setActiveSheetIndex (0);

		$objPHPExcel->getActiveSheet ()->setTitle ("Descargue_Informe_JD_Duquesa");       
		$objPHPExcel->getActiveSheet () -> setCellValue ('A1', 'CONCEPTO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('A3', 'ACEITES');
		$objPHPExcel->getActiveSheet () -> setCellValue ('B1', 'ENERO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('C1', 'FEBRERO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('D1', 'MARZO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('E1', '1ER TRIMESTRE');
		$objPHPExcel->getActiveSheet () -> setCellValue ('F1', 'ABRIL'); 
		$objPHPExcel->getActiveSheet () -> setCellValue ('G1', 'MAYO'); 
		$objPHPExcel->getActiveSheet () -> setCellValue ('H1', 'JUNIO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('I1', '2DO TRIMESTRE');
		$objPHPExcel->getActiveSheet () -> setCellValue ('J1', 'JULIO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('K1', 'AGOSTO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('L1', 'SEPTIEMBRE');
		$objPHPExcel->getActiveSheet () -> setCellValue ('M1', '3ER TRIMESTRE');
		$objPHPExcel->getActiveSheet () -> setCellValue ('N1', 'OCTUBRE');
		$objPHPExcel->getActiveSheet () -> setCellValue ('O1', 'NOVIEMBRE');
		$objPHPExcel->getActiveSheet () -> setCellValue ('P1', 'DICIEMBRE');
		$objPHPExcel->getActiveSheet () -> setCellValue ('Q1', '4TO TRIMESTRE');
		$objPHPExcel->getActiveSheet () -> setCellValue ('R1', 'ACUMULADO');
		$objPHPExcel->getActiveSheet () -> setCellValue ('S1', 'PROMEDIO');

		//$objPHPExcel->getActiveSheet () -> setCellValue ('A2', print_r(sqlsrv_configure(WarningsReturnAsErrors)));
			
			

		while($row=odbc_fetch_array($stmt)){

			
			$objPHPExcel->getActiveSheet () -> setCellValue ('A'.$fila, $row['']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('B'.$fila, $row['']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('C'.$fila, $row['']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('D'.$fila, $row['']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('E'.$fila, $row['']); 			
  			$objPHPExcel->getActiveSheet () -> setCellValue ('F'.$fila, $row['']);
  			$objPHPExcel->getActiveSheet () -> setCellValue ('G'.$fila, $row['']);
 			$objPHPExcel->getActiveSheet () -> setCellValue ('H'.$fila, $row['']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('I'.$fila, $row['']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('J'.$fila, $row['']);
			$objPHPExcel->getActiveSheet () -> setCellValue ('K'.$fila, $row['']);			
            

		$fila++;

		}
		
			// Save Excel 2007 file
		#echo date('H:i:s') . " Write to Excel2007 format\n";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		ob_end_clean();
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Informe_Base_JD_Duquesa.xlsx"');
		$objWriter->save('php://output');







}?>