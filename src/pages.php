<HTML>
<HEAD>
<TITLE> writing a file </TITLE>
</HEAD>

<BODY>


<?php

$map = array();

$map = array(
    "image" => "<input type='text' name='fname'>",
    "button" => "<input type='button' value='Click me' onclick='msg()'>",
    "email" => "<input type='text' name='fname'>",
    "file" => "<input type='text' name='fname'>",
    "dropdown" => "<input type='text' name='fname'>",
    "time" => "<input type='text' name='fname'>",
    "text" => "<input type='text' name='fname'>"
);

require '/home/kiran/vendor/autoload.php';

use Stichoza\GoogleTranslate\TranslateClient;
function translate($text, $lang){


$tr = new TranslateClient(); // Default is from 'auto' to 'en'
$tr->setSource('en'); // Translate from English
$tr->setTarget($lang); // Translate to Georgian

echo $tr->translate($text);
}




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

    $lang = 'ta';
    $tabs = array();
    $data =  array ();
    $type = array();
    $count = array();



    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, $xml, $tags);
    xml_parser_free($parser);

    $elements = array();  // the currently filling [child] XmlElement array
    $stack = array();
    $i = 0;
    foreach ($tags as $tag) {

        $index = count($elements);
        if ($tag['type'] == "complete" || $tag['type'] == "open") {
            $elements[$index] = new XmlElement;

            if($tag['level'] >= 3){

                if($tag['tag']=='desc'){
                    array_push($tabs,$tag['value']);
                    array_push($count,$i);
                    $i = 0;
                }
                else if($tag['tag'] == 'type'){
                    array_push($type,$tag['value']);

                }
                else{
		    $tem = translate($tag['tag'], $lang);
		    echo $tem;
 		    echo 2;
                    array_push($data,$tag['tag']);
                    $i++;
                }

            }

            else if($tag['tag']=='num' && $tag['level']==2){
                $count[0] = $tag['value'];
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

    //return array($tabs, $data);
    return array($type, $data, $count, $tabs);
}
//file pointers initialized and pointed

$wfile = fopen("/var/www/html/easyauthor/test.php", "w") or die("Unable to open file!");
$rfile = fopen("/var/www/html/config/telugu.xml", "r") or die("Unable to open file!");
$rfile1 = fopen("/var/www/html/src/stitch-1.txt", "r") or die("Unable to open file!");
$rfile3 = fopen("/var/www/html/src/stitch-3.txt", "r") or die("Unable to open file!");
$rfile5 = fopen("/var/www/html/src/stitch-5.txt", "r") or die("Unable to open file!");


//file pointers reading or writing
$xml = fread($rfile,filesize("/var/www/html/config/telugu.xml"));
$txt1 = fread($rfile1,filesize("/var/www/html/src/stitch-1.txt"));
$txt3 = fread($rfile3,filesize("/var/www/html/src/stitch-3.txt"));
$txt5 = fread($rfile5,filesize("/var/www/html/src/stitch-5.txt"));

//$val is the variable which consists of the attribute in the xml file. You get the data which is enclosed in the attribute
$val = 'name';

//$output is the array which consists of the text fields which is obtained from the xml schema file
list($type, $data, $count, $tabs) = xml_to_object($xml, $val);


//$number is the number of pages which will be present in the easyauthor framework wizard
$number = $count[0];

//*********************************Generating process starts*******************************//

//Initializing HTML and scripts
fwrite($wfile, $txt1);

//Specifing the language

$txt = "$" + "lang = $lang";
fwrite($wfile, $txt);

//Tab generating,initializing and naming
for ($x = 1; $x <= $number; $x++) {
    $word = $tabs[$x];
    $txt2 = "<li><a href='#tab$x' data-toggle='tab'>$word</a></li>";
    fwrite($wfile, $txt2);
}

fwrite($wfile, $txt3);


//Page content generating
for ($x = 1; $x <= $number; $x++) {
    $txt4 =  "<div class='tab-pane' id='tab$x'>";
    fwrite($wfile, $txt4);

    for($y = 0; $y <= $count[$x]; $y++){
	
	$temp = $type[$x];
        $txt4 = "<div class='control-group'>
            <label class='control-label' for=$type[$x]>$data[$x]</label>
            <div class='controls'>
            $map[$temp]
            </div>
            </div>";

        fwrite($wfile, $txt4);
    }
    $txt4 = "</div>";
    fwrite($wfile, $txt4);
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
