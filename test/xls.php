<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel/Writer/IWriter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel/Writer/Abstract.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel/Writer/CSV.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Faker/src/autoload.php';
require_once __DIR__ . '/fields.php';

$host = 'localhost:C:\Program Files\Firebird\Firebird_2_5\data\test.fdb';
$username = 'sysdba';
$password = 'masterkey';

function exception_error_handler($severity, $message, $file, $line)
{
    if (!(error_reporting() & $severity)) {
        // Этот код ошибки не входит в error_reporting
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
}

set_error_handler("exception_error_handler");

$dbh = ibase_connect($host, $username, $password, 'utf-8');


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

$preparedSQL = ibase_prepare('INSERT INTO test (mat_id, mat_diler_id, part_no, model, name) VALUES (?, ?, ?, ?, ?) ');


for ($i = 1; $i <= 10; $i++) {
    $sth = ibase_execute($preparedSQL, $faker->randomNumber(), $faker->userName, $faker->swiftBicNumber, $faker->company, $faker->sentences[0]);
}

//$j =  0;
//foreach ($headers as $key => $value) {
//    $sheet->setCellValueByColumnAndRow($j, 1, $value);
//    $j++;
//}
//
//$i = 2;
//foreach ($info as $row) {
//    $j =  0;
//    foreach ($headers as $key => $value) {
//        $sheet->setCellValueByColumnAndRow($j, $i, $row[$key]);
//        $j++;
//    }
//    $i++;
//}
//
//$objWriter = new PHPExcel_Writer_CSV($objPHPExcel);
//
//$filename = 'info-1.csv';
//
//$objWriter->save($filename);
//
//header('Content-Type: text/csv');
//header('Content-disposition: attachment; filename=' . $filename);
//readfile($filename);
//unlink($filename);