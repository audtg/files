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

</head>
<body>
<a href="download-csv.php">csv</a>
<?php

$pureDesription = strip_tags('<p>Lorem jefggf jjefbgfiegfuefeu <b>egfuegfu kfsk</b> jfbsekfsv. Gfyufdyd fjkjge jhegh hfgef.</p>');
$firstParagraph = substr($str, 0, strpos($str, '.') + 1);


//foreach (scandir(ini_get('session.save_path')) as $value) {
//
//    foreach ($_COOKIE as $cookieName => $cookieValue) {
//
//        if (preg_match('/'.$cookieValue.'/', $value, $matches)== 1) {
//            echo $cookieName.' =  '.file_get_contents(ini_get('session.save_path').$value).'<br>';
//        }
//
//    }
//}
require_once 'getNames.php';

foreach ($result as $category => $files) {
    echo '<div><a href="getCategoryFromDb.php?category=' . $category . '">download ' . $category . '</a>
    <span style="padding-right: 50px;"></span>';
    echo '<button class="colorbox" id="' . $category . '">' . $category . '</button></div><br>';

    foreach ($files as $file) {
        echo '<img src="getFileFromDb.php?category=' . $category . '&name=' . $file . '" width="200" height="200">';
    }

}
?>

<script>
    jQuery(function () {
            var category = '';
            jQuery('.colorbox').click(function () {
                category = jQuery(this).attr('id');
                jQuery.get('getNamesByCategory.php', {category: category}, function (response) {
                    var data = JSON.parse(response);
                    jQuery.each(data, function (index, item) {
                        jQuery('body')
                            .append(jQuery('<a>').attr({href: '#' + category + index}).addClass('box'))
                            //                            .append(jQuery('<div onClick="jQuery.colorbox.next();">')
                            .append(jQuery('<div>').attr({onClick: "jQuery.colorbox.next();"})
                                .addClass('invis')
                                .css({display: 'none'})
                                .append(jQuery('<img>').attr({
                                    width: "400",
                                    height: "400",
                                    id: category + index,
                                    src: 'getFileFromDb.php?category=' + category + '&name=' + item
                                }).addClass('loadable'))
                            )

                        ;

                    });
                    jQuery('.loadable').last().load(function () {
                        jQuery('.box').colorbox({inline: true, open: true, rel: 'box'});
                    });
                });

            });

        }
    );
</script>
</body>
</html>