<?php

$SQL[] = <<<EOF
DELETE FROM core_hooks WHERE hook_name='Gallery Images' AND ( hook_key ='');
EOF;
