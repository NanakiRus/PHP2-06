<?php

require_once __DIR__ . '/vendor/autoload.php';

function my_autoload($className)
{
    $filename = str_replace('\\', '/', $className) . '.php';
    $path = __DIR__ . '/' . $filename;
    if (file_exists($path)) {
        require $path;
    }
}

spl_autoload_register('my_autoload');