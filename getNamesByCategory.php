<?php

$result = array();

$urlPrefix = 'http://files/';
$url = $urlPrefix . 'ws_get_names_by_category.php?category=' . urlencode($_REQUEST['category']);

$context = stream_context_create();

$xml = new SimpleXMLElement(file_get_contents($url, false, $context), null, false);

foreach ($xml->fileName as $value) {
    $fileName = (string)$value;
    $result[] = $fileName;
}

echo json_encode($result);

