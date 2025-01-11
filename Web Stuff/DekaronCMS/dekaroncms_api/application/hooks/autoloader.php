<?php
function callAutoloader()
{
    spl_autoload_register('autoloadInterfaces');
}


function autoloadInterfaces($className)
{
    $filename = APPPATH . 'abstract/' . strtolower($className) . '.php';
    if (file_exists($filename)) {
        require_once  $filename;
    }
}  