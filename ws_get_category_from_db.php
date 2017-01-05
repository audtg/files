<?php

require_once('dbFunctions.php');

$category = urldecode($_REQUEST['category']);

$blobCategoryContent = getCategoryFromDb($category);

$XML_txt = '<?xml version="1.0" encoding="utf-8"?'.'>';
$XML_txt .= '<blob>';
foreach($blobCategoryContent as $blobContent) {
    $XML_txt .= '<blobContent>'.base64_encode($blobContent).'</blobContent>';
}
$XML_txt .= '</blob>';

if ($_GET['json'] == 1) { // вывод в формате JSON
    $xml = simplexml_load_string($XML_txt);
    header ("Content-Type:application/json");
    echo json_encode($xml);
} else {
    header ("Content-Type:application/xml");
    echo $XML_txt;    // вывод в XML  формате
}
