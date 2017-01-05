<?php
require_once('dbFunctions.php');

$result = array();

$urlPrefix = 'http://files/';
$url = $urlPrefix . 'ws_get_names.php';

$context = stream_context_create();

$xml = new SimpleXMLElement(file_get_contents($url, false, $context), null, false);

foreach ($xml->category as $item) {
    $categoryName = (string) $item->categoryName;
    foreach($item->files->fileName as $value) {
        $fileName = (string) $value;
        $result[$categoryName][] = $fileName;
    }
}


