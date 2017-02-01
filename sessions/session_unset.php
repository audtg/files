<?php
session_name($_REQUEST['session_unset']);
session_start();
session_unset();
echo ini_get('session.name').'<br>';
var_dump($_SESSION);

echo '<a href="index-1.php">Home</a>';

