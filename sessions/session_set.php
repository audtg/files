<?php

session_name($_REQUEST['session_set']);
session_start();
echo ini_get('session.name').'<br>';
$_SESSION['qq'] = 'aa';
var_dump($_SESSION);
echo '<a href="index.php">Home</a>';