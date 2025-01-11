<?php
ob_start();
$url = "http://www.dkunderground.org/forums/index.php?app=core&module=search&do=quick_search&search_filter_app[forums]=1&search_term=" . $_POST['onlinesearch'] . "";
?>
<!-- Histats.com  START  (standard)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<script  type="text/javascript" >
try {Histats.start(1,904297,4,0,0,0,"00000000");
Histats.track_hits();} catch(err){};
</script></a>
<!-- Histats.com  END  -->

<?php

header('Location: ' . $url);
die();
?>
