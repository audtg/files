<?php
session_start();

//header('Location: /sessions');
var_dump($_COOKIE);
var_dump($_REQUEST);


var_dump($_SESSION);

//echo ini_get('session.name').'<br>';
echo ini_get('session.save_path').'<br>';
foreach (scandir(ini_get('session.save_path')) as $value) {

    foreach ($_COOKIE as $cookieName => $cookieValue) {

        if (preg_match('/'.$cookieValue.'/', $value, $matches)== 1) {
//            $context = stream_context_create();
            $handle = fopen(ini_get('session.save_path').$value, 'r');
            $content = fread($handle, filesize(ini_get('session.save_path').$value));
            fclose($handle);
            echo 'content = '.($content == false ? 0 : 1);
            echo '<br>';
//            echo $cookieName.' =  '. file_get_contents(ini_get('session.save_path').$value).'<br>';
        }

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sessions</title>
</head>
<body>
<form action="session_start.php" method="post">
    <input type="text" id="session_start" name="session_start">
    <button type="submit">Start session</button>
</form>
<form action="session_delete.php" method="post">
    <input type="text" id="session_delete" name="session_delete">
    <button type="submit">Delete session</button>
</form>
<form action="session_set.php" method="get">
    <input type="text" id="session_set" name="session_set">
    <button type="submit">Set session values</button>
</form>
<form action="session_unset.php" method="get">
    <input type="text" id="session_unset" name="session_unset">
    <button type="submit">Unset session</button>
</form>
<form action="session_destroy.php" method="get">
    <input type="text" id="session_destroy" name="session_destroy">
    <button type="submit">Destroy session</button>
</form>
</body>
</html>


