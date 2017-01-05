<?php

$category = $_REQUEST['category'];
$name = $_REQUEST['name'];

$urlPrefix = 'http://files/';
$url = $urlPrefix . 'ws_get_category_from_db.php?category=' . urlencode($_REQUEST['category']);

$context = stream_context_create();

$xml = new SimpleXMLElement(file_get_contents($url, false, $context), null, false);

$zipName = $_REQUEST['category'].'.zip';
$zip = new ZipArchive();
$zip->open($zipName, ZipArchive::CREATE);
$i = 1;
foreach ($xml->blobContent as $item) {
    $image = base64_decode((string) $item);
    $fileName = str_pad((string) $i, 2, '0', STR_PAD_LEFT).'.jpg';
    file_put_contents($fileName, $image);
    $zip->addFile($fileName);
    $i++;
}
$zip->close();
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipName);
header('Content-Length: ' . filesize($zipName));
readfile($zipName);
unlink($zipName);
for($j = 1; $j <= $i; $j++) {
    $fileName = str_pad((string) $j, 2, '0', STR_PAD_LEFT).'.jpg';
    unlink($fileName);
}
