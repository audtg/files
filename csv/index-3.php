<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel/Writer/IWriter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel/Writer/Abstract.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel/Writer/CSV.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/../Faker/src/autoload.php';
require_once __DIR__ . '/headers.php';


$objPHPExcel = new PHPExcel();

$locale = 'ru';
$validLocale = PHPExcel_Settings::setLocale($locale);
if (!$validLocale) {
    echo 'Unable to set locale to ' . $locale . ' - reverting to ru <br>';
}

$objPHPExcel->setActiveSheetIndex(0);

$sheet = $objPHPExcel->getActiveSheet();

$fields = array('zerro', 'first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth', 'ninth');
//var_dump($fields);
$info = array();
$info[] = array(0 => 'hvhv', 1 => 'fffuvfu', 5=> 'hfvhv', 6 => 'jdbjda', 9 => 'kjdbjabd');
$info[] = array(1 => 'hvhv', 2 => 'fffuvfu', 3=> 'hfvhv', 4 => 'jdbjda', 7 => 'kjdbjabd');
$info[] = array(0 => 'hvhv', 4 => 'fffuvfu', 5=> 'hfvhv', 7 => 'jdbjda', 8 => 'kjdbjabd');


array_walk($info, function(&$row, $key, $fields) {
    $diff = array_diff_key($fields, $row);
    $row += array_fill_keys(array_keys($diff), null);
    ksort($row);
}, $fields);

array_unshift($info, $fields);

$sheet->fromArray($info);






$objWriter = new PHPExcel_Writer_CSV($objPHPExcel);
//
$filename = 'info-3.csv';
//
$objWriter->save($filename);
//
header('Content-Type: text/csv');
header('Content-disposition: attachment; filename=' . $filename);
readfile($filename);
unlink($filename);
