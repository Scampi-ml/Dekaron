<?php
$QUERY[] = "DELETE FROM core_incoming_emails WHERE rule_app='nexus';";
$QUERY[] = "UPDATE core_sys_settings_titles SET conf_title_noshow=0 WHERE conf_title_keyword='adcodeintegration'";