<?php

session_name($_REQUEST['session_start']);
session_start();
echo ini_get('session.name').'<br>';
ini_set('session.name', 'newses').'<br>';
echo ini_get('session.name').'<br>';
echo '<a href="index-1.php">Home</a>';