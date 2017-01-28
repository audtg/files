<?php

$host = 'localhost:C:\Program Files\Firebird\Firebird_2_5\data\test.fdb';
$username = 'sysdba';
$password = 'masterkey';

$dbh = ibase_connect($host, $username, $password, 'utf-8');

$XML_txt = '<?xml version="1.0" encoding="utf-8"?'.'>';
$XML_txt .= '<data>';

$preparedSQL = ibase_prepare('
select ma1.ma_blobvalue as big_image, ma2.ma_blobvalue as small_image, ma3.ma_blobvalue as photos
from matattr ma1,  matattr ma2, matattr ma3
where ma1.mca_id = 6055 and ma2.mca_id = 6056 and ma3.mca_id = 6057
and ma1.ma_blobvalue is not null and ma2.ma_blobvalue is not null and ma3.ma_blobvalue is not null
-- and ma.MAT_ID = 48050
');

$preparedSQL = ibase_prepare('
select ma3.ma_blobvalue as photos
from matattr ma3
where ma3.mca_id = 6057
and ma3.ma_blobvalue is not null
and ma3.MAT_ID = 37397
');

$sth = ibase_execute($preparedSQL);

while($row = ibase_fetch_object($sth)) {
//    $bigBlobId = $row->BIG_PHOTO;
//    $bigBlobHandle = ibase_blob_open($bigBlobId);
//    $bigBlobInfo = ibase_blob_info($bigBlobId);
//    $bigBlobContent = ibase_blob_get($bigBlobHandle, $bigBlobInfo['length']);
//    $bigXml = new SimpleXMLElement($bigBlobContent);
//    $XML_txt .= '<BIG_PHOTO>'.(string)$bigXml->url.'</BIG_PHOTO>';

    $photosBlobId = $row->PHOTOS;
    $photosBlobHandle = ibase_blob_open($photosBlobId);
    $photosBlobInfo = ibase_blob_info($photosBlobId);
    $photosBlobContent = ibase_blob_get($photosBlobHandle, $photosBlobInfo['length']);
    $photosXml = new SimpleXMLElement($photosBlobContent);
    $arrPhotos = array();
    foreach ($photosXml as $photos) {
        $arrPhotos[] = (string)$photos->url;
    }
    $XML_txt .= '<PHOTOS>'.implode('; ', $arrPhotos).'</PHOTOS>';
}



//while($row = ibase_fetch_object($sth)) {
//    $bigBlobId = $row->BIG_IMAGE;
//    $bigBlobHandle = ibase_blob_open($bigBlobId);
//    $bigBlobInfo = ibase_blob_info($bigBlobId);
//    $bigBlobContent = ibase_blob_get($bigBlobHandle, $bigBlobInfo['length']);
//    $bigXml = new SimpleXMLElement($bigBlobContent);
//
//    $XML_txt .= '<bigImage>'.(string)$bigXml->url.'</bigImage>';
////    foreach ($xml->url as $item) {
////        $XML_txt .= '<path>'.(string)$item.'</path>';
////    }
//}
ibase_free_result($sth);

$XML_txt .= '</data>';

if ($_GET['json'] == 1) { // вывод в формате JSON
    $xml = simplexml_load_string($XML_txt);
    header ("Content-Type:application/json");
    echo json_encode($xml);
} else {
    header ("Content-Type:application/xml");
    echo $XML_txt;    // вывод в XML  формате
}
