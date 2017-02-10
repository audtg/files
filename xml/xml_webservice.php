<?php
header('Content-type: text/xml');
//header('Content-disposition: attachment; filename=' . 'xml-file.xml');
$xml = new XmlWriter();
$xml->openMemory();
$xml->startDocument('1.0', 'UTF-8');
$xml->startElement('mydoc');
//$xml->startCdata('data');
//$xml->startCdata('materials');
//
//// CData output
//$xml->startCdata('mycdataelement');
$xml->writeCData("text for inclusion within CData tags");
//$xml->endCdata();
//
//// end the document and output
//$xml->endCdata();
//$xml->endCdata();
$xml->endElement();
$xml->endDocument();
//header ("Content-Type:application/xml");
file_put_contents('log.log', $xml->outputMemory(false));
$xml->outputMemory(true);