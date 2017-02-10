<?php
$url = 'xml_webservice.php';

header('Content-Type: text/xml');
header('Content-disposition: attachment; filename=' . 'xml-file.xml');
echo file_get_contents($url);