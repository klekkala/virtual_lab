<HTML>
<HEAD>
<TITLE> writing a file </TITLE>
</HEAD>

<BODY>


<?php
$myFile = "test.html"; // or .php   
$fh = fopen($myFile, 'w'); // or die("error");  
$stringData = "<html><head><title>hello</title><p>Hello world</p></head></html>";   
fwrite($fh, $stringData);
fclose($myfile);
?>

</BODY>
</HTML>

