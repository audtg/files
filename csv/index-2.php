<?php
require_once __DIR__ . '/../Faker/src/autoload.php';
require_once __DIR__ . '/headers.php';

$info = array();

$faker = Faker\Factory::create('ru_RU');

for ($i = 1; $i <= 10; $i++) {
    $info[$i]['artAuvix'] = $faker->randomNumber();
    $info[$i]['artHolding'] = $faker->userName;
    $info[$i]['partnumber'] = $faker->swiftBicNumber;
    $info[$i]['model'] = $faker->company;
    $info[$i]['name'] = $faker->sentences[0];
}

$filename = 'info-2.csv';

$fp = fopen($filename, 'w');
fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

fputcsv($fp, $headers);
fwrite($fp, PHP_EOL);

foreach ($info as $row) {
    fputcsv($fp, $row);
    fwrite($fp, PHP_EOL);
}

fclose($fp);

header('Content-Type: text/csv');
header('Content-disposition: attachment; filename=' . $filename);
readfile($filename);
unlink($filename);
