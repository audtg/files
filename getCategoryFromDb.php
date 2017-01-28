<?php

$category = $_REQUEST['category'];
$name = $_REQUEST['name'];

$urlPrefix = 'http://files/';
$url = $urlPrefix . 'ws_get_category_from_db.php?category=' . urlencode($_REQUEST['category']);

$context = stream_context_create();

$xml = new SimpleXMLElement(file_get_contents($url, false, $context), null, false);

if (count($xml->blobContent) == 1) {
    $fileName = $_REQUEST['category'] . '.jpg';
    $image = base64_decode((string)$xml->blobContent);
    file_put_contents($fileName, $image);
    header('Content-Type: image/jpeg');
    header('Content-disposition: attachment; filename=' . $fileName);
    header('Content-Length: ' . filesize($fileName));
    readfile($fileName);
    unlink($fileName);
} elseif (count($xml->blobContent) > 1) {
    $zipName = $_REQUEST['category'] . '.zip';
    $zip = new ZipArchive();
    $zip->open($zipName, ZipArchive::CREATE);
    $i = 1;
    foreach ($xml->blobContent as $item) {
        $fileName = str_pad((string)$i, 2, '0', STR_PAD_LEFT) . '.jpg';
        $image = base64_decode((string)$item);
        file_put_contents($fileName, $image);
        $zip->addFile($fileName);
        $i++;
    }
    $zip->close();
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $zipName);
    header('Content-Length: ' . filesize($zipName));
    readfile($zipName);
    unlink($zipName);
    for ($j = 1; $j <= $i; $j++) {
        $fileName = str_pad((string)$j, 2, '0', STR_PAD_LEFT) . '.jpg';
        unlink($fileName);
    }
}

