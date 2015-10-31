<?php 
function getXmlValueByTag($xml,$needle){ 
        $parser    =    xml_parser_create();//Create an XML parser 
        xml_parse_into_struct($parser, $xml, $outArray);// Parse XML data into an array structure 
        xml_parser_free($parser);//Free an XML parser 
        
        for($i=0;$i<count($outArray);$i++){ 
            if($outArray[$i]['tag']==strtoupper($needle)){ 
                $tagValue    =    $outArray[$i]['value']; 
            } 
        } 
        return $tagValue; 
    } 
$xml = '
<parser>
   <name language="en-us">Fred Parser</name>
   <category>
       <name>Nomenclature</name>
       <note>Noteworthy</note>
   </category>
</parser>
';

    $needle = 'note';
    echo getXmlValueByTag($xml,$needle); 
?>
