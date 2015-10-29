<html>
<head>
<title> Parse </title>
</head>
<body>

<?php
$xml=simplexml_load_file("/var/www/html/config/hindi.xml") or die("Error: Cannot create object");
print_r($xml);
?>


</body>
<html>
