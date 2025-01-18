<?php
function bbcode($text){
$bbcode = array("&" => "&amp;",
"<" => "&lt;",
">" => "&gt;",
"\n" => "<br />",
"[b]" => "<b>",
"[/b]" => "</b>",
"[i]" => "<i>",
"[/i]" => "</i>",
"[u]" => "<u>",
"[/u]" => "</u>",
"[center]" => "<center>",
"[/center]" => "</center>",
);
$parsedtext = str_replace(array_keys($bbcode), array_values($bbcode), $text);
$bbcode = '/(\[url=)(.*)(\])(.*)(\[\/url\])/';  
$html = '<a href="${2}">${4}</a>';    
$parsedtext = preg_replace($bbcode, $html, $parsedtext);
return $parsedtext;
}
?>