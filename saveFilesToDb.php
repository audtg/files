<?php
require_once('dbFunctions.php');

clearstatcache();

$arr = array();

foreach (scandir(__DIR__) as $category) {
    $path = __DIR__ . DIRECTORY_SEPARATOR . $category;
    if (is_dir($path) && substr($category, 0, 1) != '.') {
        foreach (scandir($path) as $name) {
            if (is_file($path . DIRECTORY_SEPARATOR . $name)) {
                $picture = file_get_contents($path . DIRECTORY_SEPARATOR . $name);
                $arr[$category][$name] = base64_encode($picture);
            }

       }
    }
}

$data = http_build_query($arr);

$urlPrefix = 'http://files/';
$url = $urlPrefix . 'ws_save_file_to_db.php';

$opts = array(
    'http' => array(
        'method' => "POST",
        'header' => "Content-type: application/x-www-form-urlencoded\r\n"
//            . "Cookie: CRMSESSID=" . $_SESSION["SESS_AUTH"]['crmsession'] . "\r\n"
            . "Content-Length: " . strlen($data) . "\r\n",
        'content' => $data
    )
);

$context = stream_context_create($opts);

$xml = new SimpleXMLElement(file_get_contents($url, false, $context), null, false);

$result = array();

foreach ($xml->name as $name) {
    $result[] = (string) $name;
}

var_dump($result);

//foreach (scandir($dirName2) as $item) {
//    if (is_file($dirName2 . DIRECTORY_SEPARATOR . $item)) {
////        echo "\r\n" . $item;
//        $handle = fopen($dirName2 . DIRECTORY_SEPARATOR .$item, 'rb'); // имя файла или картинки -- открыли файл на чтение
////        $upload = fread($handle, filesize($dirName2 . DIRECTORY_SEPARATOR .$item)); // считали файл в переменную
//        $upload = ibase_blob_import ($handle); // считали файл в переменную
//        fclose($handle); // закрыли файл.
//        $arrFiles[] = array('name' => 'new-'.$item, 'picture' => $upload);
//    }
//}
//
//var_dump(saveFilesToDb($dbh, $dirName2, $arrFiles));

