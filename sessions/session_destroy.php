<?php
session_name('aa');
session_start();
session_id($_REQUEST['session_destroy']);

session_destroy();

echo '<a href="index-1.php">Home</a>';