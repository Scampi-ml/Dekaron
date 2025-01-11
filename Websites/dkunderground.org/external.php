<?php
ob_start();

//--------------- GET THE PAGE ---------------------
$external = $_GET['page'];

if ($external == "")
{
	echo "I have no idea how to redirect you.";
}

if ($external == "install")
{
	header('Location: http://www.dkunderground.org/forums/topic/177-installation-guide/');
}

if ($external == "support")
{
	header('Location: http://www.dkunderground.org/forums/tracker/project-1-osds-v4/');
}

if ($external == "forums")
{
	header('Location: http://www.dkunderground.org/forums/');
}

if ($external == "homepage")
{
	header('Location: http://www.dkunderground.org/');
}

echo "What do you expect to see here?"; 
?>
<!-- Histats.com  START (hidden counter)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="web page hit counter" ><script  type="text/javascript" >
try {Histats.start(1,904297,4,0,0,0,"");
Histats.track_hits();} catch(err){};
</script></a>
<noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?904297&101" alt="web page hit counter" border="0"></a></noscript>
<!-- Histats.com  END  -->