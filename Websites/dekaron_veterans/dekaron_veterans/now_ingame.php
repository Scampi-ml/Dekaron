<?php
$handle = "http://abnormal-dekaron.no-ip.org/index.php";
$html = file($handle);

$phrase  = strip_tags($html[222], '<td><table><tr><th><br>');
$healthy = array(
'Abnormal', 
'<p>', 
'</p>', 
'<td>',
'bordercolor="#FF6600"',
'bgcolor="#FFCC99"',
'width="70%"',
'<b>',
'Time ago',
'Character',
'Event',
'align="center"',
'<th>',
'</th>',
'height=25',
);

$yummy   = array(
'Veterans', 
'', 
'', 
'<td class="d_gary">',
'',
'',
'width="100%"',
'',
'<b>Time Ago</b>',
'<b>Character Name</b>',
'<b>Event</b>',
'',
'<td class="d_gary"><b>',
'</b></td>',
'height=40',
);

$newphrase = str_replace($healthy, $yummy, $phrase);

echo $newphrase;



