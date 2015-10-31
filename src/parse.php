<?php 
class XmlElement {
  var $name;      //Name of the attribute
  var $attributes;//List of subattributes
  var $content;   //Content of the attributes
  var $children;  //Number of children
};

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
	echo 2;
    $index = count($elements);
    if ($tag['type'] == "complete" || $tag['type'] == "open") {
      $elements[$index] = new XmlElement;
    //  if($tag['tag']=='text'){
	//array_push($tabs,$tag['value']);
	//}
	echo $tag['type'];
echo $tag['value'];
echo $tag['tag'];

    
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
	echo $elements[0];
    }
  }

//return $tabs;
//return $elements[0];
}

$rfile1 = fopen("/var/www/html/config/telugu.xml", "r") or die("Unable to open file!");
$xml = fread($rfile1,filesize("/var/www/html/config/telugu.xml"));

$val = 'name';

$output = xml_to_object($xml, $val);


?>
