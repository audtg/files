<?php

$host = 'localhost:C:\Program Files\Firebird\Firebird_2_5\data\test.fdb';
$username = 'sysdba';
$password = 'masterkey';

function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // Этот код ошибки не входит в error_reporting
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
}
set_error_handler("exception_error_handler");

//echo error_reporting(E_ERROR | E_CORE_ERROR | E_USER_ERROR);
//echo '<br>';
//echo error_reporting();

try {
    $dbh = ibase_connect($host, $username, $password, 'utf-8');
} catch (ErrorException $e) {
    echo 'error<br>';
    echo $e->getCode().'<br>';
    echo $e->getMessage().'<br>';
    echo $e->getLine().'<br>';
    echo $e->getFile().'<br>';
    echo ibase_errcode() . '<br>';
    echo ibase_errmsg() . '<br>';
}



var_dump(intval(ibase_errcode()));
var_dump(strval(ibase_errmsg()));
echo 'ibase_errmsg()='.ibase_errmsg() . '<br>';

if (!$dbh) {
    echo 'connection error<br>';
    echo ibase_errcode() . '<br>';
    echo ibase_errmsg() . '<br>';
}

$preparedSQL = ibase_prepare('insert into corr values (2, \'haixhajxabjk\')');

if (!$preparedSQL) {
    echo 'preparing error'. '<br>';
    echo ibase_errcode() . '<br>';
    echo ibase_errmsg() . '<br>';
}

$sth = ibase_execute($preparedSQL);

var_dump(gettype($sth));

if (is_integer($sth)) {
    echo 'inserted ' . $sth . ' strings';
} elseif(!$sth) {
        echo 'execution error'. '<br>';
        echo ibase_errcode() . '<br>';
        echo ibase_errmsg() . '<br>';
}

$preparedSQL = ibase_prepare('update corr set CORR_ID =  1 where CORR_ID=3');

if (!$preparedSQL) {
    echo 'preparing error';
}

$sth = ibase_execute($preparedSQL);

var_dump(gettype($sth));

if (is_integer($sth)) {
    echo 'updated ' . $sth . ' strings';
} elseif ($sth) {
    echo 'no strings for update';
} else {
    echo 'update error';
}


$preparedSQL = ibase_prepare('select * from corr where 1=2');

if (!$preparedSQL) {
    echo 'preparing error';
}

$sth = ibase_execute($preparedSQL);

var_dump(gettype($sth));

if (is_resource($sth)) {
    echo 'resource for select';
} else {
    echo 'select error';
}
