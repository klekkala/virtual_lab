<HTML>
<HEAD>
<TITLE> writing a file </TITLE>
</HEAD>

<BODY>


<?php
$myfile = fopen("/var/www/html/easyauthor/test.txt", "w") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fclose($myfile);
?>

</BODY>
</HTML>

