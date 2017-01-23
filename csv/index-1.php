<?php

require_once __DIR__ . '/PHPExcel/Classes/PHPExcel.php';
require_once __DIR__ . '/PHPExcel/Classes/PHPExcel/Writer/IWriter.php';
require_once __DIR__ . '/PHPExcel/Classes/PHPExcel/Writer/Abstract.php';
require_once __DIR__ . '/PHPExcel/Classes/PHPExcel/Writer/CSV.php';
require_once __DIR__ . '/../Faker/src/autoload.php';
require_once __DIR__ . '/headers.php';


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

$j =  0;
foreach ($headers as $key => $value) {
    $sheet->setCellValueByColumnAndRow($j, 1, $value);
    $j++;
}

$i = 2;
foreach ($info as $row) {
    $j =  0;
    foreach ($headers as $key => $value) {
        $sheet->setCellValueByColumnAndRow($j, $i, $row[$key]);
        $j++;
    }
    $i++;
}

$objWriter = new PHPExcel_Writer_CSV($objPHPExcel);

$filename = 'info-1.csv';

$objWriter->save($filename);

header('Content-Type: text/csv');
header('Content-disposition: attachment; filename=' . $filename);
readfile($filename);
unlink($filename);
