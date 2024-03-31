<?php
include ("PHPExcel-1.8.1\Classes\PHPExcel\IOFactory.php");
include ("PHPExcel-1.8.1\Classes\PHPExcel.php");
$excel=new PHPExcel();
$excel->setActiveSheetIndex(0);
$excel->getDefaultStyle()->getAlignment()->setWrapText(true);
$excel->getActiveSheet()->setCellValue('A1',"SAIKATTTTTT");
$excel->getActiveSheet()->getStyle('A1:A4')->getFill()->applyFromArray(
 array('type' =>PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000')));
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$excel->getActiveSheet()->setCellValue('A2',"RAJIBgggggg");
$excel->getActiveSheet()->mergeCells('A2:A4');
$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
$wr=PHPExcel_IOFactory::createWriter($excel,'Excel5');
$wr->save('pp.xls');
?>