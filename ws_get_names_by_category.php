<?php

require_once('dbFunctions.php');

$category = urldecode($_REQUEST['category']);

$names = getNamesByCategory($category);

$XML_txt = '<?xml version="1.0" encoding="utf-8"?'.'>';

    $XML_txt .= '<files>';
    foreach($names as $value) {
        $XML_txt .= '<fileName>'.$value.'</fileName>';
    }
    $XML_txt .= '</files>';


if ($_GET['json'] == 1) { // вывод в формате JSON
    $xml = simplexml_load_string($XML_txt);
    header ("Content-Type:application/json");
    echo json_encode($xml);
} else {
    header ("Content-Type:application/xml");
    echo $XML_txt;    // вывод в XML  формате
}
