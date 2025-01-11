<?php

$SQL[] = "CREATE INDEX public_album ON gallery_albums (public_album)";
$SQL[] = "CREATE INDEX album_id ON gallery_images (album_id)";
$SQL[] = "CREATE INDEX member_id ON gallery_images (member_id)";

?>