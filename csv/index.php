<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel/Writer/IWriter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel/Writer/Abstract.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel/Writer/CSV.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Faker/src/autoload.php';

function exception_error_handler($severity, $message, $file, $line)
{
    if (!(error_reporting() & $severity)) {
        // Этот код ошибки не входит в error_reporting
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
}

set_error_handler("exception_error_handler");

$objPHPExcel = new PHPExcel();

$locale = 'ru';
$validLocale = PHPExcel_Settings::setLocale($locale);
if (!$validLocale) {
    echo 'Unable to set locale to ' . $locale . ' - reverting to ru <br>';
}

$objPHPExcel->setActiveSheetIndex(0);

$sheet = $objPHPExcel->getActiveSheet();

$info = array();

$faker = Faker\Factory::create('ru_RU');

for ($i = 1; $i <= 10; $i++) {
    $info[$i]['artAuvix'] = $faker->randomNumber();
    $info[$i]['artHolding'] = $faker->userName;
    $info[$i]['partnumber'] = $faker->swiftBicNumber;
    $info[$i]['model'] = $faker->company;
    $info[$i]['name'] = $faker->sentences[0];
}

for ($i = 1; $i <= count($info); $i++) {
    try {
        $sheet->setCellValueByColumnAndRow(0, $i, $info[$i]['artAuvix']);
        $sheet->setCellValueByColumnAndRow(1, $i, $info[$i]['artHolding']);
        $sheet->setCellValueByColumnAndRow(2, $i, $info[$i]['partnumber']);
        $sheet->setCellValueByColumnAndRow(3, $i, $info[$i]['model']);
        $sheet->setCellValueByColumnAndRow(4, $i, $info[$i]['name']);
    } catch (ErrorException $e) {
        @file_put_contents('logfile.log', $e->getMessage()."\r\n", FILE_APPEND | LOCK_EX);
    }

}

//$objWriter = new PHPExcel_Writer_CSV($objPHPExcel);
//
//$filename = 'info.csv';
//
//$objWriter->save($filename);

header('Content-Type: text/csv');
header('Content-disposition: attachment; filename=' . 'info.csv');
//readfile('info.csv');
//unlink($filename);
