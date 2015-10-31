<HTML>
<HEAD>
<TITLE> writing a file </TITLE>
</HEAD>

<BODY>


<?php

//**********************************************XML parser********************************************
//This XML parser works by pushing the retrieved nodes into a stack and later retrieving them//
class XmlElement {
  var $name;      //Name of the attribute
  var $attributes;//List of subattributes
  var $content;   //Content of the attributes
  var $children;  //Number of children
};


//Function which converts xml variable to element-object format//
//$xml is the variable which is read from an xml file//
//$val can be one of the 4 variables in the class types//
//$tabs is the array which consists of the names and appending it for every name attribute//
function xml_to_object($xml, $val) {
    $tabs = array();
    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, $xml, $tags);
    xml_parser_free($parser);

    $elements = array();  // the currently filling [child] XmlElement array
    $stack = array();
    foreach ($tags as $tag) {
        $index = count($elements);
	
        if ($tag['type'] == "complete" || $tag['type'] == "open") {
            $elements[$index] = new XmlElement;
	    if($tag['tag']=='num'){
                array_push($tabs,$tag['value']);
            }
            if($tag['tag']=='text'){
                array_push($tabs,$tag['value']);
            }
            $elements[$index]->name = $tag['tag'];
            $elements[$index]->attributes = $tag['attributes'];
            $elements[$index]->content = $tag['value'];
            if ($tag['type'] == "open") {  // push
                $elements[$index]->children = array();
                $stack[count($stack)] = &$elements;
                $elements = &$elements[$index]->children;
            }
        }
        if ($tag['type'] == "close") {  // pop
            $elements = &$stack[count($stack) - 1];
            unset($stack[count($stack) - 1]);
        }
    }

    return $tabs;
    //return $elements[0];
}

//file pointers initialized and pointed

$wfile = fopen("/var/www/html/easyauthor/test.html", "w") or die("Unable to open file!");
$rfile = fopen("/var/www/html/config/telugu.xml", "r") or die("Unable to open file!");
$rfile1 = fopen("/var/www/html/src/stitch-1.txt", "r") or die("Unable to open file!");
//$rfile2 = fopen("/var/www/html/src/stitch-2.txt", "r") or die("Unable to open file!");
$rfile3 = fopen("/var/www/html/src/stitch-3.txt", "r") or die("Unable to open file!");
$rfile4 = fopen("/var/www/html/src/stitch-4.txt", "r") or die("Unable to open file!");
$rfile5 = fopen("/var/www/html/src/stitch-5.txt", "r") or die("Unable to open file!");


//file pointers reading or writing
$xml = fread($rfile,filesize("/var/www/html/config/telugu.xml"));
$txt1 = fread($rfile1,filesize("/var/www/html/src/stitch-1.txt"));
//$txt2 = fread($rfile2,filesize("/var/www/html/src/stitch-2.txt"));
$txt3 = fread($rfile3,filesize("/var/www/html/src/stitch-3.txt"));
$txt4 = fread($rfile4,filesize("/var/www/html/src/stitch-4.txt"));
$txt5 = fread($rfile5,filesize("/var/www/html/src/stitch-5.txt"));

//$val is the variable which consists of the attribute in the xml file. You get the data which is enclosed in the attribute
$val = 'name';

//$output is the array which consists of the text fields which is obtained from the xml schema file
$output = xml_to_object($xml, $val);

//$number is the number of pages which will be present in the easyauthor framework wizard
$number = $output[0];

//*********************************Generating process starts*******************************//

//Initializing HTML and scripts
fwrite($wfile, $txt1);

//Tab generating,initializing and naming
for ($x = 1; $x <= $number; $x++) {
    $word = $output[$x];
    $txt = "<li><a href='#tab1' data-toggle='tab'>$word</a></li>";
    fwrite($wfile, $txt);
}

fwrite($wfile, $txt3);

//Page content generating
for ($x = 0; $x <= $number; $x++) {
    <div class="tab-pane" id="tab1">
                        <div class="control-group">
                            <label class="control-label" for="image">Image</label>
                            <div class="controls">
                                <input type="image" id="imagefield" name="imagefield" class="required image">
                            </div>
                        </div>

                    </div>
}
fwrite($wfile, $txt5);

fclose($rfile);
fclose($wfile);
fclose($rfile1);
fclose($rfile2);
fclose($rfile3);
fclose($rfile4);
fclose($rfile5);
?>



</BODY>
</HTML>
