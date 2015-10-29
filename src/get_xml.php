<html>
<head>
<title> Parse </title>
</head>
<body>

<?php
    //include '/var/www/html/config/test.php'
    $mysongs = simplexml_load_file('/var/www/html/config/hindi.xml');
    //echo $mysongs;
    print_r($mysongs);
?>

</body>
<html>
