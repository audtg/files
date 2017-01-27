<?php
require_once __DIR__ . '/fields.php';

$host = 'localhost:C:\Program Files\Firebird\Firebird_2_5\data\test.fdb';
$username = 'sysdba';
$password = 'masterkey';

$dbh = ibase_connect($host, $username, $password, 'utf-8');


$preparedSQL = ibase_prepare('select * from test');

$sth = ibase_execute($preparedSQL);

$fp = fopen('test.csv', 'w');
fputs($fp, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
fputcsv($fp, $fields);

//while ($row = ibase_fetch_object($sth)) {
//    $arrRow = array();
//    foreach ($fields as $key => $value) {
//        $arrRow[] = $row->$key;
//    }
//    fputcsv($fp, $arrRow);
//}

while ($row = ibase_fetch_row($sth)) {
    fputcsv($fp, $row);
}
fclose($fp);

$arrStr = file('test.csv', FILE_IGNORE_NEW_LINES);

foreach ($arrStr as $key => $item) {
    $arrStr[$key] = array_combine(array_keys($fields), str_getcsv($item));
}

file_put_contents('str-csv.log', print_r($arrStr, true));
