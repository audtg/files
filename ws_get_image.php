<?php

$host = 'localhost:C:\Program Files\Firebird\Firebird_2_5\data\test.fdb';
$username = 'sysdba';
$password = 'masterkey';

$dbh = ibase_connect($host, $username, $password, 'utf-8');

$XML_txt = '<?xml version="1.0" encoding="utf-8"?'.'>';
$XML_txt .= '<data>';

$preparedSQL = ibase_prepare('
select ma.ma_blobvalue from matattr ma where ma.mca_id=6056 and ma.ma_blobvalue is not null
');

$sth = ibase_execute($preparedSQL);

while($row = ibase_fetch_object($sth)) {
    $blobId = $row->MA_BLOBVALUE;
    $blobHandle = ibase_blob_open($blobId);
    $blobInfo = ibase_blob_info($blobId);
    $blobContent = ibase_blob_get($blobHandle, $blobInfo['length']);
    $xml = new SimpleXMLElement($blobContent);
    $XML_txt .= '<path>'.(string)$xml->url.'</path>';
}
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
