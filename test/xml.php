<?php
require_once __DIR__ . '/fields.php';

$host = 'localhost:C:\Program Files\Firebird\Firebird_2_5\data\test.fdb';
$username = 'sysdba';
$password = 'masterkey';

$dbh = ibase_connect($host, $username, $password, 'utf-8');


$preparedSQL = ibase_prepare('select * from test');

$sth = ibase_execute($preparedSQL);

$xmlWriter = new XMLWriter();
$xmlWriter->openUri('test.xml');
$xmlWriter->setIndent(true);
$xmlWriter->startDocument('1.0', 'UTF-8');
$xmlWriter->startElement('data');
$xmlWriter->startElement('info');
$xmlWriter->startElement('created');
$xmlWriter->text(date('d.m.Y H:i'));
$xmlWriter->endElement();
$xmlWriter->endElement();
$xmlWriter->startElement('materials');
while ($row = ibase_fetch_object($sth)) {
    $xmlWriter->startElement('material');
    foreach ($fields as $key => $value) {
        $xmlWriter->startElement($key);
        $xmlWriter->text($row->$key);
        $xmlWriter->endElement();
    }
    $xmlWriter->endElement();
}
$xmlWriter->endElement();
$xmlWriter->endElement();
$xmlWriter->endDocument();




function xml2assoc($xml, $name)
{
    $tree = null;

    while($xml->read())
    {
        if($xml->nodeType == XMLReader::END_ELEMENT)
        {
            return $tree;
        }
        else if($xml->nodeType == XMLReader::ELEMENT)
        {
            $tag = $xml->name;
            if(!$xml->isEmptyElement)
            {
                $childs = xml2assoc($xml, $tag);
            }
            $tree[] = array($tag => $childs);
        }

        else if($xml->nodeType == XMLReader::TEXT)
        {
            $tree = $xml->value;
        }
    }

    return $tree;
}

$xml = new XMLReader();
$xml->open('test.xml');
$assoc = xml2assoc($xml, 'data');
$xml->close();

var_dump($assoc);


$obj = simplexml_load_file('test.xml');

var_dump($obj);



file_put_contents('str-xml.log', print_r($assoc, true));