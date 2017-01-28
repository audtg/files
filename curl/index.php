<?php
session_start();
// создание нового cURL ресурса
//header('Location: /sessions');

function c() {
//    $_SESSION['CAUVIX-ERROR']['FB'] = 1;
//    header('Location: /sessions/');
//    $ch = curl_init();
//    $data = http_build_query(array('name' => 'Foo', 'file' => 'gughihn'));
//
//    curl_setopt($ch, CURLOPT_URL,"http://files/pdf/");
//    curl_setopt($ch, CURLOPT_POST, 1);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//    curl_setopt($ch, CURLOPT_HEADER, false);
//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Location: /sessions/'));
//    curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
//
//// in real life you should use something like:
//// curl_setopt($ch, CURLOPT_POSTFIELDS,
////          http_build_query(array('postvar1' => 'value1')));
//
//// receive server response ...
////    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//   curl_exec ($ch);
//
//    curl_close ($ch);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://files/sessions/"); //set url
    curl_setopt($ch, CURLOPT_HEADER, true); //get header
    $data = array('name' => 'Foo', 'file' => 'gughihn');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//    curl_setopt($ch, CURLOPT_NOBODY, true); //do not include response body
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //do not show in browser the response
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Location: /files/sessions/'));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //follow any redirects
    curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
    curl_exec($ch);
//    $new_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); //extract the url from the header response
    curl_close($ch);
//    echo $new_url;

}

function f() {

}


c();
//header('Location: /sessions/');

//header('Location: ../sessions/');

var_dump($_SERVER);