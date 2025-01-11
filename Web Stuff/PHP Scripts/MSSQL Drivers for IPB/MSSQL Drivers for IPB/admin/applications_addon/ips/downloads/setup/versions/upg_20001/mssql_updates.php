<?php

$SQL[] = "DELETE FROM core_sys_conf_settings WHERE conf_key='idm_progress_bar';";

$SQL[] = <<<EOF
INSERT INTO rc_classes (onoff, class_title, class_desc, author, author_url, pversion, my_class, group_can_report, mod_group_perm, extra_data, lockd) VALUES(1, 'IP.Downloads Plugin', 'This is the plugin for making reports for the <a href=''http://www.invisionpower.com/community/downloads/index.html'' target=''_blank''>IP.Downloads</a>.', 'Invision Power Services, Inc', 'http://invisionpower.com', 'v1.0', 'downloads', ',1,2,3,4,6,', ',4,6,', 'a:2:{s:15:"report_supermod";i:1;s:13:"report_bypass";i:1;}', 1);
EOF;

