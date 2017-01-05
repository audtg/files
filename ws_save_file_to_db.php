<?php

require_once('dbFunctions.php');

$files = saveFilesToDb($dbh, $_POST);

$XML_txt = '<?xml version="1.0" encoding="utf-8"?'.'>';
$XML_txt .= '<names>';
foreach ($files as $name) {
    $XML_txt .= '<name>'.$name.'</name>';
}

$XML_txt .= '</names>';

if ($_GET['json'] == 1) { // вывод в формате JSON
    $xml = simplexml_load_string($XML_txt);
    header ("Content-Type:application/json");
    echo json_encode($xml);
} else {
    header ("Content-Type:application/xml");
    echo $XML_txt;    // вывод в XML  формате
}
