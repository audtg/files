<?php
//session_name($_REQUEST['session_delete']);
session_start();
session_unset();
session_destroy();
setcookie(session_name(),false,0,'/');

echo '<a href="index-1.php">Home</a>';

