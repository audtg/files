<?php

$category = $_REQUEST['category'];
$name = $_REQUEST['name'];

$urlPrefix = 'http://files/';
$url = $urlPrefix . 'ws_get_file_from_db.php?category=' . urlencode($_REQUEST['category']) . '&name=' . urlencode($_REQUEST['name']);

$context = stream_context_create();

$xml = new SimpleXMLElement(file_get_contents($url, false, $context), null, false);
$image = base64_decode((string)$xml->blobContent);
$fileName = $_REQUEST['name'];
//
header("Content-type: image/*");
//header('Content-Disposition: attachment; filename=' . $fileName);

echo $image;


