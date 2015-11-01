<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>translate</title>
</head>
<body>
<?php
 
function curl($url,$params = array(),$is_coockie_set = false)
{
 
if(!$is_coockie_set){
/* STEP 1. let’s create a cookie file */
$ckfile = tempnam ("/tmp", "CURLCOOKIE");
 
/* STEP 2. visit the homepage to set the cookie properly */
$ch = curl_init ($url);
curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec ($ch);
}
 
$str = ''; $str_arr= array();
foreach($params as $key => $value)
{
$str_arr[] = urlencode($key)."=".urlencode($value);
}
if(!empty($str_arr))
$str = '?'.implode('&',$str_arr);
 
/* STEP 3. visit cookiepage.php */
 
$Url = $url.$str;
 
$ch = curl_init ($Url);
curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
 
$output = curl_exec ($ch);
return $output;
}
 
function Translate($word,$conversion = 'hi_to_en')
{
$word = urlencode($word);
// dutch to english
if($conversion == 'nl_to_en')
$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=nl&tl=en&multires=1&otf=2&pc=1&ssel=0&tsel=0&sc=1';
 
// english to hindi
if($conversion == 'en_to_hi')
$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=en&tl=hi&ie=UTF-8&oe=UTF-8&multires=1&otf=1&ssel=3&tsel=3&sc=1';
 
// hindi to english
if($conversion == 'hi_to_en')
$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=hi&tl=en&ie=UTF-8&oe=UTF-8&multires=1&otf=1&pc=1&trs=1&ssel=3&tsel=6&sc=1';
 
//$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=nl&tl=en&multires=1&otf=2&pc=1&ssel=0&tsel=0&sc=1';
 
$name_en = curl($url);
 
$name_en = explode('"',$name_en);
return  $name_en[1];
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php

//echo  Translate('कानूनी नोटिस: यह गूगल के अनुवादक सेवाओं की एक दुरुपयोग है, आप इस के लिए भुगतान करना होगा.');

echo  Translate('legal notice: This is an abuse of google translator services ,  you must pay for this.','en_to_hi');

?>
</body>
</html>
