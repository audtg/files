<?php

session_name($_REQUEST['session_set']);
session_start();

$_SESSION['integer_value'] = 100;
$_SESSION['float_value'] = 100.85;
$_SESSION['boolean_value'] = true;
$_SESSION['array_value'] = array(true, 11, 'cvb', array(false, 22, 23.45, 'bfjkbfk'));

var_dump($_SESSION);
echo '<a href="index-1.php">Home</a>';

