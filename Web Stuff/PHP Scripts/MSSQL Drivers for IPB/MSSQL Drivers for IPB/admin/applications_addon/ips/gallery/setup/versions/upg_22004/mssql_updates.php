<?php

# Oracle don't like "size" so we'll switch to bsize
$SQL[] = "EXEC sp_rename 'gallery_bandwidth.size','bsize','COLUMN'";

?>