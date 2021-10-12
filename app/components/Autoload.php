<?php

function autoload($classname) {

    $arrayPaths = [
        '/app/models/',
        '/app/controllers/',
        '/app/components/'
    ];

    foreach ($arrayPaths as $path) {
        $path = ROOT . $path . $classname . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}

spl_autoload_register('autoload');
