<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        body {
            font: 12px/1.2 Verdana, sans-serif;
            padding: 0 10px;
        }

        a:link, a:visited {
            text-decoration: none;
            color: #416CE5;
            border-bottom: 1px solid #416CE5;
        }

        h2 {
            font-size: 13px;
            margin: 15px 0 0 0;
        }
    </style>
    <link rel="stylesheet" href="colorbox/colorbox.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="colorbox/jquery.colorbox.js"></script>
    <script>
        jQuery(function () {
                jQuery('.colorbox').click(function () {

                });
            }
        );
    </script>
</head>
<body>

<?php
require_once 'getNames.php';

foreach ($result as $category => $files) {
    echo '<div><a href="getCategoryFromDb.php?category=' . $category . '">download ' . $category . '</a><span style="padding-right: 50px;"></span>';
    echo '<button class="colorbox" id="' . $category . '">' . $category . '</button></div><br>';

    foreach ($files as $file) {
        echo '<img src="getFileFromDb.php?category=' . $category . '&name=' . $file . '" width="200" height="200">';
    }

}
?>
</body>
</html>