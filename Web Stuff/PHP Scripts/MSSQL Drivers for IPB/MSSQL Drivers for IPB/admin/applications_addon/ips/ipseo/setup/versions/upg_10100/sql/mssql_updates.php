<?php

// Add comment_approved for new comments functionality:
$SQL   = array();
$SQL[] = "UPDATE task_manager SET task_enabled = 1, task_locked = 0 WHERE task_key IN ('ipseo_sitemap_generator', 'ipseo_daily_clean')";