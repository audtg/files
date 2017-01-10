<?php

$host = 'localhost:C:\Program Files\Firebird\Firebird_2_5\data\test.fdb';
$username = 'sysdba';
$password = 'masterkey';

error_reporting(E_ERROR | E_CORE_ERROR | E_USER_ERROR);

$dbh = ibase_connect($host, $username, $password, 'utf-8');

if (!$dbh) {
   echo 'connection error';
}

$preparedSQL = ibase_prepare('insert into corr values (1, \'haixhajxabjk\')');

if (!$preparedSQL) {
    echo 'preparing error';
}

$sth = ibase_execute($preparedSQL);

var_dump(gettype($sth));

if (is_integer($sth)) {
    echo 'inserted '.$sth.' strings';
}

$preparedSQL = ibase_prepare('update corr set CORR_ID =  3 where CORR_ID=1');

if (!$preparedSQL) {
    echo 'preparing error';
}

$sth = ibase_execute($preparedSQL);

var_dump(gettype($sth));

if (is_integer($sth)) {
    echo 'updated '.$sth.' strings';
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
