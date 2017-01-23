<?php

require_once('dbFunctions.php');

$names = getNames();

$XML_txt = '<?xml version="1.0" encoding="utf-8"?'.'>';
$XML_txt .= '<names>';
foreach($names as $category => $name) {
    $XML_txt .= '<category>';
    $XML_txt .= '<categoryName>'.$category.'</categoryName>';
    $XML_txt .= '<files>';
    foreach($name as $value) {
        $XML_txt .= '<fileName>'.$value.'</fileName>';
    }
    $XML_txt .= '</files>';
    $XML_txt .= '</category>';
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
